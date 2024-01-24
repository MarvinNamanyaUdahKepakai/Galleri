<?php

namespace App\Controllers;
use App\Models\M_model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends BaseController
{
    public function check_internet_connection() {
        $connected = @fsockopen("www.example.com", 80);
        if ($connected) {
            fclose($connected);
            return true; 
        } else {
            return false; 
        }
    }
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
    
    

	
	public function logout()
	{
		session()->destroy();
		return redirect()->to('/Home');
	}
    public function dashboard()
    {   
        echo view('header');
        echo view('menu');
		echo view('dashboard');
        echo view('footer');
    }
    public function reset_password($id)
	{
		if(session()->get('level')==1){
			$model=new M_model();
			$where=array('id_user'=>$id);
			$user=array('password'=>md5('12345'));
			$model->qedit('user', $user, $where);
			return redirect()->to('/User');
		}else{
			return redirect()->to('/Home');
		}
	}
    public function jadwal()
    {
        if(session()->get('level')==1 ||  session()->get('level')==2){
            $model=new M_model();
                $on='user.level=level.id_level';
                $data['a'] = $model->tampil('jadwal');
                echo view('header');
                echo view('menu');
                echo view('jadwal',$data);
                echo view('footer');
            }else{
                return redirect()->to('/Home');
            }
    }
    public function tambah_jadwal()
    {
        if(session()->get('level')==1){
            $model=new M_model();
            echo view('header');
            echo view('menu');
            echo view('tambah_jadwal');
            echo view('footer');
        }else{
            return redirect()->to('/Home');
        }
    }
    public function terima_jadwal()
    {
        if(session()->get('level')==1 ||  session()->get('level')==2){
            $model=new M_model();
            echo view('header');
            echo view('menu');
            echo view('terima_jadwal');
            echo view('footer');
        }else{
            return redirect()->to('/Home/bayar');
        }
    }
    public function aksi_terima($id_jadwal)
{

    $id_sesi = session()->get('id');

    if ($id_sesi) {
        $simpan = [
            'user' => $id_sesi,
            'jadwal' => $id_jadwal,
            'created_at'=>date('Y-m-d H:i:s')
        ];

        $model = new M_model();
        $model->simpan('bayar', $simpan);

        return redirect()->to('/Home/bayar');
    } else {
        return "ID sesi tidak valid.";
    }
}
    public function aksi_tambah_jadwal()
    {
        $a=$this->request->getPost('tempat');
        $b=$this->request->getPost('tanggal');
        $simpan=array(
            'tempat'=>$a,
            'tanggal'=>$b,
        );
        $model=new M_model();
        $model->simpan('jadwal',$simpan);
        return redirect()->to('/Home/jadwal');
    }
    public function delete_jadwal($id)
    {
        $model=new m_model();
        $where=array('jadwal'=>$id);
        $where2=array('id_jadwal'=>$id);
        $model->hapus('jadwal',$where);
        $model->hapus('jadwal',$where2);
        return redirect()->to('/Home/jadwal');
    }
    public function user()
    {
        if(session()->get('level')==1){
            $model=new M_model();
                $on='user.level=level.id_level';
                $data['a'] = $model->joinuser('user', 'level',$on);
                echo view('header');
                echo view('menu');
                echo view('user',$data);
                echo view('footer');
            }else{
                return redirect()->to('/Home');
            }
    }
    public function tambah_user()
    {
        if(session()->get('level')==1){
            $model=new M_model();
            echo view('header');
            echo view('menu');
            echo view('tambah_user');
            echo view('footer');
        }else{
            return redirect()->to('/Home');
        }
    }
    public function aksi_tambah_user()
    {
        $a=$this->request->getPost('username');
        $b=$this->request->getPost('password');
        $c=$this->request->getPost('umur');
        $simpan=array(
            'username'=>$a,
            'password'=>md5($b),
            'umur'=>$c,
            'created_at'=>date('Y-m-d H:i:s')
        );
        $model=new M_model();
        $model->simpan('user',$simpan);
        return redirect()->to('/Home/user');
    }
    public function edit_user($id)
    {
        if(session()->get('level')==1){
            $model=new M_model();
            $where=array('id_user'=>$id);
            $data['a']=$model->getWhere('user',$where);
            echo view('header');
            echo view('menu');
            echo view('edit_user',$data);
            echo view('footer');
        }else{
            return redirect()->to('/Home');
        }
    }
    public function edit_jadwal($id)
    {
        if(session()->get('level')==1){
            $model=new M_model();
            $where=array('id_jadwal'=>$id);
            $data['a']=$model->getWhere('jadwal',$where);
            echo view('header');
            echo view('menu');
            echo view('edit_jadwal',$data);
            echo view('footer');
        }else{
            return redirect()->to('/Home');
        }
    }
    public function aksi_edit_jadwal()
    {
        $id=$this->request->getPost('id');
        $a=$this->request->getPost('tempat');
        $c=$this->request->getPost('tanggal');
        $where=array('id_jadwal'=>$id);
        $simpan=array(
            'tempat'=>$a,
            'tanggal'=>$c,
        );
        $model=new M_model();
        $model->qedit('jadwal',$simpan,$where);
        return redirect()->to('/Home/jadwal');
    }
    public function aksi_edit_user()
    {
        $id=$this->request->getPost('id');
        $a=$this->request->getPost('username');
        $c=$this->request->getPost('umur');
        $where=array('id_user'=>$id);
        $simpan=array(
            'username'=>$a,
            'umur'=>$c,
        );
        $model=new M_model();
        $model->qedit('user',$simpan,$where);
        return redirect()->to('/Home/user');
    }
    public function delete_user($id)
    {
        $model=new m_model();
        $where=array('user'=>$id);
        $where2=array('id_user'=>$id);
        $model->hapus('user',$where);
        $model->hapus('user',$where2);
        return redirect()->to('/Home/user');
    }
    public function delete_bayar($id)
    {
        $model=new m_model();
        $where=array('bayar'=>$id);
        $where2=array('id_bayar'=>$id);
        $model->hapus('bayar',$where);
        $model->hapus('bayar',$where2);
        return redirect()->to('/Home/bayar');
    }
    public function bayar()
    {
       if(session()->get('level')==1 ||  session()->get('level')==2){
            $model=new M_model();
            $on='bayar.user=user.id_user';
            $on2='bayar.jadwal=jadwal.id_jadwal';
            $data['a'] = $model->join3('bayar', 'user','jadwal',$on,$on2);
        echo view('header');
            echo view('menu');
            echo view('bayar',$data);
            echo view('footer');
        }else{
            return redirect()->to('/Home');
        }
    }
    public function status($id_bayar)
    {
        $model = new m_model();
        
        // Dapatkan informasi pelajaran berdasarkan ID
        $pelajaran = $model->getPelajaranById($id_bayar); // Implementasikan method ini sesuai dengan model Anda
        
        
        $data = array('tanda' => 'Selesai');
        $where = array('id_bayar' => $id_bayar);
        $model->qedit('bayar', $data, $where);
        
        return redirect()->to('/Home/bayar');
    }
    public function laporan()
	{
		
			$model=new M_model();
			$kui['kunci']='lmasuk';
			echo view('header');
			echo view('menu');
			echo view('filters',$kui);
			echo view('footer');
		
	}
    public function cari_semua()
	{
		
			$model=new M_model();
			$awal= $this->request->getPost('awal');
			$akhir= $this->request->getPost('akhir');
			$kui['duar']=$model->filter2('bayar',$awal,$akhir);

			echo view('c_ms',$kui);

		
	}

    public function pdf_in()
	{
		
		$model = new M_model();
		$awal= $this->request->getPost('awal');
		$akhir= $this->request->getPost('akhir');
		$kui['duar']=$model->filter2('jadwal',$awal,$akhir);
		$dompdf = new\Dompdf\Dompdf();
		$dompdf->loadHtml(view('c_ms',$kui));
		$dompdf->setPaper('A4','landscape');
		$dompdf->render();
		$dompdf->stream('my.pdf', array('Attachment'=>0));
	
	}
    public function excel_semua()
	{
		
		$model=new M_model();
		$awal= $this->request->getPost('awal');
		$akhir= $this->request->getPost('akhir');
		$data=$model->filter2('jadwal',$awal,$akhir);
        

		$spreadsheet=new Spreadsheet();

		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'Tempat')
		->setCellValue('B1', 'Tanggal');

		$column=2;
		

		foreach($data as $data){
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'. $column, $data->tempat)
			->setCellValue('B'. $column, $data->tanggal);
			$column++;
		}
	

		$writer = new XLsx($spreadsheet);
		$fileName = 'Data Laporan Partime';


		header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition:attachment;filename='.$fileName.'.xls');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	
	}
}
 
