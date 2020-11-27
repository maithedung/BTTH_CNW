<?php
class Database
{
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'quanlynhanvien_mvc';

    private $conn = NULL;
    private $result = NULL;

    public function connect()
    {
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
        if (!$this->conn) {
            echo 'Connect fail';
            exit();
        } else {
            mysqli_set_charset($this->conn, 'utf8');
        }
        return $this->conn;
    }

    public function execute($sql)
    {
        $this->result = $this->conn->query($sql);
        return $this->result;
    }

    public function getData()
    {
        if ($this->result) {
            $data = mysqli_fetch_array($this->result);
        } else {
            $data = 0;
        }
        return $data;
    }

    public function getAllData($table)
    {
        $sql = "SELECT * FROM $table";
        $this->execute(($sql));
        if ($this->num_rows() == 0) {
            $data = 0;
        } else {
            while ($datas = $this->getData($table)) {
                $data[] = $datas;
            }
        }
        return $data;
    }

    public function getDataID($table, $idnv)
    {
        $sql = "SELECT * FROM $table WHERE idnv ='$idnv'";
        $this->execute($sql);
        if ($this->num_rows() != 0) {
            $data = mysqli_fetch_array($this->result);
        } else {
            $data = 0;
        }
        return $data;
    }

    public function num_rows()
    {
        if ($this->result) {
            $num = mysqli_num_rows($this->result);
        } else {
            $num = 0;
        }
        return $num;
    }

    public function insertData($hoten, $idpb, $diachi)
    {
        $sql = "INSERT INTO nhanvien(idnv, hoten, idpb, diachi)VALUES(null, '$hoten', '$idpb', '$diachi')";
        return $this->execute($sql);
    }

    public function updateData($idnv, $hoten, $idpb, $diachi)
    {
        $sql = "UPDATE nhanvien SET hoten = '$hoten', idpb = '$idpb', diachi = '$diachi' WHERE idnv = '$idnv'";
        return $this->execute($sql);
    }

    public function deleteData($idnv, $table)
    {
        $sql = "DELETE FROM $table WHERE idnv = '$idnv'";
        return $this->execute($sql);
    }


    public function searchData($key, $table)
    {
        $sql = "SELECT * FROM $table WHERE hoten REGEXP '$key' ORDER BY id DESC";
        $this->execute(($sql));
        if ($this->num_rows() == 0) {
            $data = 0;
        } else {
            while ($datas = $this->getData($table)) {
                $data[] = $datas;
            }
        }
        return $data;
    }
}