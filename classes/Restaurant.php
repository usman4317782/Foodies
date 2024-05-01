<?php

require_once "Database.php";

class Restaurant
{
    private $db;
    public $name_error;
    public $location_error;
    public $area_error;
    public $contact_error;
    public $details_error;
    public $name;
    public $location;
    public $contact;
    public $details;
    public $msg;
    private $owner_id;
    private $update_id;
    public $area;
    public $offer, $exp_date;

    function __construct()
    {
        $this->db = new Database();
    }

    //this function insert the record into the database
    public function insert($data, $owner_id)
    {
        if (isset($data['add'])) {
            // Sanitize and validate input data
            $this->name = $this->sanitize_input($data["name"]);
            $this->area = $this->sanitize_input($data["areaDetails"]);
            $this->location = $this->sanitize_input($data["location"]);
            $this->contact = $this->sanitize_input($data["contact_number"]);
            $this->details = $this->sanitize_input($data["details"]);
            $this->owner_id = $owner_id;

            // Perform validation
            $this->validate_name();
            $this->validate_area();
            $this->validate_location();
            $this->validate_contact();
            $this->validate_details();

            // If no errors, insert data into database
            if (empty($this->name_error) && empty($this->area_error) && empty($this->location_error) && empty($this->contact_error) && empty($this->details_error)) {
                $this->insert_restaurant();
            }
        }
    }

    // Function to sanitize input data
    private function sanitize_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    // Function to validate name
    private function validate_name()
    {
        if (empty($this->name)) {
            $this->name_error = "Name is required";
        } else {
            $this->check_name_exists();
        }
    }

    // Function to validate name
    private function validate_area()
    {
        if (empty($this->name)) {
            $this->name_error = "Area is required";
        }
    }

    // Function to validate location
    private function validate_location()
    {
        if (empty($this->location)) {
            $this->location_error = "<p class='text text-danger'>Location is required</p>";
        }
    }

    // Function to validate contact
    private function validate_contact()
    {
        if (empty($this->contact)) {
            $this->contact_error = "<p class='text text-danger'>Contact is required</p>";
        }
    }

    // Function to validate details
    private function validate_details()
    {
        if (empty($this->details)) {
            $this->details_error = "<p class='text text-danger'>Details are required</p>";
        }
    }

    // Function to insert restaurant data into the database
    public function insert_restaurant()
    {
        $sql = "INSERT INTO restaurants (Name, area, Location, contact, details, OwnerID) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->link->prepare($sql);
        $stmt->bind_param("sssssi", $this->name, $this->area, $this->location, $this->contact, $this->details, $this->owner_id);

        if ($stmt->execute()) {
            $this->msg = "<p class='text text-center text-uppercase mt-4 mb-4 text-success'>Data inserted successfully</p>";
        } else {
            $this->msg = "<p class='text text-center text-uppercase mt-4 mb-4 text-danger'>Error! while inserting record</p>";
        }
    }

    // Function to check if the name already exists in the database
    private function check_name_exists()
    {
        $sql = "SELECT * FROM restaurants WHERE Name = ?";
        $stmt = $this->db->link->prepare($sql);
        $stmt->bind_param("s", $this->name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $this->name_error = "<p class='text text-danger'>Name already exists</p>";
        }
    }

    // Function to fetch all registered data of restaurants related to the logged-in user
    public function list($ownerID)
    {

        $sql = "SELECT * FROM restaurants WHERE OwnerID = ?";
        $stmt = $this->db->link->prepare($sql);
        $stmt->bind_param("i", $ownerID);
        $stmt->execute();
        $result = $stmt->get_result();

        $restaurants = array();
        while ($row = $result->fetch_assoc()) {
            $restaurants[] = $row;
        }

        return $restaurants;
    }

    // Function to delete the registered restaurant from the DB
    public function delete($id)
    {
        $sql = "DELETE FROM restaurants WHERE RestaurantID = ?";
        $stmt = $this->db->link->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $this->msg = '<p class="text text-center text-uppercase text-success">Record deleted!</p>';
            header('refresh:2; url=resturaunt_list.php');
        } else {
            $this->msg = '<p class="text text-center text-uppercase text-danger"><b>Error!</b> Record not deleted.</p>';
        }
    }

    // Method to fetch the record based on the provided ID and owner ID
    public function fetch($id, $owner_id)
    {
        if (isset($id) && isset($owner_id)) {
            $sql = "SELECT * FROM restaurants WHERE RestaurantID = ? AND OwnerID = ?";
            $stmt = $this->db->link->prepare($sql);
            $stmt->bind_param("ii", $id, $owner_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc(); // Fetch the record
                // Store values in class variables
                $this->name = $row['Name'];
                $this->area = $row['area'];
                $this->location = $row['Location'];
                $this->contact = $row['contact'];
                $this->details = $row['details'];
                return $row; // Return the fetched record
            } else {
                return null; // Return null if no record found
            }
        }
    }
    //update the record of restuarant
    public function update($update_id, $data, $owner_id)
    {
        if (isset($data['update'])) {
            $this->owner_id = $owner_id;
            $this->update_id = $update_id;
            // Sanitize and validate input data
            $this->name = $this->sanitize_input($data["name"]);
            $this->area = $this->sanitize_input($data["areaDetails"]);
            $this->location = $this->sanitize_input($data["location"]);
            $this->contact = $this->sanitize_input($data["contact_number"]);
            $this->details = $this->sanitize_input($data["details"]);
            $this->owner_id = $owner_id;

            // Perform validation
            $this->validate_name_on_update();
            $this->validate_area();
            $this->validate_location();
            $this->validate_contact();
            $this->validate_details();

            // If no errors, insert data into database
            if (empty($this->name_error) && empty($this->area_error) && empty($this->location_error) && empty($this->contact_error) && empty($this->details_error)) {
                $this->update_restaurant();
            }
        }
    }


    // Function to update restaurant data in the database
    public function update_restaurant()
    {
        // Check if ID is set and not empty
        if (isset($this->update_id) && !empty($this->update_id)) {
            $sql = "UPDATE restaurants SET Name = ?, area = ?, Location = ?, contact = ?, details = ? WHERE RestaurantID = ?";
            $stmt = $this->db->link->prepare($sql);
            $stmt->bind_param("sssssi", $this->name, $this->area, $this->location, $this->contact, $this->details, $this->update_id);

            if ($stmt->execute()) {
                $this->msg = "<p class='text text-center text-uppercase mt-4 mb-4 text-success'>Data updated successfully</p>";
            } else {
                $this->msg = "<p class='text text-center text-uppercase mt-4 mb-4 text-danger'>Error! while updating record</p>";
            }
        } else {
            $this->msg = "<p class='text text-center text-uppercase mt-4 mb-4 text-danger'>Error! Invalid ID provided</p>";
        }
    }

    // Function to check if the name already exists in the database
    private function check_name_exists_on_update()
    {
        $sql = "SELECT * FROM restaurants WHERE Name = ? AND RestaurantID != ?";
        $stmt = $this->db->link->prepare($sql);
        $stmt->bind_param("si", $this->name, $this->update_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $this->name_error = "<p class='text text-danger'>Name already exists</p>";
        }
    }

    // Function to validate name
    private function validate_name_on_update()
    {
        if (empty($this->name)) {
            $this->name_error = "Name is required";
        } else {
            $this->check_name_exists_on_update();
        }
    }

    public function fetchAreaDetails()
    {
        $query = "select * from area";
        $result = $this->db->select($query);
        return $result;
    }

    //method post the offer and intimate the users
    public function post($data, $id)
    {
        if (isset($id) and isset($data['post_offer']) and $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->offer = $data['offer'];
            $this->exp_date = $data['exp_date'];
            $todayDate = date("Y-m-d");
            if (empty($this->offer and $this->exp_date)) {
                $this->msg = "<p class='text text-center text-danger font-weight-bold'>Error! all fields are required.</p>";
            } elseif ($this->exp_date < $todayDate) {
                $this->msg = "<p class='text text-center text-danger font-weight-bold'>Expiry date cannot be older than today's date.</p>";
            } else {
                $query = "INSERT INTO `offers`(`RestaurantID`, `OfferText`, `ExpiryDate`) 
                VALUES ('$id','$this->offer','$this->exp_date')";
                $result = $this->db->insert($query);
                if ($result) {
                    $this->msg = "<p class='text text-center text-success font-weight-bold'>Success! new offer posted.</p>";
                } else {
                    $this->msg = "<p class='text text-center text-danger font-weight-bold'>Error! new offer not posted.</p>";
                }
            }
        }
    }

    public function getPosts($id)
    {
        $query = "SELECT o.*, r.Name AS RestaurantName FROM offers o JOIN restaurants r ON o.RestaurantID = r.RestaurantID WHERE r.OwnerID = $id";
        $result = $this->db->select($query);
        $offers = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $offers[] = $row;
            }
        }
        return $offers;
    }

    //method delete the posted offer
    public function deleteOffer($id)
    {
        $sql = "DELETE FROM `offers` WHERE `OfferID` = ?";
        $stmt = $this->db->link->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $this->msg = '<p class="text text-center text-uppercase text-success">Record deleted!</p>';
            header('refresh:2; url=offers_list.php');
        } else {
            $this->msg = '<p class="text text-center text-uppercase text-danger"><b>Error!</b> Record not deleted.</p>';
        }
    }

    //method update the offer

    public function fetchOffer($owner_id, $offer_id)
    {
        if (isset($offer_id) and isset($owner_id) and is_numeric($owner_id) and is_numeric($offer_id)) {
            $query = "SELECT o.*, r.Name AS RestaurantName FROM offers o JOIN restaurants r ON o.RestaurantID = r.RestaurantID WHERE r.OwnerID = $owner_id AND o.OfferID = $offer_id";
            $result = $this->db->select($query);

            if ($result) {
                // Fetch the first (and presumably only) row
                $row = $result->fetch_assoc();

                // Store the fetched data into variables
                $this->offer = $row['OfferText'];
                $this->exp_date = $row['ExpiryDate'];
            } else {
                $this->msg = "<p class='text text-center text-uppercase mt-4 mb-4 text-danger'>Record Not found</p>";
                header("refresh:1; url=offers_list.php");
            }
        } else {
            $this->msg = "<p class='text text-center text-uppercase mt-4 mb-4 text-danger'>Record Not found</p>";
            header("refresh:1; url=offers_list.php");
        }
    }

    //method update the offer
    public function updateOffer($data, $id)
    {
        if (isset($id) && isset($data['update_offer']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->offer = trim($data['offer']);
            $this->exp_date = $data['exp_date'];
            $todayDate = date("Y-m-d");
            if (empty($this->offer) || empty($this->exp_date)) {
                $this->msg = "<p class='text text-center text-danger font-weight-bold'>Error! All fields are required.</p>";
            } elseif ($this->exp_date < $todayDate) {
                $this->msg = "<p class='text text-center text-danger font-weight-bold'>Expiry date cannot be older than today's date.</p>";
            } else {
                // Construct the SQL query to update the offer
                $query = "UPDATE offers SET OfferText = '$this->offer', ExpiryDate = '$this->exp_date' WHERE OfferID = $id";
                // Execute the query
                $result = $this->db->update($query);
                if ($result) {
                    $this->msg = "<p class='text text-center text-success font-weight-bold'>Success! Offer updated.</p>";
                } else {
                    $this->msg = "<p class='text text-center text-danger font-weight-bold'>Error! Offer not updated.</p>";
                }
            }
        }
    }


    public function ratingList($restaurant_owner_id, $restaurant_id)
    {
        $query = "SELECT r.RatingID, r.UserID, r.Rating, r.Comment, r.Created_at, u.Username 
              FROM ratings r 
              INNER JOIN users u ON r.UserID = u.UserID 
              WHERE r.RestaurantID = $restaurant_id";

        // Execute the query to fetch ratings
        // Assuming you have a database connection stored in $db_connection
        $result = $this->db->select($query);

        // Check if the query execution was successful
        if (!$result) {
            // Query execution failed, return an empty array
            return [];
        }

        // Initialize an array to store the fetched ratings
        $ratings = [];

        // Fetch each row from the result set
        while ($row = mysqli_fetch_assoc($result)) {
            // Append each rating to the ratings array
            $ratings[] = $row;
        }

        // Return the array of ratings
        return $ratings;
    }

    public function OrdersList($rest_id)
    {
        // Get the restaurant ID from URL parameter
        $restaurant_id = isset($_GET['id']) ? $_GET['id'] : '';
        // Fetching orders data for the specific restaurant
        $query = "SELECT u.Username, u.Email, ord.OrderID, ord.address AS UserAddress, ord.contact AS UserContact, o.OfferText, o.ExpiryDate, ord.Quantity AS Quantity, ord.Status AS OrderStatus
                      FROM orders ord
                      INNER JOIN users u ON ord.UserID = u.UserID
                      INNER JOIN offers o ON ord.MenuItemId = o.OfferID
                      WHERE ord.RestaurantID = $restaurant_id AND o.RestaurantID = $restaurant_id
                      GROUP BY u.Username, u.Email, ord.address, ord.contact, o.OfferText, o.ExpiryDate";
        $result = $this->db->select($query);
        if ($result) {
            return $result;
        }
    }

    public function ConfirmedOrderStatus($url_data)
    {
        if (isset($url_data['id']) and isset($url_data['status']) and $url_data['status'] === 'Confirmed') {
            $id = intval($url_data['id']);
            $status = $url_data['status'];
            $query = "UPDATE `orders` SET `Status`='$status' WHERE `OrderID` = '$id'";
            $result = $this->db->update($query);
            if ($result) {
                $this->msg = "<p class='text text-center text-success font-weight-bold'>Success! Status updated.</p>";
            } else {
                $this->msg = "<p class='text text-center text-danger font-weight-bold'>Error! Status not updated.</p>";
            }
        }
    }

    public function chatContact($data, $owner_id, $rest_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact = $data['contact'];
            
            // Check if contact number exists for the given owner_id and rest_id
            $existingContactQuery = "SELECT id FROM whatsapp_chat_contact WHERE owner_id = '$owner_id' AND rest_id = '$rest_id'";
            $existingContactResult = $this->db->select($existingContactQuery);
    
            if ($existingContactResult) {
                // Contact number already exists for the given owner_id and rest_id, perform update
                $updateQuery = "UPDATE whatsapp_chat_contact SET contact = '$contact' WHERE owner_id = '$owner_id' AND rest_id = '$rest_id'";
                $result = $this->db->update($updateQuery);
                
                if ($result) {
                    $this->msg = "<p class='text text-center text-success font-weight-bold'>Success! Contact Details updated successfully</p>";
                } else {
                    $this->msg = "<p class='text text-center text-danger font-weight-bold'>Error! Contact Details not updated</p>";
                }
            } else {
                // Contact number doesn't exist for the given owner_id and rest_id, perform insert
                $insertQuery = "INSERT INTO whatsapp_chat_contact (owner_id, rest_id, contact) VALUES ('$owner_id', '$rest_id', '$contact')";
                $result = $this->db->insert($insertQuery);
                
                if ($result) {
                    $this->msg = "<p class='text text-center text-success font-weight-bold'>Success! Contact Details added successfully</p>";
                } else {
                    $this->msg = "<p class='text text-center text-danger font-weight-bold'>Error! Contact Details not added</p>";
                }
            }
        }
    }
    
    
}
