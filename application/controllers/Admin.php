<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');

		$role	= $this->session->userdata('role');
		if ($role == '') {
			// jika belum masuk
			redirect('bima/masuk');
		} elseif ($role != 'admin') {
			// jika sudah masuk tapi role bukan admin
			redirect("$role/");
		}
	}

	function index()
	{
		redirect('admin/dashboard');
	}

	function dashboard()
	{
		$this->load->model('m_user');
		$this->load->model('m_topik');
		$this->load->model('m_topik_riwayat');
		$this->load->model('m_laboratorium');
		$this->load->model('m_alur');

		$data['jumlahMhs'] 	 = $this->m_user->getAll('tbl_user_mahasiswa')->num_rows();
		$data['jumlahDosen'] = $this->m_user->getAll('tbl_user_dosen')->num_rows();
		$data['alur'] 		 = $this->m_alur->getAll()->result_array();
		// $alur 				= $this->m_alur->getAll()->result_array();

		// $no = 0;
		// $index = 0;
		// foreach ($alur as $value) {
		// 	if ($value['daftar'] == '1') {
		// 		$data['alur'][$no]['judul'] = $alur[($index+1)]['judul'];
		// 		$data['alur'][$no]['value'] = $index+1;
		// 		$no++;

		// 		if (@$tahap == '') {
		// 			$tahap = $index+1;
		// 		}
		// 	}
		// 	$index++;
		// }

		// frekuensi tiap tahap
		$tahun 	= $this->input->post('tahun');
		$tahap 	= $this->input->post('tahap');
		if ($tahun == '') {
			$tahun = date('Y');
		}
		if ($tahap == '') {
			$tahap = 0;
		}

		for ($i = 1; $i <= 12; $i++) {
			if ($i < 10) {
				$data['data'][$i] 	= $this->m_topik_riwayat->frekuensi($tahap, "$tahun-0$i%")->num_rows();
			} else {
				$data['data'][$i] 	= $this->m_topik_riwayat->frekuensi($tahap, "$tahun-$i%")->num_rows();
			}
		}

		// jumlah mhs tiap bidang keahlian
		$data['bidang'] = $this->m_laboratorium->getAll('tbl_bidang_keahlian')->result_array();
		$no = 0;
		foreach ($data['bidang'] as $value) {
			$data['bidang'][$no]['jumlah']	= $this->m_topik->frekuensi($value['id'])->num_rows();
			$no++;
		}

		$this->template->load('v_master', 'admin/dashboard', $data);
	}

	function pengajuan()
	{
		$this->load->model('m_topik');
		$this->load->model('m_user');
		$this->load->model('m_alur');

		$data['alur'] 	= $this->m_alur->getAll()->result_array();
		//menentukan tahap pedaftaran itu alur keberapa saja		
		$no = 0;
		$index = 0;
		foreach ($data['alur'] as $value) {
			if ($value['daftar'] == 1) {
				$data['tahap'][$index] = $no;
				$index++;
			}
			$no++;
		}
		//pengambilan data
		$no = 0;
		foreach ($data['tahap'] as $value) {
			$data['topik'][$no] 	= $this->m_topik->getByTahap($value)->result_array(); // fk dosen1
			$data['topik2'][$no] 	= $this->m_topik->getByTahap2($value)->result_array(); // fk dosen2
			$no++;
		}

		$this->template->load('v_master', 'admin/pengajuan', $data);
	}

	function riwayat()
	{
		$this->load->model('m_topik_riwayat');
		$this->load->model('m_user');
		$this->load->model('m_alur');

		$data['alur'] 	= $this->m_alur->getAll()->result_array();
		$data['dosen'] 	= $this->m_user->getAll('tbl_user_dosen')->result_array();
		$data['mhs'] 	= $this->m_topik_riwayat->getall()->result_array();

		$this->template->load('v_master', 'admin/riwayat', $data);
	}

	function kuota()
	{
		$this->load->model('m_topik');
		$this->load->model('m_user');
		$this->load->model('m_alur');

		$uri 	= $this->uri->segment('3');
		$idDsn 	= $this->uri->segment('4');
		$batas 	= $this->cekAlur();

		if ($uri == 'detail') {
			if (isset($_POST['simpan-ubah'])) {
				$kuota1 = $this->input->post('kuota1');
				$kuota2 = $this->input->post('kuota2');

				$status = $this->m_user->updateKuota($idDsn, $kuota1, $kuota2);
				$this->setPesan('kuota dosen', 'merubah', $status);

				redirect("admin/kuota/detail/$idDsn");
			}

			$data['data']		= $this->m_user->getById($idDsn, 'tbl_user_dosen')->row_array();
			$data['dosen']		= $this->m_user->getAll('tbl_user_dosen')->result_array();
			$data['aktif']		= $this->m_topik->getAktifByIdDosen($idDsn, $batas['bawah'], $batas['atas'])->result_array();
			$data['selesai']	= $this->m_topik->getSelesaiByIdDosen($idDsn, $batas['atas'])->result_array();
			$data['proses']		= $this->m_topik->getAktifByIdDosen($idDsn, 0, ($batas['bawah'] - 1))->result_array();

			$this->template->load('v_master', 'admin/kuota-detail', $data);
		} else {
			$this->load->model('m_laboratorium');

			$data['lab'] 			= $this->m_laboratorium->getAll('tbl_laboratorium')->result_array();
			$data['dosen']			= $this->m_user->getAll('tbl_user_dosen')->result_array();
			$data['kuotaAktif'] 	= $this->m_topik->getJumlahAktif('id_dosen_1', $batas['bawah'], $batas['atas'])->result_array(); //dosen 1 list mhs aktif
			$data['kuotaAktif2'] 	= $this->m_topik->getJumlahAktif('id_dosen_2', $batas['bawah'], $batas['atas'])->result_array(); //dosen 2 list mhs aktif
			$data['kuotaSelesai'] 	= $this->m_topik->getJumlahSelesai('id_dosen_1', $batas['atas'])->result_array(); //dosen 1 list mhs selesai
			$data['kuotaSelesai2'] 	= $this->m_topik->getJumlahSelesai('id_dosen_2', $batas['atas'])->result_array(); //dosen 2 list mhs selesai
			$data['kuotaProses'] 		= $this->m_topik->getJumlahAktif('id_dosen_1', 0, ($batas['bawah'] - 1))->result_array(); //dosen 1 list proses
			$data['kuotaProses2'] 		= $this->m_topik->getJumlahAktif('id_dosen_2', 0, ($batas['bawah'] - 1))->result_array(); //dosen 2 list proses

			$this->template->load('v_master', 'admin/kuota', $data);
		}
	}

	function jadwal()
	{
		$this->load->model('m_jadwal');
		$uri 	= $this->uri->segment('3');
		// jika ada request simpan
		if (isset($_POST['simpan'])) {
			$tanggal 	= $this->input->post('tanggal');
			$jam 		= str_replace("'", "", htmlspecialchars($this->input->post('jam'), ENT_QUOTES));
			$keterangan = $this->input->post('keterangan');

			$status 	= $this->m_jadwal->insert($tanggal, $jam, $keterangan); // insert ke db
			$this->setPesan('jadwal', 'membuat', $status); // set alert

			redirect('admin/jadwal');
		} elseif (isset($_POST['simpan-ubah'])) {
			$id 		= $this->input->post('id');
			$tanggal 	= $this->input->post('tanggal');
			$jam 		= str_replace("'", "", htmlspecialchars($this->input->post('jam'), ENT_QUOTES));
			$keterangan = $this->input->post('keterangan');

			$status 	= $this->m_jadwal->update($id, $tanggal, $jam, $keterangan); // insert ke db
			$this->setPesan('jadwal', 'merubah', $status); // set alert

			redirect('admin/jadwal');
		} elseif ($uri == 'detail') {
			$this->load->model('m_topik_riwayat');

			$id 			= $this->uri->segment('4');
			$data['data'] 	= $this->m_topik_riwayat->getByIdJadwal($id)->result_array();
			$this->template->load('v_master', 'admin/jadwal-detail', $data);
		} elseif ($uri == 'ubah') {
			$this->load->model('m_alur');

			$id 			= $this->uri->segment('4');
			$data['ubah'] 	= $this->m_jadwal->getById($id)->row_array();
			$data['alur'] 	= $this->m_alur->getAll()->result_array();
			$data['jadwal'] = $this->m_jadwal->getAll()->result_array();
			$this->template->load('v_master', 'admin/jadwal', $data);
		} elseif ($uri == 'hapus') {
			$this->load->model('m_topik_riwayat');
			$id 	= $this->uri->segment('4');
			$cek 	= $this->m_topik_riwayat->getByIdJadwal($id)->num_rows();

			if ($cek > 0) {
				$this->setPesan('jadwal<br>Masih terdapat peserta mahasiswa', 'menghapus', 'err');
			} else {
				$status = $this->m_jadwal->delete($id); //menghapus pada db
				$this->setPesan('jadwal', 'menghapus', $status); //set alert
			}
			redirect('admin/jadwal');
		} else {
			$this->load->model('m_alur');

			$data['alur'] 	= $this->m_alur->getAll()->result_array();
			$data['jadwal'] = $this->m_jadwal->getAll()->result_array();
			$this->template->load('v_master', 'admin/jadwal', $data);
		}
	}

	function dokumen()
	{
		$this->load->model('m_dokumen');
		// jika ada request tambah dokumen
		if (isset($_POST['simpan'])) {
			$nama 	= str_replace("'", "", htmlspecialchars($this->input->post('nama'), ENT_QUOTES));
			$jumlah = $this->input->post('jumlah');
			$jenis 	= $this->input->post('jenis');

			if ($_FILES['file']["name"] != '') { //cek apakah ada file yg akan diunggah
				$lokasi 	= './data/dokumen';
				$name 		= 'file';
				$pesan 		= 'Berkas';
				$allow 		= 'gif|jpg|png|doc|xls|ppt|pdf|docx|xlsx|pptx';

				$namaFile 	= $this->unggah($lokasi, $name, $pesan, $allow); // memanggil fungsi utk unggah file
			} else {
				$namaFile 	= '';
			}

			if ($namaFile != 'err') {
				$this->m_dokumen->insert($nama, $jumlah, $jenis, $namaFile); // insert ke db
			}
			redirect('admin/dokumen');
		} elseif ($this->uri->segment('3') == 'hapus') {
			$this->load->model('m_dokumen_mahasiswa');

			$id 		= $this->uri->segment('4');
			$namaFile	= $this->uri->segment('5');
			$lokasiFile = 'data/dokumen/' . $namaFile;

			$this->m_dokumen_mahasiswa->deleteAll($id); //menghapus pada mhs jg
			$status 	= $this->m_dokumen->delete($id); //menghapus pada db
			if (file_exists($lokasiFile)) {
				unlink($lokasiFile); // menghapus file
			}

			$this->setPesan('berkas', 'menghapus', $status); //set alert
			redirect('admin/dokumen');
		} else {
			$this->load->model('m_alur');

			$data['alur'] 	= $this->m_alur->getAll()->result_array();
			$data['berkas'] = $this->m_dokumen->getAll()->result_array();
			$this->template->load('v_master', 'admin/dokumen', $data);
		}
	}

	function laboratorium()
	{
		$this->load->model('m_laboratorium');

		if (isset($_POST['simpan'])) {
			$nama 		= str_replace("'", "", htmlspecialchars($this->input->post('nama'), ENT_QUOTES));
			$jenis 		= $this->input->post('simpan');
			$table 		= 'tbl_' . $jenis;

			$status 	= $this->m_laboratorium->insert($nama, $table);
			$this->setPesan($jenis, 'menambah', $status);

			redirect('admin/laboratorium');
		} elseif (isset($_POST['simpan-ubah'])) {
			$id 		= $this->input->post('id');
			$nama 		= str_replace("'", "", htmlspecialchars($this->input->post('nama'), ENT_QUOTES));
			$jenis 		= $this->input->post('simpan-ubah');
			$table 		= 'tbl_' . $jenis;

			$status 	= $this->m_laboratorium->update($id, $nama, $table);
			$this->setPesan($jenis, 'merubah', $status);

			redirect('admin/laboratorium');
		} elseif ($this->uri->segment('3') == 'hapus') {
			$id 		= $this->uri->segment('4');
			$jenis 		= $this->uri->segment('5');
			$table 		= 'tbl_' . $jenis;

			$status 	= $this->m_laboratorium->delete($id, $table);
			$this->setPesan($jenis, 'menghapus', $status);

			redirect('admin/laboratorium');
		} elseif ($this->uri->segment('3') == 'ubah') {
			$id 			= $this->uri->segment('4');
			$jenis 			= $this->uri->segment('5');
			$table 			= 'tbl_' . $jenis;

			$data['ubah' . $jenis] 	= $this->m_laboratorium->getById($id, $table)->row_array();
		}

		$data['lab'] 	= $this->m_laboratorium->getAll('tbl_laboratorium')->result_array();
		$data['bidang'] = $this->m_laboratorium->getAll('tbl_bidang_keahlian')->result_array();

		$this->template->load('v_master', 'admin/laboratorium', $data);
	}

	function saw()
	{
		$this->load->model('m_user');

		if (isset($_POST['hitung'])) {
			$id 	= $this->input->post('mhs[]');
			$no 	= 0;
			$dosen 	= $this->m_user->getAll('tbl_user_dosen')->result_array();

			$pembagiSemester	= 1;
			$pembagiBidang		= 1;
			$pembagiIpk			= 1;
			$pembagiSks 		= 1;

			$data['bobotSemester']		= $this->input->post('%semester');
			$data['bobotBidang']		= $this->input->post('%bidang');
			$data['bobotIpk']			= $this->input->post('%ipk');
			$data['bobotSks'] 			= $this->input->post('%sks');

			foreach ($id as $value) {
				$data['mhs'][$no]	= $this->m_user->saw($value)->row_array();

				if ($data['mhs'][$no]['id'] != '') {
					//menghitung semester
					$angkatan 	= str_split($data['mhs'][$no]['npm'], 2);
					$data['mhs'][$no]['semester'] = (date('y') - $angkatan[0]) * 2;
					if (date('m') > 7) {
						$data['mhs'][$no]['semester'] = $data['mhs'][$no]['semester'] + 1;
					}

					//menghitung nilai kecocokan bidang keahlian
					$data['mhs'][$no]['bidang'] = 0;
					foreach ($dosen as $value2) {
						if ($value2['id'] == $data['mhs'][$no]['id_dosen_1']) {
							if ($value2['id_laboratorium'] == $data['mhs'][$no]['id_laboratorium']) {
								$data['mhs'][$no]['bidang'] += 1;
							}
						} elseif ($value2['id'] == $data['mhs'][$no]['id_dosen_2']) {
							if ($value2['id_laboratorium'] == $data['mhs'][$no]['id_laboratorium']) {
								$data['mhs'][$no]['bidang'] += 1;
							}
						}
					}

					//menentukan nilai pembagi utk saw
					if ($pembagiSemester < $data['mhs'][$no]['semester']) {
						$pembagiSemester = $data['mhs'][$no]['semester'];
					}
					if ($pembagiBidang < $data['mhs'][$no]['bidang']) {
						$pembagiBidang = $data['mhs'][$no]['bidang'];
					}
					if ($pembagiIpk < $data['mhs'][$no]['ipk']) {
						$pembagiIpk = $data['mhs'][$no]['ipk'];
					}
					if ($pembagiSks < $data['mhs'][$no]['jumlah_sks']) {
						$pembagiSks = $data['mhs'][$no]['jumlah_sks'];
					}

					$no++;
				}
			}

			// proses perhitungan algoritma
			if ($data['mhs'][0]['id'] != '') {
				$no = 0;
				foreach ($data['mhs'] as $value) {
					// jika data bukan angka
					if (!is_numeric($data['mhs'][$no]['semester'])) {
						$data['mhs'][$no]['semester'] = 0;
					}
					if (!is_numeric($data['mhs'][$no]['bidang'])) {
						$data['mhs'][$no]['bidang'] = 0;
					}
					if (!is_numeric($data['mhs'][$no]['ipk'])) {
						$data['mhs'][$no]['ipk'] = 0;
					}
					if (!is_numeric($data['mhs'][$no]['jumlah_sks'])) {
						$data['mhs'][$no]['jumlah_sks'] = 0;
					}

					// pembagian
					$data['hasil'][$no]['npm']			= $data['mhs'][$no]['npm'];
					$data['hasil'][$no]['nama']			= $data['mhs'][$no]['nama'];
					$data['hasil'][$no]['semester']		= $data['mhs'][$no]['semester']		/ $pembagiSemester;
					$data['hasil'][$no]['bidang']		= $data['mhs'][$no]['bidang']		/ $pembagiBidang;
					$data['hasil'][$no]['ipk']			= $data['mhs'][$no]['ipk']			/ $pembagiIpk;
					$data['hasil'][$no]['jumlah_sks']	= $data['mhs'][$no]['jumlah_sks']	/ $pembagiSks;

					if (($data['hasil'][$no]['semester'] < 1) 	&& ($data['hasil'][$no]['semester'] > 0)) {
						$data['hasil'][$no]['semester'] 	= round($data['hasil'][$no]['semester'], 3);
					}
					if (($data['hasil'][$no]['bidang'] < 1) 	&& ($data['hasil'][$no]['bidang'] > 0)) {
						$data['hasil'][$no]['bidang'] 	= round($data['hasil'][$no]['bidang'], 3);
					}
					if (($data['hasil'][$no]['ipk'] < 1) 		&& ($data['hasil'][$no]['ipk'] > 0)) {
						$data['hasil'][$no]['ipk'] 		= round($data['hasil'][$no]['ipk'], 3);
					}
					if (($data['hasil'][$no]['jumlah_sks'] < 1) && ($data['hasil'][$no]['jumlah_sks'] > 0)) {
						$data['hasil'][$no]['jumlah_sks'] = round($data['hasil'][$no]['jumlah_sks'], 3);
					}

					$data['hasil'][$no]['total']		= $data['hasil'][$no]['semester'] * $data['bobotSemester'] + $data['hasil'][$no]['bidang'] * $data['bobotBidang'] + $data['hasil'][$no]['ipk'] * $data['bobotIpk'] + $data['hasil'][$no]['jumlah_sks'] * $data['bobotSks'];
					$no++;
				}

				// pemeringkatan
				$no = 0;
				foreach ($data['hasil'] as $value) {
					$values[$no] = $data['hasil'][$no]['total'];
					$no++;
				}

				$ordered_values = $values;
				rsort($ordered_values);

				$no = 0;
				foreach ($values as $key => $value) {
					foreach ($ordered_values as $ordered_key => $ordered_value) {
						if ($value === $ordered_value) {
							$key = $ordered_key;
							$data['hasil'][$no]['rank'] = $key + 1;
							break;
						}
					}
					$no++;
				}
			}
		}

		$data['data'] = $this->m_user->getAll('tbl_user_mahasiswa')->result_array();
		$this->template->load('v_master', 'admin/saw', $data);
	}

	function akun()
	{
		$this->load->model('m_user');

		$uri 	= $this->uri->segment('3');
		$table 	= 'tbl_user_' . $uri;
		$idMhs 	= $this->uri->segment('4');

		if (isset($_POST['simpan'])) {
			$email 		= $this->input->post('email');
			$password 	= $this->input->post('password');
			$konfirmasi = $this->input->post('konfirmasi');
			$nama 		= str_replace("'", "", htmlspecialchars($this->input->post('nama'), ENT_QUOTES));
			$lab 		= $this->input->post('lab');
			$status_lektor = $this->input->post('status_lektor');

			// validasi
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbl_user_mahasiswa.email]|is_unique[tbl_user_dosen.email]|is_unique[tbl_user_admin.email]|is_unique[tbl_user_pimpinan.email]|trim|xss_clean|min_length[11]|max_length[50]|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|min_length[8]|matches[konfirmasi]');
			$this->form_validation->set_rules('konfirmasi', 'Konfirmasi password', 'required|trim|xss_clean');

			// jika tidak lolos validasi
			if ($this->form_validation->run() == false) {
				$pesan = form_error('email', '<small class="text-danger">', '</small>');
				$this->session->set_flashdata('email', $pesan);

				$pesan = form_error('password', '<small class="text-danger">', '</small>');
				$this->session->set_flashdata('password', $pesan);

				$this->setPesan('akun', 'membuat', 'err');
			}
			// jika lolos validasi
			else {
				$password 	= password_hash($password, PASSWORD_DEFAULT);
				if ($lab != '') { //jika dosen
					$status = $this->m_user->insert($email, $password, $nama, $table, $lab, $status_lektor);
				} else {
					$status = $this->m_user->insert($email, $password, $nama, $table, '');
				}

				$this->setPesan("akun $uri", 'membuat', $status); //set alert
			}
			redirect("admin/akun/$uri");
		} elseif (isset($_POST['simpan-ubah'])) {
			$password 	= $this->input->post('password');
			$konfirmasi = $this->input->post('konfirmasi');
			$nama 		= str_replace("'", "", htmlspecialchars($this->input->post('nama'), ENT_QUOTES));
			$lab 		= $this->input->post('lab');
			$status_lektor = $this->input->post('status_lektor');

			// validasi
			if ($password != $konfirmasi) {
				$this->setPesan("akun $uri<br><mall class='text-white'>The Password field does not match the Konfirmasi password field.</small>", 'mengubah', 'err'); //set alert

				$this->setPesan('akun', 'merubah', 'err');
			}
			// jika lolos validasi
			else {
				$id 		= $this->input->post('id');
				$password 	= password_hash($password, PASSWORD_DEFAULT);

				if ($lab != '') {
					$status = $this->m_user->update($id, $password, $nama, $table, $lab, $status_lektor);
				} else {
					$status = $this->m_user->update($id, $password, $nama, $table, '');
				}

				$this->setPesan("akun $uri", 'mengubah', $status); //set alert
			}
			redirect("admin/akun/$uri");
		} elseif ($this->uri->segment('4') == 'ubah') {
			$id 			= $this->uri->segment('5');
			$data['ubah'] 	= $this->m_user->getById($id, $table)->row_array();
		} elseif ($this->uri->segment('4') == 'hapus') {
			$id 		= $this->uri->segment('5');
			$status 	= $this->m_user->delete($id, $table); //menghapus pada db

			$this->setPesan("akun $uri", 'menghapus', $status); //set alert
			redirect("admin/akun/$uri");
		} elseif ($this->uri->segment('4') == 'aktif') {
			$id 		= $this->uri->segment('5');
			$status 	= $this->m_user->setStatusOn($id); //update status akun pada db

			$this->setPesan("akun $uri", 'mengubah status', $status);
			redirect("admin/akun/$uri");
		} elseif ($this->uri->segment('4') == 'nonaktif') {
			$id 		= $this->uri->segment('5');
			$status 	= $this->m_user->setStatusOff($id); //update status akun pada db

			$this->setPesan("akun $uri", 'mengubah status', $status);
			redirect("admin/akun/$uri");
		}

		if ($uri == 'mahasiswa') {
			$this->load->model('m_alur');

			$data['alur'] 	= $this->m_alur->getAll()->result_array();
			$data['data']	= $this->m_user->getWithTahap()->result_array();
			$this->template->load('v_master', 'admin/akun/mahasiswa', $data);
		} elseif ($uri == 'detail') {
			$this->load->model('m_topik');
			$this->load->model('m_topik_riwayat');
			$this->load->model('m_user');

			// jika ada perubahan data topik
			if (isset($_POST['ubah-topik'])) {
				log_message('debug', 'Judul: ' . $judul);
				log_message('debug', 'Dosen1: ' . $dosen1);
				log_message('debug', 'Latar: ' . $latar);

				$judul 			= str_replace("'", "", htmlspecialchars($this->input->post('judul'), ENT_QUOTES));
				$dosen1 		= $this->input->post('dosen1');
				$dosen2 		= $this->input->post('dosen2');
				$lab 			= $this->input->post('lab');
				$bidang 		= $this->input->post('bidang');
				$latar 	 		= str_replace("'", "", htmlspecialchars($this->input->post('latar'), ENT_QUOTES));
				$tujuan  		= str_replace("'", "", htmlspecialchars($this->input->post('tujuan'), ENT_QUOTES));
				$permasalahan 	= str_replace("'", "", htmlspecialchars($this->input->post('permasalahan'), ENT_QUOTES));
				$metodologi 	= str_replace("'", "", htmlspecialchars($this->input->post('metodologi'), ENT_QUOTES));
				$metode  		= str_replace("'", "", htmlspecialchars($this->input->post('metode'), ENT_QUOTES));

				$status = $this->m_topik->update($idMhs, $judul, $dosen1, $dosen2, $lab, $bidang, $latar, $tujuan, $permasalahan, $metodologi, $metode); // update db
				$this->setPesan('topik', 'merubah', $status); // set alert

				redirect("admin/akun/detail/$idMhs");
			}

			// mendaftarkan/membatalkan pengajuan 
			// elseif (isset($_POST['ubah-status'])) {
			// 	$tahap 	= $this->input->post('ubah-status');
			// 	$status = $this->m_topik->updateTahap($idMhs, $tahap);

			// 	if (($tahap == 0) || ($tahap == 2)) {
			// 		$this->setPesan('topik','membatalkan pendaftaran',$status); // set alert
			// 	}
			// 	else{
			// 		$this->setPesan('topik','mendaftarkan',$status); // set alert
			// 	}
			// 	redirect("admin/akun/detail/$idMhs");
			// }

			elseif (($this->uri->segment('5') == 'tahap') && ($this->uri->segment('6') != '')) {
				$tahap 	= $this->uri->segment('6');
				$status = $this->m_topik->updateTahap($idMhs, $tahap);
				$this->setPesan('tahap mahasiswa', 'merubah', $status);
				redirect("admin/akun/detail/$idMhs");
			} elseif (isset($_POST['simpan-riwayat'])) {
				$this->load->model('m_alur');

				$tahap 		= $this->input->post('tahap');
				$tanggal 	= $this->input->post('tanggal');
				$penguji1 	= $this->input->post('penguji1');
				$penguji2 	= $this->input->post('penguji2');
				$penguji3 	= $this->input->post('penguji3');
				$hasil 		= $this->input->post('hasil');
				$judul 		= $this->input->post('judul');
				$pembimbing1 = $this->input->post('pembimbing1');
				$pembimbing2 = $this->input->post('pembimbing2');
				$keterangan = str_replace("'", "", htmlspecialchars($this->input->post('keterangan'), ENT_QUOTES));

				$status 	= $this->m_topik_riwayat->insert($idMhs, $tanggal, $hasil, $keterangan, $tahap, $penguji1, $penguji2, $penguji3, $judul, $pembimbing1, $pembimbing2);

				$cek 		= $this->m_alur->getAll()->num_rows();
				if ($tahap == ($cek - 1)) {
					$this->load->model('m_jadwal');
					$this->load->model('m_histori');

					$idMhs 	= $this->uri->segment('4');
					$topik	= $this->m_topik->getDetail($idMhs)->row_array(); //mengambil fk dosen 1
					$topik2 = $this->m_topik->getDetail2($idMhs)->row_array(); //mengambil fk dosen 2
					$jadwal = $this->m_jadwal->getById($tanggal)->row_array(); // mengampil tgl yudisium

					$this->m_histori->insert($topik['npm'], $topik['nama'], $topik['judul'], $topik['dosen'], $topik2['nama'], $jadwal['tanggal']);
				}

				$this->setPesan('data mahasiswa', 'manambah', $status);
				redirect("admin/akun/detail/$idMhs");
			} else {
				$this->load->model('m_laboratorium');
				$this->load->model('m_jadwal');
				$this->load->model('m_alur');
				$this->load->model('m_topik_acc');

				if ($this->uri->segment(5) == 'acc') {

					$idDsn 		= $this->uri->segment(6);
					$statusAcc 	= $this->uri->segment(7);
					$posisi		= $this->uri->segment(8);

					$status 	= $this->m_topik_acc->insert($idMhs, $idDsn, $statusAcc, $posisi);

					$this->setPesan('status dosen pembimbing', 'merubah', $status);
					redirect("admin/akun/detail/$idMhs");
				}
				$data['topik']  = $this->m_topik->getDetail($idMhs)->row_array();
				$data['topik2'] = $this->m_topik->getDetail2($idMhs)->row_array();
				
				$data['dosen']  = $this->m_user->getAll('tbl_user_dosen')->result_array();
				$data['lab']    = $this->m_laboratorium->getAll('tbl_laboratorium')->result_array();
				$data['bidang'] = $this->m_laboratorium->getAll('tbl_bidang_keahlian')->result_array();
				$data['alur']   = $this->m_alur->getAll()->result_array();
				
				// Inisialisasi ACC dengan default
				$data['acc'][0] = ['status' => 0];
				$data['acc'][1] = ['status' => 0];
				
				// Pastikan $data['topik'] dan key 'id_dosen_1' ada
				if (!empty($data['topik']) && isset($data['topik']['id_dosen_1'])) {
					$acc0 = $this->m_topik_acc->getByIdMhs($idMhs, $data['topik']['id_dosen_1'], 0)->row_array();
					if (!empty($acc0)) {
						$data['acc'][0] = $acc0;
						if ($data['acc'][0]['status'] === '') {
							$data['acc'][0]['status'] = 0;
						}
					}
				}
				
				// Pastikan $data['topik2'] dan key 'id_dosen_2' ada
				if (!empty($data['topik2']) && isset($data['topik2']['id_dosen_2'])) {
					$acc1 = $this->m_topik_acc->getByIdMhs($idMhs, $data['topik2']['id_dosen_2'], 1)->row_array();
					if (!empty($acc1)) {
						$data['acc'][1] = $acc1;
						if ($data['acc'][1]['status'] === '') {
							$data['acc'][1]['status'] = 0;
						}
					}
				}
				
				// Load ke view
				$this->template->load('v_master', 'admin/akun/mahasiswa-detail', $data);				
			}
		} elseif ($uri == 'profil') {
			$data['data'] 	= $this->m_user->getById($idMhs, 'tbl_user_mahasiswa')->row_array();
			$this->template->load('v_master', 'admin/akun/mahasiswa-profil', $data);
		} elseif ($uri == 'dokumen') {
			$this->load->model('m_dokumen');
			$this->load->model('m_dokumen_mahasiswa');
			$this->load->model('m_alur');

			if ($this->uri->segment('5') == 'validasi') {
				$id 	= $this->uri->segment('6');
				$status = $this->m_dokumen_mahasiswa->updateStatus($id, '2');
				$this->setPesan('berkas', 'memvalidasi', $status);

				redirect("admin/akun/dokumen/$idMhs");
			} elseif ($this->uri->segment('5') == 'batalvalidasi') {
				$id 	= $this->uri->segment('6');
				$status = $this->m_dokumen_mahasiswa->updateStatus($id, '1');
				$this->setPesan('berkas', 'membatalkan validasi', $status);

				redirect("admin/akun/dokumen/$idMhs");
			}

			$data['data'] 		= $this->m_user->getById($idMhs, 'tbl_user_mahasiswa')->row_array();
			$data['berkasMhs']	= $this->m_dokumen_mahasiswa->getByIdMhs($idMhs)->result_array();
			$data['berkas']		= $this->m_dokumen->getAll()->result_array();
			$data['alur']		= $this->m_alur->getAll()->result_array();

			$this->template->load('v_master', 'admin/akun/mahasiswa-dokumen', $data);
		} elseif ($uri == 'bimbingan') {
			$this->load->model('m_bimbingan');
			$this->load->model('m_topik');

			if ($this->uri->segment('5') == 'validasi') {
				$id 	= $this->uri->segment('6');
				$status = $this->m_bimbingan->updateStatus($id, '2');
				$this->setPesan('bimbingan', 'memvalidasi', $status);

				redirect("admin/akun/bimbingan/$idMhs");
			}

			$data['data']		= $this->m_user->getById($idMhs, 'tbl_user_mahasiswa')->row_array();
			$data['topik']	 	= $this->m_topik->getByIdMhs($idMhs)->row_array();
			$data['dosen'] 		= $this->m_user->getAll('tbl_user_dosen')->result_array();
			$data['bimbingan'] 	= $this->m_bimbingan->getByIdMhs($idMhs)->result_array();

			$this->template->load('v_master', 'admin/akun/mahasiswa-bimbingan', $data);
		} elseif ($uri == 'riwayat') {
			$this->load->model('m_topik_riwayat');
			if ($this->uri->segment('5') == 'hapus') {
				$id 	= $this->uri->segment('6');
				$status = $this->m_topik_riwayat->delete($id);

				$this->setPesan('riwayat mahasiswa', 'menghapus', $status);
				redirect("admin/akun/riwayat/$idMhs");
			} else {
				$this->load->model('m_alur');

				$data['alur']		= $this->m_alur->getAll()->result_array();
				$data['dosen'] 		= $this->m_user->getAll('tbl_user_dosen')->result_array();
				$data['data'] 		= $this->m_user->getById($idMhs, 'tbl_user_mahasiswa')->row_array();
				$data['riwayat']	= $this->m_topik_riwayat->getAllById($idMhs)->result_array();

				$this->template->load('v_master', 'admin/akun/mahasiswa-riwayat', $data);
			}
		} elseif ($uri == 'pemberitahuan') {
			$this->load->model('m_email');

			if (isset($_POST['kirim'])) {
				$this->load->library('custom/api');

				$id 	= $this->input->post('id');
				$email 	= $this->input->post('email');
				$pesan 	= str_replace("'", "", htmlspecialchars($this->input->post('pesan'), ENT_QUOTES));
				$chatid = $this->input->post('telegram');

				$status = $this->api->sendMail($email, 'Pemberitahuan', $pesan); //kirim email

				if ($status == 'oke') {
					//	$this->api->sendTelegram($chatid, $pesan); //kirim telegram
					$this->m_email->insert($id, $pesan, date('Y-m-d H:i:s')); // insert jika berhasil mengirim
				}

				$this->setPesan('pesan', 'mengirim', $status);
				redirect("admin/akun/pemberitahuan/$id");
			}

			$data['mahasiswa']	= $this->m_user->getById($idMhs, 'tbl_user_mahasiswa')->row_array();
			$data['email'] 		= $this->m_email->getByIdMhs($idMhs)->result_array();
			$this->template->load('v_master', 'admin/akun/mahasiswa-pemberitahuan', $data);
		} elseif ($uri == 'dosen') {
			$this->load->model('m_laboratorium');
			$this->load->model('m_status_lektor');
			
			$data['lab'] = $this->m_laboratorium->getAll('tbl_laboratorium')->result_array();
			$data['data']	= $this->m_user->getAll($table)->result_array();
			$data['status_lektor'] = $this->m_status_lektor->getAll('tbl_status_lektor')->result_array();
			
			$this->template->load('v_master', 'admin/akun/akun', $data);
		} elseif (($uri == 'admin') || ($uri == 'pimpinan')) {
			$data['data']	= $this->m_user->getAll($table)->result_array();
			$this->template->load('v_master', 'admin/akun/akun', $data);
		} else {
			redirect('admin');
		}
	}

	function email()
	{
		$this->load->model('m_email');

		if ($this->uri->segment('3') == 'hapus') {
			$id 	= $this->uri->segment('4');
			$status = $this->m_email->delete($id);
			$this->setPesan('pesan', 'menghapus', $status);

			redirect('admin/email');
		}

		$data['data'] 	= $this->m_email->getAll()->result_array();
		$this->template->load('v_master', 'admin/email', $data);
	}

	function berita()
	{
		$this->load->model('m_berita');
		$this->load->model('m_carousel');

		if (isset($_POST['simpan-berita'])) {
			$judul 		= str_replace("'", "", htmlspecialchars($this->input->post('judul'), ENT_QUOTES));
			$tanggal	= date('Y-m-d H:i:s');
			$keterangan = str_replace("'", "", htmlspecialchars($this->input->post('keterangan'), ENT_QUOTES));

			$lokasi 	= './data/berita'; // lokasi menyimpan file
			$name 		= 'file'; //name target form yg dikirim
			$pesan 		= 'Berita';
			$allow 		= 'gif|jpg|png';

			$namaFile = $this->unggah($lokasi, $name, $pesan, $allow); // memanggil fungsi utk unggah file
			if ($namaFile != 'err') {
				$status = $this->m_berita->insert($judul, $tanggal, $keterangan, $namaFile); // insert ke db
				$this->setPesan('berita', 'menambah', $status);
			}
			redirect('admin/berita');
		} elseif (isset($_POST['simpan-ubah'])) {
			$id 			= $this->input->post('id');
			$judul 			= str_replace("'", "", htmlspecialchars($this->input->post('judul'), ENT_QUOTES));
			$keterangan		= str_replace("'", "", htmlspecialchars($this->input->post('keterangan'), ENT_QUOTES));

			$namaFileLama	= $this->input->post('namaFile');
			// menyimpan file baru
			$lokasi 		= './data/berita';
			$name 			= 'file';
			$pesan 			= 'Berita';
			$allow 			= 'gif|jpg|png';

			$namaFileBaru 	= $this->unggah($lokasi, $name, $pesan, $allow);

			if ($namaFileBaru != 'err') { //jika berhasil unggah
				// menghapus file lama
				$lokasiFile = './data/berita/' . $namaFileLama;
				if (file_exists($lokasiFile)) {
					unlink($lokasiFile); // menghapus file
				}
				$this->m_berita->update($id, $judul, $keterangan, $namaFileBaru); // insert ke db
			} else { //jika tidak ada file utk diunggah
				$status = $this->m_berita->update($id, $judul, $keterangan, $namaFileLama);
				$this->setPesan('berita', 'merubah', $status);
			}

			redirect("admin/berita/lihat/$id");
		} elseif (isset($_POST['simpan-carousel'])) {
			$judul 	= str_replace("'", "", htmlspecialchars($this->input->post('judul'), ENT_QUOTES));
			$lokasi = './data/carousel';
			$name 	= 'file';
			$pesan 	= 'Gambar';
			$allow 	= 'gif|jpg|png';

			$namaFile = $this->unggah($lokasi, $name, $pesan, $allow); // memanggil fungsi utk unggah file
			if ($namaFile != 'err') {
				$this->m_carousel->insert($judul, $namaFile); // insert ke db
			}
			redirect('admin/berita');
		} elseif ($this->uri->segment('3') == 'hapus-berita') {
			$id 		= $this->uri->segment('4');
			$namaFile	= $this->uri->segment('5');
			$lokasiFile = 'data/berita/' . $namaFile;

			$status 	= $this->m_berita->delete($id); //menghapus pada db
			if (file_exists($lokasiFile)) {
				unlink($lokasiFile); // menghapus file
			}

			$this->setPesan('berita', 'menghapus', $status); //set alert
			redirect('admin/berita');
		} elseif ($this->uri->segment('3') == 'hapus-carousel') {
			$id 		= $this->uri->segment('4');
			$namaFile	= $this->uri->segment('5');
			$lokasiFile = 'data/carousel/' . $namaFile;

			$status 	= $this->m_carousel->delete($id); //menghapus pada db
			if (file_exists($lokasiFile)) {
				unlink($lokasiFile); // menghapus file
			}

			$this->setPesan('carousel', 'menghapus', $status); //set alert
			redirect('admin/berita');
		} elseif ($this->uri->segment('3') == 'lihat') {
			$id 				= $this->uri->segment('4');
			$data['berita'] 	= $this->m_berita->getById($id)->row_array();
			$this->template->load('v_master', 'admin/berita-lihat', $data);
		} else {
			$data['berita'] 	= $this->m_berita->getAll()->result_array();
			$data['carousel'] 	= $this->m_carousel->getAll()->result_array();

			$this->template->load('v_master', 'admin/berita', $data);
		}
	}

	function alur()
	{
		$this->load->model('m_alur');

		$uri 	= $this->uri->segment('3');
		$id 	= $this->uri->segment('4');

		if (isset($_POST['simpan'])) {
			$judul 		= str_replace("'", "", htmlspecialchars($this->input->post('judul'), ENT_QUOTES));
			$icon 		= $this->input->post('icon');
			$keterangan = $this->input->post('keterangan');
			$daftar 	= $this->input->post('daftar');

			$status 	= $this->m_alur->insert($judul, $icon, $keterangan, $daftar);
			$this->setPesan('alur', 'menambah', $status);

			redirect('admin/alur');
		} elseif (isset($_POST['simpan-ubah'])) {
			$id 		= $this->input->post('id');
			$judul 		= str_replace("'", "", htmlspecialchars($this->input->post('judul'), ENT_QUOTES));
			$icon 		= $this->input->post('icon');
			$keterangan = $this->input->post('keterangan');
			$daftar 	= $this->input->post('daftar');

			$status 	= $this->m_alur->update($id, $judul, $icon, $keterangan, $daftar);
			$this->setPesan('alur', 'mengubah', $status);

			redirect('admin/alur');
		} elseif ($uri == 'ubah') {
			$data['ubah']	= $this->m_alur->getById($id)->row_array();
		} elseif ($uri == 'hapus') {
			$status 	= $this->m_alur->delete($id);
			$this->setPesan('alur', 'menghapus', $status);

			redirect('admin/alur');
		}

		$data['data']	= $this->m_alur->getAll()->result_array();
		$this->template->load('v_master', 'admin/alur', $data);
	}

	function faq()
	{
		$this->load->model('m_faq');

		$uri 	= $this->uri->segment('3');
		$id 	= $this->uri->segment('4');

		if (isset($_POST['simpan'])) {
			$tanya 		= str_replace("'", "", htmlspecialchars($this->input->post('tanya'), ENT_QUOTES));
			$jawab 		= str_replace("'", "", htmlspecialchars($this->input->post('jawab'), ENT_QUOTES));

			$status 	= $this->m_faq->insert($tanya, $jawab);
			$this->setPesan('faq', 'menambah', $status);

			redirect('admin/faq');
		} elseif (isset($_POST['simpan-ubah'])) {
			$id 		= $this->input->post('id');
			$tanya 		= str_replace("'", "", htmlspecialchars($this->input->post('tanya'), ENT_QUOTES));
			$jawab 		= str_replace("'", "", htmlspecialchars($this->input->post('jawab'), ENT_QUOTES));

			$status 	= $this->m_faq->update($id, $tanya, $jawab);
			$this->setPesan('faq', 'mengubah', $status);

			redirect('admin/faq');
		} elseif ($uri == 'detail') {
			$data['ubah']	= $this->m_faq->getById($id)->row_array();
		} elseif ($uri == 'hapus') {
			$status 	= $this->m_faq->delete($id);
			$this->setPesan('faq', 'menghapus', $status);

			redirect('admin/faq');
		}

		$data['data']	= $this->m_faq->getAll()->result_array();
		$this->template->load('v_master', 'admin/faq', $data);
	}

	function histori()
	{
		$this->load->model('m_histori');

		if (isset($_POST['simpan'])) {
			$npm			= $this->input->post('npm');
			$nama			= str_replace("'", "", htmlspecialchars($this->input->post('nama'), ENT_QUOTES));
			$judul			= str_replace("'", "", htmlspecialchars($this->input->post('judul'), ENT_QUOTES));
			$pembimbing1	= $this->input->post('pembimbing1');
			$pembimbing2	= $this->input->post('pembimbing2');
			$tanggal		= $this->input->post('tanggal');

			$status 		= $this->m_histori->insert($npm, $nama, $judul, $pembimbing1, $pembimbing2, $tanggal);
			$this->setPesan('histori judul', 'menambah', $status);

			redirect('admin/histori');
		} elseif (isset($_POST['simpan-ubah'])) {
			$id				= $this->input->post('id');
			$npm			= $this->input->post('npm');
			$nama			= str_replace("'", "", htmlspecialchars($this->input->post('nama'), ENT_QUOTES));
			$judul			= str_replace("'", "", htmlspecialchars($this->input->post('judul'), ENT_QUOTES));
			$pembimbing1	= $this->input->post('pembimbing1');
			$pembimbing2	= $this->input->post('pembimbing2');
			$tanggal		= $this->input->post('tanggal');

			$status 		= $this->m_histori->update($id, $npm, $nama, $judul, $pembimbing1, $pembimbing2, $tanggal);
			$this->setPesan('histori judul', 'merubah', $status);

			redirect('admin/histori');
		} elseif (isset($_POST['impor'])) {
			include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

			if ($_FILES['file']["name"] != '') { //cek apakah ada file yg akan diunggah
				$lokasi 	= './data/import';
				$name 		= 'file';
				$pesan 		= 'import data';
				$allow 		= 'xlsx';

				$namaFile 	= $this->unggah($lokasi, $name, $pesan, $allow); // memanggil fungsi utk unggah file
				if ($namaFile != 'err') {
					$excelreader = new PHPExcel_Reader_Excel2007();
					$loadexcel = $excelreader->load('data/import/' . $namaFile); // Load file yang telah diupload ke folder excel
					$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

					// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
					$data = array();

					$numrow = 1;
					foreach ($sheet as $row) {
						// Cek $numrow apakah lebih dari 1
						// Artinya karena baris pertama adalah nama-nama kolom
						// Jadi dilewat saja, tidak usah diimport
						if ($numrow > 1) {
							// Kita push (add) array data ke variabel data
							array_push($data, array(
								'npm' => $row['B'], // Insert data nis dari kolom A di excel
								'nama' => $row['C'], // Insert data nama dari kolom B di excel
								'judul' => $row['D'], // Insert data jenis kelamin dari kolom C di excel
								'pembimbing_1' => $row['E'],
								'pembimbing_2' => $row['F'],
								'tanggal_lulus' => $row['G'],
								// 'alamat'=>$row['D'], // Insert data alamat dari kolom D di excel
							));
						}

						$numrow++; // Tambah 1 setiap kali looping
					}

					// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
					$this->m_histori->insert_multiple($data);
				}

				redirect('admin/histori');
			}
		} elseif ($this->uri->segment('3') == 'hapus') {
			$id 			= $this->uri->segment('4');
			$status 		= $this->m_histori->delete($id);
			$this->setPesan('histori judul', 'menghapus', $status);

			redirect('admin/histori');
		} elseif ($this->uri->segment('3') == 'ubah') {
			$id 			= $this->uri->segment('4');
			$data['ubah'] 	= $this->m_histori->getById($id)->row_array();
		}

		$data['data'] 		= $this->m_histori->getAll()->result_array();
		$this->template->load('v_master', 'admin/histori', $data);
	}

	function kontak()
	{
		$this->load->model('m_kontak');

		$uri 	= $this->uri->segment('3');
		$id 	= $this->uri->segment('4');

		if (isset($_POST['balas'])) {
			$this->load->library('custom/api');

			$email 		= $this->input->post('email');
			$balasan 	= str_replace("'", "", htmlspecialchars($this->input->post('balasan'), ENT_QUOTES));

			$status = $this->api->sendMail($email, 'Kontak', $balasan); //kirim email

			if ($status == 'oke') {
				$status 	= $this->m_kontak->update($id, $balasan); //update jika berhasil membalas
			}

			$this->setPesan('pesan', 'mengirim', $status);
			redirect('admin/kontak');
		} elseif ($uri == 'detail') {
			$data['ubah']	= $this->m_kontak->getById($id)->row_array();
		} elseif ($uri == 'hapus') {
			$status 	= $this->m_kontak->delete($id);
			$this->setPesan('kontak', 'menghapus', $status);

			redirect('admin/kontak');
		}

		$data['data'] 	= $this->m_kontak->getAll()->result_array();
		$this->template->load('v_master', 'admin/kontak', $data);
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

	function tanggal()
	{
		$this->load->model('m_jadwal');
		$id 	= $this->input->post('brand_id');
		if ($id == '') {
			redirect('admin');
		}

		$data 	= $this->m_jadwal->getByKeterangan($id)->result_array();
		$output = '<select name="tanggal" class="form-control" style="margin-top: -0.5rem; color: black" required="required">';
		foreach ($data as $value) {
			$output .= '<option value="' . $value['id'] . '">' . $this->tgl_indo($value['tanggal']) . ' ' . $value['jam'] . '</option>';
		}
		$output .= '</select>';
		echo $output;
	}

	private function tgl_indo($tanggal)
	{
		$bulan = array(
			1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		);
		$pecahkan = explode('-', $tanggal);
		return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
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
