<!DOCTYPE HTML>
<html lang="en">
<head>
    <title> Products Page </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/productspage.css">
    <script src="https://kit.fontawesome.com/332a215f17.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7bc299d6e3.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script type="text/javascript">
      function closeCart() {
        $('.modal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        location.reload();
      };

      $(document).on('click', '#Close-Cart', function($event) {
          location.reload();
      });
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
                        location.reload();
                        alert("Product order already exist!");
                    } else {
                        location.reload();
                        alert("Successfully added to cart!");
                    }
                }                    
            });        
        }
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

    </section>

    <br><br>
    <div id="sortable" class="container">
        <div class="row">
            <div class="col-sm-3 hidden-xs">
<div class="h5 list-group font-weight-bold" style="background-color: #f8f9fa; border-radius: 10px; box-shadow: 0px 0px 5px #ccc;">
<div class="list-group-item" style="background-color: #ffc107; color: #222222; border-radius: 10px 10px 0 0;">
    <h5 class="mb-0 h4 text-center font-weight-bold" style="color: black;"> CATEGORIES </h5>
  </div>
    <a href="productspage.php" class="list-group-item">All products</a>
  <div class="list-group-item list-group-item-action" data-toggle="collapse" data-target="#category-submenu" aria-expanded="false" aria-controls="category-submenu">
    <a href="productspage.php?category=WOMENWEAR"> Womenwear </a><span class="float-right"><i class="fas fa-angle-down"></i></span>
  </div>
  <div class="collapse" id="category-submenu">
    <div class="list-group">
      <a href="productspage.php?category=WOMENWEAR&subCategory=TOPS" class="list-group-item">TOPS</a>
      <a href="productspage.php?category=WOMENWEAR&subCategory=BOTTOMS" class="list-group-item">BOTTOMS</a>
      <a href="productspage.php?category=WOMENWEAR&subCategory=DRESSES" class="list-group-item">DRESSES</a>
      <a href="productspage.php?category=WOMENWEAR&subCategory=MATERNITY CLOTHES" class="list-group-item">MATERNITY CLOTHES</a>
    </div>
  </div>

  <div class="list-group-item list-group-item-action" data-toggle="collapse" data-target="#category-submenu2" aria-expanded="false" aria-controls="category-submenu">
    <a href="productspage.php?category=MENWEAR">Menswear</a><span class="float-right"><i class="fas fa-angle-down"></i></span>
  </div>
  <div class="collapse" id="category-submenu2">
    <div class="list-group">
      <a href="productspage.php?category=MENWEAR&subCategory=T-SHIRTS" class="list-group-item">T-SHIRTS</a>
      <a href="productspage.php?category=MENWEAR&subCategory=POLO-SHIRT" class="list-group-item">POLO-SHIRT</a>
      <a href="productspage.php?category=MENWEAR&subCategory=SWEATSHIRT" class="list-group-item">SWEATSHIRT</a>
      <a href="productspage.php?category=MENWEAR&subCategory=HOODIES" class="list-group-item">HOODIES</a>
      <a href="productspage.php?category=MENWEAR&subCategory=SHORTS" class="list-group-item">SHORTS</a>
      <a href="productspage.php?category=MENWEAR&subCategory=CROPPED PANTS" class="list-group-item">CROPPED PANTS</a>
    </div>
  </div>

  <div class="list-group-item list-group-item-action" data-toggle="collapse" data-target="#category-submenu3" aria-expanded="false" aria-controls="category-submenu">
    <a href="productspage.php?category=BABY">Baby</a><span class="float-right"><i class="fas fa-angle-down"></i></span>
  </div>
  <div class="collapse" id="category-submenu3">
    <div class="list-group">
      <a href="productspage.php?category=BABY&subCategory=BABY BODYSUIT & ONE-PIECE (BABY)" class="list-group-item">BABY BODYSUIT & ONE-PIECE (BABY)</a>
      <a href="productspage.php?category=BABY&subCategory=TOP (BABY)" class="list-group-item">TOP (BABY)</a>
      <a href="productspage.php?category=BABY&subCategory=PANTS & LEGGINGS (BABY)" class="list-group-item">PANTS & LEGGINGS (BABY)</a>
      <a href="productspage.php?category=BABY&subCategory=SOCK (BABY)" class="list-group-item">SOCK (BABY)</a>
    </div>
  </div>

  <div class="list-group-item list-group-item-action" data-toggle="collapse" data-target="#category-submenu4" aria-expanded="false" aria-controls="category-submenu">
    <a href="productspage.php?category=CHILDREN">Children</a><span class="float-right"><i class="fas fa-angle-down"></i></span>
  </div>
  <div class="collapse" id="category-submenu4">
    <div class="list-group">
      <a href="productspage.php?category=CHILDREN&subCategory=T-SHIRTS (CHILDREN)" class="list-group-item">T-SHIRTS (CHILDREN)</a>
      <a href="productspage.php?category=CHILDREN&subCategory=DRESSES (CHILDREN)" class="list-group-item">DRESSES (CHILDREN)</a>
      <a href="productspage.php?category=CHILDREN&subCategory=SHORTS (CHILDREN)" class="list-group-item">SHORTS (CHILDREN)</a>
      <a href="productspage.php?category=CHILDREN&subCategory=PANTS (CHILDREN)" class="list-group-item">PANTS (CHILDREN)</a>
      <a href="productspage.php?category=CHILDREN&subCategory=SOCKS (CHILDREN)" class="list-group-item">SOCKS (CHILDREN)</a>
    </div>
  </div>
  <div class="list-group-item list-group-item-action" data-toggle="collapse" data-target="#category-submenu5" aria-expanded="false" aria-controls="category-submenu">
    <a href="productspage.php?category=ACCESSORIES">Accessories</a>  <span class="float-right"><i class="fas fa-angle-down"></i></span>
  </div>
  <div class="collapse" id="category-submenu5">
    <div class="list-group">
      <a href="productspage.php?category=ACCESSORIES&subCategory=HEADWEAR" class="list-group-item">HEADWEAR</a>
      <a href="productspage.php?category=ACCESSORIES&subCategory=BODY ACCESSORIES" class="list-group-item">BODY ACCESSORIES</a>
      <a href="productspage.php?category=ACCESSORIES&subCategory=BAGS" class="list-group-item">BAGS</a>
    </div>
  </div>
  
</div>
               <br> <br><div class="product-sidebar">
                    <h5 class="text-center font-weight-bold"> Best Selling Items </h5>
                    <?php
                    require './include/db.handler.inc.php';

                    $sql = "SELECT p.*, IFNULL(SUM(o.quantity * p.productPrice), 0) AS total_sales
                    FROM product p
                    LEFT JOIN order_tbl o ON o.productId = p.productId
                    GROUP BY p.productId
                    ORDER BY total_sales DESC 
                    LIMIT 4;";
                    $stmtCheck = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmtCheck,$sql))
                    {
                        header("location: ../.php?error=sqlerror");
                        exit();
                    }
                    else
                    {
                        mysqli_stmt_execute($stmtCheck);
                        $result = mysqli_stmt_get_result($stmtCheck);

                        while($row = mysqli_fetch_array($result))
                        {
                          ?>

                          <!-- Featured Product Item -->
                          <div class="product-item">
                            <div class="image">
                                <img src="images/<?php echo $row['productImage'] ?>"></a>
                            </div>
                            <div class="name">
                                <?php echo $row['productName'] ?> </a>
                            </div>
                            <div class="price">
                                <span> PHP <?php echo  $row['productPrice'] ?> </span>
                            </div>
                        </div>
                        <input type="hidden" id="<?php echo $row['productID'] ?>_productPrice" name="productPrice" value="<?php echo $row['productPrice'] ?>">
                        <?php 
                    }
                }
                ?>
            </div>
        </div>

<div class="col-sm-9">
    <div class="row">
        <div class="col">
          <form class="form-inline float-sm-right" action="productspage.php" method="GET">
             <input id="searchkeyword" class="form-control" type="text" placeholder="Search by Keyword" aria-label="Search" name="search"><br>
             &nbsp <button type="submit" class="btn btn-warning" name="searchbutton"> <i class="fas fa-search"> </i>    
             </form>                
         </div>
     </div>
     <br><div id="datatable" class="container">
        <div id="th-row" class="row clearfix">
        <?php
            require './include/db.handler.inc.php';
        if (isset($_GET['category']) && isset($_GET['subCategory']) && isset($_GET['searchbutton'])) {
            $category = $_GET['category'];
            $subCategory = $_GET['subCategory'];
            $search = $_GET['search'];
            $sql = "SELECT * FROM product 
                    INNER JOIN category ON product.categoryID=category.category_id
                    INNER JOIN subcategory ON product.subcategoryid = subcategory.subCategoryID
                    INNER JOIN size ON product.productSize = size.size_id
                    WHERE category.category_name = ? AND subcategory.subCategory = ?
                    AND (product.productName LIKE '%".$search."%' OR product.productBrand LIKE '%".$search."%')";

            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $category, $subCategory);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            }
        } else if (isset($_GET['category']) && isset($_GET['searchbutton'])) {
            // if only category is set, show products for that category
            $category = $_GET['category'];
            $search = $_GET['search'];
            $sql = "SELECT * FROM product 
                    INNER JOIN category ON product.categoryID=category.category_id
                    INNER JOIN subcategory ON product.subcategoryid = subcategory.subCategoryID
                    INNER JOIN size ON product.productSize = size.size_id
                    WHERE category.category_name = ?
                    AND (product.productName LIKE '%".$search."%' OR product.productBrand LIKE '%".$search."%')";

            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $category);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            }
        } else if (isset($_GET['searchbutton'])){
            $search = $_GET['search'];
            $sql = "SELECT * FROM product 
                    INNER JOIN category ON product.categoryID=category.category_id
                    INNER JOIN subcategory ON product.subcategoryid = subcategory.subCategoryID
                    INNER JOIN size ON product.productSize = size.size_id
                    AND (product.productName LIKE '%".$search."%' OR product.productBrand LIKE '%".$search."%')";

            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            }
        }

        else if (isset($_GET['category']) && isset($_GET['subCategory'])) {
            $category = $_GET['category'];
            $subCategory = $_GET['subCategory'];
            $sql = "SELECT * FROM product 
                    INNER JOIN category ON product.categoryID=category.category_id
                    INNER JOIN subcategory ON product.subcategoryid = subcategory.subCategoryID
                    INNER JOIN size ON product.productSize = size.size_id
                    WHERE category.category_name = ? AND subcategory.subCategory = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $category, $subCategory);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            }
        } else if (isset($_GET['category'])) {
            // if only category is set, show products for that category
            $category = $_GET['category'];
            $sql = "SELECT * FROM product 
                    INNER JOIN category ON product.categoryID=category.category_id
                    INNER JOIN subcategory ON product.subcategoryid = subcategory.subCategoryID
                    INNER JOIN size ON product.productSize = size.size_id
                    WHERE category.category_name = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $category);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            }
        } else {
            // if no category is selected, show all products
            $sql = "SELECT * FROM product 
                    INNER JOIN category ON product.categoryID=category.category_id
                    INNER JOIN subcategory ON product.subcategoryid = subcategory.subCategoryID
                    INNER JOIN size ON product.productSize = size.size_id";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            }
        }

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))
    {
        ?>
        <div id="th-tr" class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card product_item">
                        <div class="body">
                            <div class="cp_img">
                                <img src="images/<?php echo $row['productImage'] ?>" width="230" height="100" alt="Product" class="img-fluid">
                            </div><br>
                            <div class="product_details">
                                <center><h5 style="color:#051094;"> <b> <?php echo $row['productName']; ?> </b> </h5> </center>
                                <center><h6 class="text-black"> Brand: <?php echo $row['productBrand']; ?> </h6> </center>
                                <center><h6 class="text-black"> Available Stock: <?php echo $row['productStock']; ?> </h6> </center>

                                <ul class="product_price list-unstyled">
                                    <center> <li class="new_price"> PHP <?php echo $row['productPrice']; ?> </li>
                                    </center>
                                </ul>
                                <center>                                       

                                    <div id="total_items">
                                        <div id="item1">
                                            <div class="modal" id="addtocart-<?php echo $row['productID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class='col-12 modal-title text-center' id="exampleModalLabel">
                                                            <b> <?php echo $row['productName'] ?> </b><br>
                                                            <b> <?php echo $row['productBrand'] ?></b> </h4>
                                                            
                                                        </div>
                                                        <div class="modal-body">
                                                            <center><h6 class="text-black"> Category: <?php echo $row['category_name']; ?> </h6> </center>
                                                            <form method="post" enctype="multipart/form-data">
                                                                <input type="hidden" id="<?php echo $row['productID'] ?>_productPrice" name="productPrice" value="<?php echo $row['productPrice'] ?>">
                                                                <input type="hidden" id="<?php echo $row['productID'] ?>_productImage" name="productImage" value="?php echo $row['productImage'] ?>">
                                                                <input type="hidden" id="<?php echo $row['productID'] ?>_productID" name="productID" value="<?php echo $row['productID'] ?>">
                                                                <input type="hidden" id="<?php echo $row['productID'] ?>_productStock" name="productStock" value="<?php echo $row['productStock'] ?>">
                                                                <input type="hidden" id="<?php echo $row['productID'] ?>_productName" name="productName" value="<?php echo $row['productName'] ?>">
                                                                <input type="hidden" name="userID" value="<?php echo $_SESSION['id'] ?>">
                                                                <div class="cp_img">
                                                                    <img src="images/<?php echo $row['productImage'] ?>" width="230" height="100" alt="Product" class="img-fluid">
                                                                </div><br>

                                                                <div class="h-100 d-flex align-items-center justify-content-center">
                                                                    <div class="product_details">                                                

                                                                        <div class="container">
                                                                           <div class="text-center justify-content-center">

                                                                            <b> <div class="list-group-item"> SIZE </div> </b>
                                                                            <select class="form-control" name="productSize" placeholder="Product Size">
                                                                               <?php  
                                                                                  $sqlSize = "SELECT size_id, size_name FROM size";
                                                                                  $stmtSize = mysqli_stmt_init($conn);
                                                                                  if(!mysqli_stmt_prepare($stmtSize,$sqlSize))
                                                                                  {
                                                                                      header("location: ../adminproducts.php?error=sqlerror");
                                                                                      exit();
                                                                                  }
                                                                                  else
                                                                                  {
                                                                                      mysqli_stmt_execute($stmtSize);
                                                                                      $resultSize = mysqli_stmt_get_result($stmtSize);

                                                                                      while($rowSize = mysqli_fetch_array($resultSize))
                                                                                      {

                                                                                      ?>
                                                                                      <option value="<?php echo $rowSize['size_id'];  
                                                                                      ?>"> <?php echo $rowSize['size_name']; ?>
                                                                                      <?php 
                                                                                         if ($row['productSize'] == $rowSize['size_id'])
                                                                                         echo "available"
                                                                                     ?>
                                                                                 </option>  
                                                                                 <?php 
                                                                                 }
                                                                             }

                                                                         ?>
                                                                     </select>
                                                                 </div>

                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <center><h5 class="text-black"> Product Description:  </h5> <?php echo $row['productDesc']; ?> <br><br> </center>
                                                 <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" onclick="closeCart();" id="Close-Cart" data-bs-dismiss=""> Close </button>
                                                  <button type="button" onclick="added(<?php echo $row['productID']; ?>)" class="btn btn-warning" data-bs-dismiss="modal"> Add To Cart </button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>            
                      </form>

                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addtocart-<?php echo $row['productID'] ?>">
                          <i class="fa-solid fa-cart-shopping" style="color: #060d19;"></i> Add to Cart
                      </button>

                      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"> </script>
                      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"> </script>
                      <br><br></center>
                  </div>
              </div>
          </div><br><br>
      </div>
      <?php
    }
} else 
{
    echo "No products found.";
}

?> 



</div>
</div>     
</div>
</div>
</div> <br> <br>

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



<!-- Pagination -->
<script type="text/javascript">
$("#datatable").ready(function () {
    $('#datatable').after('<div id="pholder" rel="0"></div>').after('<div id="nav"></div>');
    var rowsShown = 12;
    var rowsTotal = $('#datatable > #th-row > #th-tr').length;
    var numPages = Math.ceil(rowsTotal / rowsShown);

    // Add Previous button
    $('#nav').append('<a href="#" rel="prev">&laquo; Previous</a> ');

    for (i = 0; i < numPages; i++) {
        var pageNum = i + 1;
        $('#nav').append('<a href="#" rel="' + i + '">' + pageNum + '</a> ');
    }

    // Add Next button
    $('#nav').append('<a href="#" rel="next">Next &raquo;</a> ');

    $('#nav a[rel="0"]').addClass('active');

    $('#datatable > #th-row > #th-tr').hide();
    $('#datatable > #th-row > #th-tr').slice(0, rowsShown).show();
    $('#nav a:first').addClass('active');

    var currPage = $(this).attr('rel');    
    $('#pholder').attr('rel', currPage);  

    // Hide the Previous button on the first page
    $('#nav a[rel="prev"]').hide();

    $('#nav a').bind('click', function () {
        $('#nav a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');

        // Handle Previous button
        if (currPage === 'prev') {
            currPage = parseInt($('#pholder').attr('rel')) - 1;
            if (currPage < 0) {
                currPage = 0;
            }
        }

        // Handle Next button
        if (currPage === 'next') {
            currPage = parseInt($('#pholder').attr('rel')) + 1;
            if (currPage > numPages - 1) {
                currPage = numPages - 1;
            }
        }

        $('#pholder').attr('rel', currPage);
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('#datatable > #th-row > #th-tr').css('opacity', '0.0').hide().slice(startItem, endItem).
            css('display', 'table-row').animate({
                opacity: 1
            }, 300);

        // Hide the Previous button on the first page
        if (currPage == 0) {
            $('#nav a[rel="prev"]').hide();
        } else {
            $('#nav a[rel="prev"]').show();
        }
    });
});
</script>

</body>


</html>