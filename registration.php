<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title> Registration </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/registration.css">
<script src="https://kit.fontawesome.com/332a215f17.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/7bc299d6e3.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>

  <body>
    <section>
        <!--Nav-->
        <header>
        <nav class="navbar navbar-expand-lg main-navbar bg-color main-navbar-color"
        id="main-navbar">

        <div class="container">
            <br><a href="homepage.php"><img class="navbar-brand" width="240" src="BuiltImages/dmaclothinglogo.png"></img></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#myNav" aria-controls="nav" aria-expanded="false"
        aria-label="Toggle navigation">

        <i class="fas fa-bars"> </i> </button>        
        <div class="collapse navbar-collapse"id="myNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="registration.php" target="_self" class="nav-link"> Register |</a>
                </li>
                <?php
                    session_start();
                    if(isset($_SESSION['user'])) { // Check if the user is logged in
                        echo '
                            <li class="nav-item">
                                <a href="include/logout.inc.php" target="_self" class="nav-link"> Log-Out | </a>
                            </li>';
                    } else {
                        echo '
                            <li class="nav-item">
                                <a href="login.php" class="nav-link"> Log-in | </a>
                            </li>';
                    }
                ?>
            </ul>
        </div>
        <form class="form-inline my-2 my-lg-0" action="productspage.php" method="GET">
              <input id="searchByKeyword" class="form-control mr-sm-2" placeholder="Search by Keyword" aria-label="Search" name="search">
              <button class="btn btn-outline-warning my-2 my-sm-0" name="searchbutton" type="submit"> Search </button>
        </form>                          
        </div>
        </nav>
    </header>

        <nav class="navbar navbar-expand-lg main-navbar bg-color main-navbar-color"
        id="main-navbar">

        <div class="container">
            <?php
                if(isset($_SESSION['user'])) { // Check if the user is logged in
                    echo '
                    <br><a class="navbar-brand" href="userspage.php" style="display:flex;"> HOME </a>
                    <a class="navbar-brand" href="productspage.php" style="display:flex;"> PRODUCTS </a>
                    <a class="navbar-brand" href="inquiry.php" style="display:flex;"> INQUIRY  </a>
                    <a class="navbar-brand" href="faqs.php" style="display:flex;"> FAQs  </a>
                    <a class="navbar-brand" href="purchasehistory.php" style="display:flex;"> ORDER HISTORY </a>            
                    <a class="navbar-brand" href="cart.php" style="display:flex;"> <i class="fa-solid fa-cart-plus fa-lg"></i> </a>
                    ';
                } else {
                    echo '
                    <br><a class="navbar-brand" href="homepage.php" style="display:flex;"> HOME </a>
                    <a class="navbar-brand" href="productspage.php" style="display:flex;"> SEE PRODUCTS </a>
                    <a class="navbar-brand" href="faqs.php" style="display:flex;"> FAQs  </a>
                    ';
                }
                ?>

            <div class="order-lg-last btn-group">
            </div>
        </div>
        </nav>
        <!--End of Nav-->

  <section id="header">
    <div id="login-box">
      <div class="left">
        <form method="post" action="./include/register.inc.php">

        <h1> Sign up </h1><br>

            <?php 
                if(isset($_GET['registration']))
                {
                    echo "
                    <h3 style='color:green;'> Registration Success! </h3>
                    <br>";
                }
            ?>
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pword" placeholder="Password">
            <input type="text" name="firstname" placeholder="First name">
            <input type="text" name="lastname" placeholder="Last name">     
            <input type="text" name="email" placeholder="E-mail">
            <input type="text" name="address" placeholder="Address">
            <input type="text" name="contactnumber" placeholder="Contact Number">            
            <button type="submit" name="btnreg"> Sign Up </button>
            <br><br> Got an Account Already? <a href="login.php" target="_self" class="nav-link"> Login here </a>
        </form>        
          </div>
        </div>
     </section>

<footer class="footer-section">
        <div class="container">
            <div class="footer-cta pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="cta-text">
                                <h4> Find us </h4>
                                <span> 151 Muralla St, Intramuros, Manila </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-phone"></i>
                            <div class="cta-text">
                                <h4> Call us! </h4>
                                <span> 98765432100 </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="far fa-envelope-open"></i>
                            <div class="cta-text">
                                <h4> Mail us! </h4>
                                <span> dmaclothing@info.com </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-content pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 mb-50">
                        <div class="footer-widget">
                            <div class="footer-logo">
                            </div>

                            <div class="footer-social-icon">
                                <span> Follow us! </span>
                                <a href="https://www.facebook.com/" target="_blank"> <i class="fab fa-facebook-f facebook-bg"> </i> </a>
                                <a href="https://twitter.com/home" target="_blank"> <i class="fab fa-twitter twitter-bg"> </i> </a>
                                <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank"> <i class="fab fa-google-plus-g google-bg"> </i> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3> Useful Links </h3>
                            </div>
                            <ul>
                                <?php if(isset($_SESSION['user'])) { // Check if the user is logged in
                    echo '
                            <li> <a target="_self" a href="userspage.php"> Home </a> </li>
                            <li> <a target="_self" a href="productspage.php"> Categories </a> </li>
                            <li> <a target="_self" a href="faqs.php"> FAQS </a> </li>
                            <li> <a target="_self" a href="inquiry.php"> Inquiry </a> </li>';
                } else {
                    echo '
                    <li> <a target="_self" a href="homepage.php"> Home </a> </li>
                    <li> <a target="_self" a href="productspage.php"> Categories </a> </li>
                    <li> <a target="_self" a href="registration.php"> Register </a> </li>
                    <li> <a target="_self" a href="login.php"> Log-In </a> </li>';
                }
                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3> Subscribe </h3>
                            </div>
                            <div class="footer-text mb-25">
                                <p> Don't forget to sign up for our new feeds! </p>
                            </div>
                            <div class="subscribe-form">
                                    <i class="fab fa-telegram-plane"><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"> Subscribe </a></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
  </body>
</html>