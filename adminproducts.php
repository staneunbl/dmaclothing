<!DOCTYPE html>
<html>
<head>
  <title> Admin - Products </title>
  <?php
  session_start();
  ?>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>      
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/7bc299d6e3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/adminhome.css"></link>
    <script type="text/javascript">
      var esc = $.Event("keydown", { keyCode: 27 });

      $(document).ajaxComplete(function(event, jqxhr, ajaxOptions) {
        var data = JSON.parse(jqxhr.responseText);
        var options = '';
        for (var i = 0; i < data.length; i++) {
          options += '<option value="' + data[i].key + '">' + data[i].text + '</option>';
        }
        $('#sub-subcategoryId').empty();  
        $('#sub-subcategoryId').append(options);  
      });

      $(document).on('change', '#cat-categoryId', function($event) {
        procfunc($event.target.value);
      });

      $(document).on('click', '#Close-Add-Button', function($event) {
        location.reload();
      });

      function closeModify() {
        $('.modal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        location.reload();
      };

      $(document).on('click', '#Cancel-Button', function($event) {
        location.reload();
      });

      function procfunc(categoryId)
      {
       const jqXHR =  $.ajax({
        type: 'GET',
        url: 'subcategoryid.php',
        datatype: 'json',
        data: {
          categoryId: categoryId
        }});

     }
   </script>
 </head>
</head>

<body>
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
<?php
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin01') {
  echo '<script>alert("You are not allowed to access this page.");window.location.href="login.php";</script>';
  exit();
}
?>

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
            <table id="datatable" class="test" style="text-align:center; background-color:ivory; color: black">
              <div class="col-lg-12">
                <thead>
                  <tr>
                    <th colspan="11">
                      <center>
                        <?php
                        echo "PRODUCTS";
                        ?>
                      </center>
                    </th>                
                  </tr>
                  <tr>
                    <th> Product ID </th>
                    <th> Category </th>
                    <th> Sub-Category </th>                             
                    <th> Product Name </th>
                    <th> Product Image </th>
                    <th> Product Brand </th>              
                    <th> Product Description </th>
                    <th> Product Size </th>
                    <th> Product Price </th>
                    <th> Product Stock </th>              
                    <th> Action </th>                                                              
                  </tr>            
                  <tbody>
                  </thead>
                  <?php
                  require './include/db.handler.inc.php';

                  $sql = "SELECT * FROM product INNER JOIN category ON product.categoryID=category.category_id
                  INNER JOIN subcategory ON product.subcategoryid = subcategory.subCategoryID
                  INNER JOIN size ON product.productSize = size.size_id";
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

                    while($row = mysqli_fetch_array($result))
                    {
                      ?>              
                      <tr>
                        <td><?php echo $row['productID'] ?></td>
                        <td><?php echo $row['categoryID'] ?> - <?php echo $row['category_name'] ?></td> 
                        <td><?php echo $row['subcategoryID']?> - <?php echo $row['subCategory'] ?></td>
                        <td><?php echo $row['productName']; ?></td>

                        <td><img src="images/<?php echo $row['productImage'] ?>" height="80" width="80"></td>

                        <td><?php echo $row['productBrand']; ?></td>
                        <td><div class="modal" id="view-<?php echo $row['productID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h2 class='col-12 modal-title text-center' id="exampleModalLabel">
                                  <b> View Product "<?php echo $row['productName']; ?>" Description </b> </h2>
                                </div>
                                <div class="modal-body">
                                  <?php echo $row['productDesc']; ?>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" onclick="closeModify()" id="#Close-View-Button" data-bs-dismiss="modal"> Close </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>

                      <button type="button" style="width:100px" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#view-<?php echo $row['productID'] ?>">
                        View Desc
                      </button></td>                    

                      <td><?php echo $row['productSize']; ?> - <?php echo $row['size_name'] ?></td>                    
                      <td><?php echo $row['productPrice']; ?></td> 
                      <td><?php echo $row['productStock']; ?></td>                    
                      <td>
                        <div class="modal" id="delete-<?php echo $row['productID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"> Delete product </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                              </div>
                              <div class="modal-body">
                                <form method="post" action="include/delete.inc.php" enctype="multipart/form-data">
                                  <cemter>Are you sure you want to delete this product? Product ID: <?php echo $row['productID'] ?></center>
                                   <input type="hidden" value="<?php echo $row['productID'] ?>" name="productid">       
                                 </div>
                                 <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" id="Cancel-Button" data-bs-dismiss="modal"> Cancel </button>
                                  <button type="submit" class="btn btn-success" name="deleteprod">Proceed</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>

                        <button type="button" style="width:100px" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $row['productID'] ?>" >
                          Delete
                        </button>

                        <div class="modal" id="Modify-<?php echo $row['productID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h2 class='col-12 modal-title text-center' id="exampleModalLabel">
                                  <b> MODIFY PRODUCT INFORMATION </b> </h2>
                                </div>
                                <div class="modal-body">

                                  <form class='col-11 modal-title text-center' action="include/update.product.inc.php" method="post" enctype="multipart/form-data">

                                    Product ID: <?php echo $row['productID'] ?><br>
                                    <input type="hidden" name="productId" value="<?php echo $row['productID']; ?>">   

                                    <h6> <b> <a class="list-group-item"> UPDATE PRODUCT INFORMATION </a> </b> </h6>
                                    <input type="text" name="productName" placeholder="Product Name" value="<?php echo $row['productName']; ?>">          
                                    <input type="text" name="productBrand" placeholder="Product Brand" value="<?php echo $row['productBrand']; ?>">
                                    <input type="text" name="productDesc" placeholder="Product Description" value="<?php echo $row['productDesc']; ?>">

                                    <input type="text" name="productPrice" placeholder="Product Price" value="<?php echo $row['productPrice']; ?>">          
                                    <input type="text" name="productStock" placeholder="Product Quantity" value="<?php echo $row['productStock']; ?>">
                                    <br><br>

                                    <h6> <b> <a class="list-group-item"> UPDATE PRODUCT IMAGE </a> </b> </h6>
                                    <input type="file" name="productpic" placeholder="Product Image">                
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" onclick="closeModify();" class="btn btn-danger" id="#Modify-Button"> Close </button>
                                    <input type="submit" class="btn btn-success" name="modifyproduct" value="Modify Product">
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
                        </script>
                      </td>                                    
                    </tr>
                    <?php
                  }
                }
                ?>                      
              </th>           
            </table>

            <div class="container">
              <div class="row">
                <div class="col-lg-12 text-center">

                  <br>
                  <table style="width:100%; text-align:center; background-color:ivory; color: black;">
                    <thead>
                      <th style="border-radius: 10px;">
                        <?php
                        echo "ADD PRODUCTS ";
                        ?>
                      </th>                 
                    </thead>
                    <tbody>
                      <td>



                        <!-- Modal -->
                        <div class="modal" id="Add-Product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h2 class='col-12 modal-title text-center' id="exampleModalLabel">
                                  <b> ADD PRODUCT </b> </h2>
                                </div>
                                <div class="modal-body">

                                  <form class='col-11 modal-title text-center' method="post" action="include/upload.inc.php" enctype="multipart/form-data">

                                    <h6> <b> <a class="list-group-item"> SELECT PRODUCT CATEGORY </a> </b> </h6>             
                                    <select id="cat-categoryId" class="custom-select" name="categoryId" placeholder="Category"> <option selected disabled> Open to Select Product Category </option>

                                      <?php  
                                      $sqlCategory = "SELECT * FROM category";
                                      $stmtCheckCategory = mysqli_stmt_init($conn);
                                      if(!mysqli_stmt_prepare($stmtCheckCategory,$sqlCategory))
                                      {
                                        header("location: ../adminproducts.php?error=sqlerror");
                                        exit();
                                      }
                                      else
                                      {
                                        mysqli_stmt_execute($stmtCheckCategory);
                                        $resultCategory = mysqli_stmt_get_result($stmtCheckCategory);

                                        while($rowCategory = mysqli_fetch_array($resultCategory))
                                        {

                                          ?>
                                          <option id="category-<?php echo $rowCategory['category_id']?>" value="<?php echo $rowCategory['category_id']?>"> <?php echo $rowCategory['category_name']; ?>
                                        </option>  

                                        <?php 
                                      }
                                    }

                                    ?>        
                                  </select><br>

                                  <br> <h6> <b> <a class="list-group-item"> SELECT PRODUCT SUB-CATEGORY </a> </b> </h6>             
                                  <select id="sub-subcategoryId" class="custom-select" name="subcategoryId" placeholder="Sub Category"> >
                                  </select><br>

                                  <br> <h6> <b> <a class="list-group-item"> SELECT PRODUCT SIZE </a> </b> </h6>             
                                  <select class="custom-select" name="productSize" placeholder="Product Size">

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
                                      </option>

                                      <?php 
                                    }
                                  }

                                  ?>                                      
                                </select><br>

                                <br> <h5> <b> <a class="list-group-item"> PRODUCT INFORMATION </a> </b> </h5>             
                                <input type="text" name="productName" placeholder="Product Name">          
                                <input type="text" name="productBrand" placeholder="Product Brand">
                                <input type="text" name="productDesc" placeholder="Product Description">          
                                <input type="text" name="productPrice" placeholder="Product Price">          
                                <input type="text" name="productStock" placeholder="Product Quantity">
                                <br>

                                <br> <h5> <b> <a class="list-group-item"> UPLOAD PRODUCT IMAGE </a> </b> </h5>             
                                <input type="file" name="productpic" placeholder="Product Image">   

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" id="Close-Add-Button" data-bs-dismiss="modal"> Close </button>
                                <input type="submit" class="btn btn-success" name="submitpic" value="Add Product"> 
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                      <!-- END of Modal -->


                    </div>
                  </section>

                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Add-Product">
                    Add Product
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
                  </script>
                </td>                                    
              </tr>
            </th>           
          </table>
        </div>
      </div>
    </div>      
  </div>
</div>
</div>

</section>
</div>

<script type="text/javascript">
  $(document).ready( function () {
    $('#datatable').DataTable({
      "lengthMenu": [5, 10, 15, 20, 25, 50, 100]
    });
  } );
</script>


</body>

</html>