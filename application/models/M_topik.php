<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_topik extends CI_Model {

    function getByIdMhs($idMhs){
        $sql    = "SELECT * FROM tbl_topik WHERE id_mahasiswa='$idMhs'";
        $query  = $this->db->query($sql);
        return $query;
    }

    function insert($idMhs, $judul, $dosen1, $dosen2, $lab, $bidang, $latar, $tujuan, $permasalahan, $metodologi, $metode){
    	$sql    = "INSERT INTO tbl_topik (id_mahasiswa, judul, id_dosen_1, id_dosen_2, id_laboratorium, id_bidang_keahlian, latar_belakang, tujuan, permasalahan, metodologi, metode) VALUES('$idMhs', '$judul', '$dosen1', '$dosen2', '$lab', '$bidang', '$latar', '$tujuan', '$permasalahan', '$metodologi', '$metode')";
    	$query  = $this->db->query($sql);
    	if ($query) {
            $status = 'oke';
        }
        else{
            $status = 'err';
        }
        return $status;
    }

    function update($idMhs, $judul, $dosen1, $dosen2, $lab, $bidang, $latar, $tujuan, $permasalahan, $metodologi, $metode){
    	$sql	= "UPDATE tbl_topik SET judul='$judul', id_dosen_1='$dosen1', id_dosen_2='$dosen2', id_laboratorium='$lab', id_bidang_keahlian='$bidang', latar_belakang='$latar', tujuan='$tujuan', permasalahan='$permasalahan', metodologi='$metodologi', metode='$metode' WHERE id_mahasiswa = '$idMhs'";
    	$query 	= $this->db->query($sql);
        if ($query) {
            $status = 'oke';
        }
        else{
            $status = 'err';
        }
        return $status;
    }

    function getByTahap($tahap){
        $sql    = "SELECT tbl_topik.id_mahasiswa, tbl_topik.judul, tbl_topik.tahap, tbl_user_mahasiswa.npm, tbl_user_mahasiswa.nama, tbl_user_dosen.nama AS dosen 
                    FROM tbl_topik 
                    INNER JOIN tbl_user_mahasiswa
                    ON tbl_user_mahasiswa.id = tbl_topik.id_mahasiswa
                    INNER JOIN tbl_user_dosen
                    ON tbl_user_dosen.id = tbl_topik.id_dosen_1 WHERE tbl_topik.tahap ='$tahap'";
        $query  = $this->db->query($sql);
        return $query;
    }

    function getByTahap2($tahap){
        $sql    = "SELECT tbl_user_dosen.nama AS dosen FROM tbl_topik INNER JOIN tbl_user_dosen ON tbl_user_dosen.id = tbl_topik.id_dosen_2 WHERE tbl_topik.tahap ='$tahap'";
        $query  = $this->db->query($sql);
        return $query;
    }

    function updateTahap($idMhs, $tahap){
        $sql    = "UPDATE tbl_topik SET tahap='$tahap' WHERE id_mahasiswa = '$idMhs'";
        $query  = $this->db->query($sql);
        if ($query) {
            $status = 'oke';
        }
        else{
            $status = 'err';
        }
        return $status;
    }

    function getDetail($idMhs){
        $sql    = "SELECT tbl_topik.id_mahasiswa, tbl_topik.latar_belakang, tbl_topik.tujuan, tbl_topik.permasalahan, tbl_topik.metodologi, tbl_topik.metode, tbl_topik.tahap, tbl_topik.judul, tbl_user_mahasiswa.nama, tbl_user_dosen.nama AS dosen, tbl_user_dosen.id AS id_dosen_1, tbl_user_mahasiswa.npm, tbl_laboratorium.nama AS lab, tbl_laboratorium.id AS id_laboratorium, tbl_bidang_keahlian.nama AS bidang, tbl_bidang_keahlian.id AS id_bidang_keahlian
                FROM tbl_topik
                INNER JOIN tbl_user_mahasiswa
                ON tbl_user_mahasiswa.id = tbl_topik.id_mahasiswa
                INNER JOIN tbl_user_dosen
                ON tbl_user_dosen.id = tbl_topik.id_dosen_1
                INNER JOIN tbl_laboratorium
                ON tbl_laboratorium.id = tbl_topik.id_laboratorium
                INNER JOIN tbl_bidang_keahlian
                ON tbl_bidang_keahlian.id = tbl_topik.id_bidang_keahlian
                WHERE tbl_topik.id_mahasiswa = '$idMhs'";
        $query  = $this->db->query($sql);
        return $query;
    }

    function getDetail2($idMhs){
        $sql    = "SELECT tbl_user_dosen.nama AS nama, tbl_user_dosen.id as id_dosen_2 FROM tbl_topik
                INNER JOIN tbl_user_dosen
                ON tbl_user_dosen.id = tbl_topik.id_dosen_2
                WHERE tbl_topik.id_mahasiswa = '$idMhs'";
        $query  = $this->db->query($sql);
        return $query;
    }

    function getJumlahAktif($kolom, $bawah, $atas){
        $sql    = "SELECT $kolom, COUNT( id_mahasiswa ) AS total FROM tbl_topik WHERE tahap BETWEEN $bawah AND $atas GROUP BY $kolom";
        $query  = $this->db->query($sql);
        return $query;
    }

    function getJumlahSelesai($kolom, $atas){
        $sql    = "SELECT $kolom, COUNT( id_mahasiswa ) AS total FROM tbl_topik WHERE tahap > '$atas' GROUP BY $kolom";
        $query  = $this->db->query($sql);
        return $query;
    }

    function getAktifByIdDosen($idDsn, $bawah, $atas){
        $sql    = "SELECT id_mahasiswa,id_dosen_1,id_dosen_2,judul, tbl_user_mahasiswa.nama, tbl_user_mahasiswa.npm FROM tbl_topik 
                INNER JOIN tbl_user_mahasiswa
                ON tbl_user_mahasiswa.id = tbl_topik.id_mahasiswa 
                WHERE (id_dosen_1 = '$idDsn' AND tahap BETWEEN $bawah AND $atas) OR (id_dosen_2 = '$idDsn' AND tahap BETWEEN $bawah AND $atas)";
        $query  = $this->db->query($sql);
        return $query;
    }

    function getSelesaiByIdDosen($idDsn, $atas){
        $sql    = "SELECT id_mahasiswa,id_dosen_1,id_dosen_2,judul, tbl_user_mahasiswa.nama, tbl_user_mahasiswa.npm FROM tbl_topik 
                INNER JOIN tbl_user_mahasiswa
                ON tbl_user_mahasiswa.id = tbl_topik.id_mahasiswa
                WHERE (id_dosen_1 = '$idDsn' AND tahap > '$atas') OR (id_dosen_2 = '$idDsn' AND tahap > '$atas')";
        $query  = $this->db->query($sql);
        return $query;
    }

    function frekuensi($idBidang){
        $sql    = "SELECT id FROM tbl_topik WHERE id_bidang_keahlian = '$idBidang'";
        $query  = $this->db->query($sql);
        return $query;
    }

    function getJumlahAktifByIdDsn($idDsn, $kolom, $bawah, $atas){
        $sql    = "SELECT id FROM tbl_topik WHERE $kolom = '$idDsn' AND tahap BETWEEN $bawah AND $atas";
        $query  = $this->db->query($sql);
        return $query;
    }
}