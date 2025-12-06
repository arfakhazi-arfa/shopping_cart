CREATE DATABASE IF NOT EXISTS shopping_cart;
USE shopping_cart;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) NOT NULL
);

INSERT INTO products (name, price, image) VALUES
('Black-stripe-T-shirt', 450, 'black-stripe.jpg'),
('Embroidered-shirt', 530, 'Embroidered.jpg'),
('Graphic-print-hoodie', 699, 'graphic-print.jpg');
('Graphic-shirt-T-shirt', 451, 'graphic-shirt.jpg');
('Printed-hooded', 799, 'printed-hooded.jpg');
('Solid-orange-shirt', 340, 'solid-orange.jpg');
('Striped-polo-shirt', 599, 'striped-polo.jpg');
('Typography-hoodie', 499, 'typography.jpg');
