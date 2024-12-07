<?php
session_start();

// Initialize last login attempt
if (!isset($_SESSION['last_login_attempt'])) {
    $_SESSION['last_login_attempt'] = 0;
}

if (isset($_POST['loginbtn'])) {
    if (empty($_POST['user']) || empty($_POST['pass'])) {
        header("location: ../login.php?error=emptyfields");
        exit();
    }

    require 'db.handler.inc.php';

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // Escape special characters in username and password
    $user = mysqli_real_escape_string($conn, $user);
    $pass = mysqli_real_escape_string($conn, $pass);

    $sql = "SELECT * FROM user_tbl WHERE username = ? OR email = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../login.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $user, $user);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Check password
            $passwordCheck = password_verify($pass, $row['password']);
            if ($passwordCheck == true && $pass != "12345" && $user != "admin01") {
                // Successful login info
                $_SESSION['user'] = $user;
                $_SESSION['id'] = $row['userid'];
                $id = $_SESSION['id'];
                $_SESSION['address'] = $row['address'];
                $_SESSION['contact'] = $row['contactnumber'];
                $_SESSION['cart'] = $row['cartID'];
                $_SESSION['fname'] = $row['firstname'];
                $_SESSION['lname'] = $row['lastname'];
                $_SESSION['email'] = $row['email'];

                // Para mareset login attempts
                $_SESSION['login_attempts'] = 0;
                $_SESSION['password_attempts'] = 0;

                // Reset last login attempt
                $_SESSION['last_login_attempt'] = 0;

                header("location:../userspage.php");
                exit();
            } else if ($passwordCheck == true && $pass == "12345" && $user == "admin01") {
                // Successful admin login info
                $_SESSION['user'] = $user;
                $_SESSION['id'] = $row['userid'];
                $_SESSION['fname'] = $row['firstname'];
                $_SESSION['lname'] = $row['lastname'];

                // Para mareset login attempts
                $_SESSION['login_attempts'] = 0;
                $_SESSION['password_attempts'] = 0;

                // Reset last login attempt
                $_SESSION['last_login_attempt'] = 0;

                header("location:../adminhome.php");
                exit();
            } else {
                // Invalid password <-eto dto madaming error
                $_SESSION['password_attempts'] += 1;

                // Check if password attempts have exceeded limit
                if ($_SESSION['password_attempts'] >= 3) {
                    $_SESSION['login_attempts'] += 1;

                    // Update last login attempt
                    $_SESSION['last_login_attempt'] = time();

                    header("location: ../login.php?error=toomanypasswordattempts");
                    exit();
                }

                // Check if login attempts have exceeded limit
                if ($_SESSION['login_attempts'] >= 3) {

                    // Update last login attempt
                     header("location: ../login.php?error=toomanyloginattempts");
                exit();
            }

            header("location: ../login.php?error=wrongpassword");
            exit();
        }
    } else {
        // User does not exist in database
        header("location: ../login.php?error=nouser");
        exit();
    }
}
} else {
header("location: ../login.php?error=forbidden");
exit();
}
?>