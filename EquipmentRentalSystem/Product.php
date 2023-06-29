<!DOCTYPE html>
<html lang="en">

<head>
  <title>Products - Equipment Rental System</title>
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
            <a class="nav-link" href="Product.php"><i class="fas fa-th-list mr-2"></i>Products</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger">Cart</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Logout.php"><i class=""></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Displaying Products Start -->
  <div class="container">
  <div id="message"></div>
    <div class="row mt-2 pb-3">
<?php
  session_start();
if(isset($_SESSION['Lusername']) )
{
    $host = "localhost";
		$dbusername = "root";
		$dbpassword = "password";
		$dbname = "ecommerce";
		
		$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
                
                $sql = "SELECT * FROM items";		//SQL code that writes data into the database.
		$result = mysqli_query($conn, $sql);
                
			if($conn->query($sql))		//when information is added to the databse successfully the messgage below is what the user will see.
			{
                            
                          // start a table tag in the HTML

                            while($row = mysqli_fetch_array($result))
                            {   //Creates a loop to loop through results
                                
                                $pID = $row['Item_Code'];
                                $pn = $row['Category'];
                                $pd = $row['Description'];
                                $psize = $row['Size'];
                                $pcolour = $row['Colour'];
                                $pbn = $row['Bin_Number'];
                                $pp = $row['Item_Price'];
                                echo <<<_END
                                

                                     

                                         <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
                                        <div class="card-deck">
                                          <div class="card p-2 border-secondary mb-2">
                                              <img src="Funeral_Dec58.jpg" class="card-img-top" height="250">
                                            <div class="card-body p-1">
                                              <h3 class="card-title text-center text-info">$pd</h3>
                                              <h6 class="card-text text-center text-danger"><i class=""></i>&nbsp;&nbsp;$pcolour</h6>
                                            <h4 class="card-text text-center text-danger"><i class=""></i>&nbsp;&nbsp;R$pp</h4>
                                            </div>
                                            <div class="card-footer p-1">
                                                <form method="POST" action="AddToCart.php" class="form-submit">
                                                <div class="row p-2">
                                                  <div class="col-md-6 py-1 pl-4">
                                                    <b>Quantity : </b>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <input type="number" class="form-control pqty" name="product_quantity" value="1">
                                                  </div>
                                                </div>
                                                <input type="hidden" class="pid" name="product_name" value="$pd">
                                                <input type="hidden" class="pname" name="product_price" value="$pp">
                                                <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                                                  cart</button>
                                              </form>
                                            </div>

                                          </div>
                                        </div>
                                      </div>

                                    
                                _END;
                                
                                //echo "<tr><td>" . $row['PRODUCT_NAME'] . "</td><td>" . $row['PRODUCT_PRICE'] . "</td></tr>";  //$row['index'] the index here is a field name
                            }			
			}
			else		//If information was not added this is what will be shown
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
          </div>
            </div>
  
  <!-- Displaying Products End -->

</body>

</html>
