<?php
session_start();
//to ensure you are using same session
if(isset($_SESSION['Lusername']) )
{
    session_destroy(); //destroy the session

    header("location:/index.php"); //to redirect back to "index.php" after logging out
    exit();
}
else
{
    echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
}
?>