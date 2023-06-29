 <?php
session_start();
if(isset($_SESSION['Lusername']) )
{
    $cu = $_SESSION['Lusername'];
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
                
			$sql = "DELETE FROM CART WHERE customer_username = '$cu'"; //SQL code that writes data into the database.
			
			if($conn->query($sql))		//when information is added to the databse successfully the messgage below is what the user will see.
			{
                             
                           echo '<script>alert("Cart successfully cleared")</script>';
                          
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
else
{
    echo header("Location: index.php");
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

