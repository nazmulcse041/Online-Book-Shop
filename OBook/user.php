<?php

    session_start();
    include 'db.php';
   
?>

<html>

    <head>
        <title>Book Shopping : User Notifications</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        
        <style>
            table,tr,th,td{border: 1px solid #000 ;border-collapse: collapse}
            th{background: #ddd;color: black}
            th,td,input{width: 130px;text-align: center}
            input{border-style: none}
            .Message tr td:last-child{
                width: 250px
            }
            .Message tr td:nth-child(2){
                width: 250px
            }
            .Message tr td:nth-child(3){
                width: 230px
            }
        </style>
    </head>
    <body>
    <div class="main">

        <header>
            
            <div class="time_header">
                <div class="logo">
                    <img src="images/LOGO.png">       
                </div><ul class="head_menu">
                   <?php 
                        if($_SESSION["user_type"]=="admin")
                         {
                            echo "<li><a href=\"admin_page.php\">Account</a></li>";
                            echo "<li><a href=\"../logout.php\">Logout</a></li>";
                           
                         }
                        else if($_SESSION["user_type"]=="buyer")
                         {
                            echo "<li><a href=\"account.php\">Account</a></li>";
                            echo "<li><a href=\"logout.php\">Logout</a></li>";
                           
                         }
                         else
                         {
                              // session has NOT been started
                              echo "<li><a href=\"registration_login.php\">Account</a></li>";
                         }
                         
                        if(isset($_SESSION["cart_products"])){
                            $total_items = 0 ;
                            foreach ($_SESSION["cart_products"] as $cart_itm)
                            {
                                $total_items += $cart_itm["product_qty"];  
                            }
                            echo "<li><a href=\"view_cart.php\">Cart(".$total_items.")</a></li>";
                        }
                    ?>

                </ul>
            </div>

        </header>
        
        
        <section class="menu">
                 <ul>
                    <li><a href="index.php" title="home" class="current"><span>HOME</span></a></li>
                     <li><a href="categories.php" title="products"><span>CATEGORIES</span></a></li>
                     <li><a href="publishers.php" title="products"><span>PUBLISHERS</span></a></li>
                     <li><a href="user.php" title="products"><span>Notification</span></a></li>
                     
                </ul>
        </section>
        
        <section class="content">

            <section class="maincontent notifications">
                
                
                
                <?php
                     $id = $_SESSION["user_id"];
                    $results = $mysqli->query("SELECT * FROM msg where user_id = '$id' ; ");
                    
                echo "<h2>My Message </h2>";
                    
                if(mysqli_num_rows($results)>0){
                    echo "<div class=\"Reply\">";
                    echo "<table>";
                    echo "<tr><th>My Message</th><th>Reply</th></tr>";
                    while($obj = mysqli_fetch_assoc($results))
                    {   
                    
                ?>  
                    <form method="post">
                        <tr>
                            <td><?php echo $obj['msg']; ?></td>
                            <td><?php echo $obj['reply']; ?></td>
                        </tr>
                    </form>
                <?php
                   
                    }
                    echo "</table></div>";
                }
                else{
                    echo "<center>No Notifications</center>";
                }
                    
                ?>
                
            </section>
            
        </section>    
        
        </div>
        
    </body>
    
</html>    