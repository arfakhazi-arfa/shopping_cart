<?php
session_start();
include('db.php'); // Database connection

// Add to cart logic
if(isset($_POST['add_to_cart'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];

    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$id] = [
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'image' => $image
        ];
    }
    header("Location: index.php");
    exit;
}

// Fetch products
$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <style>
        table { border-collapse: collapse; width: 90%; margin: 20px auto; }
        th, td { border:1px solid #ccc; padding:10px; text-align:center; }
        th { background-color: #f2f2f2; }
        img { width: 100px; height: 100px; }
        input[type=number] { width:50px; text-align:center; }
        button { padding:5px 10px; cursor:pointer; }
        .cart-link { float:right; margin:20px; }
    </style>
</head>
<body>

<a class="cart-link" href="cart.php">
    View Cart (<?php echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'],'quantity')) : 0; ?>)
</a>

<h1 style="text-align:center;">Products</h1>

<table>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Action</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>"></td>
        <td><?php echo $row['name']; ?></td>
        <td>₹ <?php echo $row['price']; ?></td>
        <td>
            <form method="post" action="">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
                <input type="number" name="quantity" value="1" min="1">
        </td>
        <td>
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
