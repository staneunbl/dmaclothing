<!DOCTYPE html>
<html>
<head>
  <title> Admin - Dashboard </title>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7bc299d6e3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/adminhome.css"></link>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>    
    <script type="text/javascript">
      function closeModify() {
        $('.modal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        location.reload();
      };

      $(document).on('click', '#Close-Button', function($event) {
          location.reload();
      });
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin01') {
    echo '<script>alert("You are not allowed to access this page.");window.location.href="login.php";</script>';
    exit();
}
?>

        <div class="container">
          <div class="row">
            <div class="col-lg-12">

              <table id="datatable" class="test" style="width:100%; text-align:center; background-color:ivory; color: black">
                <thead>
                  <tr>
                    <th colspan="9">
                      <center>
                        SALES AND INVENTORY
                      </center>          
                    </th>
                  </tr>
                </th>                            
                <tr>
                  <th>
                    Product ID
                  </th>
                  <th>
                    Product Image
                  </th>               
                  <th>
                    Product Name
                  </th>
                  <th>
                    Product Brand
                  </th>              
                  <th>
                    Price Value
                  </th>
                  <th>
                    Available Stocks
                  </th> 
                  <th>
                    Update Stocks
                  </th>
                  <th>
                    Expected Sales (From processed orders)
                  </th>   
                  <th>
                    Total Sales
                  </th>                                                          
                </tr>
                <tbody>
                </thead>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "dmaclothing";

                $conn = mysqli_connect($servername,$username,$password,$dbname);
                if(!$conn)
                {
                  die("Cant connect to database");
                }

                $sql = "SELECT p.*, IFNULL(SUM(o.quantity * p.productPrice), 0) AS total_sales
                FROM product p
                LEFT JOIN order_tbl o ON o.productId = p.productId
                GROUP BY p.productId;";

                $stmtCheck = mysqli_stmt_init($conn);
                
                if(!mysqli_stmt_prepare($stmtCheck,$sql))
                {
                  header("location: ../adminproducts.php?error=sqlerror");
                  exit();
                }
                else
                {
                  mysqli_stmt_execute($stmtCheck);
                  $result = mysqli_stmt_get_result($stmtCheck);
                  ?>
                  <?php

                  while($row = mysqli_fetch_assoc($result))
                  {
                    ?>
                    <tr>
                      <td><?php echo $row['productID'] ?></td>
                      <td><img src="images/<?php echo $row['productImage'] ?>" height="80" width="80"></td>
                      <td><?php echo $row['productName'] ?></td>
                      <td><?php echo $row['productBrand'] ?></td>
                      <td><?php echo $row['productPrice'] ?></td>
                      <td><?php echo $row['productStock'] ?></td>
                      <td><div class="modal" id="Modify-<?php echo $row['productID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h2 class='col-12 modal-title text-center' id="exampleModalLabel">
                                <b> MODIFY PRODUCT INFORMATION </b> </h2>
                              </div>
                              <div class="modal-body">

                                <form class='col-11 modal-title text-center' action="include/update.product.inc.php" method="post" enctype="multipart/form-data">
                                  <input type="hidden" name="productId" value="<?php echo $row['productID']; ?>">   
                                  <em>"Out of stocks? or just stocking up? well introducing stock button</em>
                                  <h6> <b> <a class="list-group-item"> UPDATE PRODUCT AVAILABLE STOCKS </a> </b> </h6>        
                                  <input type="text" name="productStock" placeholder="Product Quantity" value="<?php echo $row['productStock']; ?>">           
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" onclick="closeModify();" id="Close-Button" data-bs-dismiss=""> Close </button>
                                  <input type="submit" class="btn btn-success" name="updateproductstocks" value="Update Stocks">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>

                      <button type="button" style="width:100px" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modify-<?php echo $row['productID'] ?>">
                        Update
                      </button>

                      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"> </script>
                      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"> </script>

                      <script>
                        const $button  = document.querySelector('#sidebar-toggle');
                        const $wrapper = document.querySelector('#wrapper');

                        $button.addEventListener('click', (e) => {
                          e.preventDefault();
                          $wrapper.classList.toggle('toggled');
                        });
                      </script></td>                                   
                      <td><?php echo $row['total_sales']?></td>
                      <td><?php echo $row['total_sales']?></td>
                      
                    </thbody>                                                                     
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
</div>
</section>
</div>      

<br><br><br><br><br><br><br><br>

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