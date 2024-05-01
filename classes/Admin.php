<?php

require_once "Database.php";

class Admin
{
    public $db;
    public $msg, $username, $email, $userType, $errMsg, $area, $areaDetails;
    public $quantity, $contact, $address, $status;

    function __construct()
    {
        $this->db = new Database();
    }

    // Method to get the count of food lovers
    public function getTotalFoodLovers()
    {
        $sql = "SELECT COUNT(*) as count FROM users WHERE UserType = 'FoodLover'";
        $stmt = $this->db->link->prepare($sql);
        $stmt->execute(); // Execute the prepared statement
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data['count'];
    }

    // Method to get the count of restaurant owners
    public function getTotalRestaurantOwners()
    {
        $sql = "SELECT COUNT(*) as count FROM users WHERE UserType = 'RestaurantOwner'";
        $stmt = $this->db->link->prepare($sql);
        $stmt->execute(); // Execute the prepared statement
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data['count'];
    }

    // Method to fetch food lovers data
    public function getFoodLovers()
    {
        $sql = "SELECT * FROM users WHERE UserType = 'FoodLover'";
        $stmt = $this->db->link->prepare($sql);
        $stmt->execute(); // Execute the prepared statement
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Method to fetch restaurant owner data
    public function getRestOwnser()
    {
        $sql = "SELECT * FROM users WHERE UserType = 'RestaurantOwner'";
        $stmt = $this->db->link->prepare($sql);
        $stmt->execute(); // Execute the prepared statement
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Method to delete a food lover
    public function deleteFoodLover($userId)
    {
        $sql = "DELETE FROM users WHERE UserID = ?";
        $stmt = $this->db->link->prepare($sql);
        $stmt->bind_param("i", $userId);
        if ($stmt->execute()) {
            //show success alert of bootstrap?
            $this->msg = '<div class="alert alert-success" role="alert">
            User deleted successfully
          </div>';
        } else {
            //show success alert of bootstrap?
            $this->msg = '<div class="alert alert-danger" role="alert">
             Error in deleting user
           </div>';
        }
    }
    // Method to delete a food lover
    public function deleteRestOwner($userId)
    {
        $sql = "DELETE FROM users WHERE UserID = ?";
        $stmt = $this->db->link->prepare($sql);
        $stmt->bind_param("i", $userId);
        if ($stmt->execute()) {
            //show success alert of bootstrap?
            $this->msg = '<div class="alert alert-success" role="alert">
            User deleted successfully
          </div>';
        } else {
            //show success alert of bootstrap?
            $this->msg = '<div class="alert alert-danger" role="alert">
             Error in deleting user
           </div>';
        }
    }

    //fetch the user data against the id and show in the form
    public function fetchFoodLover($userID)
    {
        if (isset($userID['id'])) {
            $id = $userID['id'];
            $stmt = $this->db->link->prepare("SELECT * FROM users WHERE UserID = ?");
            $stmt->bind_param("i", $id); // "i" indicates integer type for UserID
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $this->username = $user['Username'];
                $this->email = $user['Email'];
                $this->userType = $user['UserType'];
                $this->area = $user['area'];
            }
        }
    }

    //update the fetched user record
    public function updateFoodLovers($data, $userID)
    {
        if (isset($data['udpate'])) {
            $id = $userID['id'];
            // Define variables to hold form field values
            $this->username = $data['registerUsername'];
            $this->email = $data['registerEmail'];
            $this->userType = $data['registerUserType'];
            if (isset($data['area'])) {
                $this->areaDetails = $data['area'];
            } else {
                $this->areaDetails = "";
            }
            $this->checkUsername($id);
            $this->checkEmail($id);

            function checkEmpty(...$variables)
            {
                foreach ($variables as $var) {
                    if (empty($var)) {
                        return true; // Return true if any variable is empty
                    }
                }
                return false; // Return false if all variables are non-empty
            }

            if (checkEmpty($this->username, $this->email, $this->userType)) {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                    All fields must be filled out!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } elseif (!preg_match('/^[a-zA-Z0-9\s]+$/', $this->username)) {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                    Username can only contain letters, digits, and whitespace!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                    Invalid email format!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } elseif ($this->checkUsername($id) === true) {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                Username already exists!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            } elseif ($this->checkEmail($id) === true) {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                Email already exists!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            } else {
                $query = "UPDATE users set Username = '$this->username', UserType = '$this->userType', Email = '$this->email', area = '$this->areaDetails' WHERE UserID = '$id';";
                $insertResult = $this->db->update($query);

                // Check if the insertion was successful
                if ($insertResult === false) {
                    // Handle the case where the insertion failed
                    $this->errMsg = '<div class="alert alert-danger" role="alert">
                                    Error: Failed to update user into the database.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                } else {
                    // Handle successful registration
                    $this->errMsg = '<div class="alert alert-success" role="alert">
                                    User updated successfully!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                }
            }
        }
    }

    private function checkUsername($id)
    {
        // Check if username is already registered
        $query = "SELECT * FROM users WHERE username = '$this->username' AND UserID!='$id'";
        $result = $this->db->select($query);
        // Fetch the first row from the result set
        // $user = $result->fetch_assoc();

        // Check if a user with the given username exists
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    private function checkEmail($id)
    {
        // Check if username is already registered
        $query = "SELECT * FROM users WHERE email = '$this->email' AND UserID!='$id'";
        $result = $this->db->select($query);
        // Fetch the first row from the result set
        // $user = $result->fetch_assoc();

        // Check if a user with the given username exists
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function fetchAreaDetails()
    {
        $query = "select * from area";
        $result = $this->db->select($query);
        return $result;
    }

    public function getTotalOrders()
    {
        $sql = "SELECT COUNT(*) as count FROM orders";
        $stmt = $this->db->link->prepare($sql);
        $stmt->execute(); // Execute the prepared statement
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data['count'];
    }

    // Method to fetch restaurant owner data
    public function ManageUserOrders()
    {
        // $query = "SELECT u.Username AS UserUsername, u.Email AS UserEmail, ord.address AS UserAddress, 
        // ord.contact AS UserContact, o.OfferText, o.ExpiryDate, 
        // ord.Quantity AS Quantity, ord.Status AS OrderStatus, ord.Created_at AS OrderBookingDate,
        // r.Name AS RestaurantName, ресто.Username AS RestaurantOwnerUsername, ресто.Email AS RestaurantOwnerEmail
        // FROM orders ord
        // INNER JOIN users u ON ord.UserID = u.UserID
        // INNER JOIN offers o ON ord.MenuItemID = o.OfferID
        // INNER JOIN restaurants r ON ord.RestaurantID = r.RestaurantID
        // INNER JOIN users ресто ON r.OwnerID = ресто.UserID
        // GROUP BY u.Username, u.Email, ord.address, ord.contact, o.OfferText, 
        //   o.ExpiryDate, ord.Quantity, ord.Status, r.Name, ресто.Username, ресто.Email";
        $query = "SELECT u.Username AS UserUsername, u.Email AS UserEmail, ord.address AS UserAddress, 
            ord.contact AS UserContact, o.OfferText, o.ExpiryDate, 
            ord.Quantity AS Quantity, ord.OrderID AS OrderID, ord.Status AS OrderStatus, ord.Created_at AS OrderBookingDate,
            r.Name AS RestaurantName, ресто.Username AS RestaurantOwnerUsername, ресто.Email AS RestaurantOwnerEmail
            FROM orders ord
            INNER JOIN users u ON ord.UserID = u.UserID
            INNER JOIN offers o ON ord.MenuItemID = o.OfferID
            INNER JOIN restaurants r ON ord.RestaurantID = r.RestaurantID
            INNER JOIN users ресто ON r.OwnerID = ресто.UserID
            GROUP BY u.Username, u.Email, ord.address, ord.contact, o.OfferText, 
              o.ExpiryDate, ord.Quantity, ord.Status, r.Name, ресто.Username, ресто.Email";
        $result = $this->db->select($query);
        if ($result) {
            return $result;
        }
    }

    public function DeleteUserOrders($url_data)
    {
        if (isset($url_data['action']) and $url_data['action'] === 'delete') {
            $order_id = $_GET['order_id'];
            $query = "DELETE FROM `orders` WHERE `OrderID` = '$order_id'";
            $result = $this->db->delete($query);
            if ($result) {
                $this->errMsg = '<div class="alert alert-success" role="alert">
                                    Order deleted successfully!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
            } else {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                    Error! Order not deleted. Please try again later.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
            }
        }
    }

    public function UpdateUserOrder($order_id, $data)
    {
        if (isset($data['update_order'])) {
            $id = $order_id['order_id'];
            $this->status = $data['status'];
            $this->quantity = $data['quantity'];
            $this->contact = $data['contact'];
            $this->address = $data['address'];
            $query = "UPDATE `orders` SET `Quantity`='$this->quantity',`address`='$this->address',`contact`='$this->contact', `Status`='$this->status' WHERE `OrderID` = '$id'";
            $result = $this->db->update($query);
            if ($result) {
                $this->errMsg = "<p class='text text-center text-success font-weight-bold'>Success! Order Update</p>";
            }else{
                $this->errMsg = "<p class='text text-center text-success font-weight-bold'>Error! Order Not Update</p>";
            }
        }
    }

    public function fetchOrderDetails($url_data)
    {
        if (isset($url_data['action']) and $url_data['action'] == 'update') {
            $id = $url_data['order_id'];
            $query = "select * from orders where OrderID = '$id'";
            $result = $this->db->select($query);
            if ($result) {
                while($data = $result->fetch_assoc())
                {
                    $this->status = $data['Status'];
                    $this->quantity = $data['Quantity'];
                    $this->contact = $data['contact'];
                    $this->address = $data['address'];
                }
            }
        }
    }

    //show all registered resturants list
    public function list()
    {
        // Fetch all restaurants and their associated offers
        $sql = "SELECT r.*, o.OfferID, o.OfferText, o.ExpiryDate 
                FROM restaurants r 
                LEFT JOIN offers o ON r.RestaurantID = o.RestaurantID 
                ORDER BY r.RestaurantID";
        $stmt = $this->db->link->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $restaurants = array();
        while ($row = $result->fetch_assoc()) {
            $restaurantID = $row['RestaurantID'];
            if (!isset($restaurants[$restaurantID])) {
                $restaurants[$restaurantID] = $row;
                $restaurants[$restaurantID]['offers'] = array();
            }
            if (!empty($row['OfferText'])) {
                $restaurants[$restaurantID]['offers'][] = array(
                    'OfferID' => $row['OfferID'],
                    'OfferText' => $row['OfferText'],
                    'ExpiryDate' => $row['ExpiryDate']
                );
            }
        }
    
        return $restaurants;
    }

    public function bookOrder($session_id, $url_id, $data)
    {
        if (isset($data['book_order'])) {

            // Sanitize the data to prevent SQL injection
            $quantity = intval($data['quantity']);
            $contact = htmlspecialchars($data['contact']);
            $address = htmlspecialchars($data['address']);

            // Check if any required field is empty
            if (empty($quantity and $contact and $address)) {
                // If any required field is empty, return false
                $this->errMsg = "<p class='text text-center text-danger font-weightb-bold'>Error! all fields are required</p>";
            } else {
                // Now let's extract the restaurant and offer IDs from the URL parameters
                $restaurantID = intval($url_id['rest_id']);
                $menuItemID = intval($url_id['offer_id']);

                // Prepare the SQL statement to insert the order into the database
                $sql = "INSERT INTO orders (UserID, RestaurantID, MenuItemID, Quantity, address, contact) 
                 VALUES (?, ?, ?, ?, ?, ?)";

                // Assuming you have a database connection stored in $this->db, and using prepared statements to prevent SQL injection
                $stmt = $this->db->link->prepare($sql);
                // Bind parameters
                $stmt->bind_param("iiiiss", $session_id, $restaurantID, $menuItemID, $quantity, $address, $contact);

                // Execute the statement
                if ($stmt->execute()) {
                    // Order successfully inserted
                    $this->errMsg = "<p class='text text-center text-success font-weightb-bold'>Success! data inserted successfully</p>";
                } else {
                    // Failed to insert order
                    $this->errMsg = "<p class='text text-center text-danger font-weightb-bold'>Error! data insertion failed</p>";
                }
            }
        }
    }
}
