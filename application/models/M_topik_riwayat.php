<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_topik_riwayat extends CI_Model {

    function getAll(){
        $sql    = "SELECT tbl_topik_riwayat.id_mahasiswa, tbl_topik_riwayat.judul, tbl_topik_riwayat.id_dosen_1,  tbl_topik_riwayat.id_dosen_2, tbl_topik_riwayat.status, tbl_topik_riwayat.keterangan, tbl_topik_riwayat.tahap, tbl_topik_riwayat.penguji_1, tbl_topik_riwayat.penguji_2, tbl_topik_riwayat.penguji_3, tbl_user_mahasiswa.nama, tbl_user_mahasiswa.npm, tbl_jadwal.tanggal FROM tbl_topik_riwayat INNER JOIN tbl_user_mahasiswa ON tbl_user_mahasiswa.id = tbl_topik_riwayat.id_mahasiswa INNER JOIN tbl_jadwal ON tbl_jadwal.id = tbl_topik_riwayat.id_jadwal ORDER BY tbl_topik_riwayat.id DESC";
        $query  = $this->db->query($sql);
        return $query;
    }

    function getAllById($idMhs){
        $sql    = "SELECT tbl_topik_riwayat.id, tbl_topik_riwayat.judul, tbl_topik_riwayat.id_dosen_1,  tbl_topik_riwayat.id_dosen_2, tbl_topik_riwayat.status, tbl_topik_riwayat.keterangan, tbl_topik_riwayat.tahap, tbl_topik_riwayat.penguji_1, tbl_topik_riwayat.penguji_2, tbl_topik_riwayat.penguji_3, tbl_jadwal.tanggal, tbl_jadwal.jam FROM tbl_topik_riwayat
        INNER JOIN tbl_jadwal ON tbl_jadwal.id = tbl_topik_riwayat.id_jadwal
        WHERE tbl_topik_riwayat.id_mahasiswa = '$idMhs'";
        $query  = $this->db->query($sql);
        return $query;
    }

    function insert($idMhs,$tanggal,$hasil,$keterangan,$tahap,$penguji1,$penguji2,$penguji3,$judul,$pembimbing1,$pembimbing2){
        //hapus riwayat lama
        $sql    = "DELETE FROM tbl_topik_riwayat WHERE id_mahasiswa='$idMhs' AND id_jadwal = '$tanggal'";
        $query  = $this->db->query($sql);

        //insert riwayat baru
        $sql    = "INSERT INTO tbl_topik_riwayat VALUES('','$idMhs','$tanggal','$hasil','$keterangan','$tahap','$penguji1','$penguji2','$penguji3','$judul','$pembimbing1','$pembimbing2')";
        $query  = $this->db->query($sql);
        if ($query) {
            $status = 'oke';
        }
        else{
            $status = 'err';
        }
        return $status;
    }

    function getByIdJadwal($id){
        $sql    = "SELECT tbl_topik_riwayat.id_mahasiswa, tbl_jadwal.tanggal, tbl_user_mahasiswa.nama, tbl_user_mahasiswa.npm, tbl_topik.judul, tbl_topik.tahap FROM tbl_topik_riwayat 
                INNER JOIN tbl_user_mahasiswa
                ON tbl_user_mahasiswa.id = tbl_topik_riwayat.id_mahasiswa
                INNER JOIN tbl_topik
                ON tbl_topik.id_mahasiswa = tbl_topik_riwayat.id_mahasiswa
                INNER JOIN tbl_jadwal
                ON tbl_jadwal.id = tbl_topik_riwayat.id_jadwal
                WHERE id_jadwal = '$id'";
        $query  = $this->db->query($sql);
        return $query;
    }

    function frekuensi($tahap,$tanggal){
        $sql    = "SELECT tbl_topik_riwayat.id FROM tbl_topik_riwayat INNER JOIN tbl_jadwal ON tbl_jadwal.id = tbl_topik_riwayat.id_jadwal WHERE tahap = '$tahap' AND tbl_jadwal.tanggal LIKE '$tanggal%'";
        $query  = $this->db->query($sql);
        return $query;
    }

    function delete($id){
        $sql    = "DELETE FROM tbl_topik_riwayat WHERE id='$id'";
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