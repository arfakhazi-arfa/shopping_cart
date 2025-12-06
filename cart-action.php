<?php
session_start();

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_POST['product_id'])){
    $id = $_POST['product_id'];
    
    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id] += 1;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
    header("Location: index.php");
    exit;
}

if(isset($_GET['remove'])){
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: products.php");
    exit;
}
?>
