<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kontak extends CI_Model {

	function insert($nama,$email,$subjek,$pesan,$tanggal){
        	$sql    = "INSERT INTO tbl_kontak VALUES('','$nama','$email','$subjek','$pesan','','$tanggal')";
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
                $sql    = "SELECT * FROM tbl_kontak";
                $query  = $this->db->query($sql);
                return $query;
        }

        function getById($id){
                $sql    = "SELECT * FROM tbl_kontak WHERE id='$id'";
                $query  = $this->db->query($sql);
                return $query;
        }

        function update($id, $balasan){
                $query = $this->db->query("UPDATE tbl_kontak SET balasan='$balasan' WHERE id = '$id'");
                if ($query) {
                        $status = 'oke';
                }
                else{
                        $status = 'err';
                }
                return $status;
        }

        function delete($id){
                $sql    = "DELETE FROM tbl_kontak WHERE id='$id'";
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