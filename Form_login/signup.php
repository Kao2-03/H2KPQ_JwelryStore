<?php
session_start();
include "db_conn.php";

// Enable error reporting

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    }

    // Check if the username already exists
    $sql = "SELECT * FROM users WHERE user_name='$uname'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        exit();
    }

    if (mysqli_num_rows($result) > 0) {
        header("Location: index.php?error=The username is already taken");
        exit();
    } else {
        // Insert the new user into the database
        $sql2 = "INSERT INTO users( user_name, password) VALUES( '$uname', '$pass')";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2) {
            $_SESSION['user_name'] = $uname;
            $_SESSION['id'] = mysqli_insert_id($conn);
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}

