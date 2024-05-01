<?php

require_once 'Database.php';

class Registration
{
    public $registerUsername, $registerEmail, $registerUserType, $registerPassword, $registerRepeatPassword, $errMsg, $areaDetails;
    private $db;

    function __construct($data)
    {
        // Create a new database connection

        $this->db = new Database();
        if (isset($data['reg'])) {
            // Define variables to hold form field values
            $this->registerUsername = $data['registerUsername'];
            $this->registerEmail = $data['registerEmail'];
            $this->registerUserType = $data['registerUserType'];
            $this->registerPassword = $data['registerPassword'];
            $this->registerRepeatPassword = $data['registerRepeatPassword'];
            if (isset($data['areaDetails'])) {
                $this->areaDetails = $data['areaDetails'];
            }else{
                $this->areaDetails = "";

            }
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

            if (checkEmpty($this->registerUsername, $this->registerEmail, $this->registerUserType, $this->registerPassword, $this->registerRepeatPassword)) {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                    All fields must be filled out!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } elseif (!preg_match('/^[a-zA-Z0-9\s]+$/', $this->registerUsername)) {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                    Username can only contain letters, digits, and whitespace!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } elseif (!filter_var($this->registerEmail, FILTER_VALIDATE_EMAIL)) {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                    Invalid email format!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } elseif ($this->registerPassword !== $this->registerRepeatPassword) {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                    Passwords do not match!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } elseif (strlen($this->registerPassword) < 6) {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                    Password must be at least 6 characters long!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } elseif ($this->checkUsername() === true) {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                Username already exists!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            } elseif ($this->checkEmail() === true) {
                $this->errMsg = '<div class="alert alert-danger" role="alert">
                Email already exists!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            } else {
                // Insert new user into the database
                $hashedPassword = password_hash($this->registerPassword, PASSWORD_DEFAULT);
                $query = "INSERT INTO `users`(`Username`, `Password`, `UserType`, `Email`, `area`)
                            VALUES ('$this->registerUsername','$hashedPassword','$this->registerUserType','$this->registerEmail','$this->areaDetails')";
                $insertResult = $this->db->insert($query);
                // Check if the insertion was successful
                if ($insertResult === false) {
                    // Handle the case where the insertion failed
                    $this->errMsg = '<div class="alert alert-danger" role="alert">
                                    Error: Failed to insert user into the database.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                } else {
                    // Handle successful registration
                    $this->errMsg = '<div class="alert alert-success" role="alert">
                                    Registration successful! You can now login.
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
        $query = "SELECT * FROM users WHERE username = '$this->registerUsername'";
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
        $query = "SELECT * FROM users WHERE email = '$this->registerEmail'";
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
}
