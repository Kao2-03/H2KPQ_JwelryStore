<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID']) && isset($_POST['TenLoai']) && isset($_POST['DonGia'])) {
    $ID = $_POST['ID'];
    $TenLoai = $_POST['TenLoai'];
    $DonGia = $_POST['DonGia'];

    $DV = array(
        'ID' => $ID,
        'TenLoai' => $TenLoai,
        'DonGia' => $DonGia,
    );

    if (!isset($_SESSION['selected_DSDV'])) {
        $_SESSION['selected_DSDV'] = array();
    }

    $_SESSION['selected_DSDV'][] = $DV;

    echo json_encode(array('status' => 'success', 'message' => 'Service selected successfully'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Missing data'));
}
?>
