<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['product_index'])) {
        $product_index = $_POST['product_index'];

        if (isset($_SESSION['selected_products'][$product_index])) {
            unset($_SESSION['selected_products'][$product_index]);
            $_SESSION['selected_products'] = array_values($_SESSION['selected_products']);
            echo json_encode(array('status' => 'success', 'message' => 'Product deleted successfully'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Product not found'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Missing product index'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}
