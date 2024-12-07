<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title> FAQs </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/faqs.css">
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
                <br><?php
                session_start();

                if(isset($_SESSION['user'])) { // Check if the user is logged in
                    echo '
                    <a href="userspage.php"><img class="navbar-brand" width="240" src="BuiltImages/dmaclothinglogo.png"></img></a>
                    ';
                } else {
                    echo '
                    
                    <a href="homepage.php"><img class="navbar-brand" width="240" src="BuiltImages/dmaclothinglogo.png"></img></a>
                    ';
                }
                ?>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#myNav" aria-controls="nav" aria-expanded="false"
                aria-label="Toggle navigation">

                <i class="fas fa-bars"> </i> </button>        
                <div class="collapse navbar-collapse"id="myNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                        </li>
                    <?php
                    if(isset($_SESSION['user'])) { // Check if the user is logged in
                        echo '
                        <p>Hello, '.$_SESSION['user'].' |</p>
                        <li class="nav-item">
                            <a href="include/logout.inc.php" target="_self" class="nav-link"> Log-Out | </a>
                        </li>';

                    } else {
                        echo '
                        <a href="registration.php" target="_self" class="nav-link"> Register |</a>
                        <a href="login.php" class="nav-link"> Log-in | </a>';
                    }
                    ?>
                </ul>
            </div>
                <form class="form-inline my-2 my-lg-0" action="productspage.php" method="GET">
              <input id="searchByKeyword" class="form-control mr-sm-2" type="text" placeholder="Search by Keyword" aria-label="Search" name="search">
              <button class="btn btn-outline-warning my-2 my-sm-0" name="searchbutton" type="submit"> Search </button>
          </form>                    
        </div>
        </nav>
    </header>

        <nav class="navbar navbar-expand-xl main-navbar bg-color main-navbar-color"
        id="main-navbar">

            <div class="container">
                  <?php
                if(isset($_SESSION['user'])) { // Check if the user is logged in
                    echo '
                    <br><a class="navbar-brand" href="userspage.php" style="display:flex;"> HOME </a>
                    <a class="navbar-brand" href="productspage.php" style="display:flex;"> PRODUCTS </a>
                    <a class="navbar-brand" href="inquiry.php" style="display:flex;"> INQUIRY  </a>
                    <a class="navbar-brand" href="faqs.php" style="display:flex;"> FAQs  </a>
                    <a class="navbar-brand" href="purchasehistory.php" style="display:flex;"> ORDER HISTORY </a>';

                    require './Include/db.handler.inc.php';
                    $sql = "SELECT COUNT(*) FROM cart where userid = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $_SESSION['id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $count = $row['COUNT(*)'];
                            echo "<a class='navbar-brand' href='cart.php' style='display:flex;'>"."<i class='fa badge fa-lg' value='" . $count . "'>&#xf07a;</i> </a>";
                        }
                    } else {
                        echo "<a class='navbar-brand' href='cart.php' style='display:flex;'>"."<i class='fa badge fa-lg' value='" . $count . "'>&#xf07a;</i> </a>";
                    }
                } else {
                    echo '
                    <br><a class="navbar-brand" href="homepage.php" style="display:flex;"> HOME </a>
                    <a class="navbar-brand" href="productspage.php" style="display:flex;"> SEE PRODUCTS </a>
                    <a class="navbar-brand" href="faqs.php" style="display:flex;"> FAQs  </a>';
                }
                ?>
                
                <style>
                  .badge:after {
                    content: attr(value);
                    font-size: 21px;
                    color: #fff;
                    background: blue;
                    border-radius: 70%;
                    padding: 0 7px;
                    position: relative;
                    left: -8px;
                    top: -27px;
                    opacity: 0.9;
                    border: 2px solid black;
                }

                .fa-lg {
                    font-size: 40px;
                }

                .navbar-brand:hover {
                    transform: translateY(-2px);
                    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
                    border-radius: 4px;
                }
            </style>

            <div class="order-lg-last btn-group">
            </div>       
        </div>
        </nav>
        <!--End of Nav-->

  <div class="container">
<br><br>
    <center> <b> <h1> <i class="fa-solid fa-clipboard-question"></i> FREQUENTLY ASKED QUESTIONS <i class="fa-solid fa-clipboard-question"></i> </h1> </b> </center> <br>
    
    <div class="faq-drawer">
      <input class="faq-drawer__trigger" id="faq-drawer" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer"> 1. Do you offer free shipping? </label>
      <div class="faq-drawer__content-wrapper">
        <div class="faq-drawer__content">
          <p>
            Yes, we offer free standard shipping on orders over PHP 200 within the continental Philippines.
          </p>
        </div>
      </div>
    </div>
    
    <div class="faq-drawer">
      <input class="faq-drawer__trigger" id="faq-drawer-2" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-2"> 2. How long does shipping take? </label>
      <div class="faq-drawer__content-wrapper">
        <div class="faq-drawer__content">
          <p>
            Shipping times vary depending on your location and the shipping option you choose at checkout. Typically, orders are processed within 1-2 business days and shipped out within 3-5 business days. You can track your order using the tracking number provided in your shipping confirmation email.
          </p>
        </div>
      </div>
    </div>
    
    <div class="faq-drawer">
      <input class="faq-drawer__trigger" id="faq-drawer-3" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-3"> 3. What is your return policy? </label>
      <div class="faq-drawer__content-wrapper">
        <div class="faq-drawer__content">
          <p>
            We accept returns within 30 days of purchase for unworn and unwashed items with tags attached. You can either receive a full refund or exchange the item for another size or style.            
          </p>
        </div>
      </div>
    </div>

    <div class="faq-drawer">
      <input class="faq-drawer__trigger" id="faq-drawer-4" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-4"> 4. How do I know which size to order? </label>
      <div class="faq-drawer__content-wrapper">
        <div class="faq-drawer__content">
          <p>
            We provide a size chart on each product page to help you determine the best size for you. You can also contact our customer service team for assistance with sizing.         
          </p>
        </div>
      </div>
    </div>

    <div class="faq-drawer">
      <input class="faq-drawer__trigger" id="faq-drawer-5" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-5"> 5. Can I cancel my order after it has been placed? </label>
      <div class="faq-drawer__content-wrapper">
        <div class="faq-drawer__content">
          <p>
            You can cancel your order within 24 hours of placing it by contacting our customer service team. After 24 hours, we cannot guarantee that your order can be canceled.           
          </p>
        </div>
      </div>
    </div>

    <div class="faq-drawer">
      <input class="faq-drawer__trigger" id="faq-drawer-6" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-6"> 6. Do you offer international shipping? </label>
      <div class="faq-drawer__content-wrapper">
        <div class="faq-drawer__content">
          <p>
            Yes, we offer international shipping to select countries. Shipping times and costs vary depending on your location. Please note that international orders may be subject to customs fees and import taxes.           
          </p>
        </div>
      </div>
    </div>


  </div>
<br><br>

<footer class="footer-section">
        <div class="container">
            <div class="footer-cta pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-map-marker-alt"> </i>
                            <div class="cta-text">
                                <h4> Find us! </h4>
                                <span> 151 Muralla St, Intramuros, Manila </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-phone"> </i>
                            <div class="cta-text">
                                <h4> Call us! </h4>
                                <span> 09237648924 </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="far fa-envelope-open"> </i>
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
                }?>
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
                                    <i class="fab fa-telegram-plane"><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">Subscribe</a></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
  </body>
</html>