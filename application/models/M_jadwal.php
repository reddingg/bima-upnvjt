<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jadwal extends CI_Model {

	function insert($tanggal, $jam, $keterangan){
        	$sql    = "INSERT INTO tbl_jadwal VALUES('','$tanggal','$jam','$keterangan')";
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
                $sql    = "SELECT * FROM tbl_jadwal ORDER BY id DESC";
                $query  = $this->db->query($sql);
                return $query;
        }

        function getById($id){
                $sql    = "SELECT * FROM tbl_jadwal WHERE id='$id'";
                $query  = $this->db->query($sql);
                return $query;
        }

        function getByKeterangan($keterangan){
                $sql    = "SELECT * FROM tbl_jadwal WHERE keterangan='$keterangan' ORDER BY id DESC";
                $query  = $this->db->query($sql);
                return $query;
        }

        function update($id, $tanggal, $jam, $keterangan){
                $query = $this->db->query("UPDATE tbl_jadwal SET tanggal='$tanggal', jam='$jam', keterangan='$keterangan' WHERE id = '$id'");
                if ($query) {
                        $status = 'oke';
                }
                else{
                        $status = 'err';
                }
                return $status;
        }

        function delete($id){
                $sql    = "DELETE FROM tbl_jadwal WHERE id='$id'";
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