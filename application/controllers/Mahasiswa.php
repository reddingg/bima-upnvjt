<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$role	= $this->session->userdata('role');
		if ($role == '') {
			// jika belum masuk
			redirect('bima/masuk');
		} elseif ($role != 'mahasiswa') {
			// jika sudah masuk tapi role bukan mahasiswa
			redirect("$role/");
		}
	}

	function index()
	{
		redirect('mahasiswa/dashboard');
	}

	function dashboard()
	{
		$data['pemberitahuan'] = $this->pemberitahuan();

		$this->load->model('m_topik');
		$this->load->model('m_alur');
		$id = $this->session->userdata('id');

		$data['data'] 			= $this->m_topik->getByIdMhs($id)->row_array();
		$data['alur'] 			= $this->m_alur->getAll()->result_array();
		$data['jumlahAlur']		= $this->m_alur->getAll()->num_rows();

		$this->template->load('v_master', 'mahasiswa/dashboard', $data);
	}

	function profil()
	{
		$data['pemberitahuan'] = $this->pemberitahuan();

		$this->load->model('m_user');

		$table		= 'tbl_user_' . $this->session->userdata('role');
		$id 		= $this->session->userdata('id');

		if (isset($_POST['simpan-ubah'])) {
			$nama 		= str_replace("'", "", htmlspecialchars($this->input->post('nama'), ENT_QUOTES));
			$npm 		= $this->input->post('npm');
			$nohp 		= $this->input->post('nohp');
			$telegram 	= $this->input->post('telegram');
			$jk 		= $this->input->post('jeniskelamin');
			$sks 		= $this->input->post('sks');
			$ipk 		= $this->input->post('ipk');
			$alamat 	= str_replace("'", "", htmlspecialchars($this->input->post('alamat'), ENT_QUOTES));

			$status 	= $this->m_user->updateProfil($id, $table, $nama, $npm, $nohp, $telegram, $jk, $sks, $ipk, $alamat); // insert ke db
			$this->setPesan('profil', 'merubah', $status); // set alert

			redirect('mahasiswa/profil');
		}

		if (isset($_POST['simpan-foto'])) {
			$file 			= $_FILES["file"]["name"];
			$extFile 		= pathinfo($file, PATHINFO_EXTENSION);
			$namaFileLama	= $this->input->post('namaFile');

			$lokasi 		= './data/profil/mahasiswa';
			$name 			= 'file';
			$pesan 			= 'Foto profil';
			$allow 			= 'gif|jpg|png|jpeg';

			$namaFileBaru 	= $this->unggah($lokasi, $name, $pesan, $allow); // memanggil fungsi utk unggah file
			// die($namaFile);
			if ($namaFileBaru != 'err') {
				// menghapus file lama
				$lokasiFile = './data/profil/mahasiswa/' . $namaFileLama;
				if (file_exists($lokasiFile)) {
					unlink($lokasiFile); // menghapus file
				}
				$this->m_user->updateFoto($id, $table, $namaFileBaru); // update ke db
			} else {
				$this->setPesan('Foto profil<br>You did not select a file to upload.', 'merubah', 'err');
			}

			redirect('mahasiswa/profil');
		}

		$data['data'] 	= $this->m_user->getById($id, $table)->row_array();
		$this->template->load('v_master', 'mahasiswa/profil', $data);
	}

	function topik()
	{
		$data['pemberitahuan'] = $this->pemberitahuan();

		$this->load->model('m_user');
		$idMhs 	= $this->session->userdata('id');
		$profil = $this->m_user->getById($idMhs, 'tbl_user_mahasiswa')->row_array();

		// cek kelengkapan profil
		if (($profil['npm'] == '') || ($profil['nama'] == '') || ($profil['no_hp'] == '') || ($profil['alamat'] == '') || ($profil['jumlah_sks'] == 0) || ($profil['ipk'] == '') || ($profil['foto'] == '')) {
			$this->setPesan('harap melengkapi profil terlebih dahulu', 'mengakses topik<br>', 'err');
			redirect('mahasiswa/profil');
		}

		$this->load->model('m_topik');
		$this->load->model('m_user');
		$this->load->model('m_laboratorium');
		$this->load->model('m_topik_riwayat');
		$this->load->model('m_alur');
		$this->load->model('m_status_lektor');

		$data['topik'] 	= $this->m_topik->getByIdMhs($idMhs)->row_array();

		//cek sudah tiap pendaftaran mhs
		$data['alur'] 	= $this->m_alur->getAll()->result_array();
		$no = 0;
		$index = 0;
		foreach ($data['alur'] as $value) {
			if ($value['daftar'] == '1') {
				$data['daftar'][$index] = $no;
				$index++;
			}
			$no++;
		}

		if (isset($_POST['simpan-ubah'])) {
			if ($data['topik']['tahap'] >= $data['daftar'][0]) {
				$this->setPesan('topik <br>Silahkan hubungi admin untuk informasi lebih lanjut.', 'merubah', 'err');
			} else {
				$judul 	 		= str_replace("'", "", htmlspecialchars($this->input->post('judul'), ENT_QUOTES));
				$dosen1  		= $this->input->post('dosen1');
				$dosen2  		= $this->input->post('dosen2');
				$lab 	 		= $this->input->post('lab');
				$bidang  		= $this->input->post('bidang');
				$latar 	 		= str_replace("'", "", htmlspecialchars($this->input->post('latar'), ENT_QUOTES));
				$tujuan  		= str_replace("'", "", htmlspecialchars($this->input->post('tujuan'), ENT_QUOTES));
				$permasalahan 	= str_replace("'", "", htmlspecialchars($this->input->post('permasalahan'), ENT_QUOTES));
				$metodologi 	= str_replace("'", "", htmlspecialchars($this->input->post('metodologi'), ENT_QUOTES));
				$metode  		= str_replace("'", "", htmlspecialchars($this->input->post('metode'), ENT_QUOTES));

				// ambil status lektor dari masing-masing dosen
				$status_dosen1 = $this->m_user->getById($dosen1, 'tbl_user_dosen')->row_array()['id_status_lektor'];
				$status_dosen2 = $this->m_user->getById($dosen2, 'tbl_user_dosen')->row_array()['id_status_lektor'];

				// melakukan pengecekan apakah dosen boleh berpasangan
				if (!$this->cekPasanganLektor($status_dosen1, $status_dosen2)) {
					$this->setPesan('Pasangan dosen tidak valid berdasarkan status lektor', 'menentukan dosen 1 & 2<br>', 'err');
					redirect('mahasiswa/topik');
				}

				// cek kuota dosen full / tidak
				$kuota_total[0]	= $this->m_user->getJumlahKuotaDosenById($dosen1, 'kuota_pembimbing_1')->row_array();
				$kuota_total[1]	= $this->m_user->getJumlahKuotaDosenById($dosen2, 'kuota_pembimbing_2')->row_array();

				$batas 			= $this->cekAlur();
				$kuota_aktif[0]	= $this->m_topik->getJumlahAktifByIdDsn($dosen1, 'id_dosen_1', $batas['bawah'], $batas['atas'])->num_rows();
				$kuota_aktif[1]	= $this->m_topik->getJumlahAktifByIdDsn($dosen2, 'id_dosen_2', $batas['bawah'], $batas['atas'])->num_rows();

				if ($kuota_total[0]['kuota_pembimbing_1'] > $kuota_aktif[0]) { // cek ketersediaan dosen 1
					// echo "dosen 1 lolos";die();
					if ($kuota_total[1]['kuota_pembimbing_2'] > $kuota_aktif[1]) { // cek ketersediaan dosen 2
						if (($data['topik']['judul'] == '') && ($data['topik']['id'] == '')) { //jika mhs belum memiliki judul di db
							$status = $this->m_topik->insert($idMhs, $judul, $dosen1, $dosen2, $lab, $bidang, $latar, $tujuan, $permasalahan, $metodologi, $metode); // insert ke db
						} else { //jika mhs sudah memiliki judul di db
							$status = $this->m_topik->update($idMhs, $judul, $dosen1, $dosen2, $lab, $bidang, $latar, $tujuan, $permasalahan, $metodologi, $metode); // insert ke db
						}
						$this->setPesan('topik', 'merubah', $status); // set alert
					} else {
						// echo "dosen 2 full";
						$this->setPesan('Kuota dosen pembimbing 2 penuh', 'merubah topik<br>', 'err');
					}
				} else {
					// echo "dosen 1 full";
					$this->setPesan('Kuota dosen pembimbing 1 penuh', 'merubah topik<br>', 'err');
				}
			}
			redirect('mahasiswa/topik');
		} elseif (isset($_POST['ubah-status'])) {
			$tahap 	= $this->input->post('ubah-status');
			$status = $this->m_topik->updateTahap($idMhs, $tahap);
			$this->setPesan('tahap saya', 'merubah', $status);
			redirect('mahasiswa/topik');
		} else {
			$this->load->model('m_topik_acc');

			$data['dosen'] 	= $this->m_user->getAll('tbl_user_dosen')->result_array();
			$data['lab'] 	= $this->m_laboratorium->getAll('tbl_laboratorium')->result_array();
			$data['bidang'] = $this->m_laboratorium->getAll('tbl_bidang_keahlian')->result_array();

			$data['acc'][0]		= $this->m_topik_acc->getByIdMhs($idMhs, $data['topik']['id_dosen_1'], 0)->row_array();
			$data['acc'][1]		= $this->m_topik_acc->getByIdMhs($idMhs, $data['topik']['id_dosen_2'], 1)->row_array();

			if (@$data['acc'][0]['status'] == '') {
				$data['acc'][0]['status'] = 0;
			}
			if (@$data['acc'][1]['status'] == '') {
				$data['acc'][1]['status'] = 0;
			}

			$this->template->load('v_master', 'mahasiswa/topik', $data);
		}
	}

	function dokumen()
	{
		$data['pemberitahuan'] = $this->pemberitahuan();

		$this->load->model('m_dokumen');
		$this->load->model('m_dokumen_mahasiswa');
		$this->load->model('m_alur');
		$this->load->model('m_topik');

		$idMhs = $this->session->userdata('id');

		if ((isset($_POST['unggah'])) && ($_FILES['file']["name"] != '')) {
			$id 		= $this->input->post('id');
			$lokasi 	= './data/dokumen/mahasiswa';
			$name 		= 'file';
			$pesan 		= 'Dokumen';
			$allow 		= 'pdf';

			$namaFile 	= $this->unggah($lokasi, $name, $pesan, $allow); // memanggil fungsi utk unggah file
			if ($namaFile != 'err') {
				$this->m_dokumen_mahasiswa->insert($idMhs, $id, $namaFile, '1');
			}
			redirect('mahasiswa/dokumen');
		} elseif ($this->uri->segment('3') == 'hapus') {
			$id 		= $this->uri->segment('4');
			$data		= $this->m_dokumen_mahasiswa->getById($id)->row_array();
			$namaFile 	= $data['nama_file'];
			$lokasiFile = 'data/dokumen/mahasiswa/' . $namaFile;

			$status 	= $this->m_dokumen_mahasiswa->delete($id, $idMhs); //menghapus pada db
			if ((file_exists($lokasiFile)) && ($status == 'oke')) {
				unlink($lokasiFile); // menghapus file
			}

			$this->setPesan('dokumen', 'menghapus', $status); //set alert
			redirect('mahasiswa/dokumen');
		}

		$data['tahap'] 		= $this->m_topik->getByIdMhs($idMhs)->row_array();
		$data['berkasMhs']	= $this->m_dokumen_mahasiswa->getByIdMhs($idMhs)->result_array();
		$data['berkas']		= $this->m_dokumen->getByJenis($data['tahap']['tahap'])->result_array();
		$data['alur']		= $this->m_alur->getAll()->result_array();

		$this->template->load('v_master', 'mahasiswa/dokumen', $data);
	}

	function bimbingan()
	{
		$data['pemberitahuan'] = $this->pemberitahuan();

		$this->load->model('m_topik');
		$this->load->model('m_user');
		$this->load->model('m_bimbingan');
		$this->load->model('m_alur');

		//cek sudah lolos daftar pertama/tidak
		$alur 	= $this->m_alur->getAll()->result_array();
		$no = 0;
		foreach ($alur as $value) {
			if ($value['daftar'] == 1) {
				$bawah = $no + 2;
				break;
			}
			$no++;
		}
		if ($bawah == '') {
			$bawah = 0;
		}

		$idMhs 	= $this->session->userdata('id');

		if (isset($_POST['simpan'])) {
			$tanggal 	= $this->input->post('tanggal');
			$dosen 		= $this->input->post('dosen');
			$materi 	= str_replace("'", "", htmlspecialchars($this->input->post('materi'), ENT_QUOTES));

			$status 	= $this->m_bimbingan->insert($idMhs, $tanggal, $dosen, $materi);
			$this->setPesan('bimbingan', 'membuat', $status);

			redirect('mahasiswa/bimbingan');
		} elseif ($this->uri->segment('3') == 'hapus') {
			$id 	= $this->uri->segment('4');
			$status = $this->m_bimbingan->delete($id);
			$this->setPesan('bimbingan', 'menghapus', $status);

			redirect('mahasiswa/bimbingan');
		} else {
			$data['topik']	 	= $this->m_topik->getByIdMhs($idMhs)->row_array();
			if ($data['topik']['tahap'] < $bawah) {
				$this->setPesan('Anda belum mencapai tahap bimbingan', 'mengakses bimbingan<br>', 'err');
				redirect('mahasiswa/profil');
			}

			$data['dosen'] 		= $this->m_user->getAll('tbl_user_dosen')->result_array();
			$data['bimbingan'] 	= $this->m_bimbingan->getByIdMhs($idMhs)->result_array();
			$this->template->load('v_master', 'mahasiswa/bimbingan', $data);
		}
	}

	function riwayat()
	{
		$data['pemberitahuan'] = $this->pemberitahuan();

		$this->load->model('m_user');
		$this->load->model('m_topik_riwayat');
		$this->load->model('m_alur');

		$idMhs 				= $this->session->userdata('id');
		$data['dosen'] 		= $this->m_user->getAll('tbl_user_dosen')->result_array();
		$data['riwayat']	= $this->m_topik_riwayat->getAllById($idMhs)->result_array();
		$data['alur']		= $this->m_alur->getAll()->result_array();

		$this->template->load('v_master', 'mahasiswa/riwayat', $data);
	}

	function kuota()
	{
		$data['pemberitahuan'] = $this->pemberitahuan();

		$this->load->model('m_topik');
		$this->load->model('m_user');
		$this->load->model('m_alur');
		$this->load->model('m_laboratorium');

		$uri 	= $this->uri->segment('3');
		$idDsn 	= $this->uri->segment('4');

		// cek tahap pendaftaran awal utk status kuota aktif dan cek tahap akhir utk status kuota selesai
		$alur 	= $this->m_alur->getAll()->result_array();
		$bawah	= '';
		$no = 0;
		foreach ($alur as $value) {
			if (($value['daftar'] == 1) && ($bawah == '')) {
				$bawah = $no + 2;
			}
			$no++;
		}
		if ($bawah == '') { //jika tidak menemukan tahap mendaftar
			$bawah = 0;
		}
		$atas = $no - 2;

		$data['lab'] 			= $this->m_laboratorium->getAll('tbl_laboratorium')->result_array();
		$data['dosen']			= $this->m_user->getAll('tbl_user_dosen')->result_array();
		$data['kuotaAktif'] 	= $this->m_topik->getJumlahAktif('id_dosen_1', $bawah, $atas)->result_array(); //dosen 1 list mhs aktif
		$data['kuotaAktif2'] 	= $this->m_topik->getJumlahAktif('id_dosen_2', $bawah, $atas)->result_array(); //dosen 2 list mhs aktif
		$data['kuotaSelesai'] 	= $this->m_topik->getJumlahSelesai('id_dosen_1', $atas)->result_array(); //dosen 1 list mhs selesai
		$data['kuotaSelesai2'] 	= $this->m_topik->getJumlahSelesai('id_dosen_2', $atas)->result_array(); //dosen 2 list mhs selesai
		$data['kuotaProses'] 		= $this->m_topik->getJumlahAktif('id_dosen_1', 0, ($bawah - 1))->result_array(); //dosen 1 list proses
		$data['kuotaProses2'] 		= $this->m_topik->getJumlahAktif('id_dosen_2', 0, ($bawah - 1))->result_array(); //dosen 2 list proses

		$this->template->load('v_master', 'admin/kuota', $data);
	}

	function histori()
	{
		$data['pemberitahuan'] = $this->pemberitahuan();

		$this->load->model('m_histori');
		$data['data'] 	= $this->m_histori->getAll()->result_array();
		$this->template->load('v_master', 'mahasiswa/histori', $data);
	}

	function password()
	{
		$data['pemberitahuan'] = $this->pemberitahuan();

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

		$this->template->load('v_master', '_include/_ubah_password', $data);
	}

	private function unggah($lokasi, $name, $pesan, $allow)
	{
		// konfigurasi file
		$namaFile					= date('dmYHis') . round(microtime(true) * 1000);
		$config['upload_path']      = $lokasi;
		$config['allowed_types']    = $allow;
		$config['file_name']        = $namaFile;
		$config['overwrite']		= true;
		$config['max_size']			= 2048;

		// ekstensi file
		$filename = $_FILES[$name]["name"];
		$file_ext = pathinfo($filename, PATHINFO_EXTENSION);
		$namaFile = $namaFile . '.' . $file_ext;

		// proses upload
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($name)) {
			// pesan jika gagal
			$error 		= $this->upload->display_errors();
			$pesan 		= "<div class='alert alert-danger' align='center'><span>" . $pesan . " gagal diunggah" . $error . "</span></div>";
			$namaFile 	= 'err';
		} else {
			// pesan jika berhasil
			$pesan 		= '<div class="alert alert-success" align="center"><span>' . $pesan . ' berhasil diunggah</span></div>';
		}
		$this->session->set_flashdata('pesan', $pesan);

		return $namaFile;
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

	private function pemberitahuan()
	{
		$this->load->model('m_email');
		$id = $this->session->userdata('id');
		if (isset($_POST['pemberitahuan'])) {
			$this->m_email->updateStatus($id);
		}

		$data = $this->m_email->getByIdMhs($id)->result_array();
		return $data;
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

	private function cekPasanganLektor($status_dosen1, $status_dosen2) {
		// jika status dosen adalah tenaga pelajar, maka tidak bisa menjadi dosen 1
		if ($status_dosen1 == 4) {
			return false;
		}

		// jika dosen1 adalah lektor kepala, maka boleh dengan siapa saja
		if ($status_dosen1 == 1) {
			return true;
		}

		// jika dosen1 adalah lektor, maka tidak boleh dengan lektor kepala, tetapi boleh dengan siapa saja selain lektor kepala
		if ($status_dosen1 == 2) {
			if ($status_dosen2 == 1) {
				return false;
			}
			return true;
		}

		// jika dosen1 adalah asisten ahli, maka tidak boleh dengan lektor & lektor kepala, tetapi boleh dengan siapa saja selain itu
		if ($status_dosen1 == 3) {
			if ($status_dosen2 == 3 || $status_dosen2 == 4) {
				return true;
			}
			return false;
		}

		return false; // fallback tidak valid
	}
}
