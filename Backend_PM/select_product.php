<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['total_price'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $total_price = $_POST['total_price'];

        $product = array(
            'id' => $product_id,
            'name' => $product_name,
            'unit_price' => $price,
            'quantity' => $quantity,
            'total_price' => $total_price
        );

        if (!isset($_SESSION['selected_products'])) {
            $_SESSION['selected_products'] = array();
        }

        $_SESSION['selected_products'][] = $product;

        echo json_encode(array('status' => 'success', 'message' => 'Product selected successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Missing data'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}
