<!DOCTYPE HTML>
<html lang="en">
<head>
    <title> Cart Page </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/cart.css">

    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Popper.js and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/7bc299d6e3.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">

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

<!-- Shopping Cart-->    
<br><div class="container padding-bottom-3x mb-1">
    <?php
    require './include/db.handler.inc.php';

    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }

                    // Get the user ID from the session
    $userId = $_SESSION['id'];

                    // Get the count of items in the user's cart
    $countQuery = "SELECT COUNT(*) FROM cart WHERE userid = ?";
    $stmt = $conn->prepare($countQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $countResult = $stmt->get_result();
    $count = mysqli_fetch_assoc($countResult)['COUNT(*)'];

                    // Join the tables to retrieve the relevant data for the current user
    $cartQuery = "SELECT * FROM cart 
    INNER JOIN product ON cart.productID = product.productID 
    INNER JOIN category ON product.categoryID = category.category_id 
    INNER JOIN subcategory ON product.subcategoryid = subcategory.subCategoryID 
    INNER JOIN size ON product.productSize = size.size_id 
    WHERE cart.userId = ?";
    $stmt = $conn->prepare($cartQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if(!$result)
    {
        header("location: ../cart.php?error=sqlerror");
        exit();
    }
    ?>

    <div class="table-responsive shopping-cart">
        <table class="table">
            <thead>
                <tr style="font-size: 25px">
                    <h4><th>Product Name</th>
                        <h4><th class="text-large"> Quantity </th></h4>
                        <h4><th class="text-center"> Price Value </th></h4>
                        <th class="text-center"><button class="btn btn-danger" data-toggle="modal" data-target="#myModal3" data-cart-id="<?php echo $row['cartID'];?>" data-toggle="tooltip" title="" data-original-title="Remove item" <?php if($count == 0){echo "disabled";}?>><b> Clear Cart </b></button></th>

                        <!-- The Modal -->
                        <div class="modal fade" id="myModal3">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title"> Are you sure? </h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form method="post" action="include/delete.inc.php" enctype="multipart/form-data">
                                    <input type="hidden" id="UID" name="userID" value="<?php echo $_SESSION['id'] ?>">
                                    <p>This will cancel all of your order</p>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="submit" name="deleteOrder" class="btn btn-primary">Delete Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) == 0) 
            {
                echo "
                <br><tr><td colspan='5'><div class='alert alert-info' role='alert'><br>
                <h4 class='alert-heading'>Your cart is empty!</h4>
                <p>Please add some items to your cart to continue shopping.</p>
                </div></td></tr>";
            }
            while($row = mysqli_fetch_array($result))
            {
              ?>
              <tr style="font-size: 18px">
                <td>
                    <div class="product-item">
                        <a class="product-thumb" href="#"> <img src="./images/<?php echo $row['productImage']?>" alt="Product"></a>
                        <div class="product-info">
                            <h4 class="product-title" style="font-size: 23px"> <a href="#"> <?php echo $row['productName']?> </a></h4><span style="font-size: 15px"> <em> Brand: </em> <?php echo $row['productBrand']?>
                        </span><span style="font-size: 15px"> <em> Size: </em> <?php echo $row['size_name']?></span>
                    </span><span style="font-size: 15px"> <em> Price: </em> <?php echo $row['productPrice']?></span>
                </div>
            </div>
        </td>
        <td class="text-left">
            <div class="count-input">
                <div class="form-group mb-0">
                    <input type="number" class="form-control " name="nn-<?php echo $row['cartID']?>" id="vv-<?php echo $row['cartID']?>" min="1" value="1">
                </div>
            </td>
            <td class="text-center text-lg text-medium">
                <b id="subtotal-<?php echo $row['cartID']?>">PHP <?php echo $row["productPrice"]?></b>
                <input type=hidden class="form-control " id="pp-<?php echo $row['cartID']?>" value="<?php echo $row['productPrice']?>"/>
            </td>

            <td class="text-center"><i class="fa fa-trash fa-xl"  class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $row['cartID']; ?>" data-cart-id="<?php echo $row['cartID'];?>" data-toggle="tooltip" title="" data-original-title="Remove item"></i></td>

            <!-- The Modal -->
            <div class="modal fade" id="myModal<?php echo $row['cartID']; ?>">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title"> Are you sure? </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="include/delete.inc.php" enctype="multipart/form-data">
                      <input type="hidden" id="UID" name="userID" value="<?php echo $_SESSION['id'] ?>">
                      <input type="hidden" id="cartID" name="cartID" value="<?php echo $row['cartID']; ?>">
                      <p> This will cancel your order <?php echo $row['productName']; ?>.</p>
                  </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="submit" name="deleteCart" class="btn btn-primary">Delete Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
</tr>
</tbody>

<?php 
}
?>                  
</table>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        updateTotal();
        $("input[id*=vv]*").on("change", function() {
            updateTotal();
        });
        
        
    });

    function prepare(){
        var vv = $("input[id*=vv]*").map(function () {
           return $(this).val();
       });

        $("input[id*=vb2]*").each( function( index ) {
           $(this).val(vv[index]);
       });
        updateModelCheckout();
    }

    function updateTotal(){
        var sum = 0;
        var vv = $("input[id*=vv]*").map(function () {
            return $(this).val();
        });

        var pp = $("input[id*=pp]*").map(function () {
           return $(this).val();
       });

        for (var i=0; i < vv.length; i++){
            sum += (parseFloat(vv[i]) * parseFloat(pp[i].split("PHP")));
        }
        

        $("span[id*=sst]*").text(sum.toFixed(2));
        var Subtot = $("span#sst").text();
        $("#subtotal").val(Subtot);


        updatesub();
    };

    function updatesub(){
        $("input[id*=vv]*").on("change", function() {
            var cartID = $(this).attr("id").replace("vv-", ""); // get cartID from input id
            var quantity = $(this).val();
            var price = $("#pp-" + cartID).val();
            var subtotal = quantity * price;
            $("#subtotal-" + cartID).text("PHP " + subtotal.toFixed(2)); // update subtotal text


        });
    };

    function updateModelCheckout(){
        var sum = 0;
        var shippingFee = parseFloat($("#shipFee").attr("value"));
        var vb = $("input[id*=vb2]*").map(function () {
            return $(this).val();
        });

        var pb = $("input[id*=pb2]*").map(function () {
            return $(this).val();
        });

        for (var i=0; i < vb.length; i++){
            sum += (parseFloat(vb[i]) * parseFloat(pb[i].split("PHP")));
        }

        sum += shippingFee; // Add the shipping fee for all products

        $("span[id*=totalShippingFee]*").text("PHP " + sum.toFixed(2));
        $("#shipFee").text("PHP " + shippingFee.toFixed(2));

        var totalShippingFee = $("span[id*=totalShippingFee]*").text("PHP " + sum.toFixed(2));
        var totaldecimal = parseFloat(totalShippingFee.text().replace("PHP ", "")).toFixed(2);
        $("#totalShippingFeeInput").val(totaldecimal);

        var ShippingFeeDef = $("#shipFee").text("PHP " + shippingFee.toFixed(2));
        var shipdecimal = parseFloat(ShippingFeeDef.text().replace("PHP ", "")).toFixed(2);
        $("#ShippingFeeInput").val(shipdecimal);

    };
</script>
<div class="shopping-cart-footer">
 <div class="column text-lg"> <h5><b> Cart Total:

 </b><span class="text-medium"> PHP <span id="sst"> 0 </span> </h5><span style="font-size:13px"> <em> "Shipping fee still not included proceed to checkout to know the total" </em></span></span></div>

</div>

<div class="shopping-cart-footer">
    <div class="column"><a class="btn btn-warning btn-lg font-weight-bold" href="productspage.php"><i class="icon-arrow-left"></i>&nbsp;Back to Shopping </a></div>
    <!-- Button trigger modal -->
    <div class="column">
        <?php if ($count == 0): ?>
            <div class="column">
                <button onclick="prepare()" type="button" class="btn btn-success btn-lg font-weight-bold" data-toggle="modal" data-target="#checkoutmodal" <?php if($count == 0){echo "disabled";}?>>
                 Checkout
             </button></div>
             <em class="text-muted" style="font-size:11px">"Checkout and Clear Cart is currently disabled as there are no items in your cart."</em>
         <?php else: ?>
            <button onclick="prepare()" type="button" class="btn btn-success btn-lg font-weight-bold" data-toggle="modal" data-target="#checkoutmodal">
              Checkout
          </button>
      <?php endif; ?>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="checkoutmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      <div class="modal-header">
        <h4 class='col-12 modal-title text-center' id="myModalLabel"> Checkout </h4>
    </div>
    <script>
  document.addEventListener('DOMContentLoaded', () => {
    const select = document.querySelector('select[name="formsuser"]');
    const button = document.querySelector('button[name="orderplace"]');

    button.disabled = true; // Disable the button by default

    select.addEventListener('change', () => {
      if (select.value === "Select Mode") {
        button.disabled = true;
      } else {
        button.disabled = false;
      }
    });

    const modal = document.getElementById('checkoutmodal');
    modal.addEventListener('shown.bs.modal', () => {
      button.disabled = true;
    });

    
  });
</script>

    <div class="modal-body">
        <div class="table-responsive shopping-cart">
            <div class="w-100 text-center">    

                <div class="container-fluid" id="msg" style="display: none;">
                    <div class="container text-center">
                        <br><h1 class= font-weight-bold> Thank you for your purchase! </h1>
                        <p class="lead w-lg-50 mx-auto">Your order has been placed successfully.</p>
                        <p class="w-lg-50 mx-auto">Your order number is <span id="OrderNumber"></span>. We will immediatelly process your order and it will be delivered in 2-4 clicks of admin. </p><button type="button" class="btn btn-danger" id="close"> Close </button>
                    </div>
                </div>
            </div>
            
            <form id="order-form" method="POST" action="order.inc.php">
                <div class="h5 px-4 py-3 bg-dark text-light font-weight-bold user-info"> 
                    User Information 
                </div>
                <select class="custom-select" name="formsuser"  onchange="toggleInput(this)" required>
                    <option value="Select Mode" disabled selected >Select Mode</option>
                    <option value='user-info1'>Automatic User Info</option>
                    <option value="user-info2">Manual User Info</option>
                </select>

                    <div class="card h-100 user-info1" style="display: none;">
                        <div class="card-body">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-2 text-primary">Please fill out the following information for delivery processes.</h6>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-firstname">
                                        <label for="fullName">First Name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $_SESSION['fname']?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $_SESSION['lname']?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone">Cellphone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $_SESSION['contact']?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $_SESSION['address']?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card h-100 user-info2" style="display: none;">
                        <div class="card-body">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-2 text-primary">Please fill out the following information for delivery processes.</h6>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-firstname">
                                        <label for="fullName">First Name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone">Cellphone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" required>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                    function toggleInput(selectElement) {
                          var selectedValue = selectElement.options[selectElement.selectedIndex].value;
                          var elementsToShow = document.getElementsByClassName(selectedValue);
                          for (var i = 0; i < elementsToShow.length; i++) {
                            elementsToShow[i].style.display = "block";
                          }
                          var allElements = document.querySelectorAll('.user-info1, .user-info2');
                          for (var i = 0; i < allElements.length; i++) {
                            if (!allElements[i].classList.contains(selectedValue)) {
                              allElements[i].style.display = "none";
                            }
                          }

                          if (selectedValue == 'user-info1') {
                            document.getElementById("firstname").removeAttribute("readonly");
                            document.getElementById("lastname").removeAttribute("readonly");
                            document.getElementById("phone").removeAttribute("readonly");
                            document.getElementById("address").removeAttribute("readonly");
                            document.getElementById("firstname").value = "<?php echo $_SESSION['fname']?>";
                            document.getElementById("lastname").value = "<?php echo $_SESSION['lname']?>";
                            document.getElementById("phone").value = "<?php echo $_SESSION['contact']?>";
                            document.getElementById("address").value = "<?php echo $_SESSION['address']?>";
                          }
                        }
                    </script>
                <br><br>
                <div class="w-100 text-center">
                  <div class="h5 px-4 py-3 bg-dark text-light font-weight-bold"> Checkout Information </div>
                  <input type="hidden" class="form-control" id="OrderNumberDisplay" name="NumberDisplay" value="">
              </div>        
              <div style="height: 300px; overflow-y: scroll; ">
                <table class="table">
                    <thead>
                        <thead>
                            <tr>
                                <th colspan="3"> 
                                </tr>
                            </thead>
                        </thead>
                        <tbody>
                         <?php
                         require './include/db.handler.inc.php';
                         if (!isset($_SESSION['id'])) {
                            header("Location: login.php");
                            exit();
                        }

                    // Get the user ID from the session
                        $userId = $_SESSION['id'];

                    // Join the tables to retrieve the relevant data for the current user
                        $sql = "SELECT * FROM cart 
                        INNER JOIN product ON cart.productID = product.productID 
                        INNER JOIN category ON product.categoryID = category.category_id 
                        INNER JOIN subcategory ON product.subcategoryid = subcategory.subCategoryID 
                        INNER JOIN size ON product.productSize = size.size_id 
                        WHERE cart.userId = ?";
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
                            <h4 class='alert-heading'>Your cart is empty!</h4>
                            <p>Please add some items to your cart to continue shopping.</p>
                            </div></td></tr>";
                        }
                        while($row = mysqli_fetch_array($result))
                        {
                          ?>
                          <tr style="font-size: 18px">
                            <td>
                                <div class="product-item">
                                    <a class="product-thumb" href="#"> <img src="./images/<?php echo $row['productImage']?>" alt="Product"></a>
                                    <div class="product-info">
                                        <h4 class="product-title" style="font-size: 23px"> <a href="#"> <?php echo $row['productName']?> </a></h4><span style="font-size: 15px"> <em> Brand: </em> <?php echo $row['productBrand']?>
                                    </span><span style="font-size: 15px"> <em> Size: </em> <?php echo $row['size_name']?> </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="col-2" style="max-width: 8rem;">
                                <div class="form-group">
                                    <br><input type="number" class="form-control text-center" id="vb2-<?php echo $row['cartID']?>" name="quantity[]" min="1" value="1" readonly>
                                    <span id="vv2-display-<?php echo $row['cartID']?>"> </span>
                                </div> 
                            </div>
                        </td>
                        <td>
                            <input type=hidden id="pb2-<?php echo $row['cartID']?>" value="<?php echo $row['productPrice']?>"/>
                        </td>
                        <td>
                            <input type="hidden" name="cartID[]" value="<?php echo $row['cartID'] ?>">
                            <input type="hidden" name="userID" value="<?php echo $_SESSION['id'] ?>">
                        </td>
                    </tr>

                </tbody>

                <?php 
            }
            ?>                  
        </table>
    </div>
    <div class="container">
        <div class="row">
          <div class="col">

              <div class="p-3 bg-light bg-opacity-10">

                <h4 class="card-title mb-3"> Order Summary </h4>
                <div class="d-flex justify-content-between mb-1 small">
                  <h6><span> Subtotal </span></h6> <h6> PHP <span id="sst2"> </span></h6>
                  <input type="hidden" id="subtotal" name="subtotal" value="">  
              </div>

              <div class="d-flex justify-content-between mb-1 small">
                  <h6><span>Shipping Fee</span></h6><h6><span id="shipFee" value="85"> </span></h6>
                  <input type="hidden" id="ShippingFeeInput" name="shippfee" value="">   
              </div>
              <h5 class="card-title mb-3"> Payment Options </h5>                
              <select id="paymentOptions" class="form-control" name="Cpayment">
                  <option> Cash On Delivery </option>
                  <option> Debit Card </option>
                  <option> Credit Card </option>                                    
              </select>
              <hr>
              <div class="d-flex justify-content-between mb-4 small">
                  <h5><span> TOTAL </span></h5> <h5><strong class="text-dark"> 
                     <span id ="totalShippingFee"> 0</span>
                     <input type="hidden" id="totalShippingFeeInput" name="total" value="">   
                 </strong></h5>
             </div>
             <button class="btn btn-warning w-100 mt-2" type="button" name="orderplace"> <b> Place order </b></button></b>
         </form>
     </div>
     <script type="text/javascript">
$("#checkoutmodal").ready(function() {
    // Generate order number
    var randomNumber = Math.floor(Math.random() * 100);
    var currentDate = Date.now();
    var OrderNumber = randomNumber.toString() + currentDate.toString();
    $('#OrderNumberDisplay').val(OrderNumber);
    console.log(OrderNumber);

    $('button[name="orderplace"]').click(submitOrderForm);

    function submitOrderForm() {
        // Get selected option
        var selectedOption = $('select[name="formsuser"]').val();
        var serializedData;

        if (selectedOption === "user-info1") {
            serializedData = $('.user-info1 :input').serialize();
        } else {
            serializedData = $('.user-info2 :input').serialize();
        }

        $.ajax({
            type: 'POST',
            url: "order.inc.php",
            data: $('#order-form').serialize() + '&' + serializedData,
            dataType: "json",
            success: function (response) {
                console.log("AJAX request succeeded!");
                console.log(response);
                console.log($('#order-form').serialize());
                if (response.success == true) {
                    $('#order-form').hide();
                    $('#msg').css('display', 'block');
                    // Display order number in thank you message
                    $('#OrderNumber').text(OrderNumber);
                } else if (response.success == false && response.message.startsWith("Not enough stock")) {
                    console.log(response.message);
                    alert("No stocks currently available, Sorry for the inconvenience");
                } else {
                    alert("Failed to place order. Please try again later.");
                };

            },
        });
    };

    // Show/hide user info forms based on selected option
    $('select[name="formsuser"]').on('change', function() {
        var selectedOption = $(this).val();
        $('.user-info1, .user-info2').hide();
        $('.' + selectedOption).show();
    });

    $('#close').click(function() {
        console.log("Close button clicked!");
        $('#msg').css('display', 'none');
        $('#order-form').show();
        $('#order-form')[0].reset();
        console.log("Modal hidden!");
        $('#checkoutmodal').modal('hide');
        location.reload();
    });
});
</script>


</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div><br><br>

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