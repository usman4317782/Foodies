<?php
session_start();
require_once 'config.php';
require_once BASE_DIR . "Paras-Foodies/classes/Registration.php";
$registration = new Registration($_POST);
$areas = $registration->fetchAreaDetails();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
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
                <h5 class="mb-0 text-center">Foodies.com (Registration)</h5>
            </div>
            <div class="card-body">

                <div class="tab-content" id="myTabContent">

                    <!-- Register Form -->
                    <div class="tab-pane active <?php echo $registration->errMsg ? '' : 'show active'; ?>" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <?php if ($registration->errMsg) : ?>
                            <?php echo $registration->errMsg; ?>
                        <?php endif; ?>
                        <form action="" method="post">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="registerUsername" placeholder="Username" value="<?php echo $_POST['registerUsername'] ?? ''; ?>">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" name="registerEmail" placeholder="Email" value="<?php echo $_POST['registerEmail'] ?? ''; ?>">
                            </div>

                            <div class="mb-3">
                                <select class="form-control" name="registerUserType" id="registerUserType" onchange="toggleAreaField()">
                                    <option value="">Select User Type</option>
                                    <option value="RestaurantOwner" <?php echo ($_POST['registerUserType'] ?? '') == 'RestaurantOwner' ? 'selected' : ''; ?>>Restaurant Owner</option>
                                    <option value="FoodLover" <?php echo ($_POST['registerUserType'] ?? '') == 'FoodLover' ? 'selected' : ''; ?>>Food Lover</option>
                                </select>
                            </div>
                            <div class="mb-3" id="areaField" style="display: none;">
                                <!-- <input type="text" class="form-control" name="areaDetails" placeholder="Area Details"> -->
                                <div class="mb-3" id="areaField">
                                    <select class="form-select" name="areaDetails" id="areaDetails">
                                        <option value="">Select Area</option>
                                        <?php
                                        // Assuming $areas contains the result of fetchAreaDetails() function
                                        foreach ($areas as $area) {
                                            echo "<option value='" . $area['name'] . "'>" . $area['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="registerPassword" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="registerRepeatPassword" placeholder="Repeat Password">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block" name="reg">Register</button>
                                <button type="reset" class="btn btn-danger btn-block">Reset</button>
                                <?php
                                if (isset($_SESSION["Admin"])) {
                                ?>
                                    <br>
                                    <a href="admin/dashboard.php" class="btn btn-link">Go to dashboard</a>
                                <?php
                                } else {
                                ?>
                                    <a href="login.php" class="btn btn-link">Already Registered? Login</a>

                                <?php
                                }
                                ?>
                            </div>
                        </form>


                    </div>
                    <!-- End Register Form -->

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleAreaField() {
            var userType = document.getElementById("registerUserType").value;
            var areaField = document.getElementById("areaField");

            // If Food Lover option is selected, show the area field, else hide it
            areaField.style.display = userType === "FoodLover" ? "block" : "none";
        }
    </script>

</body>

</html>