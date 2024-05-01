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
$rating = new User($_SESSION["FoodLover"]);
$rest_list = $rating->fetchResturant();
$rating->submitRating($_POST);
?>

<!doctype html>
<html lang="en">

<head>
    <title>Book Order</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <h1 class=" text text-center text-uppercase text-primary mt-5 ">
            Book New Order
        </h1>

        <hr>

        <a href="dashboard.php" class="btn btn-outline-success mb-5">Dashboard</a>

        <?php echo $rating->errMsg ?? "" ?>

        <form action="" method="post">
            <div class="container mt-2">
                <div class="form-group">
                    <label for="">Select Restaurant:</label>
                    <?php if ($rest_list) : ?>
                        <select class="form-control" name="restaurant_id" id="restaurant_id">
                            <?php foreach ($rest_list as $restaurant) : ?>
                                <option value="<?= $restaurant['RestaurantID'] ?>">
                                    <?= $restaurant['Name'] ?> - <?= $restaurant['contact'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php else : ?>
                        <p>No restaurants found</p>
                    <?php endif; ?>
                </div>
                <?php if ($rest_list) : ?>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <input type="text" class="form-control" name="comment" id="comment" aria-describedby="helpId" placeholder="enter valuable comment">
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="text" class="form-control" name="rating" id="rating" aria-describedby="helpId" placeholder="enter value from 1-5">
                </div>
                <button type="submit" class="btn btn-primary" name="review"> Submit Review</button>
                <?php endif; ?>

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
</body>

</html>