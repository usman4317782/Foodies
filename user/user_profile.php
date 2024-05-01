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
$fetchProfile = new User($_SESSION['FoodLover']);
// Get total counts of foodlover and restaurant owners
$fetchProfile->fetchPersonalProfileData();
$areas = $fetchProfile->fetchAreaDetails();
$fetchProfile->updateProfile($_POST, $_SESSION["FoodLover"]);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Food Lover Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <h1 class=" text text-center text-uppercase text-primary mt-5 ">Welcome <?php echo $_SESSION["FoodLoverName"]; ?></h1>

        <hr>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 text-center">Foodies.com (Update Profile)</h5>
                </div>
                <div class="card-body">

                    <div class="tab-content" id="myTabContent">

                        <!-- Register Form -->
                        <div class="tab-pane active" id="register" role="tabpanel" aria-labelledby="register-tab">
                            <?php if ($fetchProfile->errMsg) : ?>
                            <?php echo $fetchProfile->errMsg; ?>
                        <?php endif; ?>
                            <form action="" method="post">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $fetchProfile->user_name ?? ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $fetchProfile->email ?? ''; ?>">
                                </div>
                                <div class="mb-3" id="areaField">
                                    <!-- <input type="text" class="form-control" name="areaDetails" placeholder="Area Details"> -->
                                    <div class="mb-3" id="areaField">
                                        <select class="form-control" name="area" id="area">
                                            <option value="">Select Area</option>
                                            <?php
                                            // Assuming $areas contains the result of fetchAreaDetails() function
                                            foreach ($areas as $area) {
                                            ?>
                                                <option value="<?php echo $area['name']; ?>" <?php if (isset($fetchProfile->area) && ($fetchProfile->area == $area['name'])) {
                                                                                                    echo "selected";
                                                                                                } ?>> <?php echo $area['name']; ?> </option>;
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block" name="update">Update Profile</button>
                                    <a href="dashboard.php" class="mt-4 btn btn-info btn-block">Dashboard</a>

                                </div>
                            </form>


                        </div>
                        <!-- End Register Form -->

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>