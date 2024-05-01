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
$offers = $offer->getPosts($_SESSION["RestaurantOwnerId"]);
if (isset($_GET['id'])) {
    $offer->deleteOffer($_GET['id']);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Offers</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class=" text text-center text-uppercase text-primary mt-5 ">My offers</h1>

        <hr>

        <a href="dasboard.php" class="btn btn-outline-success mb-5">Dashboard</a>
        <a href="resturaunt_list.php" class=" mb-5 btn btn-outline-primary">Restaurant List</a>

        <?php echo $offer->msg ?? ""; ?>
        <?php
        $count = 0;
        if (!empty($offers)) {
        ?>
            <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">

            <table id="offersTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Sr. #</th>
                        <th>Offer ID</th>
                        <th>Restaurant Name</th>
                        <th>Offer Text</th>
                        <th>Expiry Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($offers as $offer) {
                        $count++;
                    ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $offer['OfferID']; ?></td>
                            <td><?php echo $offer['RestaurantName']; ?></td>
                            <td><?php echo $offer['OfferText']; ?></td>
                            <td><?php echo $offer['ExpiryDate']; ?></td>
                            <td>
                                <a href="update_offer.php?id=<?php echo $offer['OfferID']; ?>">Update</a> |
                                <a href="?id=<?php echo $offer['OfferID']; ?>" onclick="return confirm('Are you sure you want to delete this offer?');">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
        ?>
            <p class="text text-center text-danger font-weight-bold">No Offer Found</p>
        <?php
        }
        ?>

    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to filter table rows based on input value
            $('#searchInput').on('keyup', function() {
                var searchText = $(this).val().toLowerCase();
                $('#offersTable tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                });
            });
        });
    </script>
</body>

</html>