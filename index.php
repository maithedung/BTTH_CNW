<?php
include "./Model/DBConfig.php";

$db = new Database;
$db->connect();

// print_r($db->getAllData("nhanvien"));
// print_r(($db->getDataID('nhanvien', '1')));

if (isset($_GET['controller'])) 
{
  $controller = $_GET['controller'];
}
else
{
  $controller = '';
}

switch ($controller) 
{
  case 'nhanvien':
    {
      require_once("./Controller/nhanvien/index.php");
    }
}