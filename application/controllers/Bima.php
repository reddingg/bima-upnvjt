<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bima extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('m_user');
		date_default_timezone_set('Asia/Jakarta');

		// cek sesi
		$uri = $this->uri->segment('2');
		$role	= $this->session->userdata('role');
		if (($uri == "masuk") || ($uri == "daftar") || ($uri == "lupa") || ($uri == "reset")) {
			if ($role != '') {
				redirect("$role/");
			}
		}
	}
	
	function index(){
		redirect('bima/beranda');
	}

	function beranda(){
		$this->load->model('m_carousel');
		$this->load->model('m_berita');

		$uri = $this->uri->segment('3');
		if (($uri == 1) || ($uri == '') || ($uri < 1)) {
			$atas	= 6;
			$bawah 	= 0;
		}
		else{
			$atas	= 6;
			$bawah	= 6 * $uri - 6;
		}

		$data['berita'] 	= $this->m_berita->getByLimit($bawah, $atas)->result_array();
		$data['carousel'] 	= $this->m_carousel->getAll()->result_array();

		// menghitung pagination
		$jumlah 	= $this->db->count_all_results('tbl_berita'); // jumlah berita
 		for ($data['pagination'] = 1; $jumlah >= 6 ; $data['pagination'] ++) { 
 			$jumlah	= $jumlah - 6;
 		}

		$this->load->view('utama/beranda',$data);
	}

	function berita(){
		$this->load->model('m_berita');
		$uri = $this->uri->segment('3');

		$data['berita'] = $this->m_berita->getById($uri)->row_array();
		if ($data['berita'] == '') { //jika berita tidak ditemukan
			$this->index();
		}

		$this->load->view('utama/berita',$data);
	}

	function alur(){
		$this->load->model('m_alur');
		$data['data'] = $this->m_alur->getAll()->result_array();
		$this->load->view('utama/alur',$data);
	}

	function jadwal(){
		$this->load->model('m_jadwal');
		$this->load->model('m_alur');

		$data['alur'] 	= $this->m_alur->getAll()->result_array();
		$data['data'] = $this->m_jadwal->getAll()->result_array();
		$this->load->view('utama/jadwal',$data);
	}

	function unduh(){
		$this->load->model('m_dokumen');
		$this->load->model('m_alur');

		$data['alur'] 	= $this->m_alur->getAll()->result_array();
		$data['data'] = $this->m_dokumen->getAll()->result_array();
		$this->load->view('utama/unduh',$data);
	}

	function bantuan(){
		$this->load->model('m_faq');
		$data['data'] = $this->m_faq->getAll()->result_array();
		$this->load->view('utama/bantuan',$data);
	}

	function kontak(){
		if (isset($_POST['kirim'])) {
			$this->load->model('m_kontak');

			$nama 	= $this->input->post('nama');
			$email 	= $this->input->post('email');
			$subjek = $this->input->post('subjek');
			$pesan 	= $this->input->post('pesan');

			$status	= $this->m_kontak->insert($nama,$email,$subjek,$pesan,date('Y-m-d H:i:s'));
			$this->setPesan('pesan','mengirim',$status);
			redirect('bima/kontak');
		}
		else{
			$this->load->view('utama/kontak');
		}

	}

	function masuk(){
		$this->load->view('auth/v_auth');
	}

	function daftar(){
		$this->load->view('auth/v_auth');
	}

	function lupa(){
		$this->load->view('auth/v_auth');
	}

	function reset(){
		$this->load->model('m_user');

		$email	= $this->uri->segment('3');
		$kode 	= $this->uri->segment('4');
		$data 	= $this->m_user->cekByEmail($email,'tbl_user_mahasiswa')->row_array();

		if (($email != '') && ($kode != '') && ($data['kode'] == $kode)) {
			$this->load->view('auth/v_auth',$data);
		}
		else{
			redirect('bima/masuk');
		}
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
