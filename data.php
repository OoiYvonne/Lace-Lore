<?php
$conn = new mysqli("localhost", "root", "", "lace_lore");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);


// Get form data
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$address = $_POST['address'] ?? '';
$city = $_POST['city'] ?? '';
$postal_code = $_POST['postal_code'] ?? '';
$country = $_POST['country'] ?? '';
$card_number = $_POST['card_number'] ?? '';
$expiry_date = $_POST['expiry_date'] ?? '';
$cvv = $_POST['cvv'] ?? '';
$products = json_decode($_POST['cart_data'] ?? '[]', true);


// Insert shipping
$shipping = $conn->prepare("INSERT INTO shipping (name, phone, address, city, postal_code, country) VALUES (?, ?, ?, ?, ?, ?)");
$shipping->bind_param("ssssss", $name, $phone, $address, $city, $postal_code, $country);
$shipping->execute();
$shipping->close();


// Insert payment
$payment = $conn->prepare("INSERT INTO payments (card_number, expiry_date, cvv) VALUES (?, ?, ?)");
$payment->bind_param("sss", $card_number, $expiry_date, $cvv);
$payment->execute();
$payment->close();


// Insert products
$product_stmt = $conn->prepare("INSERT INTO products (`Product`, `Size`, `Quantity`, `Price (RM)`) VALUES (?, ?, ?, ?)");
foreach ($products as $item) {
  $product = $item['name'];
  $size = $item['size'];
  $qty = $item['quantity'];
  $price = $item['price'];
  $product_stmt->bind_param("ssii", $product, $size, $qty, $price);
  $product_stmt->execute();
}
$product_stmt->close();


echo "<script>alert('Checkout complete!');</script>";
echo "<script>setTimeout(function(){ window.location.href = 'mainpage.html'; }, 1000);</script>";


$conn->close();
?>
