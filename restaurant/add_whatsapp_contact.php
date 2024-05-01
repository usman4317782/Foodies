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
$contact = new Restaurant();
$contact->chatContact($_POST, $_SESSION["RestaurantOwnerId"], $_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create WhatsApp Chat Contact</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="mb-4">Create WhatsApp Chat Contact</h2>
        <?php echo $contact->msg ?? "" ?>
        <form action="" method="POST">
          <div class="form-group">
            <label for="contact">Contact:</label>
            <input type="text" class="form-control" id="contact" name="contact" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="dasboard.php" class="btn btn-success">Dashboard</a>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
