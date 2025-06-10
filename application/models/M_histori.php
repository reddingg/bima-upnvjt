<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_histori extends CI_Model {

	function insert($npm,$nama,$judul,$pembimbing1,$pembimbing2,$tanggal){
        	$sql    = "INSERT INTO tbl_histori VALUES('','$npm','$nama','$judul','$pembimbing1','$pembimbing2','$tanggal')";
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
                $sql    = "SELECT * FROM tbl_histori ORDER BY id DESC";
                $query  = $this->db->query($sql);
                return $query;
        }

        function getById($id){
                $sql    = "SELECT * FROM tbl_histori WHERE id='$id'";
                $query  = $this->db->query($sql);
                return $query;
        }

        function update($id, $npm,$nama,$judul,$pembimbing1,$pembimbing2,$tanggal){
                $sql   = "UPDATE tbl_histori SET npm='$npm', nama='$nama', judul='$judul', pembimbing_1='$pembimbing1', pembimbing_2='$pembimbing2', tanggal_lulus='$tanggal' WHERE id='$id'";
                $query = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                }
                else{
                        $status = 'err';
                }
                return $status;
        }

        function delete($id){
                $sql    = "DELETE FROM tbl_histori WHERE id='$id'";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                }
                else{
                        $status = 'err';
                }
                return $query;
        }

        function insert_multiple($data){
                $this->db->insert_batch('tbl_histori', $data);
        }

}