<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <style>
        table { width:80%; border-collapse:collapse; margin:20px auto; }
        th, td { padding:10px; border:1px solid #333; text-align:center; }
        img { width:80px; height:80px; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Your Cart</h2>

<table>
<thead>
<tr>
    <th>Image</th>
    <th>Name</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
<?php
if(!empty($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $id => $qty){

        $sql="SELECT * FROM products WHERE id=$id LIMIT 1";
        $res = $conn->query($sql);
        $row = $res->fetch_assoc();

        $total = $row['price'] * $qty;
?>
<tr>
    <td><img src="images/<?php echo $row['image']; ?>"></td>
    <td><?php echo $row['name']; ?></td>
    <td>₹ <?php echo $row['price']; ?></td>
    <td><?php echo $qty; ?></td>
    <td>₹ <?php echo $total; ?></td>
    <td>
        <a href="cart-action.php?remove=<?php echo $id; ?>">Remove</a>
    </td>
</tr>
<?php
    }
} else {
    echo "<tr><td colspan='6'>Cart is empty</td></tr>";
}
?>
</tbody>
</table>

</body>
</html>
