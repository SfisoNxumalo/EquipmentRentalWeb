<?php
session_start();

if(isset($_SESSION['Lusername']) )
{
     $productcode = sanitizeString(Filter_input(INPUT_POST, 'productC'));
$productcategory = sanitizeString(Filter_input(INPUT_POST, 'category'));
$productdescription = sanitizeString(Filter_input(INPUT_POST, 'description'));
$productsize = sanitizeString(Filter_input(INPUT_POST, 'size'));
$productcolour = sanitizeString(Filter_input(INPUT_POST, 'colour'));
$productbinnumber = sanitizeString(Filter_input(INPUT_POST, 'bin_number'));
$productprice = sanitizeString(Filter_input(INPUT_POST, 'price'));
/*
The If Statement is to make sure that the connection to the database
is only made if the values are not are empty.
*/


if(!empty($productcode) || !empty($productcategory) || !empty($productdescription) || !empty($productsize) || !empty($productcolour) || !empty($productbinnumber) || !empty($productprice))
{
	/*
	Declares variables then passes database information into these variables
	this includes, the username, password, name of the database, and host name.
	*/	
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
			$sql = "INSERT INTO items (Item_Code, Category, Description, Size, Colour, Bin_Number, Item_Price) values('$productcode', '$productcategory', '$productdescription', '$productsize', '$productcolour', '$productbinnumber', '$productprice')";		//SQL code that writes data into the database.
			
			if($conn->query($sql))		//when information is added to the databse successfully the messgage below is what the user will see.
			{
                            
                         
                           echo '<script>alert("Item HAS BEEN ADDED SUCESSFULLY")</script>';
                            header( "Refresh:0; url=AdminEquipmentRentalSystem.php", true, 303);
                            ////header('location: Product.html');
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
