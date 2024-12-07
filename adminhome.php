<!DOCTYPE html>
<html>
<head>
  <title> Admin - Dashboard </title>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7bc299d6e3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/adminhome.css"></link>
</head>
</head>
<body >
 <!--Nav-->
 <nav class="navbar navbar-expand-lg main-navbar bg-color main-navbar-color"
 id="main-navbar">
 <div class="container">
    <a href="userspage.php"><img class="navbar-brand" width="140" src="BuiltImages/dmaclothinglogo.png"></img></a>

    <a class="navbar-brand" href="adminhome.php"> D'MA CLOTHING </a>

    <div class="order-lg-last btn-group">
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse"
    data-target="#myNav" aria-controls="nav" aria-expanded="false"
    aria-label="Toggle navigation">

    <i class="fas fa-bars"> </i> </button>
    <div class="collapse navbar-collapse"id="myNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="adminhome.php" target="_self" class="nav-link"> Admin Page </a>
            </li>
            <li class="nav-item">
                <a href="include/logout.inc.php" target="_self" class="nav-link"> Log-Out </a>
            </li>                               
        </ul>
    </div>
</div>
</nav>
<!--End of Nav-->

<div id="wrapper">
  <aside id="sidebar-wrapper">
    <ul class="sidebar-nav">
      <li>
        <div id="navbar-wrapper">
            <nav class="navbar navbar-inverse">
              <div class="container-fluid"> 
                <a href="#" class="navbar-brand text-right" id="sidebar-toggle"> <i class="fa fa-bars"></i> </a> <BR> 
              </div>
          </nav>
      </div>
  </li> 
  <li>
    <a href="adminhome.php"> <i class="fa fa-home"></i> Dashboard </a>
</li>
<li>
    <a href="admincustomer.php"><i class="fa fa-users"></i> Customers </a>
</li>
<li>
    <a href="admininquiry.php"><i class="fa fa-message"></i> Users' Inquiry </a>
</li>
<li>
    <a href="adminproducts.php"><i class="fa fa-shirt"></i> Products </a>
</li>
<li>
    <a href="adminorders.php"><i class="fa fa-cart-shopping"></i> Customers' Orders </a>
</li>
<li>
    <a href="adminsales.php"><i class="fa fa-warehouse"></i> Sales and Inventory </a>
</li>                        
</ul>
</aside>



<br><br><br>

<section id="content-wrapper">
  <div class="row">

    <div class="col-lg-12">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="card bg-c-one order-card">
                        <div class="card-block">
                            <h6 class="m-b-20"> Total Number of Users </h6><br>
                            <?php
                            require './Include/db.handler.inc.php';
                            $totalusers = "SELECT COUNT(*) AS total_users FROM user_tbl";
                            $stmt = mysqli_stmt_init($conn);
                            if(mysqli_stmt_prepare($stmt,$totalusers))
                            {
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if($row = mysqli_fetch_assoc($result))
                                {
                                    ?> 
                                    <h2 class="text-right"> <i class="fa-solid fa-users f-left"></i><span> <?php echo $row['total_users']; ?> </span></h2> 
                                    <?php
                                }
                            }
                            ?>  

                        </div>
                    </div>
                </div>

                <div class="col-sm">
                    <div class="card bg-c-one order-card">
                        <div class="card-block">
                            <h6 class="m-b-20"> Total Number of Inquiries </h6><br>
                            <?php
                            require './Include/db.handler.inc.php';
                            $totalinquiries = "SELECT COUNT(*) AS total_inquiries FROM inquiry_tbl";
                            $stmt = mysqli_stmt_init($conn);
                            if(mysqli_stmt_prepare($stmt,$totalinquiries))
                            {
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if($row = mysqli_fetch_assoc($result))
                                {
                                    ?> 
                                    <h2 class="text-right"> <i class="fa-solid fa-users f-left"></i><span> <?php echo $row['total_inquiries']; ?> </span></h2> 
                                    <?php
                                }
                            }
                            ?>  

                        </div>
                    </div>
                </div>

                <div class="col-sm">
                    <div class="card bg-c-one order-card">
                        <div class="card-block">
                            <h6 class="m-b-20"> Total Number of Products </h6><br>
                            <?php
                            require './Include/db.handler.inc.php';
                            $totalproducts = "SELECT COUNT(*) AS total_products FROM product";
                            $stmt = mysqli_stmt_init($conn);
                            if(mysqli_stmt_prepare($stmt,$totalproducts))
                            {
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if($row = mysqli_fetch_assoc($result))
                                {
                                    ?> 
                                    <h2 class="text-right"> <i class="fa-solid fa-users f-left"></i><span> <?php echo $row['total_products']; ?> </span></h2> 
                                    <?php
                                }
                            }
                            ?>  

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="col-lg-12">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="card bg-c-two order-card">
                        <div class="card-block">
                            <h6 class="m-b-20"> Total Sales of all Products </h6><br>
                            <?php
                            require './Include/db.handler.inc.php';
                            $totalsales = "SELECT SUM(total) AS total_sales FROM order_tbl WHERE delivery_status = 'Complete'";
                            $stmt = mysqli_stmt_init($conn);
                            if(mysqli_stmt_prepare($stmt,$totalsales))
                            {
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if($row = mysqli_fetch_assoc($result))
                                {
                                                $total_sales = number_format($row['total_sales'], 2); // convert to decimal with 2 decimal places
                                                ?> 
                                                <h2 class="text-right"> <i class="fa-solid fa-users f-left"></i><span> <?php echo $total_sales; ?> </span></h2> 
                                                <?php
                                            }
                                        }
                                        ?>  
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm">
                                <div class="card bg-c-two order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20"> Total Orders Placed </h6> <br>
                                        <?php
                                        require './Include/db.handler.inc.php';
                                        $totalordersplaced = "SELECT COUNT(DISTINCT ordernumber) AS total_orders_placed FROM order_tbl";
                                        $stmt = mysqli_stmt_init($conn);
                                        if(mysqli_stmt_prepare($stmt,$totalordersplaced))
                                        {
                                            mysqli_stmt_execute($stmt);
                                            $result = mysqli_stmt_get_result($stmt);

                                            if($row = mysqli_fetch_assoc($result))
                                            {
                                            ?> <h2 class="text-right"> <i class="fa-solid fa-users f-left"></i><span> <?php echo $row['total_orders_placed']; ?> </span></h2> 
                                            <?php
                                        }
                                    }
                                    ?> 
                                </div>
                            </div>
                        </div>


                        <div class="col-sm">
                            <div class="card bg-c-two order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20"> Total Products Sold </h6> <br>
                                    <?php
                                    require './Include/db.handler.inc.php';
                                    $totalprodsold = "SELECT SUM(quantity) AS total_products_sold FROM order_tbl where delivery_status ='Complete'";
                                    $stmt = mysqli_stmt_init($conn);
                                    if(mysqli_stmt_prepare($stmt,$totalprodsold))
                                    {
                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);

                                        if($row = mysqli_fetch_assoc($result))
                                        {
                                        ?> <h2 class="text-right"> <i class="fa-solid fa-users f-left"></i><span> <?php echo $row['total_products_sold']; ?> </span></h2> 
                                        <?php
                                    }
                                }
                                ?> 
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="card bg-c-three order-card">
                            <div class="card-block">
                                <br><br><h2> Top Best Selling Items <br><br></h2>
                            </div>
                        </div>
                    </div>
                    <?php
                    require './include/db.handler.inc.php';
                            // Query order_tbl to get the total quantity of each product that has been sold
                    $sql = "SELECT p.*, IFNULL(SUM(o.quantity * p.productPrice), 0) AS total_sales
                    FROM product p
                    LEFT JOIN order_tbl o ON o.productId = p.productId
                    WHERE o.delivery_status = 'Complete'
                    GROUP BY p.productId
                    ORDER BY total_sales DESC 
                    LIMIT 5";
                    $stmtCheck = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtCheck, $sql)) {
                        header("location: ../.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_execute($stmtCheck);
                        $result = mysqli_stmt_get_result($stmtCheck);
                        $i = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <div class="col">
                                <div class="card bg-c-three order-card">
                                    <div class="card-block text-center">
                                        <div class=" h6 text-center font-weight-bold"><?php echo $i . ". " . $row['productName'] ?> </div><hr>
                                        <a href="#"><img src="images/<?php echo $row['productImage'] ?>" width="110"> </a> <hr>
                                        <span class=" h6 text-center"> Total Sales: PHP <?php echo $row['total_sales'] ?></span>

                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-four order-card">
                            <div class="card-block">

                                <h6 class="m-b-20"> Daily Sales </h6><br>
                                <?php
                                require './Include/db.handler.inc.php';
                                $dailysales = "SELECT SUM(total) AS daily_sales FROM order_tbl WHERE DATE(orderdate) = CURDATE() AND delivery_status = 'Complete'";
                                $stmt = mysqli_stmt_init($conn);
                                if(mysqli_stmt_prepare($stmt,$dailysales))
                                {
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);

                                    if($row = mysqli_fetch_assoc($result))
                                    {
                                                $daily_sales = number_format($row['daily_sales'], 2); // convert to decimal with 2 decimal places
                                                ?> 
                                                <h2 class="text-right"> <i class="fa-solid fa-users f-left"></i><span> <?php echo $daily_sales; ?> </span></h2> 
                                                <?php
                                            }
                                        }
                                        ?>  

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-3">
                                <div class="card bg-c-four order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20"> Weekly Sales </h6><br>
                                        <?php
                                        require './Include/db.handler.inc.php';
                                        $weeklysales = "SELECT WEEK(orderdate) AS week_number, SUM(total) AS weekly_sales FROM order_tbl where delivery_status = 'Complete' GROUP BY week_number";
                                        $stmt = mysqli_stmt_init($conn);
                                        if(mysqli_stmt_prepare($stmt,$weeklysales))
                                        {
                                            mysqli_stmt_execute($stmt);
                                            $result = mysqli_stmt_get_result($stmt);

                                            if($row = mysqli_fetch_assoc($result))
                                            {
                                                $weekly_sales = number_format($row['weekly_sales'], 2); // convert to decimal with 2 decimal places
                                                ?> 
                                                <h2 class="text-right"> <i class="fa-solid fa-users f-left"></i><span> <?php echo $weekly_sales; ?> </span></h2> 
                                                <?php
                                            }
                                        }
                                        ?>  
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-3">
                                <div class="card bg-c-four order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20"> Monthly Sales </h6><br>
                                        <?php
                                        require './Include/db.handler.inc.php';
                                        $monthlysales = "SELECT SUM(total) AS sales_month FROM order_tbl WHERE MONTH(orderdate) = MONTH(CURRENT_DATE()) AND delivery_status = 'Complete' ";
                                        $stmt = mysqli_stmt_init($conn);
                                        if(mysqli_stmt_prepare($stmt,$monthlysales))
                                        {
                                            mysqli_stmt_execute($stmt);
                                            $result = mysqli_stmt_get_result($stmt);

                                            if($row = mysqli_fetch_assoc($result))
                                            {
                                                $sales_month = number_format($row['sales_month'], 2); // convert to decimal with 2 decimal places
                                                ?> 
                                                <h2 class="text-right"> <i class="fa-solid fa-users f-left"></i><span> <?php echo $sales_month; ?> </span></h2> 
                                                <?php
                                            }
                                        }
                                        ?>  
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-3">
                                <div class="card bg-c-four order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20"> Yearly Sales </h6><br>
                                        <?php
                                        require './Include/db.handler.inc.php';
                                        $yearlysales = "SELECT SUM(total) AS sales_year FROM order_tbl WHERE YEAR(orderdate) = YEAR(CURDATE()) AND delivery_status = 'Complete'";
                                        $stmt = mysqli_stmt_init($conn);
                                        if(mysqli_stmt_prepare($stmt,$yearlysales))
                                        {
                                            mysqli_stmt_execute($stmt);
                                            $result = mysqli_stmt_get_result($stmt);

                                            if($row = mysqli_fetch_assoc($result))
                                            {
                                                $sales_year = number_format($row['sales_year'], 2); // convert to decimal with 2 decimal places
                                                ?> 
                                                <h2 class="text-right"> <i class="fa-solid fa-users f-left"></i><span> <?php echo $sales_year; ?> </span></h2> 
                                                <?php
                                            }
                                        }
                                        ?>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>







<br><br>

<script>
  const $button  = document.querySelector('#sidebar-toggle');
  const $wrapper = document.querySelector('#wrapper');

  $button.addEventListener('click', (e) => {
    e.preventDefault();
    $wrapper.classList.toggle('toggled');
});
</script>
</body>
</html>