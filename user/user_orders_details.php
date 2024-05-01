<?php
session_start();
if (!isset($_SESSION["FoodLover"])) {
?>
    <script>
        window.location.replace("../login.php"); // Replace with your desired URL
    </script>
<?php
}
require_once "../classes/User.php";
$orders_list = new User($_SESSION["FoodLover"]);
$orders_list_data = $orders_list->OrdersList();
// if (isset($_GET['id'])) {
//   $list->delete($_GET['id']);
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h1 class=" text text-center text-uppercase text-primary mt-5 ">
            <?php echo $_SESSION["FoodLoverName"]; ?> Orders List
        </h1>

        <hr>

        <a href="user_profile.php" class="btn btn-outline-primary">Profile</a>
        <a href="user_resturant_list.php" class="btn btn-outline-success">Resturaunt Details</a>
        <a href="ratings.php" class="btn btn-outline-info">Resturaunt Rating</a>
        <a href="user_orders_details.php" class="btn btn-outline-warning">Orders </a>
        <a href="../logout.php" onclick="return confirm('Logout Confirmed!');" class="btn btn-outline-danger">Logout</a>

        <br><br>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>Sr.#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>User Address</th>
                    <th>User Contact</th>
                    <th>Restaurant Name</th>
                    <th>Restaurant Owner Username</th>
                    <th>Restaurant Owner Email</th>
                    <th>Offer Text</th>
                    <th>Expiry Date</th>
                    <th>Quantity</th>
                    <th>Order Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($orders_list_data) {
                    $count = 0;
                    while ($row = $orders_list_data->fetch_assoc()) {
                        $count++;
                ?>
                        <tr>
                            <td><?php echo $count ?></td>
                            <td><?php echo $row['Username'] ?></td>
                            <td><?php echo $row['Email'] ?></td>
                            <td><?php echo $row['UserAddress'] ?></td>
                            <td><?php echo $row['UserContact'] ?></td>
                            <td><?php echo $row['RestaurantName'] ?></td>
                            <td><?php echo $row['RestaurantOwnerUsername'] ?></td>
                            <td><?php echo $row['RestaurantOwnerEmail'] ?></td>
                            <td><?php echo $row['OfferText'] ?></td>
                            <td><?php echo $row['ExpiryDate'] ?></td>
                            <td><?php echo $row['Quantity'] ?></td>
                            <td><?php if ($row['OrderStatus'] === 'Confirmed') {
                                    echo "<span class='text text-success '>" . $row['OrderStatus'] . "</span>";
                                } elseif ($row['OrderStatus'] === 'Pending') {
                                    echo "<span class='text text-danger '>" . $row['OrderStatus'] . "</span>";
                                }  ?>
                            </td>
                    <?php
                    }
                } else {
                    echo "<tr><td colspan='11'>No orders found for this restaurant</td></tr>";
                }
                    ?>
            </tbody>
        </table>
    </div>

</body>

</html>