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
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email Aleady Exists')</script>";
        } else {
            $stmt->execute();
         // header('Location: WHERE NEXT?.php');
        }
    } // SignUp

   if(isset($_POST['login'])) {
         $email = mysqli_real_escape_string($con, $_POST['email']);
         $prepass = mysqli_real_escape_string($con, $_POST['pass']);
         $pass = hash('ripemd128', $salt . $prepass);
           
         // echo "<script>alert('" . $pass . "')</script>";
       
        $sel_user = "SELECT * FROM users WHERE email='$email' AND pass='$pass'";
        $run_user = mysqli_query($con, $sel_user);
        $check_user = mysqli_num_rows($run_user);
        
        if ($check_user > 0) {
            session_start(); 
            $_SESSION['user_email'] = $email;
            header('Location: Account.php');
                
        } else {
            echo "<script>alert('Incorrect Login')</script>";
        } 
    } 
?>

<html>
    <head>
    <title>DPFB</title>
    <link rel='stylesheet' type="text/css" href="stylesheet.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Yantramanav:100" rel="stylesheet"> 
    <script src="jquery-3.1.1.min.js"></script>
    </head>
    <body>
    
        <div id='header'>
            <img id='logo' src="assets/logo.png">
            
            <form method='post' id='logIn'>
                <input type='text' placeholder="Email" name='email' required>
                <input type='password' placeholder="Password" name='pass' required>
                <input type="submit" value="Log In" name="login">
            </form>
        </div> 
        
        <div id='videoWrap'> <!-- Video BG -->
            <video loop muted autoplay class="fullVid">
                <source src="assets/grade.webm" type="video/webm">
            </video>
        </div> <!-- VideoWrap -->
        
        <div id='main'>
            
            <span id='error'></span>
            
        <div id='wrapper'>    
            <div id='left'>
                <h3>Quick Description</h3>
                    <hr>
                <p>insert here some text that will not only take up space but also look very very good on the landing page</p>
            </div>
            
            <div id='mid'>
                <h1 id='SignUp'>Sign Up</h1>
                    <hr id='line'>
                <form method="post">
                    <input type='text' placeholder="First" name='first' required>
                    <input type="text" placeholder="Last" name='last' required>
                    <input type='email' placeholder="Email" name='emailLog' required>
                    <input type='password'placeholder="Password" name='pass1' required>
                    <input type='password' placeholder="Re-Enter Password" name='pass2' required>
                    <input type='submit' value="Sign Up" name="signup">
                </form>
            </div>
                
            <div id='right'>
               <h3>Mission Statement</h3>
                    <hr>
                <p>insert here some text that will not only take up space but also look very very good on the landing page</p>
            </div>       
        </div>
            
        </div>
    
    </body>
</html>