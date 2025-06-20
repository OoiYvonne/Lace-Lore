<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - Lace & Lore</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>
  <h2>Shipping Details</h2>
  <a href="mainpage.html">← Back</a>
  <table border="1">
    <tr>
      <th>No.</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Address</th>
      <th>City</th>
      <th>Postal Code</th>
      <th>Country</th>
    </tr>
    <?php
    $conn = new mysqli("localhost", "root", "", "lace_lore");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);


    $sql = "SELECT * FROM shipping";
    $result = $conn->query($sql);
    $i = 1;
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$i}</td>
        <td>{$row['name']}</td>
        <td>{$row['phone']}</td>
        <td>{$row['address']}</td>
        <td>{$row['city']}</td>
        <td>{$row['postal_code']}</td>
        <td>{$row['country']}</td>
      </tr>";
      $i++;
    }
    ?>
  </table>


  <h2>Payment Details</h2>
  <table border="1">
    <tr>
      <th>No.</th>
      <th>Card Number</th>
      <th>Expiry Date</th>
      <th>CVV</th>
    </tr>
    <?php
    $sql = "SELECT * FROM payments";
    $result = $conn->query($sql);
    $j = 1;
    while ($row = $result->fetch_assoc()) {
      $masked_card = "**** **** **** " . substr($row['card_number'], -4);
      echo "<tr>
        <td>{$j}</td>
        <td>{$masked_card}</td>
        <td>{$row['expiry_date']}</td>
        <td>***</td>
      </tr>";
      $j++;
    }
    ?>
  </table>


  <h2>Products Purchased</h2>
  <table border="1">
    <tr>
      <th>No.</th>
      <th>Product</th>
      <th>Size</th>
      <th>Quantity</th>
      <th>Price (RM)</th>
    </tr>
    <?php
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    $k = 1;
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$k}</td>
        <td>{$row['Product']}</td>
        <td>{$row['Size']}</td>
        <td>{$row['Quantity']}</td>
        <td>{$row['Price (RM)']}</td>
      </tr>";
      $k++;
    }
    $conn->close();
    ?>
  </table>
</body>
</html>
