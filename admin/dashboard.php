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
$getCounts = new Admin();
// Get total counts of foodlover and restaurant owners
$totalFoodLovers = $getCounts->getTotalFoodLovers();
$totalRestaurantOwners = $getCounts->getTotalRestaurantOwners();
$totalOrders = $getCounts->getTotalOrders();
?>
<!doctype html>
<html lang="en">

<head>
  <title>Admin Dashboard</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

  <div class="container">
    <h1 class=" text text-center  text-uppercase text-primary mt-5 ">Welcome admin
    </h1>

    <hr>

    <!-- <a href="add_resturaunt.php" class="btn btn-outline-info">Manage Food Lovers</a>
      <a href="add_resturaunt.php" class="btn btn-outline-primary">Manage Restaurant Owner</a> -->
    <a href="manage_food_lovers.php" class="btn btn-outline-info">Manage Food Lovers (<?php echo $totalFoodLovers; ?>)</a>
    <a href="manage_restaurant_owners.php" class="btn btn-outline-primary">Manage Restaurant Owners (<?php echo $totalRestaurantOwners; ?>)</a>
    <a href="manage_user_orders.php" class="btn btn-outline-primary">Manage User Orders (<?php echo $totalOrders; ?>)</a>
    <a href="../logout.php" onclick="return confirm('Logout Confirmed!');" class="btn btn-outline-danger">Logout</a>

  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>