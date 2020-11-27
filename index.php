<?php
include "./Model/DBConfig.php";

$db = new Database;
$db->connect();

// print_r($db->getAllData("sinhvien"));
// print_r(($db->getDataID('sinhvien', '1')));

if (isset($_GET['controller'])) {
  $controller = $_GET['controller'];
} else {
  $controller = '';
}

switch ($controller) {
  case 'sinhvien': {
      require_once("./Controller/sinhvien/index.php");
    }
}