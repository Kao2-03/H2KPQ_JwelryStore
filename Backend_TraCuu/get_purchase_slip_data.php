<?php
include '../db_connection.php';

$sql = "SELECT ps.id, ps.supplier_name, ps.total_payment, ps.payment_date, s.diachi, s.sdt 
        FROM purchase_slip ps
        JOIN suppliers s ON ps.supplier_name = s.ten";
$result = $mysqli->query($sql);

if (!$result) {
    echo "SQL Error: " . $mysqli->error;
    exit;
}

$purchaseDisplayed = array(); // Mảng để lưu các phiếu mua đã hiển thị

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
        $supplierName = htmlspecialchars($row['supplier_name'], ENT_QUOTES, 'UTF-8');
        $totalPayment = htmlspecialchars($row['total_payment'], ENT_QUOTES, 'UTF-8');
        $paymentDate = htmlspecialchars($row['payment_date'], ENT_QUOTES, 'UTF-8');
        $supplierAddress = htmlspecialchars($row['diachi'], ENT_QUOTES, 'UTF-8');
        $supplierPhone = htmlspecialchars($row['sdt'], ENT_QUOTES, 'UTF-8');

        if (!in_array($id, $purchaseDisplayed)) {
            $productSql = "SELECT product_name, unit_price, quantity, total_price FROM purchase_products WHERE purchase_code = '$id'";
            $productResult = $mysqli->query($productSql);

            $products = array(); 

            if ($productResult->num_rows > 0) {
                while ($productRow = $productResult->fetch_assoc()) {
                    $product = array(
                        'productName' => htmlspecialchars($productRow['product_name'], ENT_QUOTES, 'UTF-8'),
                        'unitPrice' => htmlspecialchars($productRow['unit_price'], ENT_QUOTES, 'UTF-8'),
                        'quantity' => htmlspecialchars($productRow['quantity'], ENT_QUOTES, 'UTF-8'),
                        'totalPrice' => htmlspecialchars($productRow['total_price'], ENT_QUOTES, 'UTF-8')
                    );
                    $products[] = $product; 
                }
            }

            $productsJson = json_encode($products);

            echo '<tr id="purchase-' . $id . '">';
            echo '<td>' . $id . '</td>';
            echo '<td>' . $supplierName . '</td>';
            echo '<td>' . $totalPayment . '</td>';
            echo '<td>' . $paymentDate . '</td>';
            echo '<td>
                    <button type="button" class="btn ChiTiet" onclick="togglePopupChiTiet_TTPM(\'' . $id . '\', \'' . $paymentDate . '\', \'' . $supplierName . '\', \'' . $totalPayment . '\', \'' . $supplierAddress . '\', \'' . $supplierPhone . '\', \'' . htmlspecialchars($productsJson, ENT_QUOTES, 'UTF-8') . '\')">Chi tiết</button>
                    <button type="button" class="btn Xoa" onclick="deletePurchase(' . $id . ')">Xóa</button>
                  </td>';
            echo '</tr>';
            $purchaseDisplayed[] = $id;
        }
    }
} else {
    echo '<tr><td colspan="5">Không có dữ liệu</td></tr>';
}

// Đóng kết nối
$mysqli->close();
?>
