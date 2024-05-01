<?php


require_once "Database.php";

class User
{
    private $db, $id;
    public $user_name, $email, $area, $errMsg, $quantity, $contact, $address;
    public function __construct($session_id)
    {
        $this->db = new Database();
        $this->id = $session_id;
    }

    public function fetchAreaDetails()
    {
        $query = "select * from area";
        $result = $this->db->select($query);
        return $result;
    }

    public function fetchPersonalProfileData()
    {
        $query = "SELECT * FROM `users` WHERE UserID = '$this->id' and UserType = 'FoodLover'";
        $result = $this->db->select($query);
        if ($result) {
            while ($data = $result->fetch_assoc()) {
                $this->user_name = $data['Username'];
                $this->email = $data['Email'];
                $this->area = $data['area'];
            }
        }
    }

    public function updateProfile($data, $session_id)
    {
        $this->id = $session_id;
        if (isset($data['update'])) {
            $this->user_name = $data['username'];
            $this->email = $data['email'];
            $this->area = $data['area'];
            $this->checkUsername();
            $this->checkEmail();
            function checkEmpty(...$variables)
            {
                foreach ($variables as $var) {
                    if (empty($var)) {
                        return true; // Return true if any variable is empty
                    }
                }
                return false; // Return false if all variables are non-empty
            }
            if (checkEmpty($this->user_name, $this->email, $this->area)) {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                    All fields must be filled out!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } elseif (!preg_match('/^[a-zA-Z0-9\s]+$/', $this->user_name)) {
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
            } elseif ($this->checkUsername() === true) {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                Username already exists against another user!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            } elseif ($this->checkEmail() === true) {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                Email already exists against another user!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            } else {
                // Insert new user into the database
                $query = "update users set Username = '$this->user_name', Email = '$this->email', area = '$this->area' where UserID = $this->id";
                $updateResult = $this->db->update($query);
                // Check if the insertion was successful
                if ($updateResult === false) {
                    // Handle the case where the insertion failed
                    $this->errMsg = '<div class="alert alert-danger" role="alert">
                                    Error: Failed to udpate user into the database.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                } else {
                    // Handle successful registration
                    $this->errMsg = '<div class="alert alert-success" role="alert">
                                    Data updated successfully.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                }
            }
        }
    }




    private function checkUsername()
    {
        // Check if username is already registered
        $query = "SELECT * FROM users WHERE username = '" . $this->user_name . "' AND UserID != '" . $this->id . "'";
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
    private function checkEmail()
    {
        // Check if username is already registered
        $query = "SELECT * FROM users WHERE email = '" . $this->email . "' AND UserID != '" . $this->id . "'";
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

    /*
    public function list()
    {
        // Fetch the area of the logged-in user
        $sql_user_area = "SELECT area FROM users WHERE UserID = ?";
        $stmt_user_area = $this->db->link->prepare($sql_user_area);
        $stmt_user_area->bind_param("i", $this->id);
        $stmt_user_area->execute();
        $result_user_area = $stmt_user_area->get_result();
        $user_area_row = $result_user_area->fetch_assoc();
        $user_area = $user_area_row['area'];

        // Fetch restaurants and their associated offers based on the user's area
        $sql = "SELECT r.*, o.OfferID, o.OfferText, o.ExpiryDate 
                FROM restaurants r 
                LEFT JOIN offers o ON r.RestaurantID = o.RestaurantID 
                WHERE r.area = ?
                ORDER BY r.RestaurantID";
        $stmt = $this->db->link->prepare($sql);
        $stmt->bind_param("s", $user_area);
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
    */

    public function list()
    {
        // Fetch the area of the logged-in user
        $sql_user_area = "SELECT area FROM users WHERE UserID = ?";
        $stmt_user_area = $this->db->link->prepare($sql_user_area);
        $stmt_user_area->bind_param("i", $this->id);
        $stmt_user_area->execute();
        $result_user_area = $stmt_user_area->get_result();
        $user_area_row = $result_user_area->fetch_assoc();
        $user_area = $user_area_row['area'];

        // Fetch restaurants, their associated offers, and WhatsApp contact details based on the user's area
        $sql = "SELECT r.*, o.OfferID, o.OfferText, o.ExpiryDate, c.contact AS whatsapp_contact
            FROM restaurants r 
            LEFT JOIN offers o ON r.RestaurantID = o.RestaurantID 
            LEFT JOIN whatsapp_chat_contact c ON r.RestaurantID = c.rest_id
            WHERE r.area = ?
            ORDER BY r.RestaurantID";
        $stmt = $this->db->link->prepare($sql);
        $stmt->bind_param("s", $user_area);
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

    public function fetchResturant()
    {
        // Get logged-in user's ID from session
        $userID = $this->id;

        // Fetch user's area from the database
        $query = "SELECT area FROM users WHERE UserID = $userID";
        $userResult = $this->db->select($query);
        if ($userResult) {
            $userRow = $userResult->fetch_assoc();
            $userArea = $userRow['area'];

            // Fetch restaurants based on user's area
            $query = "SELECT * FROM restaurants WHERE area = '$userArea'";
            $restaurantResult = $this->db->select($query);
            return $restaurantResult;
        }
    }

    public function submitRating($data)
    {
        if (isset($data['review'])) {
            $restaurant_id = filter_var($data['restaurant_id'], FILTER_SANITIZE_NUMBER_INT);
            $comment = filter_var($data['comment'], FILTER_SANITIZE_STRING);
            $rating = filter_var($data['rating'], FILTER_SANITIZE_NUMBER_INT);
            //    echo var_dump($restaurant_id, $comment, $rating<0);
            if (empty($restaurant_id and $comment and $rating)) {
                $this->errMsg =  "<p class='text text-center text-danger font-weight-bold'>Error! all fields are required</p>";
            } elseif ($rating < 1 or $rating > 5) {
                $this->errMsg =  "<p class='text text-center text-danger font-weight-bold'>Error! rating should in b/w 1-5</p>";
            } else {
                $query = "insert into ratings (RestaurantID, UserID, Rating, Comment)
                 values ('$restaurant_id','$this->id','$rating','$comment')";

                $result = $this->db->insert($query);
                if ($result) {
                    $this->errMsg = "<p class='text text-center text-success font-weight-bold'>Thanks for you valueable comment";
                } else {
                    $this->errMsg = "<p class='text text-center text-danger font-weight-bold'>Error! occurred";
                }
            }
        }
    }
    public function OrdersList()
    {
        // Get the restaurant ID from URL parameter
        $restaurant_id = isset($_GET['id']) ? $_GET['id'] : '';
        // Fetching orders data for the specific restaurant
        // Fetching orders data for the specific user
        // $query = "SELECT u.Username, u.Email, ord.address AS UserAddress, ord.contact AS UserContact, o.OfferText, o.ExpiryDate, ord.Quantity AS Quantity, ord.Status AS OrderStatus
        //           FROM orders ord
        //           INNER JOIN users u ON ord.UserID = u.UserID
        //           INNER JOIN offers o ON ord.MenuItemID = o.OfferID
        //           WHERE ord.UserID = $this->id
        //           GROUP BY u.Username, u.Email, ord.address, ord.contact, o.OfferText, o.ExpiryDate";
        // $query = "SELECT u.Username, u.Email, ord.address AS UserAddress, 
        //  ord.contact AS UserContact, o.OfferText, o.ExpiryDate, 
        //  ord.Quantity AS Quantity, ord.Status AS OrderStatus,
        //  r.Name AS RestaurantName
        // FROM orders ord
        // INNER JOIN users u ON ord.UserID = u.UserID
        // INNER JOIN offers o ON ord.MenuItemID = o.OfferID
        // INNER JOIN restaurants r ON ord.RestaurantID = r.RestaurantID  -- Join restaurants table
        // WHERE ord.UserID = $this->id
        // GROUP BY u.Username, u.Email, ord.address, ord.contact, o.OfferText, 
        //         o.ExpiryDate, ord.Quantity, ord.Status";
        $query = "SELECT u.Username, u.Email, ord.address AS UserAddress, 
         ord.contact AS UserContact, o.OfferText, o.ExpiryDate, 
         ord.Quantity AS Quantity, ord.Status AS OrderStatus,
         r.Name AS RestaurantName, ресто.Username AS RestaurantOwnerUsername, ресто.Email AS RestaurantOwnerEmail
        FROM orders ord
        INNER JOIN users u ON ord.UserID = u.UserID
        INNER JOIN offers o ON ord.MenuItemID = o.OfferID
        INNER JOIN restaurants r ON ord.RestaurantID = r.RestaurantID
        INNER JOIN users ресто ON r.OwnerID = ресто.UserID  -- Join users table again with alias
        WHERE ord.UserID = $this->id
        GROUP BY u.Username, u.Email, ord.address, ord.contact, o.OfferText, 
                o.ExpiryDate, ord.Quantity, ord.Status, r.Name, ресто.Username, ресто.Email";


        $result = $this->db->select($query);
        if ($result) {
            return $result;
        }
    }
}
