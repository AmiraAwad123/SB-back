<?php
$message = "";
if(isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    
    if($password != $cpassword){
        $message = "Passwords do not match";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Check if email already exists
        $check = $conn->query("SELECT * FROM sbtask WHERE email='$email'");
        if($check->num_rows > 0){
            $message = "This email is already registered";
        } else {
            // Insert into DB
            $sql = "INSERT INTO sbtask (firstname, lastname, email, password) 
                    VALUES ('$first_name', '$last_name', '$email', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                $message = "Account Created Successfully!";
                // header("Location: login.php"); // uncomment to redirect after success
            } else {
                $message = "Error: " . $conn->error;
            }
        }
    }
}