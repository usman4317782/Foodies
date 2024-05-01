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
$rating_list = new Restaurant();
$rating_list_data = $rating_list->ratingList($_SESSION["RestaurantOwnerId"], $_GET['id']);
?>

<!doctype html>
<html lang="en">

<head>
  <title>User Rating List</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
  <div class="container">
    <h1 class=" text text-center text-uppercase text-primary mt-5 ">
      User Rating List
    </h1>

    <hr>

    <a href="dasboard.php" class="btn btn-outline-success mb-5">Dashboard</a>
    <a href="add_resturaunt.php" class=" mb-5 btn btn-outline-info">Add New</a>
    <a href="offers_list.php" class=" mb-5 btn btn-outline-primary">Offers List</a>
    <a href="resturaunt_list.php" class=" mb-5 btn btn-outline-warning">Restaurant list</a>

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
            <th>User</th>
            <th>Rating</th>
            <th>Comment</th>
            <th>Created_at</th>
        </tr>
    </thead>
    <tbody id="tableBody">
        <?php if (empty($rating_list_data)) : ?>
            <tr>
                <td colspan="5" class="text text-center text-uppercase text-danger font-weight-bold">No ratings found</td>
            </tr>
        <?php else : $count = 0;
            foreach ($rating_list_data as $rating) : $count++ ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $rating['Username']; ?></td>
                    <td><?php echo $rating['Rating']; ?></td>
                    <td><?php echo $rating['Comment']; ?></td>
                    <td><?php echo $rating['Created_at']; ?></td>
                </tr>
            <?php endforeach;
        endif; ?>
    </tbody>
</table>




  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script>
    // JavaScript for filtering table rows based on search input
    $(document).ready(function() {
      $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tableBody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
</body>

</html>