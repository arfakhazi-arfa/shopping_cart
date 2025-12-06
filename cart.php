<?php
session_start();

// Remove item from cart
if(isset($_GET['remove'])){
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit;
}

// Update quantities
if(isset($_POST['update_cart'])){
    foreach($_POST['quantities'] as $id => $quantity){
        if($quantity > 0){
            $_SESSION['cart'][$id]['quantity'] = $quantity;
        } else {
            unset($_SESSION['cart'][$id]);
        }
    }
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border:1px solid #ccc; padding:10px; text-align:center; }
        th { background-color: #f2f2f2; }
        img { width: 80px; height: 80px; }
        input[type=number] { width:50px; text-align:center; }
        button { padding:5px 10px; cursor:pointer; }
        .total-row td { font-weight: bold; font-size: 18px; }
        a { text-decoration: none; color: #007BFF; }
        a:hover { text-decoration: underline; }
        .cart-empty { font-size: 20px; margin: 50px; color: #555; }
        .continue-btn { margin-top: 20px; display: inline-block; padding: 10px 15px; background-color:#007BFF; color:#fff; border-radius:5px; }
        .continue-btn:hover { background-color:#0056b3; }
    </style>
</head>
<body>

<h1>Your Shopping Cart</h1>

<?php if(!empty($_SESSION['cart'])): ?>
<form method="post" action="">
    <table>
        <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>
        <?php
        $total = 0;
        foreach($_SESSION['cart'] as $id => $item):
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
        ?>
        <tr>
            <td><img src="images/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>"></td>
            <td><?php echo $item['name']; ?></td>
            <td>₹ <?php echo $item['price']; ?></td>
            <td>
                <input type="number" name="quantities[<?php echo $id; ?>]" value="<?php echo $item['quantity']; ?>" min="1">
            </td>
            <td>₹ <?php echo $subtotal; ?></td>
            <td><a href="cart.php?remove=<?php echo $id; ?>">Remove</a></td>
        </tr>
        <?php endforeach; ?>
        <tr class="total-row">
            <td colspan="4" align="right">Total:</td>
            <td colspan="2">₹ <?php echo $total; ?></td>
        </tr>
    </table>
    <button type="submit" name="update_cart">Update Cart</button>
</form>
<?php else: ?>
    <p class="cart-empty">Your cart is empty!</p>
<?php endif; ?>

<a href="index.php" class="continue-btn">Continue Shopping</a>

</body>
</html>
