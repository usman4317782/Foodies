<?php session_start(); require_once 'config.php';?>
<?php
// Include the config.php file
require_once BASE_DIR."Paras-Foodies/classes/Login.php";
$login = new Login($_POST);
?>

<?php
if (isset($_SESSION["RestaurantOwnerId"])) {
    ?>
    <script>
        window.location.replace("restaurant/dasboard.php"); // Replace with your desired URL
    </script>
    <?php
}
elseif (isset($_SESSION["FoodLover"])) {
    ?>
    <script>
        window.location.replace("user/dasboard.php"); // Replace with your desired URL
    </script>
    <?php
}
elseif (isset($_SESSION["Admin"])) {
    ?>
    <script>
        window.location.replace("admin/dasboard.php"); // Replace with your desired URL
    </script>
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
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
                <h5 class="mb-0 text-center">Foodies.com (Login)</h5>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login"
                            type="button" role="tab" aria-controls="login" aria-selected="true">Login</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- Login Form -->
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <?php echo $login->errorMsg ?? ""?>
                        <form action="" method="post">
                            <div class="mb-3">
                                <input type="email" class="form-control" name="loginEmail" placeholder="Email" value="<?php echo  $login->email ?? ""?>">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="loginPassword" placeholder="Password">
                            </div>
                            <div class="text-center">
                                <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                                <button type="reset" class="btn btn-danger btn-block">Reset</button><br>
                                <a href="index.php" class="btn btn-link">Newbie? Get Registere</a>
                            </div>
                        </form>
                    </div>
                    <!-- End Login Form -->


                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>