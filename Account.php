<?php require 'connect.php';
      session_start();
    
    // Pull Data From user Database
    $sql = "SELECT firstName, lastName FROM users WHERE email = '" . $_SESSION['user_email'] . "'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    // $row['firstName'] = 'Lucas'
    
    $rows=NULL;

    // Search Users
if(isset($_POST['search'])) {
    $search = $_POST['input']; 
    $sql = "SELECT firstName, lastName, user_id FROM users WHERE firstName LIKE '%" . $search . "%'";
    $result = mysqli_query($con, $sql);
    $rows = mysqli_fetch_array($result);    
    }

if (isset($_POST['signOut'])) {
    session_destroy();
    header('Location: index.php');
}

?>

<html>
    <head>
    <title>Account</title>
    <link rel='stylesheet' type="text/css" href="AcctStylesheet.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Yantramanav:100" rel="stylesheet"> 
    <script src="jquery-3.1.1.min.js"></script>
    </head>
<body>
    
    <div id='header'>
        <div id="headerWrap">
            <img id='logo' src="assets/logo.png">
            
            <form method='post' id='ArchiveSearch'>
                <input type='text' placeholder="Search DPFB" name='input'>
                <input type="submit" value="Search" name="search">
            </form>
        </div>
    </div>
    
 <div id="main">
    <div id="VertNav">
       <img id="profile" src="assets/default_profile.jpg"> 
        
<?php
    echo "<h3 id='name'>" . $row['firstName'] . " " . $row['lastName'] . "</h3>";
?>
        
    <div id='NavMenu'>
        <ul>
            <li>Profile</li>
            <li>Photos</li>
            <li>Memories</li>
            <li>Settings</li>
        </ul>
    <form method="post">
        <input type="submit" name='signOut' value='Sign Out'>
     </form> 
        
    </div>
</div><!-- VertNav -->
     
<div id="profileBody">
    <div id="timeline">
    
        <?php echo " " . $rows['firstName'] . " " . $rows['lastName'] ?>
    
    </div>
    
    <div id="timelineFocus">
    
    
    </div>
</div><!-- Profile Body -->     
</div><!-- Main -->
    

    
</body>
</html>