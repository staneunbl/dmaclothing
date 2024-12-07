<!DOCTYPE HTML>
<html lang="en">
<head>
    <title> Purchase Page </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/purchasehistory.css">
    <script src="https://kit.fontawesome.com/332a215f17.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7bc299d6e3.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
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
                    <a href="userspage.php">
                    ';
                } else {
                    echo '
                    
                    <a href="homepage.php">
                    ';
                }
                ?>
                <img class="navbar-brand" width="240" src="BuiltImages/dmaclothinglogo.png"></img></a>

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

<nav class="navbar navbar-expand-xl main-navbar bg-color main-navbar-color" id="main-navbar">

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
    <br> <br>
    <div class="container">
        <header class="h4 card-header font-weight-bold" style="background-color:#fbc304";> My Orders / Tracking </header>
        <div class="card-body">
            <hr>

            <?php
            require './include/db.handler.inc.php';
            if (!isset($_SESSION['id'])) {
                header("Location: login.php");
                exit();
            }

                    // Get the user ID from the session
            $userId = $_SESSION['id'];

                    // Join the tables to retrieve the relevant data for the current user
            $sql = "SELECT 
            ot.ordernumber,
            ot.delivery_status,
            ot.firstname,
            ot.lastname,
            ot.phone,
            ot.address,
            ot.orderdate,
            ot.subtotal,
            ot.shippingfee,
            ot.total,
            ot.paymentoptions,
            ot.paymentstatus,
            GROUP_CONCAT(pt.productName SEPARATOR ' & ') AS products,
            GROUP_CONCAT(pt.productBrand SEPARATOR ' & ') AS brands,
            GROUP_CONCAT(pt.productPrice SEPARATOR ' & ') AS prices,
            GROUP_CONCAT(ot.quantity SEPARATOR ' & ') AS quantities

            FROM order_tbl ot
            JOIN product pt ON ot.productID = pt.productID
            where ot.userid= ?
            GROUP BY ot.ordernumber
            ORDER BY ot.delivery_status";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
            {
                header("location: ../cart.php?error=sqlerror");
                exit();
            }
            ?>
             <?php if (mysqli_num_rows($result) == 0) 
            {
                echo "
                <br><tr><td colspan='5'><div class='alert alert-info' role='alert'><br>
                <h4 class='alert-heading'>No Orders to be found!</h4>
                <p>It looks like you haven't placed an order yet.... <br><a href='productspage.php'>click here to shop now</a>.</p>
                </div></td></tr>";
            }
        ?>
            <?php
            while($row = mysqli_fetch_array($result))
            {
              ?>
              <article class="card">

                <header class="h6 card-header font-weight-bold"> ORDER NUMBER: <?php echo $row['ordernumber']?> </header>
                <header class="h6 card-header font-weight-bold"> STATUS: <?php echo $row['delivery_status']?> </header>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="itemside mb-3">
                                <div class="aside"> <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQoI3ssJwIp2F091rVxApGwC5E4MGHo-TiGqA&usqp=CAU" height="95"></div>
                                <div class="info align-self-center">
                                    <p class=" h6 title"><b> Product Name: </b><?php echo $row['products']?> <br> <b>Product Brand:</b>  <?php echo $row['brands']?> </p> <span class="text-muted"> <b>Quantity:</b> <?php echo $row['quantities']?> </span>
                                </div>
                                <div class="col text-right">
                                    <br><p class="h5 title font-weight-bold">  PHP <?php echo $row['total']?></p> <span class="text-muted">
                                    </div>                        
                                </div><hr size="10" color="#fbc304">

                                <p><a class="btn btn-warning font-weight-bold w-100 border" data-toggle="collapse" href="#multiCollapseExample<?php echo $row['ordernumber'] ?>" role="button" aria-expanded="false" aria-controls="multiCollapseExample<?php echo $row['ordernumber'] ?>">Click for more details</a></p>                    
                                
                                <div class="collapse multi-collapse" id="multiCollapseExample<?php echo $row['ordernumber'] ?>">
                                    <div class="row">

                                        <div class="col">
                                            <div class="p-2 bg-light bg-opacity-10">
                                        <div class="track">
                                            <div class="step <?php echo $row['delivery_status'] == 'placed order (processing)' || $row['delivery_status'] == 'Waiting to Receive' || $row['delivery_status'] == 'Complete' ? 'active' : ''; ?>">
                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                <span class="text h5 font-weight-bold">Order Placed</span>
                                            </div>
                                            <div class="step <?php echo $row['delivery_status'] == 'Waiting to Receive' || $row['delivery_status'] == 'Complete' ? 'active' : ''; ?>">
                                                <span class="icon"><i class="fa fa-user"></i><i class="fa fa-truck"></i></span>
                                                <span class="text h5 font-weight-bold">To receive by user</span>
                                            </div>
                                            <div class="step <?php echo $row['delivery_status'] == 'Complete' ? 'active' : ''; ?>">
                                                <span class="icon"><i class="fa fa-box"></i></span>
                                                <span class="text h5 font-weight-bold">Completed</span>
                                            </div>
                                        </div>
                                            <br><h4 class="card-title mb-3 font-weight-bold"> Reciever Information Details </h4>
                                            <div class="d-flex justify-content-between mb-1 small">
                                                <h5><span> Full Name </span></h5> <h6><span><?php echo $row['lastname']?> , <?php echo $row['firstname']?> </span></h6>
                                            </div>
                                            <div class="d-flex justify-content-between mb-1 small">
                                                <h6><span> Contact Number </span></h6> <h6><span> <?php echo $row['phone']?> </span></h6>
                                            </div>                  
                                            <div class="d-flex justify-content-between mb-1 small">
                                                <h6><span> Home Address  </span></h6> <h6><span> <?php echo $row['address']?> </span></h6>
                                            </div>
                                            <div class="d-flex justify-content-between mb-1 small">
                                                <h6><span> Order Date </span></h6> <h6><span> <?php echo $row['orderdate']?> </span></h6>
                                            </div>
                                            <div class="d-flex justify-content-between mb-1 small">
                                                <h6><span> Payment Status: </span></h6> <h6><span> <?php echo $row['paymentstatus']?> </span></h6>
                                            </div>

                                            <hr>
                                            <form method="POST" action="updatepaystatus.php">
                                            <input type="hidden" name="orderNumber" value="<?php echo $row['ordernumber'] ?>">
                                            <input type="hidden" name="deliveryStatus" value="Complete">
                                            <?php if($row['delivery_status'] == 'placed order (processing)'): ?>
                                            <em>Disabled, Waiting for product to arrive to activate</em><br>
                                            <button type="submit" name="buttonfinished" value="submit" class="btn btn-primary" disabled><em>Button Disabled</em></button>
                                            <?php elseif($row['delivery_status'] == 'Complete'): ?>
                                                <button type="submit" name="buttonfinished" value="submit" class="btn btn-primary" disabled><em>Order Completed</em></button>
                                            <?php else: ?>
                                                <button type="submit" name="buttonfinished" value="submit" class="btn btn-primary">Recieve and Pay product</button>
                                            <?php endif; ?>
                                            </form>                                               
                                        </div>
                                    </div>
                                    <div class="col">
                                      <div class="p-2 bg-light">
                                        <br><h4 class="card-title mb-3 font-weight-bold"> Order Summary </h4>
                                        <div class="d-flex justify-content-between mb-1 small">
                                            <h6><span> Mode of Delivery </span></h6> <h6><span><?php echo $row['paymentoptions']?> </span></h6>
                                        </div>   
                                        <div class="d-flex justify-content-between mb-1 small">
                                            <h6><span> Prices of product </span></h6> <h6><span> PHP <?php echo $row['prices']?> </span></h6>
                                        </div>
                                        <div class="d-flex justify-content-between mb-1 small">
                                            <h6><span> Shipping Fee </span></h6> <h6><span> PHP  <?php echo $row['shippingfee']?> </span></h6>
                                        </div>  
                                        <div class="d-flex justify-content-between mb-1 small">
                                            <h5><span> Subtotal </span></h5><h6><span> PHP <?php echo $row['subtotal']?> </span></h6>
                                        </div>
                                        <hr>                         
                                        <div class="text-right">
                                            <br><p class="h4 title font-weight-bold"> Total Order: PHP <?php echo $row['total']?>  </p>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article> <br>

                <?php
            }
            ?>

            <br>

            <hr>
            <a href="cart.php" class="btn btn-warning btn-lg font-weight-bold" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to Cart </a>
        </div>

    </div>

    <br><br><br> 


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