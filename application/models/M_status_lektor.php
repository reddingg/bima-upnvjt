<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_status_lektor extends CI_Model {
    function insert($nama, $table) {
        $sql = "INSERT INTO $table VALUES('', '$nama')";
        $query = $this->db->query($sql);

        if ($query) {
            $status = 'oke';
        } else {
            $status = 'err';
        }

        return $query;
    }

    function update($id, $nama, $table) {
        $sql = "UPDATE $table SET nama='$nama' WHERE id='$id'";
        $query = $this->db->query($sql);

        if ($query) {
            $status = 'oke';
        } else {
            $status = 'err';
        }

        return $query;
    }

    function delete($id, $table) {
        $sql = "DELETE FROM $table WHERE id='$id'";
        $query = $this->db->query($sql);

        if ($query) {
            $status = 'oke';
        } else {
            $status = 'err';
        }

        return $query;
    }
    
    function getAll($table) {
        $sql = "SELECT * FROM $table";
        $query = $this->db->query($sql);

        return $query;
    }

    function getById($id, $table) {
        $sql = "SELECT * FROM $table WHERE id='$id'";
        $query = $this->db->query($sql);

        return $query;
    }
}