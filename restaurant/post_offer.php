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
$offer = new Restaurant();
$offer->post($_POST ,$_GET['id']);
// if (isset($_GET['id'])) {
//   $list->delete($_GET['id']);
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create New Offer</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
  <h1 class=" text text-center text-uppercase text-primary mt-5 ">Create Offer</h1>

    <hr>

    <a href="dasboard.php" class="btn btn-outline-success mb-5">Dashboard</a>
    <a href="offers_list.php" class=" mb-5 btn btn-outline-primary">Offers List</a>

    <?php
    if(isset($offer->msg))
    {
      echo $offer->msg;
    }
    ?>
    <form action="" method="POST">
      <div class="form-group">
        <label for="offer">Offer Text</label>
        <textarea class="form-control" id="offer" name="offer" rows="3"> <?php echo $offer->offer ?? ""?></textarea>
      </div>
      <div class="form-group">
        <label for="exp_date">Expiry Date</label>
        <input type="date" class="form-control" id="exp_date" name="exp_date" value="<?php echo $offer->exp_date ?? ""?>">
      </div>
      <button type="submit" name="post_offer" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

