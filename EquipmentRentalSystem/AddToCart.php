<?php
session_start();
if(isset($_SESSION['Lusername']) )
{
    $productname = Filter_input(INPUT_POST, 'product_name');
$price = Filter_input(INPUT_POST, 'product_price');
$quantity = Filter_input(INPUT_POST, 'product_quantity');



/*
The If Statement is to make sure that the connection to the database
is only made if the values are not are empty.
*/


if(!empty($productname) || !empty($price)|| !empty($quantity))
{
	/*
	Declares variables then passes database information into these variables
	this includes, the username, password, name of the database, and host name.
	*/	$cu = $_SESSION['Lusername'];
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
			$sql = "INSERT INTO cart (PRODUCT_NAME, PRICE, QUANTITY, customer_username) values('$productname', '$price', '$quantity', '$cu')";		//SQL code that writes data into the database.
			
			if($conn->query($sql))		//when information is added to the databse successfully the messgage below is what the user will see.
			{
                             
                           echo '<script>alert("Added ' .$productname. ' to cart")</script>';
                          
                           header( "Refresh:0; url=Product.php", true, 0);
                           
                           //header('url = Product.php');
                            //header('<script>alert("Login Successful!")<script>');
				
			}
			else		//If information was not added this is what will be shown
			{
				echo "Error: ". $sql . "<br>" . $conn->error;
			}
			$conn->close(); 	//This ends the connection between the database and the website.
		}
}
else 		//if any info is missing on the "I GET INVOLVED" form, error message to be shown. 
{
	echo "One of the fields is empty, Please provide the required information.";
	die();		//kills connection.
}       
}
else
{
    echo header("Location: index.php");
}
/*
These are declared variables for php and
and the values being passed are the values from the html file
for example "FirstName" in your HTML code is where a user inserts their firstname.. 
*/



?>
