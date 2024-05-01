<?php
session_start();
if (!isset($_SESSION["Admin"])) {
?>
<script>
  window.location.replace("../login.php"); // Replace with your desired URL
</script>
<?php
}

require_once "../classes/Admin.php";
$book_order = new Admin();
$result = $book_order->bookOrder($_SESSION["Admin"], $_GET, $_POST);
?>

<!doctype html>
<html lang="en">

<head>
  <title>Book Order</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
  <div class="container">
    <h1 class=" text text-center text-uppercase text-primary mt-5 ">
      Book New Order
    </h1>

    <hr>

    <a href="dashboard.php" class="btn btn-outline-success mb-5">Dashboard</a>
    <!-- <a href="user_resturant_list.php" class="btn btn-outline-primary mb-5">Restaurant List</a> -->


    <div class="container mt-2">
      <?php
      if (isset($book_order->errMsg)) {
        echo $book_order->errMsg;
      }
      ?>
      <form action="" method="POST">
        <div class="form-group">
          <label for="quantity">Quantity:</label>
          <input type="number" class="form-control" id="quantity" name="quantity" min="0">
        </div>
        <div class="form-group">
          <label for="contact">Contact:</label>
          <input type="number" class="form-control" id="contact" name="contact">
        </div>
        <div class="form-group">
            <label for="address">Adress</label>
            <textarea id="address" class="form-control" name="address" rows="3"></textarea>
        </div>
        <!-- <div class="form-group">
          <label for="Status">Status:</label>
          <select class="form-control" id="Status" name="Status">
            <option value="Pending">Pending</option>
            <option value="Confirmed">Confirmed</option>
            <option value="Cancelled">Cancelled</option>
          </select>
        </div> -->
        <button type="submit" name="book_order" class="btn btn-primary">Book Order</button>
      </form>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</body>

</html>