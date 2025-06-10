<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_email extends CI_Model {

        function insert($idMhs, $pesan, $tanggal){
                $sql    = "INSERT INTO tbl_email VALUES('','$idMhs','$pesan','$tanggal','')";
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
                $sql    = "SELECT tbl_email.id, tbl_user_mahasiswa.id as id_mahasiswa, tbl_user_mahasiswa.email, pesan, tanggal FROM tbl_email
                        INNER JOIN tbl_user_mahasiswa
                        ON tbl_user_mahasiswa.id = id_mahasiswa";
                $query  = $this->db->query($sql);
                return $query;
        }

        function getByIdMhs($idMhs){
                $sql    = "SELECT * FROM tbl_email WHERE id_mahasiswa = '$idMhs' ORDER BY id DESC";
                $query  = $this->db->query($sql);
                return $query;
        }

        function updateStatus($id){
                $sql    = "UPDATE tbl_email SET status='1' WHERE id_mahasiswa='$id'";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                }
                else{
                        $status = 'err';
                }
                return $query;
        }

        function delete($id){
                $sql    = "DELETE FROM tbl_email WHERE id='$id'";
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