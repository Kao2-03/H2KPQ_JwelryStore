<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['dv_index'])) {
        $dv_index = intval($_POST['dv_index']); // Chuyển đổi sang số nguyên dương

        if ($dv_index >= 0 && isset($_SESSION['selectdv'][$dv_index])) {
            unset($_SESSION['selectdv'][$dv_index]);
            $_SESSION['selectdv'] = array_values($_SESSION['selectdv']); // Sắp xếp lại chỉ số của mảng
            echo json_encode(['status' => 'success', 'message' => 'Service deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid service index']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing service index']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
