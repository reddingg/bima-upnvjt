<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dokumen_mahasiswa extends CI_Model {

        function insert($idMhs, $id_dokumen, $namaFile, $status){
                $sql    = "INSERT INTO tbl_dokumen_mahasiswa VALUES('','$idMhs',$id_dokumen,'$namaFile','$status')";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                }
                else{
                        $status = 'err';
                }
                return $query;
        }

        function getById($id){
                $sql = "SELECT * FROM tbl_dokumen_mahasiswa WHERE id = '$id'";
                $query  = $this->db->query($sql);
                return $query;
        }

        function getByIdMhs($idMhs){
                $sql = "SELECT * FROM tbl_dokumen_mahasiswa WHERE id_mahasiswa = '$idMhs'";
                $query  = $this->db->query($sql);
                return $query;
        }

        function updateStatus($id,$status){
                $sql    = "UPDATE tbl_dokumen_mahasiswa SET status = '$status' WHERE id='$id'";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                }
                else{
                        $status = 'err';
                }
                return $query;
        }

        function delete($id,$idMhs){
                $sql    = "DELETE FROM tbl_dokumen_mahasiswa WHERE id='$id' AND id_mahasiswa ='$idMhs'";
                $query  = $this->db->query($sql);
                if ($query) {
                        $status = 'oke';
                }
                else{
                        $status = 'err';
                }
                return $query;
        }

        function deleteAll($id){
                $sql    = "DELETE FROM tbl_dokumen_mahasiswa WHERE id_dokumen='$id'";
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