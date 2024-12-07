<?php
require 'db.handler.inc.php';
if(isset($_POST['deleteprod'])) //Deletes the product from db
{
    

    $productID = $_POST['productid'];
    $sql = "DELETE FROM product WHERE productID = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        header("location: ../adminproducts.php?error=sqlerror");
        exit();
    }
    else
    {
        mysqli_stmt_bind_param($stmt,"i",$productID);
        mysqli_stmt_execute($stmt);
        header("location: ../adminproducts.php?delete=success");
    }
}

else if(isset($_POST['delete'])) //Deletes the user from db
{

    $user = $_POST['name'];
    $sql = "DELETE FROM user_tbl WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        header("location: ../admincustomer.php?error=sqlerror");
        exit();
    }
    else
    {
        mysqli_stmt_bind_param($stmt,"s",$user);
        mysqli_stmt_execute($stmt);
        header("location: ../admincustomer.php?delete=success");
    }
}

else if(isset($_POST['deleteinq'])) //Deletes the inquiry from db
{

    $id = $_POST['userID'];
    $sql = "DELETE FROM inquiry_tbl WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        header("location: ../admininquiry.php?error=sqlerror");
        exit();
    }
    else
    {
        mysqli_stmt_bind_param($stmt,"i",$id);
        mysqli_stmt_execute($stmt);
        header("location: ../admininquiry.php?delete=success");
    }
}

else if(isset($_POST['deleteOrder']))
{
    $order = $_POST['userID'];
        $sql = "DELETE FROM cart WHERE userid = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        header("location: ../cart.php?error=sqlerror");
        exit();
    }
    else
    {
        mysqli_stmt_bind_param($stmt,"i",$order);
        mysqli_stmt_execute($stmt);
        header("location: ../cart.php?delete=success");
    }
}

else if(isset($_POST['deleteCart']))
{
    $cart = $_POST['cartID'];
        $sql = "DELETE FROM cart WHERE cartid = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        header("location: ../cart.php?error=sqlerror");
        exit();
    }
    else
    {
        mysqli_stmt_bind_param($stmt,"i",$cart);
        mysqli_stmt_execute($stmt);
        header("location: ../cart.php?delete=success");
    }
}

?>