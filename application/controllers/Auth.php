<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('m_user');

		// cek sesi
		$uri 	= $this->uri->segment('2');
		$role	= $this->session->userdata('role');
		if (($role != '') && ($uri != 'keluar') && ($uri != 'tema') ) {
			redirect("$role/");
		}
	}
	
	function index(){
		redirect('bima/');
	}

	function masuk(){
		$email 		= $this->input->post('email');
		$password 	= $this->input->post('password');

		$table 		= 'tbl_user_mahasiswa';
		$role		= 'mahasiswa';
		// $num 		= $this->m_user->cekByEmail($email, $table)->num_rows();
		$cek = $this->m_user->cekByEmail($email, $table)->row_array();
		// inisialiasi alert
		$this->setPesan('<br>Email atau password salah','masuk','err');

		// cek ketersediaan user
		if ($cek['id'] == '') {
			$table 	= 'tbl_user_dosen';
			$role	= 'dosen';
			// $num 	= $this->m_user->cekByEmail($email, $table)->num_rows();
			$cek = $this->m_user->cekByEmail($email, $table)->row_array();

			if ($cek['id'] == '') {
				$table 	= 'tbl_user_admin';
				$role	= 'admin';
				// $num 	= $this->m_user->cekByEmail($email, $table)->num_rows();
				$cek = $this->m_user->cekByEmail($email, $table)->row_array();

				if ($cek['id'] == '') {
				$table 	= 'tbl_user_pimpinan';
				$role	= 'pimpinan';
				// $num 	= $this->m_user->cekByEmail($email, $table)->num_rows();
				$cek = $this->m_user->cekByEmail($email, $table)->row_array();

					if ($cek['id'] == '') {
						redirect('bima/masuk');
					}
				}
			}
		}

		// cek kecocokan password
		if (($cek['id'] != '') && (password_verify($password, $cek['password']))) {
			if ((@$cek['status_akun'] == 0) && ($role == 'mahasiswa')) {
				// setiap login gagal karena akun belum aktif, kode mhs selalu dirandom ulang utk keamanan
				$kode 	= rand(100000,999999);
				// $pesan 		= "Buka / Klik link berikut untuk mengaktifkan akun bima ==> http://localhost".base_url()."auth/verifikasi/$email/".$kode;
				$pesan 	= '<h4 style="text-align: center;">Klik konfirmasi untuk mengaktifkan akun bima<br><br>
<a href="http://localhost'.base_url().'auth/verifikasi/'.$email.'/'.$kode.'" align="center" target="_blank" style="text-align: center; background-color: orange;color: white;padding: 14px 25px;text-decoration: none;display: inline-block;border-radius: 25px;">Konfirmasi</a></h4>';

				$status = $this->sendMail($email,$pesan);
				if ($status == 'oke') {
					$this->m_user->updateKode($email,$kode);
					$this->setPesan('<br>Silahkan cek email untuk verifikasi','masuk','err');
				}
				
				redirect('bima/masuk');
			}
			
			if ((@$cek['status_dropout'] == TRUE) && ($role == 'mahasiswa')) {
				$this->setPesan('<br>ANDA TELAH DI DROPOUT','masuk','err');

				redirect('bima/masuk');
			}

			// set sesi login
	        $this->session->set_userdata('id', $cek['id']);
	        $this->session->set_userdata('role', $role);
	        $this->session->set_userdata('tema', 'white');
	        
			redirect("$role/");
		}
		else{
			redirect('bima/masuk');
		}
	}

	function daftar(){
		$email 		= $this->input->post('email');
		$password 	= $this->input->post('password');
		$konfirmasi = $this->input->post('konfirmasi');

		// validasi
		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbl_user_mahasiswa.email]|is_unique[tbl_user_dosen.email]|is_unique[tbl_user_admin.email]|is_unique[tbl_user_pimpinan.email]|trim|xss_clean|min_length[11]|max_length[50]|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|min_length[8]|matches[konfirmasi]');
		$this->form_validation->set_rules('konfirmasi', 'Konfirmasi password', 'required|trim|xss_clean');

		// jika tidak lolos validasi
		if ($this->form_validation->run() == false) {
			$pesan = form_error('email', '<small class="text-danger">','</small>');
			$this->session->set_flashdata('email', $pesan);
			$pesan = form_error('password', '<small class="text-danger">','</small>');
			$this->session->set_flashdata('password', $pesan);

			$this->setPesan('akun','mendaftarkan','err');
		}
		// jika lolos validasi
		else {
			$kode 		= rand(100000,999999);
			$password 	= password_hash($password,PASSWORD_DEFAULT);
			// $pesan 		= "Buka / Klik link berikut untuk mengaktifkan akun bima ==> http://localhost".base_url()."auth/verifikasi/$email/$kode/";
			$pesan 	= '<h4 style="text-align: center;">Klik konfirmasi untuk mengaktifkan akun bima<br><br>
<a href="http://localhost'.base_url().'auth/verifikasi/'.$email.'/'.$kode.'" align="center" target="_blank" style="text-align: center; background-color: orange;color: white;padding: 14px 25px;text-decoration: none;display: inline-block;border-radius: 25px;">Konfirmasi</a></h4>';
			
			$status 	= $this->sendMail($email,$pesan);
			if ($status == 'oke') {
				$this->m_user->insertKode($email, $password, $kode);
				$this->setPesan('akun<br>Silahkan cek email untuk verifikasi','mendaftarkan',$status);
			}
			else{
				$this->setPesan('akun','mendaftarkan',$status);
			}
		}
		redirect('bima/daftar');
	}

	function lupa(){
		$this->load->model('m_user');

		$email 	= $this->input->post('email');
		$data 	= $this->m_user->cekByEmail($email, 'tbl_user_mahasiswa')->row_array();

		if ($data['id'] != '') {
			// setiap melakukan reset, kode mhs selalu dirandom ulang utk keamanan
			$kode 	= rand(100000,999999);
			$this->m_user->updateKode($email,$kode);

			// $pesan 	= "Buka / Klik link berikut untuk reset password akun bima ==> http://localhost".base_url()."bima/reset/".$data['email']."/".$kode;
			$pesan 	= '<h4 style="text-align: center;">Klik konfirmasi untuk mereset password akun bima<br><br>
<a href="http://localhost'.base_url().'bima/reset/'.$data['email'].'/'.$kode.'" align="center" target="_blank" style="text-align: center; background-color: orange;color: white;padding: 14px 25px;text-decoration: none;display: inline-block;border-radius: 25px;">Konfirmasi</a></h4>';

			$status = $this->sendMail($email,$pesan);
			$this->setPesan('kode verifikasi','mengirim',$status);
		}
		else{
			$this->setPesan('kode verifikasi','mengirim','err');
		}
		redirect('bima/lupa');
	}

	function reset(){
		$id 		= $this->input->post('id');
		$email 		= $this->input->post('email');
		$kode 		= $this->input->post('kode');
		$password 	= $this->input->post('password');
		$konfirmasi = $this->input->post('konfirmasi');

		$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|min_length[8]|matches[konfirmasi]');
		$this->form_validation->set_rules('konfirmasi', 'Konfirmasi password', 'required|trim|xss_clean');

		// jika tidak lolos validasi
		if ($this->form_validation->run() == false) {
			$pesan = form_error('password', '<small class="text-danger">','</small>');
			$this->session->set_flashdata('password', $pesan);

			$this->setPesan('password','mereset','err');
			redirect("bima/reset/$email/$kode");
		}
		else{
			$password 	= password_hash($password,PASSWORD_DEFAULT);
			$status 	= $this->m_user->updatePassword($id,$password,'tbl_user_mahasiswa');
			$this->setPesan('password','merubah',$status);

			$kode 	= rand(100000,999999);
			$this->m_user->updateKode($email,$kode);
			redirect('bima/masuk');
		}
	}

	private function sendMail($email,$pesan){
    	require_once(APPPATH.'libraries/classes/class.phpmailer.php');

		$mail = new PHPMailer; 

		$mail->IsSMTP(); //aktifkan SMTP
		$mail->SMTPSecure = 'ssl'; //transfer aman diaktifkan
		$mail->Host = "smtp.gmail.com"; //host masing-masing provider email
		$mail->SMTPDebug = 2; //debugging: 1 = errors and pesan, 2 = hanya pesan
		$mail->Port = 465; //set port yang digunakan (465 atau 587)
		$mail->SMTPAuth = true; //auth diaktifkan

		$mail->Username = "bima.informatika@gmail.com"; //user email
		$mail->Password = "Informatika20"; //password email 

		$mail->SetFrom("bima.informatika@gmail.com","Bima"); //email pengirim
		$mail->AddAddress($email,"");  //email tujuan

		$mail->Subject = "Verifikasi email"; //subyek email
		$mail->MsgHTML($pesan); //pesan email

		if ($mail->Send()){
			return 'oke'; //sukses, email terkirim
		} 
		else {
			return 'err'; //gagal, email tidak terkirim
		}
	}

	function verifikasi(){
		$this->load->model('m_user');

		$email 	= $this->uri->segment('3');
		$kode 	= $this->uri->segment('4');
		//cek ketersediaan email didb
		$data 	= $this->m_user->cekByEmail($email, 'tbl_user_mahasiswa')->row_array();
		if (($kode == $data['kode']) && ($email != '') && ($kode != '')) {
			$status = $this->m_user->updateStatus($email);
			$this->setPesan('akun','memverifikasi',$status);
		}
		else{
			$this->setPesan('akun','memverifikasi','err');
		}
		redirect('bima/masuk');
	}

	function keluar(){
		// menghancurkan sesi
		$this->session->sess_destroy();
		redirect('bima/masuk');
	}

	function tema(){
		if ($this->session->userdata('tema') == 'black') {
			$this->session->set_userdata('tema', 'white'); //merubah tema white
		}
		else{
			$this->session->set_userdata('tema', 'black'); //merubah tema black
		}

		$role = $this->session->userdata('role');
		redirect("$role");
	}

	private function setPesan($nama, $jenis, $status){
		if ($status == 'oke') {
			$pesan = "<div class='alert alert-success' align='center'><span>Berhasil $jenis $nama</span></div>";
		}
		else{
			$pesan = "<div class='alert alert-danger' align='center'><span>Gagal $jenis $nama</span></div>";
		}
		$this->session->set_flashdata('pesan', $pesan);
	}

}
