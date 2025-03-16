<?php
$conndb = mysqli_connect("localhost", "root", "", "PanelDB");

// Check connection
if (!$conndb) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Database Connected successfully!";
}
$conn = mysqli_select_db($conndb,"PanelDB");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "<br> PanelDb Connected successfully!";
}
session_start();
var_dump($_GET);

//Check if the form has been submitted
if(isset($_REQUEST['form_type'])) {
    $err_array = array();
    if($_REQUEST['form_type'] == 'signup') {
        // Process user signup
        // Check for errors
        if(empty($_POST['username'])) {
            $err_array[] = "username";
        }
        if(empty($_POST['password']) || (strlen($_POST['password']) < 5)) {
            $err_array[] = "password";
        }
        if(empty($_POST['email'])) {
            $err_array[] = "email";
        }

        if($err_array) {
            header('Location: Panels_HTML.php?err_array=' . implode(', ', $err_array) . '&error=password');
            exit;
        } else {
            // Append user data to database
            $query = 'INSERT INTO `userdata`(`id`, `name`, `email`, `PASSWORD`, `admin`) 
                      VALUES (null,"'.trim($_POST['username']).'","'.$_POST['email'].'","'.$_POST['password'].'",1)';
            $appended = mysqli_query($conndb, $query);
            mysqli_free_result($result);
            header('Location: Panels_HTML.php?err_array=' . implode(', ', $err_array) . '&error=null');
        }
    } elseif($_REQUEST['form_type'] == 'contactus') {
        // Append contact message to database
        $query = 'INSERT INTO `messages`(`id`, `name`, `email`, `message`) 
                    VALUES (null,"'.$_POST['username'].'","'.$_POST['email'].'","'.$_POST['message'].'")';
        $appended = mysqli_query($conndb, $query);
        //append user message to the database
        $dir_file = $_SERVER['DOCUMENT_ROOT'] .'/Electrical panels example/DB/';
        $avatar='';
        if ($_FILES["avatar"]["error"] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["avatar"]["tmp_name"];
            $name = basename($_FILES["avatar"]["name"]);
            $type = $_FILES["avatar"]["type"];  
            move_uploaded_file( $tmp_name, $dir_file . "/" . $name);
            echo "<br> file uploaded";
            header('Location: Panels_HTML.php?' . '&fileuploaded');

            
        }else{
            echo "file not uploaded";
            exit;
        }
        
    } else if($_GET["form_type"] == "login"){
        var_dump($_GET);
        $email = $_GET["email"];
        $password = $_GET["password"];
        $query = "SELECT * FROM userdata WHERE email = '$email' AND PASSWORD = '$password'";
        $result = mysqli_query($conndb, $query);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['ID'] = $row["ID"];
            $_SESSION["name"] = $row["Name"];
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header('Location: Panels_HTML.php');
        }
        else{
            header('Location: Panels_HTML.php?error=invalidlogin');
            exit;
        }
    } else if($_GET["form_type"] == "logout"){
        header('Location: Panels_HTML.php');
        $_SESSION = array();
        session_destroy() ;
        
    }
}


//close the connection
mysqli_close($conndb);

?>
