<?php   require 'connect.php';  
    
    // Salt for password hashing
    $salt = 'h^&%!';

    if(isset($_POST['signup'])) {
        
        // Save variables & hash password
        $fname = $_POST['first'];
        $lname = $_POST['last'];
        $email = $_POST['emailLog'];
        $pass1 = hash('ripemd128', $salt . $_POST['pass1']);
        $pass2 = hash('ripemd128', $salt . $_POST['pass2']);
    
        $stmt = $con->prepare("INSERT INTO users (firstName, lastName, email, pass)Values(?, ?, ?, ?)");
        $stmt->bind_param('ssss', $fname, $lname, $email, $pass1);
        $check_user = "SELECT * FROM users WHERE email = '" . $email . "'";
        $result = mysqli_query($con, $check_user);
            
        // Check if passwords match
        if($pass1 != $pass2) {
            echo "<script>alert('Passwords Do Not Match')</script>";
        }       
        
        // Check if User is already in the system
        elseif (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email Aleady Exists')</script>";
        
        // Submit The Query
        } else {
            $stmt->execute();
         // header('Location: WHERE NEXT?.php');
        }
    } // SignUp
?>