<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$role	= $this->session->userdata('role');
		if ($role == '') {
			// jika belum masuk
			redirect('bima/masuk');
		} elseif ($role != 'dosen') {
			// jika sudah masuk tapi role bukan dosen
			redirect("$role/");
		}
	}

	function index()
	{
		redirect('dosen/dashboard');
	}

	function dashboard()
	{
		$this->load->model('m_bimbingan');
		$this->load->model('m_topik');

		$id 	= $this->session->userdata('id');
		// frekuensi bimbingan
		$tahun 	= $this->input->post('tahun');
		if ($tahun == '') {
			$tahun = date('Y');
		}

		for ($i = 1; $i <= 12; $i++) {
			if ($i < 10) {
				$data['frek'][$i] = $this->m_bimbingan->frekuensi($id, "$tahun-0$i%")->num_rows();
			} else {
				$data['frek'][$i] = $this->m_bimbingan->frekuensi($id, "$tahun-$i%")->num_rows();
			}
		}

		// jumlah bimbingan
		$batas 				= $this->cekAlur();
		$data['aktif']		= $this->m_topik->getAktifByIdDosen($id, $batas['bawah'], $batas['atas'])->num_rows();
		$data['selesai']	= $this->m_topik->getSelesaiByIdDosen($id, $batas['atas'])->num_rows();

		$this->template->load('v_master', 'dosen/dashboard', $data);
	}

	function profil()
	{
		$this->load->model('m_user');
		$this->load->model('m_laboratorium');
		$this->load->model('m_status_lektor');
		$this->load->model('m_topik');

		$id = $this->session->userdata('id');
		$batas = $this->cekAlur();

		if (isset($_POST['simpan-ubah'])) {
			$no 	= $this->input->post('no');
			$nama	= str_replace("'", "", htmlspecialchars($this->input->post('nama'), ENT_QUOTES));
			$lab	= $this->input->post('lab');
			$bidang	= $this->input->post('bidang');
			$status_lektor = $this->input->post('status_lektor');

			$status = $this->m_user->updateDosen($id, $no, $nama, $lab, $bidang, $status_lektor); //proses update
			$this->setPesan('profil', 'merubah', $status);

			redirect('dosen/profil');
		}

		$data['lab'] 	= $this->m_laboratorium->getAll('tbl_laboratorium')->result_array();
		$data['bidang'] = $this->m_laboratorium->getAll('tbl_bidang_keahlian')->result_array();
		$data['profil'] = $this->m_user->getById($id, 'tbl_user_dosen')->row_array();
		$data['status_lektor'] = $this->m_status_lektor->getAll('tbl_status_lektor')->result_array();
		
		$data['aktif'] = $this->m_topik->getAktifByIdDosen($id, $batas['bawah'], $batas['atas'])->result_array();
		
		$kuotaAktif1 = 0;
		$kuotaAktif2 = 0;
		
		foreach ($data['aktif'] as $a) {
			if ($a['id_dosen_1'] == $id) {
				$kuotaAktif1++;
			}
			if ($a['id_dosen_2'] == $id) {
				$kuotaAktif2++;
			}
		}
		
		$data['kuota_aktif_1'] = $kuotaAktif1;
		$data['kuota_aktif_2'] = $kuotaAktif2;
		
		$data['proses'] = $this->m_topik->getAktifByIdDosen($id, 0, ($batas['bawah'] - 1))->result_array();

		$kuotaProses1 = 0;
		$kuotaProses2 = 0;

		foreach ($data['proses'] as $p) {
			if ($p['id_dosen_1'] == $id) {
				$kuotaProses1++;
			}
			if ($p['id_dosen_2'] == $id) {
				$kuotaProses2++;
			}
		}

		$data['kuota_proses_1'] = $kuotaProses1;
		$data['kuota_proses_2'] = $kuotaProses2;

		
		$data['sisa_kuota_1'] = max(0, $data['profil']['kuota_pembimbing_1'] - $kuotaAktif1);
		$data['sisa_kuota_2'] = max(0, $data['profil']['kuota_pembimbing_2'] - $kuotaAktif2);


		$this->template->load('v_master', 'dosen/profil', $data);
	}

	function mahasiswa()
	{
		$this->load->model('m_topik');
		$this->load->model('m_user');

		$batas	= $this->cekAlur();

		$id 	= $this->session->userdata('id');
		$uri 	= $this->uri->segment('3');
		$idMhs 	= $this->uri->segment('4');

		if (($uri == 'detail') && ($idMhs != '')) { //dosen hanya bisa akses ke mhs yang diampunya saja
			$data	= $this->m_topik->getByIdMhs($idMhs)->row_array();
			if (($data['id_dosen_1'] != $id) && ($data['id_dosen_2'] != $id)) {
				redirect('dosen/dashboard');
			}
		}

		if ($uri == 'detail') {
			$this->load->model('m_laboratorium');
			$this->load->model('m_alur');
			$this->load->model('m_topik_acc');

			if ($this->uri->segment(5) == 'acc') {
				$statusAcc 	= $this->uri->segment(6);
				$posisi		= $this->uri->segment(7);

				$status 	= $this->m_topik_acc->insert($idMhs, $id, $statusAcc, $posisi);

				$this->setPesan('status dosen pembimbing', 'merubah', $status);
				redirect("dosen/mahasiswa/detail/$idMhs");
			}

			$data['profil']			= $this->m_user->getById($idMhs, 'tbl_user_mahasiswa')->row_array();
			$data['topik']			= $this->m_topik->getByIdMhs($idMhs)->row_array();
			$data['dosen']			= $this->m_user->getAll('tbl_user_dosen')->result_array();
			$data['lab'] 			= $this->m_laboratorium->getAll('tbl_laboratorium')->result_array();
			$data['bidang'] 		= $this->m_laboratorium->getAll('tbl_bidang_keahlian')->result_array();
			$data['alur'] 			= $this->m_alur->getAll()->result_array();

			$data['acc'][0]		= $this->m_topik_acc->getByIdMhs($idMhs, $data['topik']['id_dosen_1'], 0)->row_array();
			$data['acc'][1]		= $this->m_topik_acc->getByIdMhs($idMhs, $data['topik']['id_dosen_2'], 1)->row_array();

			if ($data['acc'][0]['status'] == '') {
				$data['acc'][0]['status'] = 0;
			}
			if ($data['acc'][1]['status'] == '') {
				$data['acc'][1]['status'] = 0;
			}

			$this->template->load('v_master', 'dosen/mahasiswa-detail', $data);
		} elseif ($uri == 'profil') {
			$data['data'] 	= $this->m_user->getById($idMhs, 'tbl_user_mahasiswa')->row_array();
			$this->template->load('v_master', 'admin/akun/mahasiswa-profil', $data);
		} elseif ($uri == 'bimbingan') {
			$this->load->model('m_bimbingan');

			if ($this->uri->segment('5') == 'validasi') {
				$id 	= $this->uri->segment('6');
				$status = $this->m_bimbingan->updateStatus($id, '1');
				$this->setPesan('bimbingan', 'memvalidasi', $status);

				redirect("dosen/mahasiswa/bimbingan/$idMhs");
			}

			$data['data']		= $this->m_user->getById($idMhs, 'tbl_user_mahasiswa')->row_array();
			$data['topik']	 	= $this->m_topik->getByIdMhs($idMhs)->row_array();
			$data['dosen'] 		= $this->m_user->getAll('tbl_user_dosen')->result_array();
			$data['bimbingan'] 	= $this->m_bimbingan->getByIdMhs($idMhs)->result_array();

			$this->template->load('v_master', 'admin/akun/mahasiswa-bimbingan', $data);
		} elseif ($uri == 'riwayat') {
			$this->load->model('m_topik_riwayat');
			$this->load->model('m_alur');

			$data['alur']		= $this->m_alur->getAll()->result_array();
			$data['dosen'] 		= $this->m_user->getAll('tbl_user_dosen')->result_array();
			$data['data'] 		= $this->m_user->getById($idMhs, 'tbl_user_mahasiswa')->row_array();
			$data['riwayat']	= $this->m_topik_riwayat->getAllById($idMhs)->result_array();

			$this->template->load('v_master', 'admin/akun/mahasiswa-riwayat', $data);
		} elseif ($uri == 'pemberitahuan') {
			$this->load->model('m_email');

			if (isset($_POST['kirim'])) {
				$this->load->library('custom/api');

				$id 	= $this->input->post('id');
				$email 	= $this->input->post('email');
				$pesan 	= $this->input->post('pesan');
				$chatid = $this->input->post('telegram');

				$status = $this->api->sendMail($email, 'Pemberitahuan', $pesan); //kirim email

				if ($status == 'oke') {
					//	$this->api->sendTelegram($chatid,$pesan); //kirim telegram
					$this->m_email->insert($id, $pesan, date('Y-m-d H:i:s')); // insert jika berhasil mengirim
				}

				$this->setPesan('pesan', 'mengirim', $status);
				redirect("dosen/mahasiswa/pemberitahuan/$idMhs");
			} elseif ($this->uri->segment('5') == 'hapus') {
				$id 	= $this->uri->segment('6');
				$status = $this->m_email->delete($id);

				$this->setPesan('pesan', 'menghapus', $status);
				redirect("dosen/mahasiswa/pemberitahuan/$idMhs");
			}

			$data['mahasiswa']	= $this->m_user->getById($idMhs, 'tbl_user_mahasiswa')->row_array();
			$data['email'] 		= $this->m_email->getByIdMhs($idMhs)->result_array();
			$this->template->load('v_master', 'admin/akun/mahasiswa-pemberitahuan', $data);
		} else {
			$data['dosen']		= $this->m_user->getAll('tbl_user_dosen')->result_array();
			$data['aktif']		= $this->m_topik->getAktifByIdDosen($id, $batas['bawah'], $batas['atas'])->result_array();
			$data['selesai']	= $this->m_topik->getSelesaiByIdDosen($id, $batas['atas'])->result_array();
			$data['proses']		= $this->m_topik->getAktifByIdDosen($id, 0, ($batas['bawah'] - 1))->result_array();
			// var_dump($data['proses']);die();
			$this->template->load('v_master', 'dosen/mahasiswa', $data);
		}
	}

	function bimbingan()
	{
		$this->load->model('m_bimbingan');

		$id 			= $this->session->userdata('id');
		$data['data'] 	= $this->m_bimbingan->getByIdDsn($id)->result_array();

		if ($this->uri->segment('3') == 'validasi') {
			$id 	= $this->uri->segment('4');
			$status = $this->m_bimbingan->updateStatus($id, '1');
			$this->setPesan('bimbingan', 'memvalidasi', $status);

			redirect("dosen/bimbingan");
		}

		$this->template->load('v_master', 'dosen/bimbingan', $data);
	}

	function password()
	{
		if (isset($_POST['simpan-ubah'])) {
			$this->load->model('m_user');
			$id 		= $this->session->userdata('id');
			$role		= $this->session->userdata('role');
			$table		= 'tbl_user_' . $role;

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
					$pesan = form_error('baru', '', '');
					$this->setPesan("password<br>$pesan", 'merubah', 'err');
				} else {
					$password 	= password_hash($baru, PASSWORD_DEFAULT);
					$status 	= $this->m_user->updatePassword($id, $password, $table);
					$this->setPesan('password', 'merubah', $status);
				}
			} else {
				$this->setPesan('password<br>Password lama salah', 'merubah', 'err');
			}

			redirect("$role/password");
		}

		$this->template->load('v_master', '_include/_ubah_password');
	}

	private function setPesan($nama, $jenis, $status)
	{
		if ($status == 'oke') {
			$pesan = "<div class='alert alert-success' align='center'><span>Berhasil $jenis $nama</span></div>";
		} else {
			$pesan = "<div class='alert alert-danger' align='center'><span>Gagal $jenis $nama</span></div>";
		}
		$this->session->set_flashdata('pesan', $pesan);
	}

	private function cekAlur()
	{
		$this->load->model('m_alur');
		// cek alur batas bimbingan boleh diget mahasiswa pada tahap brapa
		$alur 	= $this->m_alur->getAll()->result_array();
		$data['bawah']	= '';
		$no = 0;
		foreach ($alur as $value) {
			if (($value['daftar'] == 1) && ($data['bawah'] == '')) {
				$data['bawah'] = $no + 2;
			}
			$no++;
		}
		if ($data['bawah'] == '') { //jika tidak menemukan tahap mendaftar
			$data['bawah'] = 0;
		}
		$data['atas'] = $no - 2;
		return $data;
	}
}
