<!DOCTYPE html>
<html>
<head>
  <title> Admin - Order Status </title>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/adminhome.css"></link>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://kit.fontawesome.com/7bc299d6e3.js" crossorigin="anonymous"></script>
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

  <i class="fas fa-bars"></i></button>
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
            <div class="col-lg-12">

              <table id="datatable" class="test" style="width:100%; text-align:center; background-color:ivory; color: black">
                <thead>
                  <tr>
                    <th colspan="8">
                      <center>
                        <?php
                        echo "ORDER STATUS";
                        ?>
                      </center>          
                    </th>
                  </tr>
                </th>                            
                <tr>
                  <th>
                    Order Numbers
                  </th>              
                  <th>
                    Order Date
                  </th>
                  <th>
                    Full Name
                  </th>              
                  <th>
                    Contact Number
                  </th>
                  <th>
                    Payment Status
                  </th>
                  <th>
                    Order Status
                  </th> 
                  <th>
                    Order Status Option
                  </th>                                                                        
                </tr>
                <tbody>
                </thead>
                <?php
                require './include/db.handler.inc.php';

                $sql = "SELECT orderID, cartID, productID, CONCAT(firstname, ' ', lastname) AS fullname, phone, address, paymentoptions, total, orderdate, ordernumber, shippingfee, subtotal, delivery_status, productName, productStock, quantity, paymentstatus
                FROM order_tbl
                GROUP BY ordernumber";


                $stmtCheck = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmtCheck,$sql))
                {
                  header("location: ../login.php?error=sqlerror");
                  exit();
                }
                else
                {
                  mysqli_stmt_execute($stmtCheck);
                  $result = mysqli_stmt_get_result($stmtCheck);

                  while($row = mysqli_fetch_assoc($result))
                  {
                    ?>
                    <tr>
                      <td><?php echo $row['ordernumber'] ?></td>
                      <td><?php echo $row['orderdate'] ?></td>
                      <td><?php echo $row['fullname'] ?></td>
                      <td><?php echo $row['phone'] ?></td>
                      <td><?php echo $row['paymentstatus'] ?></td>
                      <td><?php echo $row['delivery_status'] ?></td>
                      <td>
                        <form method="post" action="updatepaystatus.php">
                          <select id="vv-<?php echo $row['orderID']?>" class="custom-select" name="deliveryStatus" onchange="updateDeliveryStatus(this)">
                            <option selected disabled>Select an option</option>
                            <option value="placed order (processing)"> placed order (processing) </option>
                            <option value="Delivered (Waiting to Receive)"> Delivered (Waiting to Receive) </option>
                            <option value="Complete" disabled> Complete <em>(disabled)</em></option>
                          </select>
                          <input type="hidden" name="orderNumber" value="<?php echo $row['ordernumber']?>">
                          <input type="hidden" name="deliveryStatusInput" id="deliveryStatusInput" value="<?php echo $row['delivery_status']?>">
                          <button type="submit" name="buttonfinished" class="btn btn-dark btn-md btn-block"> Submit </button>
                        </form>

                        <script>
                          function updateDeliveryStatus(selectElement) {
                            var selectedValue = selectElement.value;
                            var deliveryStatus;
                            switch (selectedValue) {
                            case "placed order (processing)":
                              deliveryStatus = "Placed Order (Processing)";
                              break;
                            case "Delivered (Waiting to Receive)":
                              deliveryStatus = "Delivered (Waiting to Receive)";
                              break;
                            case "Complete":
                              deliveryStatus = "Complete";
                              break;
                            default:
                              deliveryStatus = "";
                            }
                        // Update the hidden input field with the delivery status
                            document.getElementById("deliveryStatusInput").value = deliveryStatus;
                          }
                        </script>
                      </td>
                    </tr>
                    <?php
                  }

                }
                ?>
              </table>
            </div>
          </div>
        </div>

      </div>      
    </div>
  </section>
</div>
<br><br><br>

<script>
  const $button  = document.querySelector('#sidebar-toggle');
  const $wrapper = document.querySelector('#wrapper');

  $button.addEventListener('click', (e) => {
    e.preventDefault();
    $wrapper.classList.toggle('toggled');
  });
</script>

<script type="text/javascript">
  $(document).ready( function () {
    $('#datatable').DataTable({
      "lengthMenu": [5, 10, 15, 20, 25, 50, 100]
    });
  } );
</script>
<br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br>
</body>
</html>