<?php
    require '../system/Database.php';
    require '../system/Post.php';
    require '../system/Session.php';
    require '../system/Admin.php';

    //--[[Pre-Script Checks]]--\\
    if (isset($_GET['request'])){
        $request = $_GET['request'];
    }
    else {
        header("location:../Admin");
    }
    if (isset($_GET['ID'])){
        $ID = $_GET['ID'];
    }
    
    $db = new Database();
    $session = new Session();
    $post = new Post();
    $admin = $_SESSION['admin'];
    date_default_timezone_set ( 'Europe/London' );
    
    switch($request){
        case "add":
            $title = mysqli_real_escape_string($db->con,$_POST['title']);
            $text = mysqli_real_escape_string($db->con,$_POST['content']);
            $date = date('Y/m/d h:i:s',time());
            $post->create($title,$text,$date,null,$admin->ID);
            $db->con->query($post->add());
            header("location:../admin/blog");
        break;
        
        case "edit":
            $title = mysqli_real_escape_string($db->con,$_POST['title']);
            $text = mysqli_real_escape_string($db->con,$_POST['content']);
            $date = date('Y/m/d h:i:s',time());
            $post->set($ID,$title,$text,null,$date,$admin->ID);
            $db->con->query($post->update());
            header("location:../admin/blog");
        break;
        
        case "delete":
            $db->con->query($post->delete($ID));
            header("location:../admin/blog");
        break;
        
        case "getTitle":
            $query = $db->con->query($post->selectByID($ID));
            $r = $query->fetch_assoc();
            echo $r['Title'];
        break;
        
        case "getText":
            $query = $db->con->query($post->selectByID($ID));
            $r = $query->fetch_assoc();
            echo $r['Text'];
        break;
        
        case "search":
            $query = $_GET['query'];
            $searchTerms = explode(" ",$query);
            $query = $db->con->query($post->selectAll());
            while ($r = $query->fetch_assoc()){
                $post = new Post();
                $post->set($r['ID'],$r['Title'],$r['Text'],$r['Date'],$r['LastEdit'],$r['AdminID']);
                $posts[] = $post;
            }
            foreach ($posts as $post){
                foreach($searchTerms as $searchTerm){
                    if (strpos(strtolower($post->title),strtolower($searchTerm)) !== FALSE){
                        $results[] = $post;
                        break;
                    }
                }
            }
            foreach($results as $post){
                echo "<li><a href='post?ID=".$post->ID."'>".$post->title."</a></li>";
            }
            if (count($results) == 0){
                echo "<li>No results</li>";
            }
        break;
    }
?>