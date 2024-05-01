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
$list = new Restaurant();
$rest_list_data = $list->list($_SESSION["RestaurantOwnerId"]);
if (isset($_GET['id'])) {
  $list->delete($_GET['id']);
}
?>

<!doctype html>
<html lang="en">

<head>
  <title>Restaurant List</title>
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
      Restaurant(s) List
    </h1>

    <hr>

    <a href="dasboard.php" class="btn btn-outline-success mb-5">Dashboard</a>
    <a href="add_resturaunt.php" class=" mb-5 btn btn-outline-info">Add New</a>
    <a href="offers_list.php" class=" mb-5 btn btn-outline-primary">Offers List</a>

    <?php
    if (isset($list->msg)) {
      echo $list->msg;
    }
    ?>

    <input type="text" id="searchInput" class="form-control mt-3" placeholder="Search...">
    <table class="table mt-3 table-bordered table-hover">
      <thead>
        <tr>
          <th>Sr.#</th>
          <th>Name</th>
          <th>Area</th>
          <th>Location</th>
          <th>Contact</th>
          <th>Detailed Menu</th>
          <th colspan="6" class="text text-center">Actions</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <?php if (isset($rest_list_data) && count($rest_list_data) > 0) : $count = 0;
          foreach ($rest_list_data as $restaurant) : $count++ ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $restaurant['Name']; ?></td>
          <td><?php echo $restaurant['area']; ?></td>
          <td><?php echo $restaurant['Location']; ?></td>
          <td><?php echo $restaurant['contact']; ?></td>
          <td><?php echo $restaurant['details']; ?></td>
          <td>
            <a title="update the restaurant details" href="update_resturaunt.php?id=<?php echo $restaurant['RestaurantID']; ?>"
              class="btn btn-sm btn-primary">Update</a>
            <!-- <a onclick="return confirm('Confirm Delete!');" href="?id=<?php echo $restaurant['RestaurantID']; ?>" class="btn btn-sm btn-danger">Delete</a> -->
          </td>
          <td> <a title="post the new offer" href="post_offer.php?id=<?php echo $restaurant['RestaurantID']; ?>" class="btn btn-sm btn-info">Post
              Offer</a>
          </td>
          <td> <a title="check users ratings" href="user_rating.php?id=<?php echo $restaurant['RestaurantID']; ?>"
              class="btn btn-sm btn-warning">Ratings</a>
          </td>
          <td> <a title="check the users orders list" href="user_orders.php?id=<?php echo $restaurant['RestaurantID']; ?>"
              class="btn btn-sm btn-secondary">List</a>
          </td>
          <td> <a title="update the contact info for instant real chat" href="add_whatsapp_contact.php?id=<?php echo $restaurant['RestaurantID']; ?>"
              class="btn btn-sm btn-success">Chat</a>
          </td>
        </tr>
        <?php endforeach;
        else : ?>
        <tr>
          <td colspan="6" class="text text-center text-uppercase text-danger font-weight-bold">Record not found</td>
        </tr>
        <?php endif; ?>
      </tbody>

    </table>


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
  <script>
    // JavaScript for filtering table rows based on search input
    $(document).ready(function () {
      $("#searchInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#tableBody tr").filter(function () {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
</body>

</html>