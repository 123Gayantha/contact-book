<?php 
$page_id = 5;
include "inc_header.php";

// delete contact
if(isset($_GET['delete']) && isset($_GET['id']) && !empty($_GET['id'])){
    try{
        include "db_connection.php";
        $db->prepare("DELETE FROM `contacts` WHERE `id`=?")->execute(array($_GET['id']));
    }catch(PDOException $error){
        echo $error->getMessage();
    }
}


?>
        <title>Show All Contacts</title>
        <style> 
            ul{
                list-style: none;
                display: table;
                width: 100%;
                margin: 0;
                padding: 0;
            }
            li{
                display: table-cell;
                padding: 5px .5%;
                width: 11%;
                border-right: 1px solid #ccc;
                overflow: hidden;
            }
            #row{
                background: #444;
                color: #fff;
            }
            .male, .view, .edit, .delete, .female{ 
                width: 20px;
                height: 20px;
                background-size: cover;
                display: inline-block;
                margin:0 2px ;
            }
            .male{
                background-image: url(icons/male.svg);
            }
            .female{
                background-image: url(icons/female.svg);
            }
            .view{
                background-image: url(icons/view.svg);
            }
            .edit{
                background-image: url(icons/edit.svg);
            }
            .delete{
                background-image: url(icons/delete.svg);
            }
            .col1{
                width: 3%;
            }
            .col2{
                width: 23%;
            }
            .col3{
                border-right: 0;
                text-align: center;
            }
            .row2{
                background: #eee;
            }

            /* style of pagination */

            .pg{
                background: #f3b918;
                color: #000;
                box-shadow: 0 0 3px #000;
            }
            .pg:hover{
                background: #f27609;
            }
            .dots, .pg, .current{
                padding: 5px;
                text-decoration: none;
                margin: 5px;
                float: left;
                font-size: 1em;
            }
            .current{
                background: #333;
                color: #fff;
                box-shadow: 0 0 3px #000;
            }
            #pagination{
                margin-top: 20px;
            }

            /*  style of search bar */
            form{
                margin-bottom: 20px;
                width: 100%;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                border-bottom: 3px solid #444;
                padding-bottom: 10px;
            }
            .in1{
                width: 300px;
                background: #ebe5e5;
                padding: 8px;
                border: 1px solid #ccc;
            }
            .in2{
                background: #f3b918;
                color: #000;
                width: 120px;
                margin: 0 5px;
                padding: 5px 0;
                border: 0;
                box-shadow: 0 0 3px #000;
                font-size: 1.1em;
            }
            .gender{
                background:#ebe5e5;
                padding: 8px;
                float:left;
                margin:0 2px;
            }
            .in2:hover{
                background: #f27609;
            }
            select{
                font-size: 1.1em;
                padding: 2px 0;
            }

            @media screen and (max-width:1220px) {
                /* for menus */
            #menu{width:100%; }
            .menu{
                float:left;
                border-right: 1px dashed #f3b918;
                border-bottom: 0;
                margin: 10px 0;
                padding: 0;
                width: 19%;
                text-align: center;
            }
            .menu:last-child{border-right: 0;}
                
                /* search form */
            .item{width:30%; margin-bottom: 15px;}
            select{width:100%;}
            .in1{width:95%; padding:8px 2%;}
            .in2{width: 100%; margin:0;} 
            .gender{width: 41%; padding:8px 2%; margin:0 .5%}
            }

            /* contact table */
            @media screen and (max-width:800px) {
                #row{display: none;}
                ul{display: flex; flex-wrap: wrap;}
                li{
                    display: block;
                    padding:5px 0;
                    width:24%;
                    text-indent: 5px;
                    border-bottom: 1px solid #ccc; 
                }
                .col1, .col2{
                    width:24%;
                } 
                .col3{text-align: left;}
                li:nth-child(4){border-right: 0;}
            }
            @media screen and (max-width:745px) {
                .item{width:48%;}
            }
            @media screen and (max-width:600px) {
                li, .col1, .col2{width:48%}
                li:nth-of-type(2n){border-right: 0;}
            }
            @media screen and (max-width:485px) {
                .item{width:95%}
            }
            @media screen and (max-width:400px) {
                li, .col1, .col2{width:99%; border-right: 0;}
            }
            @media screen and (max-width:320px){
                #menu{width:320px}
            }
        </style>
        <?php include "inc_menus.php";?>
            <form method="get">
                <div class="item">
                    <select name="limit">
                        <option value="2" <?php if(isset($_GET['limit']) && $_GET['limit']==2) echo ' selected '; ?>>Show 2 rows</option>
                        <option value="5" <?php if(isset($_GET['limit']) && $_GET['limit']==5) echo ' selected '; ?>>Show 5 rows</option>
                        <option value="10" <?php if(isset($_GET['limit']) && $_GET['limit']==10) echo ' selected '; ?>>Show 10 rows</option>
                        <option value="15" <?php if(isset($_GET['limit']) && $_GET['limit']==15) echo ' selected '; ?>>Show 15 rows</option>
                        <option value="20" <?php if(isset($_GET['limit']) && $_GET['limit']==20) echo ' selected '; ?>>Show 20 rows</option>
                        <option value="25" <?php if(isset($_GET['limit']) && $_GET['limit']==25) echo ' selected '; ?>>Show 25 rows</option>
                        <option value="50" <?php if(isset($_GET['limit']) && $_GET['limit']==50) echo ' selected '; ?>>Show 50 rows</option>
                        <option value="100" <?php if(isset($_GET['limit']) && $_GET['limit']==100) echo ' selected '; ?>>Show 100 rows</option>
                    </select>
                </div>
                <div class="item">
                    <select name="letter">
                        <option value=""></option>
                        <?php
                            $letters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
                            foreach($letters as $l){
                                echo '<option value="',$l,'"';
                                if(isset($_GET['letter']) && $_GET['letter']==$l) echo ' selected ';
                                echo '>',strtoupper($l),'</option>';
                            }

                        ?>
                    </select>
                </div>
                <div class="item">
                    <input type="text" placeholder="Keywords" class="in1" name="keywords" value="<?php echo $_GET['keywords'] ?? ''; ?>">
                </div>
                <div class="item">
                    <select name="type">
                        <option value="-1"></option>
                        <option value="1" <?php if(isset($_GET['type']) && $_GET['type']==1) echo ' selected '; ?>>Friend</option>
                        <option value="2" <?php if(isset($_GET['type']) && $_GET['type']==2) echo ' selected '; ?>>Relation</option>
                        <option value="3" <?php if(isset($_GET['type']) && $_GET['type']==3) echo ' selected '; ?>>Co-Worker</option>
                        <option value="0" <?php if(isset($_GET['type']) && $_GET['type']==0) echo ' selected '; ?>>Other</option>
                    </select>
                </div>
                <div class="item">
                    <label>Male <input type="radio" name="gender" value="1" <?php if(isset($_GET['gender']) && $_GET['gender']==1) echo ' checked ';?>></label>
                    <label>Female <input type="radio" name="gender" value="2" <?php if(isset($_GET['gender']) && $_GET['gender']==2) echo ' checked ';?>></label>
                </div>
                <div class="item">
                    <input type="submit" name="search" value="SEARCH" class="in2">
                </div>
            </form>
            <ul id="row">
                <li class="col1"></li>
                <li class="col2">Name</li>
                <li>Nick</li>
                <li>Mobile No 1</li>
                <li>Mobile No 2</li>
                <li>Land No</li>
                <li>Type</li>
                <li class="col3">Action</li>
            </ul>
            
            <?php
            try{
                // to connect database
                include "db_connection.php";

                $query = "SELECT
                            `id`,
                            `name`,
                            `nick`,
                            `email`,
                            `mobile1`,
                            `mobile2`,
                            `land`,
                            `gender`,
                            `type`
                        FROM
                            `contacts`
                        WHERE 1    
                            
                            ";
                
                $query_array = array();            
                
                $statement = $db->prepare($query);
                $statement->execute($query_array);

                $count = $statement->rowCount();
                // search contacts
                if(isset($_GET['search'])){

                    if(isset($_GET['type']) && ($_GET['type']!="-1")){
                        $query .= " AND `type`=?";
                        array_push($query_array,$_GET['type']);
                    }
                    if(isset($_GET['gender']) && !empty($_GET['gender'])){
                        $query .= " AND `gender`=?";
                        array_push($query_array,$_GET['gender']);
                    }
                    if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
                        $query .= " AND `name` LIKE ?";
                        array_push($query_array, '%'.$_GET['keywords'].'%');
                    }
                    if(isset($_GET['letter']) && !empty($_GET['letter'])){
                        $query .= " AND `name` LIKE ?";
                        array_push($query_array,$_GET['letter'].'%');
                    }
                }
                
                // echo $query;
                // print_r($query_array);

                $pageno = $_GET['page'] ?? 0;
                $results_per_page = $_GET['limit'] ?? 2;
                
                $query .= " LIMIT ?, ? ";
                array_push($query_array, $pageno*$results_per_page, $results_per_page);

                $statement = $db->prepare($query);
                $statement->execute($query_array);

                $result = $statement->fetchAll();

                $typeArr = array('Other','Friend','Relation','Co-Worker');
                $genderArr = array(1 => 'male', 2 => 'female');
                // $genderArr = array('', 'male', 'female');

                foreach($result as $r){
                    echo '<ul>
                    <li class="col1"><div class="male"></div></li>
                    <li class="col2">',$r['name'],'</li>
                    <li>',$r['nick'],'</li>
                    <li>',$r['mobile1'],'</li>
                    <li>',$r['mobile2'],'</li>
                    <li>',$r['land'],'</li>
                    <li>',$typeArr[$r['type']],'</li>
                    <li class="col3">
                        <a href="view.php?id=',$r['id'],'" class="view"></a>
                        <a href="edit.php?id=',$r['id'],'" class="edit"></a>
                        <a href="all.php?id=',$r['id'],'&delete=yes" class="delete"></a>
                    </li>
                </ul>';

                }
                // print_r($result);
            
            }catch(PDOException $error){
                echo $error->getMessage();
            }

            ?>
            
            <!-- <div id="pagination">
                <a href="#" class="pg">1</a>
                <a href="#" class="pg">2</a>
                <a href="#" class="pg">3</a>
                <a class="dots">...</a>
                <a href="#" class="pg">6</a>
                <a href="#" class="pg">7</a>
                <a href="#" class="pg">8</a>
                <a href="#" class="current">9</a>
                <a href="#" class="pg">10</a>
                <a href="#" class="pg">11</a>
                <a href="#" class="pg">12</a>
                <a class="dots">...</a>
                <a href="#" class="pg">18</a>
                <a href="#" class="pg">19</a>
                <a href="#" class="pg">20</a>
            </div> -->
            
            <?php
                if($count > $results_per_page){
                    echo '<div id="pagination">';
                        $pagination_count = $count/$results_per_page;

                        $has_pageno = strpos($_SERVER['REQUEST_URI'],'page=');
                        if($has_pageno) $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'],0,$has_pageno-1);
                        for($i=0; $i<$pagination_count; $i++){
                            echo '<a href="',$_SERVER['REQUEST_URI'];
                            // if(strpos($_SERVER['REQUEST_URI'],'?')) echo '&';
                            // else echo '?';
                            // ternary operator ?:
                            echo strpos($_SERVER['REQUEST_URI'],'?') ? '&': '?';
                            $class = isset($_GET['page']) && $i==$_GET['page'] ? 'current' : 'pg';
                            echo 'page=',$i,'" class="',$class,'">',($i+1),'</a>';
                        }
                    echo '</div>';
                }
            ?>
            <?php include "inc_footer.php"; ?> 