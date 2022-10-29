<?php
$page_id = 1;
include "inc_header.php";
?>
    <title>Contact Book</title>
    <style>
        /* Home page design */
        .box{
            width: 100px;
            height: 100px;
            border: 5px solid #f3b918;
            border-radius: 100%;
            background: #fff;
            padding: 20px;
            text-decoration: none;
            text-align: center;
            color: #000;
            margin: 50px 20px 0;
            display: block;
        }
        .item{
            text-transform: uppercase;
            font-weight: bold;
            display: block;
            padding-top: 10px;
        }
        .imgs{
            width: 50px;
        }
        .box:hover{
            background: #f27609 ;
        }
        main{
            display: flex;
            justify-content: center;  
            flex-wrap: wrap;
        }
        
        </style>
        </head>
    <body>
        <header>
            <div id="welcome">
                <span id="uname">Hi, <?php echo $_SESSION['name'];?></span>
                <a href="login.php"><img src="icons/logout.svg" alt="LOGOUT" id="logout"></a>
            </div>
            <h1>Contact Book <span id="pgname">- Home</span></h1>
        </header>
        <main>
            <a href="all.php" class="box">
                <img src="icons/search.svg" alt="search" class="imgs">
                <span class="item">Show All</span>
            </a>
            <a href="add.php" class="box">
                <img src="icons/add.svg" alt="Add Contact" class="imgs">
                <span class="item">Add New</span>
            </a>
            <a href="settings.php" class="box">
                <img src="icons/settings.svg" alt="Settings" class="imgs">
                <span class="item">Settings</span>
            </a>
            <a href="logout.php" class="box">
                <img src="icons/logout.svg" alt="Logout" class="imgs">
                <span class="item">Logout</span>
            </a>
            <?php include "inc_footer.php"; ?> 