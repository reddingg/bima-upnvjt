<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_topik_acc extends CI_Model {

    function getByIdMhs($idMhs,$idDsn,$posisi){
        $sql    = "SELECT * FROM tbl_topik_acc WHERE id_mahasiswa = '$idMhs' AND id_dosen = '$idDsn' AND posisi = '$posisi'";
        $query  = $this->db->query($sql);
        return $query;
    }

    function insert($idMhs, $idDsn, $status, $posisi){
        // hapus acc lama
        $sql    = "DELETE FROM tbl_topik_acc WHERE id_mahasiswa='$idMhs' AND posisi ='$posisi'";
        $query  = $this->db->query($sql);
        // insert acc baru
        $sql    = "INSERT INTO tbl_topik_acc VALUES('','$idMhs','$idDsn','$status','$posisi')";
        $query  = $this->db->query($sql);
        if ($query) {
            $status = 'oke';
        }
        else{
            $status = 'err';
        }
        return $status;
    }
}