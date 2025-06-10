<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_carousel extends CI_Model {

	function insert($judul, $namaFile){
        	$sql    = "INSERT INTO tbl_carousel VALUES('','$judul','$namaFile')";
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
                $sql    = "SELECT * FROM tbl_carousel";
                $query  = $this->db->query($sql);
                return $query;
        }

        function delete($id)
        {
                $sql    = "DELETE FROM tbl_carousel WHERE id='$id'";
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