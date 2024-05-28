<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['service_index'])) {
        $product_index = $_POST['service_index'];

        if (isset($_SESSION['selectedDV'][$service_index])) {
            unset($_SESSION['selectedDV'][$service_index]);
            $_SESSION['selectedDV'] = array_values($_SESSION['selectedDV']);
            echo json_encode(array('status' => 'success', 'message' => 'Service deleted successfully'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Service not found'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Missing service index'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}