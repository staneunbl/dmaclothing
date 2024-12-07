<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title> Users Page </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/homepage.css">
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/332a215f17.js" crossorigin="anonymous"></script>
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

    <nav class="navbar navbar-expand-xl main-navbar bg-color main-navbar-color text-center" id="main-navbar">
        <div class="container">
                    <?php
                if(isset($_SESSION['user'])) { // Check if the user is logged in
                    echo '
                    <br><a class="navbar-brand" href="userspage.php" style="display:flex;"> HOME </a>
                    <a class="navbar-brand" href="productspage.php" style="display:flex;"> PRODUCTS </a>
                    <a class="navbar-brand" href="inquiry.php" style="display:flex;"> INQUIRY  </a>
                    <a class="navbar-brand" href="faqs.php" style="display:flex;"> FAQs  </a>
                    <a class="navbar-brand" href="purchasehistory.php" style="display:flex;"> ORDER HISTORY </a>
                    ';
                } else {
                    echo '
                    <br><a class="navbar-brand" href="homepage.php" style="display:flex;"> HOME </a>
                    <a class="navbar-brand" href="productspage.php" style="display:flex;"> SEE PRODUCTS </a>
                    <a class="navbar-brand" href="faqs.php" style="display:flex;"> FAQs  </a>
                    ';
                }

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

    </section>

<div class="carousel slide" id="slider" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#slider" data-slide-to="0" class="active"></li>
    <li data-target="#slider" data-slide-to="1"> </li>
    <li data-target="#slider" data-slide-to="2"> </li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
            <div class="carousel-caption">
                <h1 class="font-weight-bold"> D'MA CLOTHING </h1>          
            <h2 class="font-weight-bold font-italic"> confinement the refinement </h2><br>  
            <div class="action">
            <a class="btn btn-warning btn-lg font-weight-bold font-italic mr-2 border border-dark rounded-lg" href="productspage.php"> Shop Now </a>
            </div> <br><br><br><br>
        </div> 

    </div>

    <div class="carousel-item" style="background-image:url(https://blogs.salford.ac.uk/made-in-salford/wp-content/uploads/sites/41/2018/03/vintage-clothing-750x500.jpg);">
            <div class="carousel-caption">
                <h1 class="font-weight-bold"> ABOUT US </h1>          
            <h5 class="font-weight-bold font-italic"> At our clothing retail shop, we are passionate about providing customers with high-quality, stylish apparel at affordable prices. We pride ourselves on staying up-to-date with the latest trends while offering a diverse selection of clothing for men and women. Shop with us today and experience the best in fashion! Our shop offers a wide range of clothing and accessories for both men and women. From casual wear to formal attire, we have something for everyone. Our collections are carefully curated to ensure that we offer the latest styles and designs that meet your needs.
 </h5><br>
<br><br>
        </div>    
    </div>

    <div class="carousel-item" style="background-image:url(https://d3aux7tjp119y2.cloudfront.net/original_images/_JN31221_Myrorna20TC3A4by20Centrum-CMSTemplate.jpg);">
            <div class="carousel-caption">
        </div>          
    
    </div>
  </div>
  <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only"> Previous </span>
  </a>
  <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only"> Next </span>
  </a>
</div>

<section id="categories">
    <section class="product-section bg-img py-3">
        <div class="container">
            <div class=" row justify-content-center pb-5">
                <div class="col-md-7 heading-section text-center">
                    <br><br> <h2 class="font-weight-bold text-color glow">
                        SHOP BY CATEGORIES
                    </h2> <br>
                </div>
            </div>
            <!--End of title-->

            <div class="row">
                <div class="col">
                    <div class="product glow">
                    <div class="img d-flex align-items-center justify-content-center"
                    style="background-image:url(https://cdn.shopify.com/s/files/1/0549/9555/0392/files/ASEESA_BANNER_1024x1024.png?v=1678082113);">
                    <div class="icons">
                        <p class="icon-block d-flex">
                            <a href="productspage.php?category=WOMENWEAR" class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-eye"> </i>
                            </a>
                        </p>
                    </div>
                     </div>
                     <div class="text text-center">
                         <span class="category font-weight-bold"> Women Wear </span>
                         <h6 class="text-black"> </h6>
                     </div>
                </div>  
                </div>

                <div class="col">
                    <div class="product glow">
                    <div class="img d-flex align-items-center justify-content-center"
                    style="background-image:url(https://hips.hearstapps.com/esq.h-cdn.co/assets/16/16/1460992524-trendy-menswear.jpg?crop=0.666666666666667xw:1xh;center,top&resize=800:*);">
                    <div class="icons">
                        <p class="icon-block d-flex">
                            <a href="productspage.php?category=MENWEAR"class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-eye"> </i>
                            </a>
                        </p>
                    </div>
                     </div>
                     <div class="text text-center">
                         <span class="category font-weight-bold"> Mens Wear </span>
                         <h6 class="text-black"> </h6>
                     </div>
                </div>  
                </div>

                <div class="col">
                    <div class="product glow">
                    <div class="img d-flex align-items-center justify-content-center"
                    style="background-image:url(https://insideretail.asia/wp-content/uploads/2020/09/Zalora-childrenswear.jpg);">
                    <div class="icons">
                        <p class="icon-block d-flex">
                            <a href="productspage.php?category=CHILDREN"class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-eye"> </i>
                            </a>
                        </p>
                    </div>
                     </div>
                     <div class="text text-center">
                         <span class="category font-weight-bold"> Children Wear </span>
                         <h6 class="text-black"> </h6>
                     </div>
                </div>  
                </div>

                <div class="col">
                    <div class="product glow">
                    <div class="img d-flex align-items-center justify-content-center"
                    style="background-image:url(https://www.postie.co.nz/content/products/babies-merino-bodysuit-prem-24-months-oatdeep-blue-moons-a-outfit-808823.jpg?canvas=304:368&width=260);">
                    <div class="icons">
                        <p class="icon-block d-flex">
                            <a href="productspage.php?category=BABY"class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-eye"> </i>
                            </a>
                        </p>
                    </div>
                     </div>
                     <div class="text text-center">
                         <span class="category font-weight-bold"> Baby Wear </span>
                         <h6 class="text-black"> </h6>
                     </div>
                </div>  
                </div>

                <div class="col">
                    <div class="product glow">
                    <div class="img d-flex align-items-center justify-content-center"
                    style="background-image:url(https://media.istockphoto.com/id/655413652/photo/womens-personal-accessories.jpg?s=612x612&w=0&k=20&c=f0sPDoV2tHOcu_NENhi6WmFszsC7-qpnWHRu4J-tcMo=);">
                    <div class="icons">
                        <p class="icon-block d-flex">
                            <a href="productspage.php?category=ACCESSORIES"class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-eye"> </i>
                            </a>
                        </p>
                    </div>
                     </div>
                     <div class="text text-center">
                         <span class="category font-weight-bold"> Accessories </span>
                         <h6 class="text-black"> </h6>
                     </div>
                </div>  
                </div>
            </div>
    </section>
</section>

 

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

   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>