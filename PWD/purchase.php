<?php
include "connect.php"; 
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $total_price = 0;

    
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['price'] * $item['qty'];
    }


    $promo_code = isset($_POST['promo_code']) ? $_POST['promo_code'] : '';
    $discount_amount = 0;

    if (!empty($promo_code)) {
      
        $sql_promo = "SELECT discount_amount FROM Promotion_PCK WHERE promo_code = ? AND valid_until >= NOW()";
        
        if ($stmt_promo = $pdo->prepare($sql_promo)) {
            $stmt_promo->bindParam(1, $promo_code, PDO::PARAM_STR);
            $stmt_promo->execute();

            if ($stmt_promo->rowCount() > 0) {
                $row = $stmt_promo->fetch(PDO::FETCH_ASSOC);
                $discount_amount = $row['discount_amount'];
            } else {
                echo "รหัสโปรโมชั่นไม่ถูกต้องหรือหมดอายุ";
            }
        } else {
            echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL สำหรับโปรโมชั่น";
        }
    }


    $final_price = $total_price - $discount_amount;


    $status_food = "Preparing";  
    $payment_status = "Unpaid";  

  
    $sql = "INSERT INTO Order_PCK (user_id, status_food, total_price, order_date, payment_status) VALUES (?, ?, ?, NOW(), ?)";


    if ($stmt = $pdo->prepare($sql)) {

        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $status_food, PDO::PARAM_STR);
        $stmt->bindParam(3, $final_price, PDO::PARAM_STR);
        $stmt->bindParam(4, $payment_status, PDO::PARAM_STR);


        if ($stmt->execute()) {

            $order_id = $pdo->lastInsertId();


            $payment_url = "payment_qr.php?order_id=$order_id&amount=$final_price";


            header("Location: $payment_url");
            exit();
        } else {
            echo "เกิดข้อผิดพลาดในการเพิ่มการสั่งซื้อ.";
        }
    } else {
        echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL.";
    }
} else {
    echo "ตะกร้าว่างเปล่า!";
}
?>
