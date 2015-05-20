<?php
    include 'system/Post.php';
    include 'system/Database.php';
    
    date_default_timezone_set ( 'Europe/London' );
    $db = new Database();
    $post = new Post();
    $posts = array();
    
    $query = $db->con->query($post->selectAll());
    while ($r = $query->fetch_assoc()){
        $post = new Post();
        $post->set($r['ID'],$r['Title'],$r['Text'],$r['Date'],$r['LastEdit'],$r['AdminID']);
        $posts[] = $post;
    }
?>
<HTML>
    <HEAD>
        <link rel="stylesheet" type="text/css" href="css/fonts.css"/>
        <link rel="stylesheet" type="text/css" href="css/header.css"/>
        <link rel="stylesheet" type="text/css" href="css/footer.css"/>
        <link rel="stylesheet" type="text/css" href="css/sidebar.css"/>
        <title>Blog</title>
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
            nav#page{
                position:relative;
                top:0;
                font-family:geosans;
                margin-top:-10px;
                height:30px;
                margin-left:auto;
                margin-right:auto;
                text-align:center;
                top:20px;
            }
            nav#page a{
                font-family:geosans;
                color:black;
                font-size:14pt;
                margin-left:10px;
            }
            nav#page a#current{
                text-decoration:underline;
            }
            nav#page a#unused{
                color:grey;
            }
            nav#page a#unused:hover{
                cursor:default;
            }
            nav#page a:hover{
                cursor:pointer;
                color:#26527C;
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
                        foreach($posts as $post){
                            $date = date('dS F',strtotime($post->date));
                            $time = date('g:i a',strtotime($post->date));
                            echo "<div class='post'>".
                                "<h1><a href='post?ID=".$post->ID."'>".$post->title."</a></h1>".
                                "<h2> on the".$date." at ".$time."</h2>".
                                "<p>".$post->text."</p>".
                                "</div>";
                        }
                    ?>
                    <nav id="page">
                        <?
                            //--[[PAGE NAVIGATION]]--\\
                            //--[[Calculate number of pages needed]]--\\
                            $noPages = ceil(count($posts)/5);
                            if ($lowerLimit != 0){
                                echo "<a href='?page=0'>First</a>";
                            }
                            else{
                                echo "<a id='unused'>First</a>";
                            }
                            //--[[Set 2 page deviation on nav]]--\\
                            $i = ($page-2);
                            if ($i < 0){
                                $i = 0;
                            }
                            $navLimit = ($page +2);
                            if ($navLimit > $noPages){
                                $navLimit = $noPages;
                            }
                            for ($i; $i < $navLimit;$i++){
                                if ($i == $page){
                                    echo "<a href='?page=".$i."' id='current'>".($i+1)."</a>";
                                }
                                else{
                                    echo "<a href='?page=".$i."'>".($i+1)."</a>";
                                }
                            }
                            if ($upperLimit != count($posts)){
                                echo "<a href='?page=".($noPages-1)."'>Last</a>";
                            }
                            else {
                                echo "<a id='unused'>Last</a>";
                            }
                            

                        ?>
                    </nav>
                </div>
            </div>
        </div>
        <?php
            include 'footer.php';
        ?>
    </BODY>
</HTML>