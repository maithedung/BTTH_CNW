<?php

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';
}

switch ($action) {
    case 'add': {
            if (isset($_POST['add_user'])) {
                $name = $_POST['name'];
                $idpb = $_POST['idpb'];
                $address = $_POST['address'];

                if ($db->insertData($name, $idpb, $address)) {
                    echo "Add success";
                };
            }

            require_once("./View/nhanvien/add_user.php");
            break;
        }
    case 'edit': {
            if (isset($_GET['id'])) {
                $idnv = $_GET['id'];
                $tblTable = 'nhanvien';

                $dataID = $db->getDataID($tblTable, $idnv);
            }

            if (isset($_POST['update_user'])) {
                $name = $_POST['name'];
                $idpb = $_POST['idpb'];
                $address = $_POST['address'];

                if ($db->updateData($idnv, $name, $idpb, $address)) {
                    echo "Edit success";
                    header('location: index.php?controller=nhanvien&action=list');
                };
            }

            if (isset($_POST['delete_user'])) {
                if ($db->deleteData($idnv, $tblTable)) {
                    echo "Delete success";
                    header('location: index.php?controller=nhanvien&action=list');
                } else {
                    echo "Delete fail";
                    header('location: index.php?controller=nhanvien&action=list');
                }
            }

            require_once("./View/nhanvien/edit_user.php");
            break;
        }
    case 'search': {
            if (isset($_GET['key'])) {
                $key = $_GET['key'];
                $tblTable = 'nhanvien';

                $dataSearch = $db->searchData($key, $tblTable);
            }

            require_once("./View/nhanvien/search_user.php");
            break;
        }
        // case 'delete': {
        //         if (isset($_GET['id'])) {
        //             $idnv = $_GET['id'];
        //             $tblTable = 'nhanvien';

        //             if (isset($_POST['delete_user'])) {
        //                 if ($db->deleteData($idnv, $tblTable)) {
        //                     echo "Delete success";
        //                     header('location: index.php?controller=nhanvien&action=list');
        //                 };
        //             }

        //             require_once("./View/nhanvien/edit_user.php");
        //             break;
        //         }
        //     }
    case 'list': {
            $tblTable = "nhanvien";
            $data = $db->getAllData($tblTable);
            require_once("./View/nhanvien/list.php");
            break;
        }
    default: {
            require_once("./View/nhanvien/list.php");
            break;
        }
}