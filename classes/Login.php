    <?php

require_once "Database.php";

class Login
{
    private $db, $password;
    public $email, $errorMsg, $userId, $username;

    function __construct($data)
    {
        $this->db = new Database();
        if (isset($data['login'])) {
            $this->email = $data['loginEmail'];
            $this->password = $data['loginPassword'];
            $this->validateUser();
        }
    }

    private function validateUser()
    {
        $query = "SELECT * FROM users WHERE Email = ?";
        $stmt = $this->db->link->prepare($query);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result) {
            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                $this->userId = $user['UserID'];
                $this->username = $user['Username'];
                if (password_verify($this->password, $user['Password'])) {
                    // Password is correct
                    $this->redirectUser($user['UserType']);
                } else {
                    // Invalid password
                    $this->errorMsg = '<div class="alert alert-danger" role="alert">
                            Invalid email or password.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                }
            } else {
                // User not found
                $this->errorMsg = '<div class="alert alert-danger" role="alert">
                            User not found.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
            }
        } else {
            // Query execution failed
            $this->errorMsg = '<div class="alert alert-danger" role="alert">
                        Error executing query. Please try again later.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
        }
    }
    
    

    private function redirectUser($userType)
    {
        switch ($userType) {
            case 'RestaurantOwner':
                $_SESSION["RestaurantOwnerId"] =  $this->userId;
                header("Location: restaurant/dasboard.php");
                exit();
                break;
            case 'FoodLover':
                $_SESSION["FoodLover"] =  $this->userId;
                $_SESSION["FoodLoverName"] =  $this->username;
                header("Location: user/dashboard.php");
                exit();
                break;
            case 'Admin':
                $_SESSION["Admin"] =  $this->userId;
                header("Location: admin/dashboard.php");
                exit();
                break;
            default:
                // Redirect to a default dashboard or display an error
                // Invalid credentials
                $this->errorMsg = '<div class="alert alert-danger" role="alert">
                                Invalid user type.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                break;
        }
    }
}