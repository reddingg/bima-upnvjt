<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bimbingan extends CI_Model {

	function insert($idMhs,$tanggal,$dosen,$materi){
        	$sql    = "INSERT INTO tbl_bimbingan VALUES('','$idMhs','$dosen','$materi','$tanggal','')";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                }
                else{
                        $status = 'err';
                }
                return $query;
	}

        function getByIdMhs($idMhs){
                $sql    = "SELECT * FROM tbl_bimbingan WHERE id_mahasiswa ='$idMhs'";
                $query  = $this->db->query($sql);
                return $query;
        }

        function getByIdDsn($idDsn){
                $sql    = "SELECT tbl_bimbingan.id, tbl_bimbingan.materi, tbl_bimbingan.tanggal, tbl_bimbingan.status, tbl_user_mahasiswa.nama, tbl_user_mahasiswa.npm FROM tbl_bimbingan 
                        INNER JOIN tbl_user_mahasiswa ON tbl_bimbingan.id_mahasiswa = tbl_user_mahasiswa.id 
                        WHERE tbl_bimbingan.id_dosen ='$idDsn' ORDER BY tbl_bimbingan.id DESC";
                $query  = $this->db->query($sql);
                return $query;
        }

        function updateStatus($id,$status){
                $sql    = "UPDATE tbl_bimbingan SET status = '$status' WHERE id='$id'";
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
                $sql    = "DELETE FROM tbl_bimbingan WHERE id='$id'";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                }
                else{
                        $status = 'err';
                }
                return $query;
        }

        function frekuensi($id,$tanggal){
                $sql    = "SELECT id FROM tbl_bimbingan WHERE id_dosen = '$id' AND tanggal LIKE '$tanggal'";
                $query  = $this->db->query($sql);
                return $query;
        }

        function frekuensiAll($tanggal){
                $sql    = "SELECT id FROM tbl_bimbingan WHERE tanggal LIKE '$tanggal'";
                $query  = $this->db->query($sql);
                return $query;
        }

}