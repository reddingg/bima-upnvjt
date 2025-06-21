<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

        function cekByEmail($email, $table)
        {
                $sql    = "SELECT * FROM $table WHERE email = '$email'";
                $query  = $this->db->query($sql);
                return $query;
        }

        function insert($email, $password, $nama, $table, $lab, $status_lektor = null)
        {
                $sql    = "INSERT INTO $table (email, password, nama) VALUES('$email', '$password', '$nama')";
                if ($lab != '') {
                        $sql    = "INSERT INTO $table (email,password,nama,id_laboratorium,id_status_lektor) VALUES('$email','$password','$nama','$lab', '$status_lektor')";
                }
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                } else {
                        $status = 'err';
                }
                return $query;
        }

        function insertKode($email, $password, $kode)
        {
                $sql    = "INSERT INTO tbl_user_mahasiswa (email, password, kode) VALUES('$email', '$password', '$kode')";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                } else {
                        $status = 'err';
                }
                return $query;
        }

        function getAll($table)
        {
                $sql    = "SELECT * FROM $table";
                if ($table == 'tbl_user_mahasiswa') {
                        $sql .= ' ORDER BY npm';
                }
                $query  = $this->db->query($sql);
                return $query;
        }

        function getWithTahap()
        {
                $sql    = "SELECT tbl_user_mahasiswa.id,npm, nama, email, tbl_topik.tahap FROM tbl_user_mahasiswa
                LEFT JOIN tbl_topik ON tbl_user_mahasiswa.id = tbl_topik.id_mahasiswa ORDER BY npm DESC";
                $query  = $this->db->query($sql);
                return $query;
        }

        function getById($id, $table)
        {
                $sql    = "SELECT * FROM $table WHERE id='$id'";
                $query  = $this->db->query($sql);
                return $query;
        }

        function update($id, $password, $nama, $table, $lab, $status_lektor = null)
        {
                $query = $this->db->query("UPDATE $table SET password='$password', nama='$nama' WHERE id = '$id'");
                if ($lab != '') {
                        $query = $this->db->query("UPDATE $table SET password='$password', nama='$nama', id_laboratorium = '$lab', id_status_lektor='$status_lektor' WHERE id = '$id'");
                }
                if ($query) {
                        $status = 'oke';
                } else {
                        $status = 'err';
                }
                return $status;
        }

        function updateProfil($id, $table, $nama, $npm, $nohp, $telegram, $jk, $sks, $ipk, $alamat)
        {
                $query = $this->db->query("UPDATE $table SET nama='$nama', npm='$npm', no_hp='$nohp', telegram='$telegram', jenis_kelamin='$jk', jumlah_sks='$sks', ipk='$ipk', alamat='$alamat' WHERE id = '$id'");
                if ($query) {
                        $status = 'oke';
                } else {
                        $status = 'err';
                }
                return $status;
        }

        function updateFoto($id, $table, $namaFile)
        {
                $query = $this->db->query("UPDATE $table SET foto='$namaFile' WHERE id = '$id'");
                if ($query) {
                        $status = 'oke';
                } else {
                        $status = 'err';
                }
                return $status;
        }

        function updateKuota($idDsn, $kuota1, $kuota2)
        {
                $sql    = "UPDATE tbl_user_dosen SET kuota_pembimbing_1='$kuota1', kuota_pembimbing_2='$kuota2' WHERE id = '$idDsn'";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                } else {
                        $status = 'err';
                }
                return $status;
        }

        function updateStatus($email)
        {
                $sql    = "UPDATE tbl_user_mahasiswa SET status_akun='1' WHERE email = '$email'";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                } else {
                        $status = 'err';
                }
                return $status;
        }

        function setStatusOff($id)
        {
                $sql    = "UPDATE tbl_user_mahasiswa SET status_akun='0' WHERE id = '$id'";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                } else {
                        $status = 'err';
                }
                return $status;
        }

        function setStatusOn($id)
        {
                $sql    = "UPDATE tbl_user_mahasiswa SET status_akun='1' WHERE id = '$id'";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                } else {
                        $status = 'err';
                }
                return $status;
        }

        function updateKode($email, $kode)
        {
                $sql    = "UPDATE tbl_user_mahasiswa SET kode='$kode' WHERE email = '$email'";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                } else {
                        $status = 'err';
                }
                return $status;
        }

        function updatePassword($id, $password, $table)
        {
                $sql    = "UPDATE $table SET password='$password' WHERE id = '$id'";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                } else {
                        $status = 'err';
                }
                return $status;
        }

        function updateDosen($id, $no, $nama, $lab, $bidang, $status_lektor)
        {
                $sql    = "UPDATE tbl_user_dosen SET no_induk='$no', nama='$nama', id_laboratorium='$lab', id_status_lektor='$status_lektor' WHERE id = '$id'";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                } else {
                        $status = 'err';
                }
                return $status;
        }

        function delete($id, $table)
        {

                if ($table == 'tbl_user_mahasiswa') { // hapus child akun mhs
                        $this->db->query("DELETE FROM tbl_topik WHERE id_mahasiswa = '$id'");
                        $this->db->query("DELETE FROM tbl_topik_riwayat WHERE id_mahasiswa = '$id'");
                        $this->db->query("DELETE FROM tbl_bimbingan WHERE id_mahasiswa = '$id'");
                        $this->db->query("DELETE FROM tbl_dokumen_mahasiswa WHERE id_mahasiswa = '$id'");
                        $this->db->query("DELETE FROM tbl_email WHERE id_mahasiswa = '$id'");
                } elseif ($table == 'tbl_user_dosen') { //ubah child
                        $this->db->query("UPDATE tbl_topik SET id_dosen_1='1' WHERE id_dosen_1 = '$id'");
                        $this->db->query("UPDATE tbl_topik SET id_dosen_2='1' WHERE id_dosen_2 = '$id'");
                        $this->db->query("UPDATE tbl_bimbingan SET id_dosen='1' WHERE id_dosen = '$id'");
                        $this->db->query("UPDATE tbl_topik_riwayat SET penguji_1='1' WHERE penguji_1 = '$id'");
                        $this->db->query("UPDATE tbl_topik_riwayat SET penguji_2='1' WHERE penguji_2 = '$id'");
                        $this->db->query("UPDATE tbl_topik_riwayat SET penguji_3='1' WHERE penguji_3 = '$id'");
                }

                $sql    = "DELETE FROM $table WHERE id='$id'";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                } else {
                        $status = 'err';
                }
                return $query;
        }

        function saw($id)
        {
                $sql    = "SELECT tbl_user_mahasiswa.id, tbl_user_mahasiswa.npm, tbl_user_mahasiswa.nama,  tbl_user_mahasiswa.ipk, tbl_user_mahasiswa.jumlah_sks, tbl_topik.id_laboratorium, tbl_topik.id_dosen_1, tbl_topik.id_dosen_2 FROM tbl_user_mahasiswa
                        INNER JOIN tbl_topik ON tbl_topik.id_mahasiswa = tbl_user_mahasiswa.id WHERE tbl_user_mahasiswa.id ='$id'";
                $query  = $this->db->query($sql);
                return $query;
        }

        function getByAngkatan($tahun)
        {
                $sql    = "SELECT id FROM tbl_user_mahasiswa WHERE npm LIKE '$tahun%'";
                $query  = $this->db->query($sql);
                return $query;
        }

        function getJumlahKuotaDosenById($idDsn, $kolom)
        {
                $sql    = "SELECT $kolom FROM tbl_user_dosen WHERE id = '$idDsn'";
                $query  = $this->db->query($sql);
                return $query;
        }
}
