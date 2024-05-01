<?php
session_start();

if (!isset($_SESSION["RestaurantOwnerId"])) {
?>
    <script>
        window.location.replace("../login.php"); // Replace with your desired URL
    </script>
<?php
}
require_once "../classes/Restaurant.php";
$orders_list = new Restaurant();
$orders_list_data = $orders_list->OrdersList($_GET);
$orders_list->ConfirmedOrderStatus($_GET);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h1 class=" text text-center text-uppercase text-primary mt-5 ">
            Orders List
        </h1>

        <hr>

        <a href="dasboard.php" class="btn btn-outline-success mb-5">Dashboard</a>
        <a href="add_resturaunt.php" class=" mb-5 btn btn-outline-info">Add New</a>
        <a href="offers_list.php" class=" mb-5 btn btn-outline-primary">Offers List</a>

        <?php
        if(isset($orders_list->msg))
        {
            echo $orders_list->msg;
            header("refresh:1; url=resturaunt_list.php");
        }
        ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User Address</th>
                    <th>User Contact</th>
                    <th>Offer Text</th>
                    <th>Expiry Date</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    <?php
    if ($orders_list_data) {
        while ($row = $orders_list_data->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['Username']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['UserAddress']; ?></td>
                <td><?php echo $row['UserContact']; ?></td>
                <td><?php echo $row['OfferText']; ?></td>
                <td><?php echo $row['ExpiryDate']; ?></td>
                <td><?php echo $row['Quantity']; ?></td>
                <!-- <td><?php echo $row['OrderStatus']; ?></td> -->
                <td><?php if ($row['OrderStatus'] === 'Confirmed') {
                                    echo "<span class='text text-success '>" . $row['OrderStatus'] . "</span>";
                                } elseif ($row['OrderStatus'] === 'Pending') {
                                    echo "<span class='text text-danger '>" . $row['OrderStatus'] . "</span>";
                                }  ?>
                            </td>
                <td>
                    <?php
                    if ($row['OrderStatus'] != 'Confirmed') {
                        ?>
                        <a onclick="return confirm('Confirmed order completed');" href='?status=Confirmed&id=<?php echo $row['OrderID']; ?>'>Confirmed</a>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan='7'>No orders found for this restaurant</td>
        </tr>
        <?php
    }
    ?>
</tbody>


        </table>
    </div>

</body>

</html>