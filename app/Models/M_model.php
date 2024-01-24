<?php namespace App\Models;

use CodeIgniter\Model;

class M_model extends Model
{
    public function tampil($table) {
        return $this->db->table($table)
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->getResult();
    }
    
    
    public function geta()
    {
        return $this->findAll();
    }
    public function hapus($table, $where){
        return $this->db->table($table)->delete($where);
    }
    public function simpan($table, $data){
        return $this->db->table($table)->insert($data);
    }
    public function getWhere($table, $where){
        return $this->db->table($table)->getWhere($where)->getRow();
    }
    public function qedit($table, $data, $where){
        return $this->db->table($table)->update($data, $where);
    }

    public function join2($table1, $table2, $on){
        return $this->db->table($table1)
                        ->join($table2, $on, 'left')
                        ->orderBy("$table2.created_at", 'desc') 
                        ->get()
                        ->getResult();
    }
    public function joinuser($table1, $table2, $on){
        return $this->db->table($table1)
                        ->join($table2, $on, 'left')
                        ->orderBy("$table1.created_at", 'desc') 
                        ->get()
                        ->getResult();
    }
    
    public function join_with_user_id($table1, $table2, $on, $user_id) {
        return $this->db->table($table1)
                        ->join($table2, $on, 'left')
                        ->where("$table1.user", $user_id) 
                        ->get()
                        ->getResult();
    }
    
    public function joinaa($table1, $table2, $on, $where = array()){
        return $this->db->table($table1)
            ->join($table2, $on, 'left')
            ->where($where)
            ->get()
            ->getResult();
    }
    public function getPemesananById($id_pemesanan)
    {
        return $this->db->table('pemesanan')->where('id_pemesanan', $id_pemesanan)->get()->getRow();
    }
    public function getPelajaranById($id_pel)
{
    return $this->db->table('bayar')->where('id_bayar', $id_bayar)->get()->getRow();
}
    
    public function getWhere2($table, $where){
        return $this->db->table($table)->getWhere($where)->getRowArray();
    }
    public function join3($table1, $table2,$table3, $on,$on1){
        return $this->db->table($table1)
        ->join($table2, $on, 'left')
        ->join($table3, $on1, 'left')
        ->get()
        ->getResult();
    }
    public function join4($table1, $table2, $table3, $table4, $on1, $on2, $on3)
    {
        $builder = $this->db->table($table1);
        $builder->select('*');
        $builder->join($table2, $on1);
        $builder->join($table3, $on2);
        $builder->join($table4, $on3);
    
        
        // Add the WHERE clause for deleted_at for each table
        $builder->where("$table1.deleted_at IS NULL");
        $builder->where("$table2.deleted_at IS NULL");
        $builder->where("$table3.deleted_at IS NULL");
        $builder->where("$table4.deleted_at IS NULL");
        
        
        $query = $builder->get();
        return $query->getResult();
    }
    

public function joint($table1, $table2, $on, $userLevel, $userId){
    $query = $this->db->table($table1)
                     ->join($table2, $on, 'left');

    // For levels 1 to 4, allow them to see all data
    if ($userLevel >= 1 && $userLevel <= 4) {
        $query->where('pembayaran.deleted_at', null);
    } elseif ($userLevel == 5) {
        // For level 5, only show their own payment data (user_id in siswa should match the logged-in user's ID)
        $query->where('siswa.user', $userId)
              ->where('pembayaran.deleted_at', null);
    } else {
        // Invalid user level, return an empty result or handle the error accordingly
        return [];
    }

    return $query->get()->getResult();
}

    public function joiny($table1, $table2, $on){
        return $this->db->table('pengeluaran')
        ->join('siswa', 'pengeluaran.siswa = siswa.id_siswa', 'left')
        ->where('pengeluaran.deleted_at', null)
        ->where('siswa.deleted_at', null)
        ->get()
        ->getResult();
    }
    public function filter2($table, $awal, $akhir)
    {
        return $this->db->query("
            SELECT *
            FROM ".$table."
            WHERE ".$table.".tanggal BETWEEN '".$awal."' AND '".$akhir."'
        ")->getResult();
    }
    public function filter_hadir($table, $tanggal)
    {
        return $this->db->query("
            SELECT *
            FROM " . $table . "
            LEFT JOIN siswa ON " . $table . ".siswa = siswa.id_siswa
            WHERE " . $table . ".tanggal = '" . $tanggal . "'
        ")->getResult();
    }
    public function filter_hadir_e($table, $tanggal)
    {
        return $this->db->query("
            SELECT *
            FROM " . $table . "
            LEFT JOIN siswa ON " . $table . ".siswa = siswa.id_siswa
            LEFT JOIN mapel ON " . $table . ".mapel = mapel.id_mapel
            WHERE " . $table . ".tanggal = '" . $tanggal . "'
            ORDER BY sesi ASC
        ")->getResult();
    }
    
    
    public function filter_hadir_guru($table, $tanggal, $id_user)
    {
        $builder = $this->db->table($table);
        $builder->select('*');
        $builder->join('siswa', $table . '.siswa = siswa.id_siswa', 'left');
        $builder->join('kelas as kelas_siswa', 'siswa.kelas = kelas_siswa.id_kelas', 'left');
        $builder->join('guru', 'kelas_siswa.id_kelas = guru.kelas', 'left');
        $builder->where('guru.user', $id_user);
        $builder->where($table . '.tanggal', $tanggal);
        $builder->orderBy($table . '.created_at', 'desc');
    
        $query = $builder->get();
        return $query->getResult();
    }
    public function filter_hadir_guru_e($table, $tanggal, $id_user)
    {
        $builder = $this->db->table($table);
        $builder->select('*');
        $builder->join('siswa', $table . '.siswa = siswa.id_siswa', 'left');
        $builder->join('mapel', $table . '.mapel = mapel.id_mapel');
        $builder->join('kelas as kelas_siswa', 'siswa.kelas = kelas_siswa.id_kelas', 'left');
        $builder->join('guru', 'kelas_siswa.id_kelas = guru.kelas', 'left');
        $builder->where('guru.user', $id_user);
        $builder->where($table . '.tanggal', $tanggal);
        $builder->orderBy($table . '.sesi', 'asc');
    
        $query = $builder->get();
        return $query->getResult();
    }
    public function filterrr($table, $awal, $akhir)
{
    return $this->db->query("
        SELECT *
        FROM ".$table."
        INNER JOIN siswa ON ".$table.".siswa = siswa.id_siswa
        WHERE ".$table.".tanggal BETWEEN '".$awal."' AND '".$akhir."'
    ")->getResult();
}
    public function getPaymentDataBySiswaId($id_siswa)
    {
        return $this->db->table('pembayaran')
            ->join('siswa', 'pembayaran.siswa = siswa.id_siswa', 'left')
            ->where('pembayaran.siswa', $id_siswa)
            ->where('pembayaran.deleted_at', null)
            ->where('siswa.deleted_at', null)
            ->where('pembayaran.status', 'Uang-Kas') // Add this line to filter by 'Uang-Kas' status
            ->where('pembayaran.status2', 'Lunas')    // Add this line to filter by 'Lunas' status
            ->get()
            ->getResult();
    }
    public function getPaymenttDataBySiswaId($id_siswa)
    {
        return $this->db->table('pembayaran')
            ->join('siswa', 'pembayaran.siswa = siswa.id_siswa', 'left')
            ->where('pembayaran.siswa', $id_siswa)
            ->where('pembayaran.deleted_at', null)
            ->where('siswa.deleted_at', null)
            ->where('pembayaran.status', 'Uang-Kas') // Add this line to filter by 'Uang-Kas' status
            ->where('pembayaran.status2', 'Belum-Lunas')    // Add this line to filter by 'Lunas' status
            ->get()
            ->getResult();
    }
    public function getdenda($id_siswa)
    {
        return $this->db->table('pembayaran')
            ->join('siswa', 'pembayaran.siswa = siswa.id_siswa', 'left')
            ->where('pembayaran.siswa', $id_siswa)
            ->where('pembayaran.deleted_at', null)
            ->where('siswa.deleted_at', null)
            ->where('pembayaran.status', 'Uang-Denda') // Add this line to filter by 'Uang-Kas' status
            ->where('pembayaran.status2', 'Lunas')    // Add this line to filter by 'Lunas' status
            ->get()
            ->getResult();
    }
    
    public function getdendaa($id_siswa)
    {
        return $this->db->table('pembayaran')
            ->join('siswa', 'pembayaran.siswa = siswa.id_siswa', 'left')
            ->where('pembayaran.siswa', $id_siswa)
            ->where('pembayaran.deleted_at', null)
            ->where('siswa.deleted_at', null)
            ->where('pembayaran.status', 'Uang-Denda') // Add this line to filter by 'Uang-Kas' status
            ->where('pembayaran.status2', 'Belum-Lunas')    // Add this line to filter by 'Lunas' status
            ->get()
            ->getResult();
    }

public function getSiswaWithConditions($on, $on1, $on2, $id_guru)
{
    $query = $this->db->table('siswa')
        ->join('kelas', $on)
        ->join('jurusan', $on1)
        ->join('rombel', $on2)
        ->where('rombel.guru', $id_guru) 
        ->get()
        ->getResult();
}


public function getGuruByUserId($id_user)
{

    $query = $this->db->table('guru')
        ->where('user', $id_user)
        ->get();
    return $query->getRowArray();
}
public function join4_where($table1, $table2, $table3, $table4, $on1, $on2, $on3, $where)
    {
        $builder = $this->db->table($table1);
        $builder->select('*');
        $builder->join($table2, $on1);
        $builder->join($table3, $on2);
        $builder->join($table4, $on3);
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult();
    }
    public function getSiswaByGuruId($id_user)
{
    $builder = $this->db->table('siswa');
    $builder->select('*');
    $builder->join('kelas as kelas_siswa', 'siswa.kelas = kelas_siswa.id_kelas');
    $builder->join('guru', 'kelas_siswa.id_kelas = guru.kelas');
    $builder->where('guru.user', $id_user);
    $builder->orderBy('siswa.created_at', 'desc');

    $query = $builder->get();
    return $query->getResult();
}
public function getSiswaBySiswaId($id_user)
{
    $builder = $this->db->table('siswa');
    $builder->select(['siswa.*', 'kelas.nama_kelas']);
    $builder->join('kelas', 'siswa.kelas = kelas.id_kelas');
    
    // Ambil ID kelas siswa yang login
    $kelasSiswa = $builder->where('siswa.user', $id_user)->get()->getRow();
    $id_kelas_siswa = $kelasSiswa->kelas;
    
    // Sekarang gunakan ID kelas siswa untuk mengambil semua siswa dengan kelas yang sama
    $builder->resetQuery();
    $builder->select(['siswa.*', 'kelas.nama_kelas']);
    $builder->join('kelas', 'siswa.kelas = kelas.id_kelas');
    $builder->where('siswa.kelas', $id_kelas_siswa);
    $builder->orderBy('siswa.created_at', 'desc');
    
    $query = $builder->get();
    return $query->getResult();
}

public function getSiswaBySiswaIdd($id_user)
{
    $builder = $this->db->table('hadir');
    $builder->select('*');
    
    // Dapatkan ID kelas siswa yang login
    $kelasSiswa = $this->db->table('siswa')
        ->select('kelas')
        ->where('user', $id_user)
        ->get()
        ->getRow();
    $id_kelas_siswa = $kelasSiswa->kelas;

    // Gabungkan tabel hadir dengan tabel siswa berdasarkan kelas yang sama
    $builder->join('siswa', 'hadir.siswa = siswa.id_siswa');
    $builder->where('siswa.kelas', $id_kelas_siswa);
    $builder->orderBy('hadir.created_at', 'desc');

    $query = $builder->get();
    return $query->getResult();
}
public function filter_hadir_siswa($table, $tanggal, $id_user)
{
    $builder = $this->db->table($table);
    $builder->select('*');
   
    // Dapatkan ID kelas siswa yang login
    $kelasSiswa = $this->db->table('siswa')
        ->select('kelas')
        ->where('user', $id_user)
        ->get()
        ->getRow();
    $id_kelas_siswa = $kelasSiswa->kelas;

    // Gabungkan tabel hadir dengan tabel siswa berdasarkan kelas yang sama
    $builder->join('siswa', $table . '.siswa = siswa.id_siswa');
    $builder->where('siswa.kelas', $id_kelas_siswa);
    $builder->where($table . '.tanggal', $tanggal);
    $builder->orderBy($table . '.created_at', 'desc');

    $query = $builder->get();
    return $query->getResult();
}
public function filter_hadir_siswa_e($table, $tanggal, $id_user)
{
    $builder = $this->db->table($table);
    $builder->select('*');

    // Dapatkan ID kelas siswa yang login
    $kelasSiswa = $this->db->table('siswa')
        ->select('kelas')
        ->where('user', $id_user)
        ->get()
        ->getRow();
    $id_kelas_siswa = $kelasSiswa->kelas;

    // Gabungkan tabel hadir dengan tabel siswa berdasarkan kelas yang sama
    $builder->join('siswa', $table . '.siswa = siswa.id_siswa');
    $builder->join('mapel', $table . '.mapel = mapel.id_mapel');
    $builder->where('siswa.kelas', $id_kelas_siswa);
    $builder->where($table . '.tanggal', $tanggal);
    $builder->orderBy($table . '.sesi', 'asc');

    $query = $builder->get();
    return $query->getResult();
}
public function getSiswaBySiswaIId($id_user)
{
    $builder = $this->db->table('pelajaran');
    $builder->select('*');
    
    // Dapatkan ID kelas siswa yang login
    $kelasSiswa = $this->db->table('siswa')
        ->select('kelas')
        ->where('user', $id_user)
        ->get()
        ->getRow();
    $id_kelas_siswa = $kelasSiswa->kelas;

    $builder->join('mapel', 'pelajaran.mapel = mapel.id_mapel');
    $builder->join('siswa', 'pelajaran.siswa = siswa.id_siswa', 'left');
    $builder->where('siswa.kelas', $id_kelas_siswa);
    $builder->orderBy('pelajaran.created_at', 'desc');

    $query = $builder->get();
    return $query->getResult();
}
public function getSiswaByGuruId2($id_user)
{
    $builder = $this->db->table('siswa');
    $builder->select('*');
    $builder->join('kelas as kelas_siswa', 'siswa.kelas = kelas_siswa.id_kelas');
    $builder->join('guru', 'kelas_siswa.id_kelas = guru.kelas');
    $builder->join('user', 'siswa.user = user.id_user'); // Menambahkan join ke tabel users
    $builder->where('user.level', 4); // Menambahkan kondisi WHERE untuk level pengguna
    $builder->where('guru.user', $id_user);
    $builder->orderBy('siswa.created_at', 'desc');

    $query = $builder->get();
    return $query->getResult();
}
public function getSiswaByGuruIdd($id_user)
{
    $builder = $this->db->table('hadir');
    $builder->select('*');
    $builder->join('siswa', 'hadir.siswa = siswa.id_siswa');
    $builder->join('kelas as kelas_siswa', 'siswa.kelas = kelas_siswa.id_kelas');
    $builder->join('guru', 'kelas_siswa.id_kelas = guru.kelas');
    $builder->where('guru.user', $id_user);
    $builder->orderBy('hadir.created_at', 'desc');

    $query = $builder->get();
    return $query->getResult();
}
public function getSiswaByGuruIId($id_user)
{
    $builder = $this->db->table('pelajaran');
    $builder->select('*');
    $builder->join('siswa', 'pelajaran.siswa = siswa.id_siswa', 'left');
    $builder->join('mapel', 'pelajaran.mapel = mapel.id_mapel');
    $builder->join('kelas as kelas_siswa', 'siswa.kelas = kelas_siswa.id_kelas');
    $builder->join('guru', 'kelas_siswa.id_kelas = guru.kelas');
    $builder->where('guru.user', $id_user);
    $builder->orderBy('pelajaran.created_at', 'desc');

    $query = $builder->get();
    return $query->getResult();
}

    public function getAllPaymentData()
{
    $builder = $this->db->table('pembayaran');
    $builder->select('*');
    $builder->join('siswa', 'pembayaran.siswa = siswa.id_siswa');
    $builder->where('pembayaran.deleted_at IS NULL'); // Hanya data yang belum dihapus

    $query = $builder->get();
    return $query->getResult();
}

    public function getAllPData()
    {
        $builder = $this->db->table('siswa');
        $builder->select('*');
        $builder->join('kelas', 'siswa.kelas = kelas.id_kelas');
        
        $builder->orderBy('siswa.created_at', 'desc');

        $query = $builder->get();
        return $query->getResult();
    }
    public function getAllPDatta()
    {
        $builder = $this->db->table('pelajaran');
        $builder->select('*');
        $builder->join('siswa', 'pelajaran.siswa = siswa.id_siswa', 'left');
        $builder->join('mapel', 'pelajaran.mapel = mapel.id_mapel');
        
        $builder->orderBy('pelajaran.created_at', 'desc');
    
        $query = $builder->get();
        return $query->getResult();
    }
    public function getAllPDataa()
    {
        $builder = $this->db->table('hadir');
        $builder->select('*');
        $builder->join('siswa', 'hadir.siswa = siswa.id_siswa');
        
        $builder->orderBy('hadir.created_at', 'desc');

        $query = $builder->get();
        return $query->getResult();
    }
    public function getAllPData2()
    {
        $builder = $this->db->table('siswa');
        $builder->select('*');
        $builder->join('kelas', 'siswa.kelas = kelas.id_kelas');
        $builder->join('user', 'siswa.user = user.id_user'); // Menambahkan join ke tabel users
        $builder->where('user.level', 4);
        $builder->orderBy('siswa.created_at', 'desc');

        $query = $builder->get();
        return $query->getResult();
    }
    public function getPaymentDataByUserId($id_user)
    {
        $builder = $this->db->table('pembayaran');
        $builder->select('*');
        $builder->join('siswa', 'pembayaran.siswa = siswa.id_siswa');
        $builder->join('rombel', 'siswa.rombel = rombel.id_rombel');
        $builder->join('guru', 'rombel.guru = guru.id_guru'); // Menyambungkan guru dengan rombel berdasarkan ID user guru.
        $builder->where('guru.user', $id_user); // Memfilter siswa berdasarkan ID user guru yang masuk.

        $query = $builder->get();
        return $query->getResult();
    }

    public function getPaymentDataByLoggedInStudent($userId)
{
    // Mengambil informasi rombel siswa yang sedang login
    $builder = $this->db->table('siswa');
    $builder->select('rombel');
    $builder->where('user', $userId);
    
    $query = $builder->get();
    $result = $query->getRow();

    if ($result) {
        // Mengambil data pembayaran berdasarkan rombel siswa yang login
        $builder = $this->db->table('pembayaran');
        $builder->select('*');
        $builder->join('siswa', 'pembayaran.siswa = siswa.id_siswa');
        $builder->join('rombel', 'siswa.rombel = rombel.id_rombel');
        $builder->where('siswa.rombel', $result->rombel); // Menggunakan informasi rombel
        
        $query = $builder->get();
        return $query->getResult();
    }

    return []; // Mengembalikan array kosong jika data siswa tidak ditemukan
}
public function getPaymentDataByLoggedInStudentpem($userId)
{
    // Mengambil informasi rombel siswa yang sedang login
    $builder = $this->db->table('siswa');
    $builder->select('rombel');
    $builder->where('user', $userId);
    
    $query = $builder->get();
    $result = $query->getRow();

    if ($result) {
        // Mengambil data siswa berdasarkan rombel siswa yang login
        $builder = $this->db->table('siswa');
        $builder->select('*');
        $builder->join('kelas', 'siswa.kelas = kelas.id_kelas');
        $builder->join('jurusan', 'siswa.jurusan = jurusan.id_jurusan');
        $builder->join('rombel', 'siswa.rombel = rombel.id_rombel');
        $builder->where('rombel.id_rombel', $result->rombel);
        $builder->where('siswa.deleted_at', null); // Menggunakan informasi rombel
        
        $query = $builder->get();
        return $query->getResult();
    }

    return []; // Mengembalikan array kosong jika data siswa tidak ditemukan
}
public function getPaymentDataByLoggedInStudentpen($userId)
{
    $builder = $this->db->table('siswa');
    $builder->select('rombel');
    $builder->where('user', $userId);
    
    $query = $builder->get();
    $result = $query->getRow();

    if ($result) {
        // Mengambil data siswa berdasarkan rombel siswa yang login
        $builder = $this->db->table('siswa');
        $builder->select('*');
        $builder->join('kelas', 'siswa.kelas = kelas.id_kelas');
        $builder->join('jurusan', 'siswa.jurusan = jurusan.id_jurusan');
        $builder->join('rombel', 'siswa.rombel = rombel.id_rombel');
        $builder->where('rombel.id_rombel', $result->rombel);
        $builder->where('siswa.deleted_at', null); // Menggunakan informasi rombel
        
        $query = $builder->get();
        return $query->getResult();
    }

    return []; // Mengembalikan array kosong jika data siswa tidak ditemukan
}

public function getPaymentDataByLoggedInStudentt($userId)
{
  
    $builder = $this->db->table('siswa');
    $builder->select('rombel');
    $builder->where('user', $userId);
    
    $query = $builder->get();
    $result = $query->getRow();

    if ($result) {
        // Mengambil data pembayaran berdasarkan rombel siswa yang login
        $builder = $this->db->table('pengeluaran');
        $builder->select('*');
        $builder->join('siswa', 'pengeluaran.siswa = siswa.id_siswa');
        $builder->join('rombel', 'siswa.rombel = rombel.id_rombel');
        $builder->where('siswa.rombel', $result->rombel); // Menggunakan informasi rombel
        
        $query = $builder->get();
        return $query->getResult();
    }

    return []; // Mengembalikan array kosong jika data siswa tidak ditemukan
}
    public function getPaymentDataByUserIdd($id_user)
    {
        $builder = $this->db->table('pengeluaran');
        $builder->select('*');
        $builder->join('siswa', 'pengeluaran.siswa = siswa.id_siswa');
        $builder->join('rombel', 'siswa.rombel = rombel.id_rombel');
        $builder->join('guru', 'rombel.guru = guru.id_guru'); // Menyambungkan guru dengan rombel berdasarkan ID user guru.
        $builder->where('guru.user', $id_user); // Memfilter siswa berdasarkan ID user guru yang masuk.

        $query = $builder->get();
        return $query->getResult();
    }
    public function getAllPaymentDataa()
    {
        $builder = $this->db->table('pengeluaran');
        $builder->select('*');
        $builder->join('siswa', 'pengeluaran.siswa = siswa.id_siswa');
        $builder->where('pengeluaran.deleted_at IS NULL');

        $query = $builder->get();
        return $query->getResult();
    }


    

  
}