<div id ="rightColumn">
    <input type="text" placeholder="Search" id="searchBar"/>
    <ul id="searchResults">
    </ul>
    <ul id="months">
        <?php
            $sPost = new Post(); //Sidebar posts
            $query = $db->con->query($sPost->selectAll());
            while ($r = $query->fetch_assoc()){
                $sPost = new Post();
                $sPost->set($r['ID'],$r['Title'],$r['Text'],$r['Date'],$r['LastEdit'],$r['AdminID']);
                $sPosts[] = $sPost;
            }
            //--[[CREATE CALENDER]]--\\
            foreach($sPosts as $sPost){
                $dateTime = new DateTime($sPost->date); 
                $years[] = $dateTime->format('Y');
                $months[] = $dateTime->format('F-Y');
            }
            $months = array_unique($months);
            $years = array_unique($years);
            foreach($years as $year){
                echo "<h1>".$year."</h1>";
                foreach ($months as $date){
                    $dateTime = new DateTime($date); 
                    if($dateTime->format('Y') == $year){
                        $month = $dateTime->format('F');
                        echo "<li class='month'>".$month."</li>";
                        echo "<ul class='posts'>";
                        foreach($sPosts as $sPost){
                            $dateTime = new DateTime($sPost->date);
                            if ($dateTime->format('F') == $month && $dateTime->format('Y') == $year){
                                echo"<li><a href='post?ID=".$sPost->ID."'>".$sPost->title."</a></li>";
                            }
                        }
                        echo "</ul>";
                    }
                }
            }
        ?>
    </ul>
</div>