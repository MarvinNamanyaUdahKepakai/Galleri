<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\M_model;
use TCPDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Teacher_model;




class Home extends BaseController
{
    public function index()
    {
        
            $num1 = rand(1, 10);
            $num2 = rand(1, 10);
            echo view('login', ['num1' => $num1, 'num2' => $num2]);

    
}
public function aksi_login()
{
    $u = $this->request->getPost('username');
    $p = $this->request->getPost('password');
    $num1 = $this->request->getPost('num1'); // Get the first number from the form
    $num2 = $this->request->getPost('num2'); // Get the second number from the form
    $captchaAnswer = $this->request->getPost('captcha_answer'); // Get captcha answer from the form

    // Check if the CAPTCHA answer is empty
    if (empty($captchaAnswer)) {
        echo '<script>alert("Please enter the CAPTCHA answer."); window.location.href = "' . base_url('/Home') . '";</script>';
        return;
    }

    // Verify CAPTCHA answer
    $correctAnswer = $num1 + $num2;
    if ($captchaAnswer != $correctAnswer) {
        echo '<script>alert("Incorrect CAPTCHA answer. Please try again."); window.location.href = "' . base_url('/Home') . '";</script>';
        return;
    }

    // Proceed with login
    $model = new M_model();
    $data = array(
        'username' => $u,
        'password' => md5($p)
    );
    $cek = $model->getWhere2('user', $data);
    if ($cek > 0) {
        session()->set('id', $cek['id_user']);
        session()->set('username', $cek['username']);
        session()->set('level', $cek['level']);
        return redirect()->to('/Home/dashboard');
    } else {
        return redirect()->to('/Home');
    }
}

public function penguna()
    {
        if(session()->get('id')>0) {
            $model=new M_model();
            $on='penguna.user=user.id_user';
            $diva['okta'] = $model->join2('penguna', 'user',$on);
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            echo view('header',$data);
            echo view('menu');
            echo view('penguna',$diva);
            echo view('footer');
        }else{
            return redirect()->to('/Home');
    }   
}

public function hapus_penguna($id)
{
    $model = new M_model(); // Change 'm_model' to 'M_model'
    $where = array('user' => $id);
    $where2 = array('id_user' => $id);
    $model->hapus('penguna', $where);
    $model->hapus('user', $where2);

    $data2 = array(
        'id_user' => session()->get('id'),
        'aktiviti' =>"Menghapus Penguna dengan Id ".$id."",
        'waktu' => date('Y-m-d H:i:s')
       
    );
     $model->simpan('log', $data2);

    return redirect()->to('/Home/penguna');


}

public function tambah_penguna()
    {
        
        $model=new m_model();
                
        $diva['okta'] = $model->tampil('level');
        echo view('tambah_penguna', $diva);
     
       
    
    }

    public function aksi_tambah_penguna()
{
    $a = $this->request->getPost('username');
    $f = $this->request->getPost('password');
    $level = $this->request->getPost('level');
    $nama = $this->request->getPost('nama');
    $ttl = $this->request->getPost('ttl');
    $jk = $this->request->getPost('jk');
    $alamat = $this->request->getPost('alamat');
    $nohp = $this->request->getPost('nohp');
    //  $foto= $this->request->getFile('foto');
    //     if($foto->isValid() && ! $foto->hasMoved())
    //     {
    //         $imageName = $foto->getName();
    //         $foto->move('images/',$imageName);
    //     }

    $data1 = array(
        'username' => $a,
        'password' => md5($f),
        'level' => '4',
        // 'foto' => $imageName
    );

    $darrel = new M_model();
    $darrel->simpan('user', $data1);

    $where = array('username' => $a);
    $ayu = $darrel->getWhere2('user', $where);
    $id = $ayu['id_user'];

    $data2 = array(
        'nama' => $nama,
        'ttl' => $ttl,
        'jk' => $jk,
        'alamat' => $alamat,
        'nohp' => $nohp,
        'user' => $id
    );

    $darrel->simpan('penguna', $data2);
    

    $data2 = array(
        'id_user' => session()->get('id'),
        'aktiviti' =>"Menambah Penguna ".$a."",
        'waktu' => date('Y-m-d H:i:s')
       
    );
     $darrel->simpan('log', $data2);


    return redirect()->to('/Home/penguna');
}

public function edit_penguna($user)
    {
        if(session()->get('id')>0){
        $model=new M_model();

        $where=array('user'=>$user);
        $where2=array('id_user'=>$user);
        $data['jess']=$model->tampil('level');
        $data['jojo']=$model->getWhere('penguna',$where);
        $data['rizkan']=$model->getWhere('user',$where2);
        echo view('header');
        echo view('menu');
        echo view('edit_penguna',$data);
        echo view('footer');
        }else{
            return redirect()->to('/Home/penguna');

        }
    }
    public function aksi_edit_penguna()
    {
        $a= $this->request->getPost('username');
        $b= $this->request->getPost('password');
        $level= $this->request->getPost('level');
        $nama= $this->request->getPost('nama');
        $ttl= $this->request->getPost('ttl');
        $jk= $this->request->getPost('jk');
        $alamat= $this->request->getPost('alamat');
        $nohp= $this->request->getPost('nohp');
        $id= $this->request->getPost('id');
        $id2= $this->request->getPost('id2');


        $where=array('id_user'=>$id);
        $data1=array(
            'username'=>$a,
            'password'=>$b,
            'level'=>$level,
             'created_at'=>date('Y-m-d-H:i:s')
            
        );
        $darrel=new M_model();
        $darrel->qedit('user', $data1, $where);
        
        $where2=array('user'=>$id2);
        $data2=array(
            'nama'=>$nama,
            'ttl'=>$ttl,
            'jk'=>$jk,
            'alamat'=>$alamat,
            'nohp'=>$nohp,
             'created_at'=>date('Y-m-d-H:i:s')
        );
        $model=new M_model();
   
        $darrel->qedit('penguna', $data2,$where2);

        return redirect()->to('/Home/penguna');

    }

    public function reset_password($id)
    {
        if(session()->get('id')>0) {
            $okta=new M_model();
            $where=array('id_user'=>$id);
            $user=array('password'=>md5('12345'));
            $okta->qedit('user', $user, $where);

            echo view('header');
            echo view('menu');
            echo view('footer');

            return redirect()->to('/Home/user');
        }else {
            return redirect()->to('home');

        }
    }

    public function log_out()
    {

        session()->destroy();
        return redirect()->to('Home');
    }

    
   public function dashboard()
    {
        if (session()->get('id') > 0) {
            $model=new M_model();
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            echo view('header');
            echo view('menu',$data);

            $teacherModel = new Teacher_model(); // Buat objek model
            $teacherCount = $teacherModel->getTeacherCount(); // Panggil metode model

            echo view('dashboard', ['teacherCount' => $teacherCount]);
            echo view('footer');
        } else {
            return redirect()->to('/');
        }
    }
    public function user()
{
    if (session()->get('id') > 0) {
        $model = new M_model();
        $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $on = 'user.level = level.id_level';
        $diva['okta'] = $model->join2('user', 'level', $on);

        $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));

        echo view('header');
        echo view('menu',$data);
        echo view('user', $diva);
        echo view('footer');
    } else {
        return redirect()->to('/Home/');
    }
}

public function petugas()
    {
        if(session()->get('id')>0) {
            $model=new M_model();
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            $on='petugas.user=user.id_user';
            $diva['okta'] = $model->join2('petugas', 'user',$on);
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            echo view('header',$data);
            echo view('menu',$data );
            echo view('petugas',$diva);
            echo view('footer');
        }else{
            return redirect()->to('/Home');
    }   
}

public function hapus_petugas($id)
{
    $model = new M_model(); 
    $where = array('user' => $id);
    $where2 = array('id_user' => $id);
    $model->hapus('petugas', $where);
    $model->hapus('user', $where2);

    $data2 = array(
        'id_user' => session()->get('id'),
        'aktiviti' =>"Menghapus petugas dengan Id ".$id."",
        'waktu' => date('Y-m-d H:i:s')
       
    );
     $model->simpan('log', $data2);

    return redirect()->to('/Home/petugas');


}

public function tambah_petugas()
    {
        if(session()->get('id')>0) {
        $model=new m_model();
        $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        echo view('header');
        echo view('menu',$data);
        $diva['okta'] = $model->tampil('level');
        

        return view('tambah_petugas', $diva);
        echo view('footer');
        }else{
            return redirect()->to('/Home');
        }
        
    
    }

    public function aksi_tambah_petugas()
{
    $a = $this->request->getPost('username');
    $f = $this->request->getPost('password');
    $level = $this->request->getPost('level');
    $nama_petugas = $this->request->getPost('nama_petugas');
    $jk = $this->request->getPost('jk');
    $ttl = $this->request->getPost('ttl');
    $nohp = $this->request->getPost('nohp');
    $nik = $this->request->getPost('nik');
     $foto= $this->request->getFile('foto');
        if($foto->isValid() && ! $foto->hasMoved())
        {
            $imageName = $foto->getName();
            $foto->move('images/',$imageName);
        }


    $data1 = array(
        'username' => $a,
        'password' =>md5($f),
        'level' => '2',
        'foto' => $imageName,
        'created_at'=>date('Y-m-d-H:i:s')
    );

    $darrel = new M_model();
    $darrel->simpan('user', $data1);

    $where = array('username' => $a);
    $ayu = $darrel->getWhere2('user', $where);
    $id = $ayu['id_user'];

    $data2 = array(
        'nama_petugas' => $nama_petugas,
        'jk' => $jk,
        'ttl' => $ttl,
        'nohp' => $nohp,
        'nik' => $nik,
        'created_at'=>date('Y-m-d-H:i:s'),
        'user' => $id
    );

    $darrel->simpan('petugas', $data2);

    return redirect()->to('/Home/petugas');
}

public function edit_petugas($user)
    {
        if(session()->get('id')>0){
        $model=new M_model();
        $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $where=array('user'=>$user);
        $where2=array('id_user'=>$user);
        $data['jess']=$model->tampil('level');
        $data['jojo']=$model->getWhere('petugas',$where);
        $data['rizkan']=$model->getWhere('user',$where2);
        echo view('header');
        echo view('menu',$data);
        echo view('edit_petugas',$data);
        echo view('footer');
        }else{
            return redirect()->to('/Home/petugas');

        }
    }
    public function aksi_edit_petugas()
    {
        $a= $this->request->getPost('username');
        $b= $this->request->getPost('password');
        $level= $this->request->getPost('level');
        $nama_petugas= $this->request->getPost('nama_petugas');
        $jk= $this->request->getPost('jk');
        $ttl= $this->request->getPost('ttl');
        $nohp= $this->request->getPost('nohp');
        $nik= $this->request->getPost('nik');
       
        $id= $this->request->getPost('id');
        $id2= $this->request->getPost('id2');

        $where=array('id_user'=>$id);
        $data1=array(
            'username'=>$a,
           'password' =>md5($f),
            'level'=>'2',

        );
        $darrel=new M_model();
        $darrel->qedit('user', $data1, $where);
        
        $where2=array('user'=>$id2);
        $data2=array(
            'nama_petugas'=>$nama_petugas,
            'jk'=>$jk,
            'ttl'=>$ttl,
            'nohp'=>$nohp,
            'nik'=>$nik
            
        );
        $darrel->qedit('petugas', $data2,$where2);

        return redirect()->to('/Home/petugas');

    }

   

 public function barang()
    {
        // if(session()->get('id')>0) {
            $model=new M_model();
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            $diva['okta'] = $model->tampil('barang');
            echo view('header');
            echo view('menu',$data);
            echo view('barang',$diva);
            echo view('footer');
        // }else{
            // return redirect()->to('/Home/guru');
    }

     public function tambah_barang()
    {
        // if(session()->get('id')>0) {
        $model=new m_model();
         $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        echo view('header');
        echo view('menu',$data);
        $diva['okta'] = $model->tampil('barang');
        return view('tambah_barang', $diva);
        echo view('footer');
        // }else{
        //  return redirect()->to('/Home');
        // }
        
    
    }

    public function aksi_tambah_barang()
    {
        $a=$this->request->getPost('id_barang');
        $b=$this->request->getPost('nama_brg');
        $c=$this->request->getPost('kode_brg');
        $d=$this->request->getPost('stock');
        $e=$this->request->getPost('harga');
        $foto= $this->request->getFile('foto');
        if($foto->isValid() && ! $foto->hasMoved())
        {
            $imageName = $foto->getName();
            $foto->move('images/',$imageName);
        }


        
        
        $simpan=array(
            'id_barang'=>$a,
            'nama_brg'=>$b,
            'kode_brg'=>$c,
            'stock'=>$d,
            'harga'=>$e,
            'foto' => $imageName,
            'created_at'=>date('Y-m-d-H:i:s')
            
        );
        $model=new M_model();
        $model->simpan('barang',$simpan);
        return redirect()->to('/Home/barang');
    }

      public function hapus_barang($id)
    {
        $model=new m_model();
        $where=array('id_barang'=>$id);
        echo view('header');
            echo view('menu');
            echo view('footer');
        $model->hapus('barang',$where);
         $data2 = array(
        'id_user' => session()->get('id'),
        'aktiviti' =>"Menghapus rw dengan Id ".$id."",
        'waktu' => date('Y-m-d H:i:s')
       
    );
     $model->simpan('log', $data2);
        return redirect()->to('/Home/barang');
    }

     public function edit_barang($id)
    {
       
        $model=new m_model();
         $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $where=array('id_barang'=>$id);
        echo view('header');
        echo view('menu',$data);
        $data['jojo']=$model->getWhere('barang',$where);
        return view('edit_barang',$data);
        echo view('footer');

    }

    public function aksi_edit_barang()
    {
        $id=$this->request->getPost('id');
        $a=$this->request->getPost('nama_brg');
        $b=$this->request->getPost('kode_brg');
        $c=$this->request->getPost('stock');
        $d=$this->request->getPost('harga');


        $where=array('id_barang'=>$id);
        $simpan=array(
            'nama_brg'=>$a,
            'kode_brg'=>$b,
            'stock'=>$c,
            'harga'=>$d,


        );
        $model=new M_model();
        $model->qedit('barang',$simpan, $where);
        return redirect()->to('/Home/barang');

    }


    public function barang_masuk()
    {
        if(session()->get('id')>0) {
            $model=new m_model();
            $on='brg_masuk.barang=barang.id_barang';
            $on1='brg_masuk.kode_brg=kode_brg.id_barang';
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            $diva['okta'] = $model->join2('brg_masuk', 'barang',$on);
            echo view('header');
            echo view('menu');
            echo view('brg_masuk',$diva);
            echo view('footer');

        }else{
            return redirect()->to('/Home');
        }

    }

    public function tambah_brg_masuk()
    {
        if (session()->get('id') > 0) {
        $model = new M_model();
        $diva['okta'] = $model->tampil('barang');
        echo view('header');
        echo view('menu');
        echo view('tambah_brg_masuk', $diva);
        
        echo view('footer');
    } else {
        return redirect()->to('/Home');
    }
    }

    public function aksi_tambah_brg_masuk()
    {
        $a=$this->request->getPost('id_brg_masuk');
        $e=$this->request->getPost('barang');
        $b=$this->request->getPost('jumlah');
        $c=$this->request->getPost('tanggal');
        $d=$this->request->getPost('kode_brg');
        
        $simpan=array(
            'id_brg_masuk'=>$a,
            'barang'=>$e,
            'jumlah'=>$b,
            'tanggal'=>$c,
            'kode_brg'=>$d
        );
        $model=new M_model();
        $model->simpan('brg_masuk',$simpan);
        return redirect()->to('/Home/barang_masuk');

    }

    public function hapus_brg_masuk($id)
    {
        $model=new M_model();
        $where=array('id_brg_masuk'=>$id);
        echo view('header');
            echo view('menu');
            echo view('footer');
        $model->hapus('brg_masuk',$where);
        return redirect()->to('/Home/barang_masuk');
    }

    public function edit_brg_masuk($id)
    {
        if(session()->get('id')>0) {
        $model=new m_model();
        $where=array('id_brg_masuk '=>$id);
        $data['jess']=$model->tampil('barang');
        $data['jojo']=$model->getWhere('brg_masuk',$where);
        echo view('header');
        echo view('menu');
        return view('edit_brg_masuk',$data);
        echo view('footer');
        }else{
            return redirect()->to('/Home/edit_brg_masuk');
        }
    }

    public function aksi_edit_brg_masuk()
    {
        $id=$this->request->getPost('id');
        $a=$this->request->getPost('barang');
        $b=$this->request->getPost('jumlah');
        $c=$this->request->getPost('tanggal');
        $d=$this->request->getPost('kode_brg');




        $where=array('id_brg_masuk'=>$id);
        $simpan=array(
            'barang'=>$a,
            'jumlah'=>$b,
            'tanggal'=>$c,
            'kode_brg'=>$d

        );
        $model=new M_model();
        $model->qedit('brg_masuk',$simpan, $where);
        return redirect()->to('/Home/barang_masuk');

    }

    public function barang_keluar()
    {
        if(session()->get('id')>0) {
            $model=new m_model();
            $on='brg_keluar.barang=barang.id_barang';
            $on1='brg_keluar.kode_brg=kode_brg.id_barang';
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            $diva['okta'] = $model->join2('brg_keluar', 'barang',$on);
            echo view('header');
            echo view('menu');
            echo view('brg_keluar',$diva);
            echo view('footer');

        }else{
            return redirect()->to('/Home');
        }

    }

    public function tambah_brg_keluar()
    {
        if (session()->get('id') > 0) {
        $model = new M_model();
        $diva['okta'] = $model->tampil('barang');
        echo view('header');
        echo view('menu');
        echo view('tambah_brg_keluar', $diva);
        
        echo view('footer');
    } else {
        return redirect()->to('/Home');
    }
    }

    public function aksi_tambah_brg_keluar()
    {
        $a=$this->request->getPost('id_brg_keluar');
        $e=$this->request->getPost('barang');
        $b=$this->request->getPost('jumlah');
        $c=$this->request->getPost('tanggal');
        $d=$this->request->getPost('kode_brg');
        
        $simpan=array(
            'id_brg_keluar'=>$a,
            'barang'=>$e,
            'jumlah'=>$b,
            'tanggal'=>$c,
            'kode_brg'=>$d
        );
        $model=new M_model();
        $model->simpan('brg_keluar',$simpan);
        return redirect()->to('/Home/barang_keluar');

    }

    public function hapus_brg_keluar($id)
    {
        $model=new M_model();
        $where=array('id_brg_keluar'=>$id);
        echo view('header');
            echo view('menu');
            echo view('footer');
        $model->hapus('brg_keluar',$where);
        return redirect()->to('/Home/barang_keluar');
    }

    public function edit_brg_keluar($id)
    {
        if(session()->get('id')>0) {
        $model=new m_model();
        $where=array('id_brg_keluar '=>$id);
        $data['jess']=$model->tampil('barang');
        $data['jojo']=$model->getWhere('brg_keluar',$where);
        echo view('header');
        echo view('menu');
        return view('edit_brg_keluar',$data);
        echo view('footer');
        }else{
            return redirect()->to('/Home/edit_brg_keluar');
        }
    }

    public function aksi_edit_brg_keluar()
    {
        $id=$this->request->getPost('id');
        $a=$this->request->getPost('barang');
        $b=$this->request->getPost('jumlah');
        $c=$this->request->getPost('tanggal');
        $d=$this->request->getPost('kode_brg');




        $where=array('id_brg_keluar'=>$id);
        $simpan=array(
            'barang'=>$a,
            'jumlah'=>$b,
            'tanggal'=>$c,
            'kode_brg'=>$d

        );
        $model=new M_model();
        $model->qedit('brg_keluar',$simpan, $where);
        return redirect()->to('/Home/barang_keluar');

    }

      public function cari_b()
{
    if (session()->get('id') > 0) {
        $model = new M_model();
         $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $awal = $this->request->getPost('awal');
        $akhir = $this->request->getPost('akhir');
        $result = $model->filter2($awal, $akhir);

        $kui['duar'] = $result;
        echo view('header');
        echo view('menu',$data);
        echo view('c_b', $kui);
        echo view('footer');
    } else {
        return redirect()->to('/Home/barang_masuk');
    }
}

 public function cari_k()
{
    if (session()->get('id') > 0) {
        $model = new M_model();
         $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $awal = $this->request->getPost('awal');
        $akhir = $this->request->getPost('akhir');
        $result = $model->filter3($awal, $akhir);

        $kui['duar'] = $result;
        echo view('header');
        echo view('menu',$data);
        echo view('c_k', $kui);
        echo view('footer');
    } else {
        return redirect()->to('/Home/barang_keluar');
    }
}
    public function pdf_b()
{
    $model = new M_model(); 
    $awal = $this->request->getPost('awal');
    $akhir = $this->request->getPost('akhir');
    $result = $model->filter2($awal, $akhir);

    $kui['duar'] = $result;

    // Load the 'c_b' view into a variable instead of echoing it directly.
    $pdf_view = view('c_b', $kui);

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($pdf_view);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('my.pdf', ['Attachment' => 0]);
}

public function pdf_k()
{
    $model = new M_model(); 
    $awal = $this->request->getPost('awal');
    $akhir = $this->request->getPost('akhir');
    $result = $model->filter3($awal, $akhir);

    $kui['duar'] = $result;

    // Load the 'c_b' view into a variable instead of echoing it directly.
    $pdf_view = view('c_k', $kui);

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($pdf_view);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('my.pdf', ['Attachment' => 0]);
}



    public function excel_barang()
{
    $model = new M_model();
    $awal = $this->request->getPost('awal');
    $akhir = $this->request->getPost('akhir');
    $data = $model->filter2($awal, $akhir);

    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the headers for the Excel file
    $sheet->setCellValue('A1', 'Nama Barang');
    $sheet->setCellValue('B1', 'Jumlah');
    $sheet->setCellValue('C1', 'Tanggal');
    $sheet->setCellValue('D1', 'Kode Barang');

    // $sheet->setCellValue('G1', 'Kelas');
    // $sheet->setCellValue('H1', 'Rombel');
    // $sheet->setCellValue('J1', 'Guru');
    // $sheet->setCellValue('K1', 'Mapel');

    // Set the data from the filtered results
    $row = 2;
    foreach ($data as $item) {
        $sheet->setCellValue('A' . $row, $item->nama_brg);
        $sheet->setCellValue('B' . $row, $item->jumlah);
        $sheet->setCellValue('C' . $row, $item->tanggal);
        $sheet->setCellValue('D' . $row, $item->kode_brg);

        // $sheet->setCellValue('G' . $row, $item->tingkat);
        // $sheet->setCellValue('H' . $row, $item->rombel);
        // $sheet->setCellValue('J' . $row, $item->nama_guru);
        // $sheet->setCellValue('K' . $row, $item->nama_mapel);
        $row++;
    }

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $fileName = 'Data Laporan jadwal.xlsx';

    // Set the appropriate headers to download the Excel file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');

    // Output the file to the browser
    $writer->save('php://output');
}

public function excel_barang2()
{
    $model = new M_model();
    $awal = $this->request->getPost('awal');
    $akhir = $this->request->getPost('akhir');
    $data = $model->filter3($awal, $akhir);

    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the headers for the Excel file
    $sheet->setCellValue('A1', 'Nama Barang');
    $sheet->setCellValue('B1', 'Jumlah');
    $sheet->setCellValue('C1', 'Tanggal');
    $sheet->setCellValue('D1', 'Kode Barang');

    // $sheet->setCellValue('G1', 'Kelas');
    // $sheet->setCellValue('H1', 'Rombel');
    // $sheet->setCellValue('J1', 'Guru');
    // $sheet->setCellValue('K1', 'Mapel');

    // Set the data from the filtered results
    $row = 2;
    foreach ($data as $item) {
        $sheet->setCellValue('A' . $row, $item->nama_brg);
        $sheet->setCellValue('B' . $row, $item->jumlah);
        $sheet->setCellValue('C' . $row, $item->tanggal);
        $sheet->setCellValue('D' . $row, $item->kode_brg);

        // $sheet->setCellValue('G' . $row, $item->tingkat);
        // $sheet->setCellValue('H' . $row, $item->rombel);
        // $sheet->setCellValue('J' . $row, $item->nama_guru);
        // $sheet->setCellValue('K' . $row, $item->nama_mapel);
        $row++;
    }

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $fileName = 'Data Laporan jadwal.xlsx';

    // Set the appropriate headers to download the Excel file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');

    // Output the file to the browser
    $writer->save('php://output');
}

    public function l_brg()
    {
        if (session()->get('id') > 0) {

            $model=new M_model();
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            $kui['kunci']='view_b';

            echo view('header');
            echo view('menu',$data);
            echo view('filter',$kui);
            echo view('footer');

        }else{
            return redirect()->to('/home/');
        }
    }


    public function k_brg()
    {
       if (session()->get('id') > 0) {
            $model=new M_model();
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            $kui['kunci']='view_k';

            echo view('header');
            echo view('menu',$data);
            echo view('filter2',$kui);
            echo view('footer');

        }else{
            return redirect()->to('/home/');
        }
    }

     public function log()
    {
        if(session()->get('level')== 1) {
        $model=new M_model();
        $where=array('log.id_user'=>session()->get('id'));
            $on='log.id_user=user.id_user';
            $diva ['okta']= $model->join_w('log', 'user',$on, $where);
            echo view('header');
            echo view('menu');
            echo view('log',$diva);
            echo view('footer');
        
    }else{
        return redirect()->to('/Home');
    }
    }





}
