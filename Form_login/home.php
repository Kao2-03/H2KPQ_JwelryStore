<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])){

    ?>
    <!DOCTYPE html>
    <html>
    <head>

    <title>HOME</title></title>
    </head>
    <body>
        <h1>Hello, <?php echo $_SESSION['user_name']; ?></h1>
        <a href="logout.php">Logout</a>
     </body>   
    <?php
}
else{
    header("Location: index.php");
    exit();
}
?>