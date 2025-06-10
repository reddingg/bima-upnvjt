<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laboratorium extends CI_Model {

        function getAll($table){
            $sql    = "SELECT * FROM $table";
            $query  = $this->db->query($sql);
            return $query;
        }

        function getById($id,$table){
            $sql    = "SELECT * FROM $table WHERE id='$id'";
            $query  = $this->db->query($sql);
            return $query;
        }

        function insert($nama,$table){
        	$sql    = "INSERT INTO $table VALUES('','$nama')";
            $query  = $this->db->query($sql);
            if ($query) {
                    $status = 'oke';
            }
            else{
                    $status = 'err';
            }
            return $query;
        }

        function update($id, $nama,$table){
        	$sql    = "UPDATE $table SET nama='$nama' WHERE id='$id'";
            $query  = $this->db->query($sql);
            if ($query) {
                    $status = 'oke';
            }
            else{
                    $status = 'err';
            }
            return $query;
        }

        function delete($id,$table){
            if ($table == 'tbl_laboratorium') {
                $this->db->query("UPDATE tbl_topik set id_laboratorium = '1' WHERE id_laboratorium = '$id'");
                $this->db->query("UPDATE tbl_user_dosen set id_laboratorium = '1' WHERE id_laboratorium = '$id'");
            }
            else{
                $this->db->query("UPDATE tbl_topik set id_bidang_keahlian = '1' WHERE id_bidang_keahlian = '$id'");
            }

        	$sql    = "DELETE FROM $table WHERE id='$id'";
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