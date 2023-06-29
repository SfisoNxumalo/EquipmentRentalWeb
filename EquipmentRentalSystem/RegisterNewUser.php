<?php

$firstname = sanitizeString(Filter_input(INPUT_POST, 'first_name'));
$lastname = sanitizeString(Filter_input(INPUT_POST, 'last_name'));
$username = sanitizeString(Filter_input(INPUT_POST, 'username'));
$password = sanitizeString(Filter_input(INPUT_POST, 'password'));
$role = 'RegisteredUser';
$email = sanitizeString(Filter_input(INPUT_POST, 'email'));
$phone = sanitizeString(Filter_input(INPUT_POST, 'phone'));
$Gender = sanitizeString(Filter_input(INPUT_POST, 'Gender'));

if(!empty($firstname) || !empty($lastname)|| !empty($username) || !empty($password) || !empty($email) || !empty($phone) || !empty($Gender))
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
			$sql = "INSERT INTO system_users (FULLNAME, SURNAME, GENDER, USERNAME, PASSWORD, ROLE, PHONE, EMAIL) values('$firstname', '$lastname', '$Gender', '$username', '$password', '$role', '$phone', '$email')";		//SQL code that writes data into the database.
			
			if($conn->query($sql))		//when information is added to the databse successfully the messgage below is what the user will see.
			{
                            session_start();
                            $_SESSION['Lusername'] = $username;
                           echo '<script>alert("Registration Succesful!, Welcome to our site '.$firstname.'")</script>';
                           //echo '<script>alert("Added ' .$productname. ' to cart")</script>';
                            header( "Refresh:0; url=Product.php", true, 303);
                            ////header('location: Product.php');
                            //header('"Login Successful!");
				
			}
			else		//If information was not added this is what will be shown
			{
				echo "Error: ". $sql . "<br>" . $conn->error;
			}
			$conn->close(); 	//This ends the connection between the database and the website.
		}
}
else 		
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
