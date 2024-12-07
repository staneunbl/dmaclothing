<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title> Purchase Page </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/checkout.css">
<script src="https://kit.fontawesome.com/332a215f17.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/7bc299d6e3.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajax({
                type:'post',
                url:'cart_items.php',
                data:{
                    cart_items: "totalitems"
                },
                success: function(response){
                    if (response == "User not logged in") {
                        window.location.href = "login.php";
                    } else {
                        document.getElementById("total_items").value = response;
                    }
                }
            });
        });

        function added(id)
        {
            var name = document.getElementById(id+"_productName").value;
            var price = document.getElementById(id+"_productPrice").value;
            var stock = document.getElementById(id+"_productStock").value;
                        
            $.ajax({
                type: 'POST',
                url: 'cart_items.php',
                data: {
                    productName: name,
                    productPrice: price,
                    productID: id,
                    productStock: stock
                },
                success: function(response){
                    if (response == "User not logged in") {
                        alert("User not logged, going to login page");
                        setTimeout(function(){
                        window.location.href = "login.php";
                        }, 1000);
                    } else if (response == "Product already exists in cart") {
                        alert("Product order already exist!");
                    } else {
                        alert("Successfully added to cart!");
                    }
                }                    
            });        
        }
        </script>
    </script>
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
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search by Keyword" aria-label="Search">
      <button class="btn btn-outline-warning my-2 my-sm-0" type="submit"> Search </button>
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

<br><br>


  <br><br>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Login title</h4>
      </div>
      <div class="modal-body">

    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="h4 d-flex flex-wrap justify-content-between align-items-center px-4 py-3 bg-dark text-light"><span> Checkout </span><a class="font-size-sm text-light" href="#"> Continue shopping </a></h2>

                <div class="h5 d-flex flex-wrap justify-content-between align-items-center px-4 py-3 bg-secondary text-light"><span> <i class="fa-solid fa-location-dot"></i> Delivery Address </span> <div class="font-size-sm text-light" href="#"> "Address" </div>
                </div>

                <!-- Item-->
                <div class="d-sm-flex justify-content-between my-4 pb-4 border-bottom">
                    <div class="media d-block d-sm-flex text-center text-sm-left">
                        <a class="cart-item-thumb mx-auto mr-sm-4" href="#"><img src="https://www.ikea.com/ph/en/images/products/komplement-clothes-rail-white__1203424_pe906301_s5.jpg?f=s"  width="150" height="150" alt="Product"></a>
                        <div class="media-body pt-3">
                            <h4><a href="#"> Shayyanne </a></h4>
                            <div class="font-size-sm"><span class="text-muted mr-2"> Size: </span> 8.5 </div>
                            <div class="font-size-sm"><span class="text-muted mr-2"> Color: </span> Black </div>
                            <div class="font-size-lg text-primary pt-2"> $125.00 </div>
                        </div>
                    </div>

                    <div class="col-2" style="max-width: 20rem;">
                        <div class="form-group col-xs-2">
                            <h5><center><label for="quantity1"> Quantity </label></center></h5>
                            <div class="list-group-item"> //INPUT HERE </div>
                        </div>
                        <h6> <button class="btn btn-outline-danger btn-sm btn-block mb-2" type="button"> Remove </h6></button>
                    </div>       
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
          <div class="col">
              <div class="p-3 bg-light bg-opacity-10">
                <h4 class="card-title mb-3"> Order Summary </h4>
                <div class="d-flex justify-content-between mb-1 small">
                  <h5><span> Subtotal </span></h5> <h5><span> PHP </span></h5>
                </div>
                <div class="d-flex justify-content-between mb-1 small">
                  <h5><span> Shipping Fee </span></h5> <h5><span> PHP  </span></h5>
                </div>
                <h4 class="card-title mb-3"> Payment Options </h4>                
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                  <label class="form-check-label" for="inlineCheckbox1">1</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                  <label class="form-check-label" for="inlineCheckbox2">2</label>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4 small">
                  <h5><span>TOTAL</span></h5> <h5><strong class="text-dark"> PHP </strong></h5>
                </div>
                <button class="btn btn-warning w-100 mt-2"> <b>Place order </b></button></b>
              </div>
          </div>
        </div>
      </div>





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                                <li> <a target="_blank" a href="homepage.php"> Home </a> </li>
                                <li> <a target="_self" a href="homepage.php#categories"> Categories </a> </li>
                                <li> <a target="_blank" a href="registration.php"> Register </a> </li>
                                <li> <a target="_blank" a href="login.php"> Log-In </a> </li>
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
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>