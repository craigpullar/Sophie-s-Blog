<?php
    include 'system/Database.php';
    include 'system/Post.php';
    
    $post = new Post();
    $db = new Database();
    
    if (isset($_GET['ID'])){
        $ID = $_GET['ID'];
    }
    else {
        header('location:blog');
    }
    $query = $db->con->query($post->selectByID($ID));
    $r = $query->fetch_assoc();
    $post->set($r['ID'],$r['Title'],$r['Text'],$r['Date'],$r['LastEdit'],$r['AdminID']);
?>
<HTML>
    <HEAD>
        <link rel="stylesheet" type="text/css" href='css/fonts.css'/>
        <link rel="stylesheet" type="text/css" href='css/header.css'/>
        <link rel="stylesheet" type="text/css" href='css/footer.css'/>
        <link rel="stylesheet" type="text/css" href="css/sidebar.css"/>
        <title><?php echo $post->title; ?></title>
        <style>
            div#leftColumn{
                position:relative;
                width:70%;
                left:0px;
                top:0px;
                height:auto;
                padding-bottom:50px;
            }
            div.post{
                position:relative;
                top:50px;
                margin-bottom:50px;
                width:90%;
            }
            div.post p{
                font-family:geosans;
                font-size:14pt;
                position:relative;
                top:-10px;
                left:20px;
            }
            div.post h1{
                position:relative;
                font-family:geosans;
                font-weight:bold;
                color:white;
                background-color:#A63C00;
                padding-left:20px;
                text-align:left;
                left:-10px;
                height:40px;
                box-shadow: -5px 5px 5px rgba(0,0,0,0.5);
            }
            div.post h1 a{
                color:white;
                text-decoration:none;
            }
            div.post h1 a:hover{
                cursor:pointer;
            }
            div.post h1:before{
                content: "";
                position: absolute;
                display: block;
                bottom: -12px;
                border: 30px solid #A63C00;
                left: -70px;
                border-right-width: 50px;
                border-left-color: transparent;
                z-index:-1;
            }
            div.post h2{
                font-family:geosans;
                font-size:10pt;
                color:grey;
                position:relative;
                left:20px;
                top:-10px;
            }       
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="js/sidebar.js"></script>
    </HEAD>
    <BODY>
        <?php
            include 'header.php';
        ?>
        <div id="wrap">
            <div id="background">
                <?php
                    include 'sidebar.php';
                ?>
                <div id="leftColumn">
                    <?php 
                        $date = date('dS F',strtotime($post->date));
                        $time = date('g:i a',strtotime($post->date));
                        echo "<div class='post'>".
                            "<h1><a href='post?ID=".$post->ID."'>".$post->title."</a></h1>".
                            "<h2> on the".$date." at ".$time."</h2>".
                            "<p>".$post->text."</p>".
                            "</div>";
                    ?>
                </div>
            </div>
        </div>
    </BODY>
    <?php
        include 'footer.php';
    ?>
</HTML>