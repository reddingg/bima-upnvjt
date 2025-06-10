<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_faq extends CI_Model {

	function insert($tanya, $jawab){
        	$sql    = "INSERT INTO tbl_faq VALUES('','$tanya','$jawab')";
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
                $sql    = "SELECT * FROM tbl_faq";
                $query  = $this->db->query($sql);
                return $query;
        }

        function getById($id){
                $sql    = "SELECT * FROM tbl_faq WHERE id='$id'";
                $query  = $this->db->query($sql);
                return $query;
        }

        function update($id, $tanya, $jawab){
                $query = $this->db->query("UPDATE tbl_faq SET tanya='$tanya', jawab='$jawab' WHERE id = '$id'");
                if ($query) {
                        $status = 'oke';
                }
                else{
                        $status = 'err';
                }
                return $status;
        }

        function delete($id){
                $sql    = "DELETE FROM tbl_faq WHERE id='$id'";
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