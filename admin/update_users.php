<?php
session_start();
if (!isset($_SESSION["Admin"])) {
?>
    <script>
        window.location.replace("../login.php"); // Replace with your desired URL
    </script>
<?php
}
?>

<?php
require_once "../classes/Admin.php";
$update = new Admin();
// Fetch food lovers data
$update->fetchFoodLover($_GET); //this method get food lover record from DB against the ID received in URL
$update->updateFoodLovers($_POST, $_GET);
$areas = $update->fetchAreaDetails();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Food Lover</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Add custom styles here */
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }

        .form-control {
            border-radius: 20px;
        }

        .btn {
            border-radius: 20px;
        }

        .btn-toggle {
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 text-center">(Update User)</h5>
            </div>
            <div class="card-body">

                <div class="tab-content" id="myTabContent">

                    <!-- update Form -->
                    <div class="tab-pane active" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <form action="" method="post">
                            <?php echo $update->errMsg ?? ""; ?>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="registerUsername" placeholder="Username" value="<?php echo $update->username ?? ''; ?>">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" name="registerEmail" placeholder="Email" value="<?php echo $update->email ?? ''; ?>">
                            </div>
                            <?php
                            if (isset($_GET['type']) and $_GET['type'] === 'FoodLover') {
                            ?>
                                <!-- <div class="mb-3">
                                    <input type="text" class="form-control" name="area" placeholder="Area" value="<?php echo $update->area ?? ''; ?>">
                                </div> -->
                                <div class="mb-3" id="areaField">
                                    <!-- <input type="text" class="form-control" name="areaDetails" placeholder="Area Details"> -->
                                    <div class="mb-3" id="areaField">
                                        <select class="form-select" name="area" id="area">
                                            <option value="">Select Area</option>
                                            <?php
                                            // Assuming $areas contains the result of fetchAreaDetails() function
                                            foreach ($areas as $area) {
                                            ?>
                                                <option value="<?php echo htmlspecialchars($area['name']); ?>" <?php if ($update->area == $area['name']) {
                                                                                                                    echo "selected";
                                                                                                                } ?>>
                                                    <?php echo htmlspecialchars($area['name']); ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="mb-3">
                                <select class="form-control" name="registerUserType">
                                    <option value="">Select User Type</option>
                                    <option value="RestaurantOwner" <?php echo ($update->userType ?? '') == 'RestaurantOwner' ? 'selected' : ''; ?>>Restaurant Owner</option>
                                    <option value="FoodLover" <?php echo ($update->userType ?? '') == 'FoodLover' ? 'selected' : ''; ?>>Food Lover</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block" name="udpate">Update</button>
                                <br>
                                <a href="dashboard.php" class="btn btn-link">Go to Dashboard</a>
                            </div>
                        </form>
                    </div>
                    <!-- End update Form -->

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>