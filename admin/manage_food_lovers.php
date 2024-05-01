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
$getFoodLovers = new Admin();
// Fetch food lovers data

$foodLovers = $getFoodLovers->getFoodLovers();

// Check if delete request is sent
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    // Delete the food lover
    $getFoodLovers->deleteFoodLover($userId);
    // Redirect back to the same page after deletion
    // header("Location: ".$_SERVER['PHP_SELF']);
    // exit();
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Registered Food Lovers</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <div class="container">
        <h1 class="text text-center text-info text-uppercase mt-4 mb-4">
            food lovers management
        </h1>
        <hr>
        <a href="dashboard.php" class="btn btn-outline-info mt-4 mb-4">Dashboard</a>
        <a href="../index.php"  class="btn btn-outline-primary mt-4 mb-4">Add New</a>
        <?php 
            if(isset($getFoodLovers->msg)){
                echo $getFoodLovers->msg;
                header("refresh:2; url=manage_food_lovers.php");
            }
        ?>
        <table class="table table-bordered">
            <tr>
                <th>Sr. #</th>
                <th>Username</th>
                <th>Email</th>
                <th>Area</th>
                <th>Action</th>
            </tr>
            <?php $count=0; foreach ($foodLovers as $foodLover) : $count++; ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo htmlspecialchars($foodLover['Username']); ?></td>
                    <td><?php echo htmlspecialchars($foodLover['Email']); ?></td>
                    <td><?php echo htmlspecialchars($foodLover['area']); ?></td>
                    <td>
                        <a href="update_users.php?id=<?php echo $foodLover['UserID']?>&type=<?php echo $foodLover['UserType'] ?>" class="btn btn-sm btn-primary">Update</a>
                        <a onclick="return confirm('Confirmed Delete!');" href="?id=<?php echo $foodLover['UserID']?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   
</body>

</html>