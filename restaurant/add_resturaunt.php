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
$add = new Restaurant();
$add->insert($_POST, $_SESSION["RestaurantOwnerId"]);
$areas = $add->fetchAreaDetails();
?>

<!doctype html>
<html lang="en">

<head>
  <title>Add Restaurant</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h1 class=" text text-center text-uppercase text-primary mt-5 ">
      Add New Restaurant
    </h1>

    <hr>

    <a href="dasboard.php" class="btn btn-outline-success mb-5">Dashboard</a>
    <a href="resturaunt_list.php" class=" mb-5 btn btn-outline-primary">List</a>

    <form action="" method="post" class="mt-2">
      <?php
      if (isset($add->msg)) {
        echo $add->msg;
      }
      ?>
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="name" name="name" value="<?php echo $add->name ?? ""; ?>">
          <small>
            <?php if (!empty($add->name_error)) { ?>
              <span class="text-danger"><?php echo $add->name_error; ?></span>
            <?php } ?>
          </small>
        </div>
      </div>
      <div class="form-group row" id="areaField">
        <label for="name" class="col-sm-2 col-form-label">Choose Area:</label>
        <div class="col-sm-10">

          <select class="form-control" name="areaDetails" id="areaDetails">
            <option value="">Select Area</option>
            <?php
            // Assuming $areas contains the result of fetchAreaDetails() function
            foreach ($areas as $area) {
              echo "<option value='" . $area['name'] . "'>" . $area['name'] . "</option>";
            }
            ?>
          </select>
          <small>
            <?php if (!empty($add->area_error)) { ?>
              <span class="text-danger"><?php echo $add->area_error; ?></span>
            <?php } ?>
          </small>
        </div>
      </div>
      <div class="form-group row">
        <label for="location" class="col-sm-2 col-form-label">Location <br> <small style="font-weight: bold;">Complete Address as per above area selected</small></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="location" name="location" value="<?php echo $add->location ?? ""; ?>">
          <small>
            <?php if (!empty($add->location_error)) { ?>
              <span class="text-danger"><?php echo $add->location_error; ?></span>
            <?php } ?>
          </small>
        </div>
      </div>
      <div class="form-group row">
        <label for="contact" class="col-sm-2 col-form-label">Contact</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter your Pakistani contact number" value="<?php echo $add->contact ?? ""; ?>">
          <small>
            <?php if (!empty($add->contact_error)) { ?>
              <span class="text-danger"><?php echo $add->contact_error; ?></span>
            <?php } ?>
          </small>
        </div>
      </div>
      <div class="form-group row">
        <label for="details" class="col-sm-2 col-form-label">Detailed Menu</label>
        <div class="col-sm-10">
          <textarea class="form-control" id="details" name="details" rows="5"><?php echo $add->details ?? ""; ?></textarea>
          <small>
            <?php if (!empty($add->details_error)) { ?>
              <span class="text-danger"><?php echo $add->details_error; ?></span>
            <?php } ?>
          </small>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10 offset-sm-2">
          <button type="submit" class="btn btn-primary" name="add">Add</button>
        </div>
      </div>
    </form>


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
    // Apply input masking for Pakistani contact number
    $(document).ready(function() {
      $('#contact_number').mask('0000-0000000', {
        placeholder: "____-_______"
      });
    });
  </script>
</body>

</html>