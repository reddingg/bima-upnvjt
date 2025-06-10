<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dokumen extends CI_Model {

	function insert($nama,$jumlah,$jenis,$namaFile){
        	$sql    = "INSERT INTO tbl_dokumen VALUES('','$nama',$jumlah,'$jenis','$namaFile')";
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
                $sql    = "SELECT * FROM tbl_dokumen";
                $query  = $this->db->query($sql);
                return $query;
        }

        function getByJenis($jenis){
                $sql    = "SELECT * FROM tbl_dokumen WHERE jenis = '$jenis'";
                $query  = $this->db->query($sql);
                return $query;
        }

        function delete($id){
                $sql    = "DELETE FROM tbl_dokumen WHERE id='$id'";
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