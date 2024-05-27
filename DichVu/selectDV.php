<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID']) && isset($_POST['TenLoai']) && isset($_POST['DonGia'])) {
        $ID = $_POST['ID'];
        $TenLoai = $_POST['TenLoai'];
        $DonGia = $_POST['DonGia'];

        $service = array(
            'ID' => $ID,
            'LoaiDV' => $TenLoai,
            'Gia' => $DonGia
        );

        if (!isset($_SESSION['selectedDV'])) {
            $_SESSION['selectedDV'] = array();
        }

        $_SESSION['selectedDV'][] = $service;

        echo json_encode(array('status' => 'success', 'message' => 'Service selected successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Missing data'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}
