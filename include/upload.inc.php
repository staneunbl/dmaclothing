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

    if(isset($_POST['submitpic']))
    {

        $file = $_FILES['productpic'];
        $fileName = $_FILES['productpic']['name'];
        $fileTmpName = $_FILES['productpic']['tmp_name'];
        $fileSize = $_FILES['productpic']['size'];
        $fileError = $_FILES['productpic']['error'];
        $fileType = $_FILES['productpic']['type'];

        $fileExt = explode('.',$fileName);

        $fileActualExtension = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'psd','tiff');

        $categoryId = $_POST['categoryId'];
        $subcategoryId = $_POST['subcategoryId'];
        $productName = $_POST['productName'];
        $productBrand = $_POST['productBrand'];
        $productDesc = $_POST['productDesc'];
        $productSize = $_POST['productSize'];
        $productPrice = $_POST['productPrice'];
        $productStock = $_POST['productStock'];

        if(empty($categoryId)) {
            echo '<script>alert("Please select a category");window.location.href="../adminproducts.php";</script>';
            exit();
        }
            if(empty($subcategoryId)) {
            echo '<script>alert("Please select a sub-category");window.location.href="../adminproducts.php";</script>';
            exit();
        }
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
            if(empty($productSize)) {
            echo '<script>alert("Please enter a product size");window.location.href="../adminproducts.php";</script>';
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


        if(in_array($fileActualExtension, $allowed)) //check if the file is listed under allowed array
        {
            if($fileError === 0)
            {
                if($fileSize < 1000000) //limits the upload to 1000000 bytets
                {
                    $fileNewName = $productName
                    .".".$fileActualExtension;
                    $fileDirectory = "../images/".$fileNewName;
                    move_uploaded_file($fileTmpName, $fileDirectory);

                    $productImage = $fileNewName;
                    
                    $query = false;

                    $sql = "INSERT INTO product (categoryid, subcategoryid,
                    productImage, productName, productBrand, productSize, productDesc, productPrice, productStock) 
                    VALUES (?,?,?,?,?,?,?,?,?);";

                    $stmt = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt,$sql))
                    {
                        header("location: ../adminproducts.php?error");
                        exit();
                    }
                    else
                    {
                        mysqli_stmt_bind_param($stmt, "iisssssii", $categoryId, $subcategoryId, $productImage, $productName, $productBrand, $productSize, $productDesc, $productPrice, $productStock);
                        mysqli_stmt_execute($stmt);
                        $query = true;
                    }

                    if($query)
                    {
                        echo '<script>alert("Add Product Success");window.location.href="../adminproducts.php";</script>';
                    }
                    else
                    {
                        header('Location: ../adminproducts.php?sqlerror');
                    }
                }
                 else {
                    echo '<script>alert("File too big for upload!");window.location.href="../adminproducts.php";</script>';
                    exit();
                }
            }
            else {
                echo '<script>alert("Error Uploading the File!");window.location.href="../adminproducts.php";</script>';
                exit();
            }
        }
        else {
            echo '<script>alert("File type not allowed kindly refer to this jpg, png, jpeg, psd and tiff");window.location.href="../adminproducts.php";</script>';
            exit();
        }
    }
?>