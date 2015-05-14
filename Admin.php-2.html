<?php
    require '../system/Database.php';
    require '../system/Admin.php';
    require '../system/Session.php';
    
    //--[[Pre-Script Checks]]--\\
    if (isset($_GET['request'])){
        $request = $_GET['request'];
    }
    else {
        header("location:../Admin");
    }
    
    //--[[Init Objects]]--\\
    $db = new Database();
    $admin = new Admin();
    $session = new Session();
    
    //--[[Handle Requests]]--\\
    switch ($request){
    
        //--[[Login]]--\\
        case "login":
        
            //--[[Set Timezone]]--\\
            date_default_timezone_set ( "Europe/London" );
            
            //--[[Get Form Data]]--\\
            $username = mysqli_real_escape_string($db->con,$_POST['username']);
            $password = mysqli_real_escape_string($db->con,$_POST['password']);
            
            //--[[Query DB]]--\\
            $result = $db->con->query($admin->login($username,$password));
            
            //--[[Check Login]]--\\
            if($result->num_rows == 1){
                //--[[True]]--\\
                $session->login();
                $row = $result->fetch_assoc();   
                $_SESSION['admin'] = new Admin();
                $_SESSION['admin']->set($row['ID'],$row['Username'],$row['Password'],$row['Name'],$row['DOB'],$row['Image']);
                header("location:../admin/blog");
            }
            else{
                //--[[False]]--\\
                header("location:../admin/Login?error=wrong");
            }
            
        break;
    }
?>