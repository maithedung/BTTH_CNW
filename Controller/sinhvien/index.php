<?php

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';
}

switch ($action) {
    case 'add': {
            if (isset($_POST['add_user'])) {
                $masv = $_POST['masv'];
                $hoten = $_POST['hoten'];
                $gioitinh = $_POST['gioitinh'];
                $khoa = $_POST['khoa'];

                if ($db->insertData($masv, $hoten, $gioitinh, $khoa)) {
                    echo "Add success";
                };
            }

            require_once("./View/sinhvien/add_user.php");
            break;
        }
    case 'edit': {
            if (isset($_GET['id'])) {
                $idnv = $_GET['id'];
                $tblTable = 'sinhvien';

                $dataID = $db->getDataID($tblTable, $idnv);
            }

            if (isset($_POST['update_user'])) {
                $hoten = $_POST['hoten'];
                $gioitinh = $_POST['gioitinh'];
                $khoa = $_POST['khoa'];

                if ($db->updateData($idnv, $hoten, $gioitinh, $khoa)) {
                    echo "Edit success";
                    header('location: index.php?controller=sinhvien&action=list');
                };
            }

            if (isset($_POST['delete_user'])) {
                if ($db->deleteData($idnv, $tblTable)) {
                    echo "Delete success";
                    header('location: index.php?controller=sinhvien&action=list');
                } else {
                    echo "Delete fail";
                    header('location: index.php?controller=sinhvien&action=list');
                }
            }

            require_once("./View/sinhvien/edit_user.php");
            break;
        }
    case 'search': {
            if (isset($_GET['key'])) {
                $key = $_GET['key'];
                $tblTable = 'sinhvien';

                $dataSearch = $db->searchData($key, $tblTable);
            }

            require_once("./View/sinhvien/search_user.php");
            break;
        }
        // case 'delete': {
        //         if (isset($_GET['id'])) {
        //             $idnv = $_GET['id'];
        //             $tblTable = 'sinhvien';

        //             if (isset($_POST['delete_user'])) {
        //                 if ($db->deleteData($idnv, $tblTable)) {
        //                     echo "Delete success";
        //                     header('location: index.php?controller=sinhvien&action=list');
        //                 };
        //             }

        //             require_once("./View/sinhvien/edit_user.php");
        //             break;
        //         }
        //     }
    case 'list': {
            $tblTable = "sinhvien";
            $data = $db->getAllData($tblTable);
            require_once("./View/sinhvien/list.php");
            break;
        }
    default: {
            require_once("./View/sinhvien/list.php");
            break;
        }
}