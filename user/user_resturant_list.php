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
$list = new User($_SESSION["FoodLover"]);
$rest_list_data = $list->list();
?>

<!doctype html>
<html lang="en">

<head>
  <title>User Restaurant List</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
  <div class="container">
    <h1 class=" text text-center text-uppercase text-primary mt-5 ">
      Restaurant(s) List
    </h1>

    <hr>

    <a href="dashboard.php" class="btn btn-outline-success mb-5">Dashboard</a>


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
          <th>Offer Text</th>
          <th>Expiry Date</th>
          <th>Book Order</th>
          <th>Instant Chat</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <?php if (!empty($rest_list_data)) : ?>
          <?php $count = 0; ?>
          <?php foreach ($rest_list_data as $restaurant) : ?>
            <?php ++$count; ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $restaurant['Name']; ?></td>
              <td><?php echo $restaurant['area']; ?></td>
              <td><?php echo $restaurant['Location']; ?></td>
              <td><?php echo $restaurant['contact']; ?></td>
              <td><?php echo $restaurant['details']; ?></td>
              <td>
                <?php if (!empty($restaurant['offers'])) : ?>
                  <?php $offerCount = 0; ?>
                  <?php foreach ($restaurant['offers'] as $offer) : ?>
                    <?php ++$offerCount; ?>
                    <?php echo '<b>' . $offerCount . '</b>' . '. ' . $offer['OfferText'] . '<br>'; ?>
                  <?php endforeach; ?>
                <?php else : ?>
                  No Offer
                <?php endif; ?>
              </td>
              <td>
                <?php if (!empty($restaurant['offers'])) : ?>
                  <?php $expiryCount = 0; ?>
                  <?php foreach ($restaurant['offers'] as $offer) : ?>
                    <?php ++$expiryCount; ?>
                    <?php echo '<b>' .  $expiryCount . '</b>' . '. ' . $offer['ExpiryDate'] . '<br>'; ?>
                  <?php endforeach; ?>
                <?php else : ?>
                  -
                <?php endif; ?>
              </td>
              <td>
                <?php if (!empty($restaurant['offers'])) : ?>
                  <?php foreach ($restaurant['offers'] as $offer) : ?>
                    <?php if (strtotime($offer['ExpiryDate']) > time()) : ?>
                      <a href="book_order.php?action=book_order&rest_id=<?php echo $restaurant['RestaurantID']; ?>&offer_id=<?php echo $offer['OfferID']; ?>" class="btn btn-sm btn-success">Book Order</a>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
              </td>
              <td>
                <?php if (!empty($restaurant['whatsapp_contact'])) : ?>
                  <a href="https://wa.me/<?php echo $restaurant['whatsapp_contact']; ?>" class="btn btn-sm btn-success">
                    <i class="fab fa-whatsapp"></i> WhatsApp Chat
                  </a>
                <?php else : ?>
                  Facility Coming Soon
                <?php endif; ?>
              </td>

            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr>
            <td colspan="9" class="text text-center text-uppercase text-danger font-weight-bold">Record not found</td>
          </tr>
        <?php endif; ?>

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