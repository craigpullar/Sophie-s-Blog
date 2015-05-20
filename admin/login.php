<?php
    require '../system/Session.php';
    
    $session = new Session();
    
    if ($session->checkLogin()){
        header("location:blog");
    }
    //--[[Check for errors]]--\\
    if (isset($_GET['error'])){
        $error = $_GET['error'];    
        switch ($error){
        
            //--[[Wrong username & password]]--\\
            case "wrong":
                $eMessage = "The username or password you entered was incorrect.";
            break;
            
            //--[[User not logged in]]--\\
            case "noLogin":
                $eMessage = "Please login.";
            break;
        }
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>
            Login
        </title>
        <link rel="stylesheet" type="text/css" href="../css/login.css"/>
    </head>
    <body>
        <?php
            //--[[Display Errors]]--\\
            if (isset($error)){
                echo "<p class='error'>".$eMessage."</p>";
            }
        ?>
        <div class="container">
            <form class="login" action="../controllers/Admin?request=login" method="POST">
                <input type="text" name="username" placeholder="Username"/>
                <input type="password" name="password" placeholder="Password"/>
                <input type="submit" value="Login" class="submit"/>
            </form>
            <p>
                Hey, this is the admin side of my blog. Unless I'm talking to myself you shouldn't be here. Go away and read my blog.
            </p>
        </div>
    </body>
</html>