<?php

    session_start();
    include 'db.php';
    
?>

<?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['single_book_id'] = $_POST['id'] ; ;
        $yourURL="single_book.php";
        echo ("<script>location.href='$yourURL'</script>");
    }
?>

<html>

    <head>
        <title>Book Shopping</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
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
                            echo "<li><a href=\"admin/admin_page.php\">Account</a></li>";
                            echo "<li><a href=\"logout.php\">Logout</a></li>";
                           
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

                </ul>
        </section>

        <section class="content">

            <section class="maincontent">

                         <div class="newboxes" >
                             
<?php
                             
  $category  = $_SESSION['category'] ;
                             
$results = $mysqli->query("SELECT * FROM books natural join product_images where book_category = '$category' ORDER BY book_name ASC ");
if($results){ 
$products_item = '<div class="categories_book">';
echo "<h2>$category Books</h2>" ;    
//fetch results set as object and output HTML
while($obj = $results->fetch_object())
{
$products_item .= <<<EOT
	<div class="part">
	<form method="post" >
        
       <input type="image" src="images/books/{$obj->image}" >
       <b>Product Name :</b> {$obj->book_name}<br>
	   <b>Price :</b>{$currency}{$obj->book_price}<br>
       <input type="hidden" value="{$obj->book_id}" name="id">
       
	</form>
	</div>
EOT;
}
$products_item .= '</div>';
echo $products_item;
}
?>

                          
                        </div>

            </section>

        </section>

    </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    </body>

</html>