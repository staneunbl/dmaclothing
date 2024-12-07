<!DOCTYPE html>
<html>
<head>
  <title> Admin - Customer </title>
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
        <table id="datatable" class="test" style="width:100%; text-align:center; background-color:ivory; color: black">
          <thead>
            <tr>
            <th colspan="7">
            <center>
            <?php
                echo "USERS PROFILE";
            ?>
            </center>          
            </th>
            </tr>
            </th>                            
            <tr>
              <th>
                Username
              </th>              
              <th>
                First Name
              </th>
              <th>
                Last Name
              </th>
              <th>
                Email
              </th>
              <th>
                Address
              </th>
              <th>
                Contact Number
              </th>              
              <th>
                Action
              </th>              
            </tr>
          <tbody>
          </thead>
                <?php
                    require './Include/db.handler.inc.php';

                    $sql = "SELECT userid, username, firstname, lastname, email, address, contactnumber FROM user_tbl";
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
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php echo $row['firstname'] ?></td>
                                    <td><?php echo $row['lastname'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['address'] ?></td>
                                    <td><?php echo $row['contactnumber'] ?></td>
                                    <td><div class="modal fade" id="delete-<?php echo $row['userid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel"> Delete User </h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                            </div>
                                            <div class="modal-body">
                                              <form method="post" action="include/delete.inc.php" enctype="multipart/form-data">
                                                      <center> Are you sure you want to delete this user? </center>
                                                      <input type="text" name="name" placeholder="To confirm put the Username here" required>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Cancel </button>
                                              <button type="submit" class="btn btn-success" name="delete">Proceed</button>
                                            </div>
                                          </div>
                                        </div>
                                        </div>
                                      </form>
                                          <button type="button" style="width:100px" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $row['userid'] ?>" >
                                          Delete
                                          </button>

                                      <div class="modal fade" id="modify-<?php echo $row['userid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h2 class='col-12 modal-title text-center' id="exampleModalLabel">
                                                <b> UPDATE USERS' PROFILE </b> </h2>
                                            </div>                                            
                                            <div class="modal-body">     
                                            <form class='col-11 modal-title text-center'method="post" action="include/update.inc.php" enctype="multipart/form-data">        
                                              User ID: <?php echo $row['userid'] ?>
                                              <input type="hidden" name="userid" value="<?php echo $row['userid'] ?>">
                                              
                                              <h6> <b> <a class="list-group-item"> UPDATE USERS' INFORMATION </a> </b> </h6>
                                              <input type="text" name="uname" placeholder="Username" value="<?php echo $row['username'] ?>">
                                              <input type="text" name="fname" placeholder="First name"value="<?php echo $row['firstname'] ?>">
                                              <input type="text" name="lname" placeholder="Last name"value="<?php echo $row['lastname'] ?>">     
                                              <input type="text" name="email" placeholder="E-mail"value="<?php echo $row['email'] ?>">
                                              <input type="text" name="address" placeholder="Address"value="<?php echo $row['address'] ?>">
                                              <input type="text" name="contactnumber" placeholder="Contact Number"value="<?php echo $row['contactnumber'] ?>">      


                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Close </button>
                                              <button type="submit" class="btn btn-success" name="btnUpdate"> Update </button>
                                            </div>
                                          </div>
                                        </div>
                                        </div>
                                          </form>
                                          <button type="button" style="width:100px" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="
                                          #modify-<?php echo $row['userid'] ?>">
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
  </section>
</div>      
 
<script type="text/javascript">
  $(document).ready( function () {
    $('#datatable').DataTable({
      "lengthMenu": [5, 10, 15, 20, 25, 50, 100]
    });
  } );
</script>

<br><br><br><br><br>
</body>
</html>