<?php
    require '../system/Session.php';
    require '../system/Database.php';
    require '../system/Admin.php';
    require'../system/Post.php';
    
    $session = new Session();
    $db = new Database();
    $admin = $_SESSION['admin'];
    $post = new Post();
    
    if (!$session->checkLogin()){
        header("location:login?error=noLogin");
    }
    
?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <title>Blog Control</title>
        <link rel="stylesheet" type="text/css" href="../css/fonts.css"/>
        <style>
            html{
                background-color:#C8C8C8;
            }
            header.account{
                box-shadow: 1px 1px 5px 1px #888888;
                background-color:white;
                position:fixed;
                width:96%;
                left:2%;
                right:2%;
                margin:0;
                height:40px;
                border-left:5px solid #BF8530;
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
            header.account img{
                width:30px;
                height:30px;
                border-radius:15px;
                position:absolute;
                margin:0px;
                left:10px;
                top:5px;
            }
            header.account h1 {
                font-family:harabara;
                position:absolute;
                left:5px;
                margin:0px;
                font-size:26px;
                left:50px;
                top:5px;
            }
            header.account a#optionsButton{
                user-select: none;
                position:absolute;
                width:30px;
                height:30px;
                background-color:#BF8530;
                color:white;
                right:5px;
                text-align:center;
                top:5px;
                font-family:harabara;
                font-size:20pt;
                font-weight:bold;
            }
            header.account a#optionsButton:hover{
                cursor:pointer;
                box-shadow: 1px 1px 5px 1px #888888;
            }
            header.account ul.options{
                box-shadow: 1px 1px 5px 1px #888888;
                display:none;
                position:absolute;
                background-color:white;
                right:4px;
                top:25px;
                width:100px;
                list-style:none;
                height:auto;
                text-align:center;
                padding:0;
            }
            header.account ul.options li{
                display:block;
                margin:0;
                position:relative;
                width:100%;
                padding:2px;
                height:20px;
            }
            header.account ul.options li:hover{
                border-left:5px solid #BF8530;
                cursor:pointer;
                left:-5px;
            }
            header.account ul.options li a{
                font-size:12pt;
                text-decoration:none;
                position:absolute;
                width:100%;
                height:100%;
                left:0px;
                top:0px;
                background-color:white;
                color:black;
                font-family:harabara;
                color:gray;
                font-weight:100;
            }
            header.account ul.options li a:hover{
                color:black;
            }
            header.account ul.options li span{
                padding-top:5px;
                display:inline-block;
                vertical-align:middle;
            }
            header.account div.optionsTriangle{
                z-index: 1;
            	width: 0; 
	            height: 0; 
	            border-left: 10px solid transparent;
	            border-right: 10px solid transparent;
	            border-bottom: 15px solid white;
                position:absolute;
                display:none;
                right:15px;
                top:30px;
            }
            header.page{
                background-color:white;
                position:relative;
                width:90%;
                margin-left:auto;
                margin-right:auto;
                height:40px;
                top:100px;
                border-left:5px solid #26527C;
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
            header.page h1{
                font-family:harabara;
                position:absolute;
                left:5px;
                margin:0px;
                font-size:26px;
                left:5px;
                top:5px;
            }
            header.page a#addPostButton{
                font-family:harabara;
                background-color:#26527C;
                position:absolute;
                right:5px;
                top:5px;
                color:white;
                padding:5px;
            }
            header.page a#addPostButton:hover{
                cursor:pointer;
                box-shadow: 1px 1px 5px 1px #888888;
            }
            div#curtain{
                display:none;
                position:fixed;
                top:0px;
                left:0px;
                height:100%;
                width:100%;
                z-index:3;
                background-color:rgba(0,0,0,0.75);
            }
            form#addPost{
                display:none;
                position:fixed;
                background-color:white;
                width:500px;
                height:400px;
                margin-top:-200px;
                margin-left:-250px;
                left:50%;
                top:50%;
                z-index:4;
            }
            form#addPost h1{
                font-family:harabara;
                position:relative;
                text-align:center;
                border-bottom:5px solid #26527C;
            }
            form#addPost input#title{
                width:80%;
                display:block;
                position:relative;
                margin-left:auto;
                margin-right:auto;
                font-family:geosans;
                height:25px;
                font-size:16pt;
                outline-color:#BF8530;
                text-align:center;
            }
            form#addPost textarea{
                width:80%;
                position:relative;
                display:block;
                height:200px;
                margin-top:20px;
                margin-left:auto;
                margin-right:auto;
                resize:none;
                outline-color:#BF8530;
                font-family:geosans;
                font-size:12pt;
                overflow:auto;
            }
            form#addPost input#submit{
                display:block;
                width:100px;
                position:realtive;
                margin-left:auto;
                margin-right:auto;
                font-family:geosans;
                height:25px;
                margin-top:30px;
                font-size:12pt;
                color:gray;
                outline-color:#BF8530;
            }
            form#addPost input#submit:hover{
                border:1px solid #BF8530;
                color:#BF8530;
                background-color:white;
            }
            div.post{
                position:relative;
                background-color:white;
                width:90%;
                margin-left:auto;
                margin-right:auto;
                height:40px;
                top:110px;
                border-left:5px solid #BF8530;
                border-top:1px dashed #BF8530;
            }
            div.post h1{
                font-family:geosans;
                position:absolute;
                top:10px;
                left:10px;
                margin:0;
                font-size:14pt;
            }
            div.post a.deletePostButton, div.post a.editPostButton{
                font-family:geosans;
                background-color:#BF4030;
                position:absolute;
                right:5px;
                top:5px;
                color:white;
                padding:5px;
                text-decoration:none;
            }
            div.post a.deletePostButton:hover, div.post a.editPostButton:hover{
                cursor:pointer;
                box-shadow: 1px 1px 5px 1px #888888;
            }
            div.post a.editPostButton{
                right:70px;
            }
            form#deletePost{
                display:none;
                position:fixed;
                background-color:white;
                z-index:4;
                width:300px;
                height:130px;
                margin-left:-150px;
                left:50%;
                margin-top:-75px;
                top:50%;
            }
            form#deletePost p{
                font-family:geosans;
                font-size:14pt;
                padding-bottom:10px;
                text-align:center;
                border-bottom:5px solid #BF4030;
            }
            form#deletePost input{
                display:block;
                width:100px;
                position:realtive;
                margin-left:auto;
                margin-right:auto;
                font-family:geosans;
                height:25px;
                font-size:12pt;
                color:gray;
                outline-color:#BF8530;
            }
            form#deletePost input:hover{
                border:1px solid #BF8530;
                color:#BF8530;
                background-color:white;
            }
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#optionsButton").click(function(){
                    $("#optionsList").toggle();
                    $("#optionsTriangle").toggle();
                });
                $("a#addPostButton").click(function(){
                    $("form#addPost h1").text("Add Post");
                    $("form#addPost input#submit").attr("value","Post");
                    $("form#addPost h1").css("border-bottom","5px solid #26527C");
                    $("form#addPost").attr("action","../controllers/Post?request=add");
                    $("form#addPost textarea").text("");
                    $("form#addPost input#title").attr("value","");
                    $("form#addPost").toggle();
                    $("div#curtain").toggle();
                });
                $("div#curtain").click(function(){
                    $("form#addPost").hide();
                    $("div#curtain").hide();
                    $("form#deletePost").hide();
                });
                $("a.editPostButton").click(function(){
                    $("form#addPost h1").text("Edit Post");
                    $("form#addPost input#submit").attr("value","Edit");
                    $("form#addPost h1").css("border-bottom","5px solid #BF4030");
                    var ID = this.id;
                    $("form#addPost").attr("action","../controllers/Post?request=edit&ID="+ID);
                    $.ajax({url:"../controllers/Post?request=getTitle&ID="+ID,success:function(result){
                        $("form#addPost input#title").attr("value",result);
                    }});
                    $.ajax({url:"../controllers/Post?request=getText&ID="+ID,success:function(result){
                        $("form#addPost textarea").text(result);
                    }});
                    $("form#addPost").toggle();
                    $("div#curtain").toggle();
                });
                $("a.deletePostButton").click(function(){
                    var ID = this.id;
                    $("form#deletePost").attr("action","../controllers/Post?request=delete&ID="+ID);
                    $("form#deletePost").toggle();
                    $("div#curtain").toggle();
                });
            });
        </script>
    </HEAD>
    <BODY>
        <header class="account">
            <img src="images/<?php echo $admin->image;?>" alt="Error"/>
            <h1><?php echo $admin->name;?></h1>
            <a id="optionsButton" class="optionsButton">...</a>
            <div id="optionsTriangle" class="optionsTriangle"></div>
            <ul class="options" id="optionsList">
                <li><a href="logout"><span>Logout</span></a></li>
            </ul>
        </header>
        <header class="page">
            <h1>Blog</h1>
            <a id="addPostButton">Add Post</a>
        </header>
        <div id="curtain"></div>
        <form id="addPost" action="" method="POST">
            <h1>Add Post</h1>
            <input id="title" value="" name="title" placeholder="Title" type="text"/>
            <textarea name="content" placeholder="What's on your mind?"></textarea>
            <input type="submit" value="Post" id="submit"/>
        </form>
        <form id="deletePost" action="" method="POST">
            <p>Are you sure you want to delete this post?</p>
            <input type="submit" value="Confirm"/>
        </form>
        <?php
            $query = $db->con->query($post->selectAll());
            while ($r = $query->fetch_assoc()){
                $post->set($r['ID'],$r['Title'],$r['Text'],$r['Date'],$r['LastEdit'],$r['AdminID']);
                echo"<div class='post'>"
                        ."<h1>".$post->title."</h1>"
                        ."<a class='deletePostButton' id='".$post->ID."'>Delete</a>"
                        ."<a id='".$post->ID."' class='editPostButton'>Edit</a>"
                    ."</div>";
            }
            
        ?>
        
    </BODY>
</HTML>