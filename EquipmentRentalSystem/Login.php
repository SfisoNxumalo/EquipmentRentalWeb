<?php

$username = sanitizeString(Filter_input(INPUT_POST, 'UserName'));
$password = sanitizeString(Filter_input(INPUT_POST, 'Password'));
$role1 ="Admin";
$role2 = "RegisteredUser";



if(!empty($username) || !empty($password))
{	
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "password";
    $dbname = "ecommerce";

    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);		//makes connection to the database, using the provided database information.

    if(mysqli_connect_error())
    {
            die('Connect Error ('.mysqli_connect_errno().')'.mysqli_connect_error()); 		// Error message to be shown when connection to the database fails, "die" kills the connection.
    }
    else 	//if connection to the database is successful the php file will write data into the database.
    { 

        $sql = "SELECT * FROM system_users WHERE USERNAME = '$username' AND PASSWORD = '$password'";		
        $result = mysqli_query($conn, $sql);

            if($conn->query($sql))		
            {

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $count = mysqli_num_rows($result);

                if($count != 0)
                {
                    session_start();
                    switch ($row['ROLE']) 
                    {
                        case $role1:

                        $_SESSION['Lusername'] = $username;
                        header("Location: AdminEquipmentRentalSystem.php");
                            break;
                        
                        case $role2:
                            
                            $_SESSION['Lusername'] = $username;
                         header("Location: Product.php");

                        default:
                            echo '<script>alert("Login failed.")</script>';
                            break;
                    }
                    
                }
                else
                {
                   echo '<script>alert("Login failed, User not found.")</script>';

                    header( "Refresh:0; url=SignIn.html", true, 303);
                }     			
            }
            else
            {
                    echo "Error: ". $sql . "<br>" . $conn->error;
            }
            $conn->close(); 	 	//This ends the connection between the database and the website.
    }
}
else 		//if any info is missing on the "I GET INVOLVED" form, error message to be shown. 
{
	echo "One of the fields is empty, Please provide the required information.";
	die();		//kills connection.
}

function sanitizeString($var)
        {
            if(get_magic_quotes_gpc())
            {
                $var = stripslashes($var);
                $var = strip_tags($var);
                $var = htmlentities($var);
            }
            
            return $var;
        }

                ?>