<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pimpinan extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		
		$role	= $this->session->userdata('role');
		if ($role == '') {
			// jika belum masuk
			redirect('bima/masuk');
		}
		elseif ($role != 'pimpinan') {
			// jika sudah masuk tapi role bukan pimpinan
			redirect("$role/");
		}
	}
	
	function index(){
		redirect('pimpinan/dashboard');
	}

	function dashboard(){
		$this->load->model('m_bimbingan');
		$this->load->model('m_user');
		
		// frekuensi seluruh bimbingan
		$tahun 	= $this->input->post('tahun');
		if ($tahun == '') {
			$tahun = date('Y');
		}

		for ($i=1; $i <= 12 ; $i++) { 
			if ($i < 10) {
				$data['allBimbingan'][$i] = $this->m_bimbingan->frekuensiAll("$tahun-0$i%")->num_rows();
			}
			else{
				$data['allBimbingan'][$i] = $this->m_bimbingan->frekuensiAll("$tahun-$i%")->num_rows();
			}
		}

		// frekuensi /dosen
		$data['dosen'] 	= $this->m_user->getAll('tbl_user_dosen')->result_array();
		$i=0;
		foreach ($data['dosen'] as $value) {
			if ($i < 10) {
				$data['dosen'][$i]['jumlah'] = $this->m_bimbingan->frekuensi($value['id'],"$tahun%")->num_rows();
			}
			else{
				$data['dosen'][$i]['jumlah'] = $this->m_bimbingan->frekuensi($value['id'],"$tahun%")->num_rows();
			}
			$i++;
		}


		$this->template->load('v_master','pimpinan/dashboard',$data);
	}

	function dosen(){
		$this->load->model('m_user');
		$this->load->model('m_topik');

		$batas 					= $this->cekAlur();

		$data['dosen'] 			= $this->m_user->getAll('tbl_user_dosen')->result_array();
		$data['kuotaAktif'] 	= $this->m_topik->getJumlahAktif('id_dosen_1',$batas['bawah'],$batas['atas'])->result_array(); //dosen 1 list mhs aktif
		$data['kuotaAktif2'] 	= $this->m_topik->getJumlahAktif('id_dosen_2',$batas['bawah'],$batas['atas'])->result_array(); //dosen 2 list mhs aktif
		$data['kuotaSelesai'] 	= $this->m_topik->getJumlahSelesai('id_dosen_1',$batas['atas'])->result_array(); //dosen 1 list mhs selesai
		$data['kuotaSelesai2'] 	= $this->m_topik->getJumlahSelesai('id_dosen_2',$batas['atas'])->result_array(); //dosen 2 list mhs selesai

		$this->template->load('v_master','pimpinan/dosen',$data);
	}

	function mahasiswa(){
		$this->load->model('m_laboratorium');
		$this->load->model('m_topik');
		$this->load->model('m_user');
		$this->load->model('m_alur');

		// grafik berdasar bidang keahlian
		$data['bidang'] = $this->m_laboratorium->getAll('tbl_bidang_keahlian')->result_array();
		$no = 0;
		foreach ($data['bidang'] as $value) {
			$data['bidang'][$no]['jumlah']	= $this->m_topik->frekuensi($value['id'])->num_rows();
			$no++;
		}

		//grafik berdasar tahapan
		$alur 	= $this->m_alur->getAll()->num_rows();
		$data['alur'] 	= $this->m_alur->getAll()->result_array();
		for ($i=0; $i < $alur; $i++) { 
			$data['tahap'][$i]['jumlah']	= $this->m_topik->getByTahap($i)->num_rows();
		}

		//grafik berdasar tahun angkatan
		for ($i=13; $i <= date('y')-3; $i++) { 
			$data['angkatan'][$i]['jumlah']	= $this->m_user->getByAngkatan($i)->num_rows();
		}

		$this->template->load('v_master','pimpinan/mahasiswa',$data);
	}

	function password(){
		if (isset($_POST['simpan-ubah'])) {
			$this->load->model('m_user');
			$id 		= $this->session->userdata('id');
			$role		= $this->session->userdata('role');
			$table		= 'tbl_user_'.$role;

			$lama 		= $this->input->post('lama');
			$baru 		= $this->input->post('baru');
			$konfirmasi = $this->input->post('konfirmasi');

			//cek password lama benar/tidak
			$cek 		= $this->m_user->getById($id, $table)->row_array();
			if (password_verify($lama, $cek['password'])) {
				$this->form_validation->set_rules('baru', 'Password baru', 'required|trim|xss_clean|min_length[8]|matches[konfirmasi]');
				$this->form_validation->set_rules('konfirmasi', 'Konfirmasi password', 'required|trim|xss_clean');

				// jika tidak lolos validasi
				if ($this->form_validation->run() == false) {
					$pesan = form_error('baru', '','');
					$this->setPesan("password<br>$pesan",'merubah','err');
				}
				else{
					$password 	= password_hash($baru,PASSWORD_DEFAULT);
					$status 	= $this->m_user->updatePassword($id,$password,$table);
					$this->setPesan('password','merubah',$status);
				}
			}
			else{
				$this->setPesan('password<br>Password lama salah','merubah','err');
			}

			redirect("$role/password");
		}

		$this->template->load('v_master','_include/_ubah_password');
	}

	function setPesan($nama, $jenis, $status){
		if ($status == 'oke') {
			$pesan = "<div class='alert alert-success' align='center'><span>Berhasil $jenis $nama</span></div>";
		}
		else{
			$pesan = "<div class='alert alert-danger' align='center'><span>Gagal $jenis $nama</span></div>";
		}
		$this->session->set_flashdata('pesan', $pesan);
	}

	private function cekAlur(){
		$this->load->model('m_alur');
		// cek alur batas bimbingan boleh diget mahasiswa pada tahap brapa
		$alur 	= $this->m_alur->getAll()->result_array();
		$data['bawah']	= '';
		$no=0;
		foreach ($alur as $value) {
			if (($value['daftar'] == 1) && ($data['bawah'] == '')) {
				$data['bawah'] = $no+2;
			}
			$no++;
		}
		if ($data['bawah'] == '') { //jika tidak menemukan tahap mendaftar
			$data['bawah'] = 0;
		}
		$data['atas'] = $no-2;
		return $data;
	}

}
