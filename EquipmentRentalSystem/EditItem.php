<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Edit Information - Equipment Rental System</title>
        <link rel="stylesheet" type="text/css" href="styledesign.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
    </head>
    <body>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="index.php"><i class=""></i>&nbsp;&nbsp;Equipment Rental System</a>
    <!-- Toggler/collapsibe Button -->
    
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="Logout.php"><i class=""></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
        <div class="editdecor">
            <img src="editicon.jpg" class="editicon">
            <h1>Edit Product Information</h1>
            
             <?php
             
             session_start();
if(isset($_SESSION['Lusername']) )
{
    $pID = $_GET['id'];
        
                $host = "localhost";
		$dbusername = "root";
		$dbpassword = "password";
		$dbname = "ecommerce";
		
		$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
                
                $sql = "SELECT * FROM items where Item_Code = '$pID'";		
		$result = mysqli_query($conn, $sql);
                
			if($conn->query($sql))		
			{
                           
                            while($row = mysqli_fetch_array($result))
                            {   //Creates a loop to loop through results
                                
                                $pID = $row['Item_Code'];
                                $pn = $row['Category'];
                                $pd = $row['Description'];
                                $psize = $row['Size'];
                                $pcolour = $row['Colour'];
                                $pbn = $row['Bin_Number'];
                                $pp = $row['Item_Price'];
                                    
                            }	
                            
                            echo <<<_END

                                    <form action="EditProductInfo.php" method="POST">
                                        <input type="hidden" name="id" value="">
                                        <p>Item Code</p>
                                        <input type="text" name="productC" placeholder="Enter Item Code" value="$pID" required>
                                        
                                        <input type="hidden" name="OldC" value="$pID">
                                    
                                        <p>Category</p>
                                        <input type="text" name="category" placeholder="Enter Category" value="$pn" required>

                                         <p>Description</p>
                                        <input type="text" name="description" placeholder="Item Description" value="$pd" required>

                                        <p>Size</p>
                                        <input type="text" name="size" placeholder="Enter item size" value="$psize" required>

                                        <p>Colour</p>
                                        <input type="text" name="colour" placeholder="Enter Item Colour" value="$pcolour" required>

                                        <p>Bin Number</p>
                                        <input type="text" name="bin_number" placeholder="Enter Item Bin No" value="$pbn" required>

                                        <p>Price</p>
                                        <input type="number" name="price" placeholder="Enter Item Price" value="$pp" required>

                                        <div id="left"><input type="submit" name="update" value="Update" class="btn-update">

                                        </div>          
                                    </form>
                                
                                _END;
			}
			else
			{
				echo "Error: ". $sql . "<br>" . $conn->error;
			}
			$conn->close();        
}
else
{
    echo header("Location: index.php");
}
                
             

                ?>
            
            <form method="POST" action="AdminEquipmentRentalSystem.php">
                <div id="right"><input type="submit" name="view" value="Back" class="btn-view"></div>
            </form>
        </div>
        
    </body>
</html>
