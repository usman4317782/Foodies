<?php
session_start();
if (!isset($_SESSION["Admin"])) {
?>
<script>
    window.location.replace("../login.php"); // Replace with your desired URL
</script>
<?php
}
?>

<?php
require_once "../classes/Admin.php";
$manageUserOrders = new Admin();
// Fetch food lovers data

$user_orders_list = $manageUserOrders->ManageUserOrders();
$manageUserOrders->DeleteUserOrders($_GET);

?>

<!doctype html>
<html lang="en">

<head>
    <title>Registered Restaurant Owners</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">




    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />


</head>

<body>

    <div class="container">
        <h1 class="text text-center text-info text-uppercase mt-4 mb-4">
            restaurant owners management
        </h1>
        <hr>
        <a href="dashboard.php" class="btn btn-outline-info mt-4 mb-4">Dashboard</a>
        <a href="all_restaurants.php" class="btn btn-outline-primary mt-4 mb-4">Add New Order</a>

        <?php 
            if(isset($manageUserOrders->errMsg)){
                echo $manageUserOrders->errMsg;
                header("refresh:1; url=manage_user_orders.php");
            }
        ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="myTable">
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
                    <th>Order Booking Date</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($user_orders_list) {
                    $count = 0;
                    while ($row = $user_orders_list->fetch_assoc()) {
                        $count++;
                ?>
                <tr>
                    <td><?php echo $count ?></td>
                    <td><?php echo $row['UserUsername'] ?></td>
                    <td><?php echo $row['UserEmail'] ?></td>
                    <td><?php echo $row['UserAddress'] ?></td>
                    <td><?php echo $row['UserContact'] ?></td>
                    <td><?php echo $row['RestaurantName'] ?></td>
                    <td><?php echo $row['RestaurantOwnerUsername'] ?></td>
                    <td><?php echo $row['RestaurantOwnerEmail'] ?></td>
                    <td><?php echo $row['OfferText'] ?></td>
                    <td><?php echo $row['ExpiryDate'] ?></td>
                    <td><?php echo $row['Quantity'] ?></td>
                    <td><?php echo $row['OrderBookingDate'] ?></td>
                    <td><?php if ($row['OrderStatus'] === 'Confirmed') {
                                    echo "<span class='text text-success '>" . $row['OrderStatus'] . "</span>";
                                } elseif ($row['OrderStatus'] === 'Pending') {
                                    echo "<span class='text text-danger '>" . $row['OrderStatus'] . "</span>";
                                }elseif ($row['OrderStatus'] === 'Cancelled') {
                                    echo "<span class='text text-danger '>" . $row['OrderStatus'] . "</span>";
                                }  ?>
                    </td>
                    <td>
                        <?php
                                if ($row['OrderStatus'] === 'Confirmed') {
                                    echo "-";
                                }else{
                                    ?>
                        <a href="update_order.php?action=update&order_id=<?php echo $row['OrderID'];?>"
                            class="btn btn-sm btn-info">Update</a>
                        <a href="?action=delete&order_id=<?php echo $row['OrderID'];?>" class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete Confirmation!')">Delete</a>
                        <?php
                                }
                                ?>
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
        

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>