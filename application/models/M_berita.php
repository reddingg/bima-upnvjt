<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_berita extends CI_Model {

	function insert($judul, $tanggal, $keterangan, $namaFile){
        	$sql    = "INSERT INTO tbl_berita VALUES('','$tanggal','$judul','$keterangan','$namaFile')";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                }
                else{
                        $status = 'err';
                }
                return $query;
	}

        function getAll(){
                $sql    = "SELECT * FROM tbl_berita ORDER BY id DESC";
                $query  = $this->db->query($sql);
                return $query;
        }

        function getById($id){
                $sql    = "SELECT * FROM tbl_berita WHERE id='$id'";
                $query  = $this->db->query($sql);
                return $query;
        }

        function getByLimit($bawah, $atas){
                $sql    = "SELECT * FROM tbl_berita ORDER BY tanggal DESC LIMIT $bawah, $atas";
                $query  = $this->db->query($sql);
                return $query;
        }

        function update($id, $judul, $keterangan, $namaFile){
                $query = $this->db->query("UPDATE tbl_berita SET judul='$judul', keterangan='$keterangan', nama_file='$namaFile' WHERE id = '$id'");
                if ($query) {
                        $status = 'oke';
                }
                else{
                        $status = 'err';
                }
                return $status;
        }

        function delete($id)
        {
                $sql    = "DELETE FROM tbl_berita WHERE id='$id'";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                }
                else{
                        $status = 'err';
                }
                return $query;
        }

}