<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_alur extends CI_Model {

	function insert($judul, $icon, $keterangan, $daftar){
        	$sql    = "INSERT INTO tbl_alur VALUES('','$judul','$icon','$keterangan', $daftar)";
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
                $sql    = "SELECT * FROM tbl_alur";
                $query  = $this->db->query($sql);
                return $query;
        }

        function getById($id){
                $sql    = "SELECT * FROM tbl_alur WHERE id='$id'";
                $query  = $this->db->query($sql);
                return $query;
        }

        function update($id, $judul, $icon, $keterangan, $daftar){
                $query = $this->db->query("UPDATE tbl_alur SET judul='$judul', icon='$icon', keterangan='$keterangan', daftar='$daftar' WHERE id = '$id'");
                if ($query) {
                        $status = 'oke';
                }
                else{
                        $status = 'err';
                }
                return $status;
        }

        function delete($id){
                $sql    = "DELETE FROM tbl_alur WHERE id='$id'";
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