<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $index = isset($_POST['index']) ? intval($_POST['index']) : -1;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : -1;

    if ($index >= 0 && $quantity >= 0) {
        if (isset($_SESSION['selected_products'][$index])) {
            $_SESSION['selected_products'][$index]['quantity'] = $quantity;
            $_SESSION['selected_products'][$index]['total_price'] = $_SESSION['selected_products'][$index]['unit_price'] * $quantity;

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Product not found in session.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid index or quantity.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
