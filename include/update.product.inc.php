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
    
    if(isset($_POST['modifyproduct']))
    {

        $productName = $_POST['productName'];
        $productBrand = $_POST['productBrand'];
        $productPrice = $_POST['productPrice'];
        $productStock = $_POST['productStock'];
        $productDesc = $_POST['productDesc'];
        $productId = $_POST['productId'];

            if(empty($productName)) {
            echo '<script>alert("Please enter a product name");window.location.href="../adminproducts.php";</script>';
            exit();
        }
            if(empty($productBrand)) {
            echo '<script>alert("Please enter a product brand");window.location.href="../adminproducts.php";</script>';
            exit();
        }
            if(empty($productDesc)) {
            echo '<script>alert("Please enter a product description");window.location.href="../adminproducts.php";</script>';
            exit();
        }
            if(empty($productPrice)) {
            echo '<script>alert("Please enter a product price");window.location.href="../adminproducts.php";</script>';
            exit();
        }
            if(empty($productStock)) {
            echo '<script>alert("Please enter a product stock quantity");window.location.href="../adminproducts.php";</script>';
            exit();
        }
        
        if(!filter_var($productPrice, FILTER_VALIDATE_FLOAT)) {
            $errorMsg = "Product price should be a valid float value.";
            header("Location: ../adminproducts.php?msg=$errorMsg");
            exit();
          }

          // Validate Product Quantity
        if(!filter_var($productStock, FILTER_VALIDATE_INT)) {
            $errorMsg = "Product quantity should be a valid integer value.";
            header("Location: ../adminproducts.php?msg=$errorMsg");
            exit();
          }


        $query = "UPDATE product SET ";
        $params = array();
        $productImage = null; 

        if(!empty($_FILES['productpic']['name'])) {
            $file = $_FILES['productpic'];
            $fileName = $_FILES['productpic']['name'];
            $fileTmpName = $_FILES['productpic']['tmp_name'];
            $fileSize = $_FILES['productpic']['size'];
            $fileError = $_FILES['productpic']['error'];
            $fileType = $_FILES['productpic']['type'];

            $fileExt = explode('.',$fileName);

            $fileActualExtension = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'psd','tiff');

            if(in_array($fileActualExtension, $allowed)) {
                if($fileError === 0) {
                    if($fileSize < 1000000) {
                        $fileNewName = $productName . "." . $fileActualExtension;
                        $fileDirectory = "../images/".$fileNewName;
                        move_uploaded_file($fileTmpName, $fileDirectory);

                        $productImage = $fileNewName;

                        $query .= "productImage = ?, productName = ?, productBrand = ?, productDesc = ?, productPrice = ?, productStock = ? WHERE productId = ?;";
                        array_push($params, $productImage, $productName, $productBrand, $productDesc, $productPrice, $productStock, $productId);

                    }
                    else {
                        header("Location: ../adminproducts.php?msg=Your+file+is+too+big+to+be+uploaded!");
                        exit();
                    }
                }
                else {
                    header("Location: ../adminproducts.php?msg=Error+uploading+the+file");
                    exit();
                }
            }
            else {
                header("Location: ../adminproducts.php?msg=File+type+is+not+allowed!");
                exit();
            }
        }
        else
        {
            $sql = "SELECT productImage FROM product WHERE productId = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../adminproducts.php?error");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, 'i', $productId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($result)) {
                    $productImage = $row['productImage'];
                $query .= "productImage = ?, productName = ?, productBrand = ?, productDesc = ?, productPrice = ?, productStock = ? WHERE productId = ?;";
                array_push($params, $productImage, $productName, $productBrand, $productDesc, $productPrice, $productStock, $productId);
                }
            }
        }


        $stmt = mysqli_stmt_init($conn);
       
        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../adminproducts.php?error");
            exit();
        }
        else {
            // mysqli_stmt_bind_param($stmt, str_repeat('ssssiib', count($params)/6), ...$params);
            mysqli_stmt_bind_param($stmt, 'ssssdii', ...$params);
            mysqli_stmt_execute($stmt);

            if(mysqli_affected_rows($conn) > 0) {
                header('Location: ../adminproducts.php?uploadsuccess');
                exit();
            }
            else {
                header('Location: ../adminproducts.php?sqlerror');
                exit();
            }
        }

    }
elseif(isset($_POST['updateproductstocks'])){
    // get the product ID and the new stock from the form
    $productId = $_POST['productId'];
    $productStock = $_POST['productStock'];

    // update the product stock in the database
    $query = "UPDATE product SET productstock = $productStock WHERE productID = $productId";
    $result = mysqli_query($conn, $query);

    // check if the update was successful
    if($result){
        echo "<script>alert(\"Product stock updated successfully\");window.location.href=\"../adminsales.php\";</script>";
    } else {
        echo "<script>alert(\"Product stock update error: " . mysqli_error($conn) . "\");window.location.href=\"../adminsales.php\";</script>";
    }
}
?>