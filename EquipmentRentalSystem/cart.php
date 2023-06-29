<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">

<head>
  <title>Cart - Equipment Hire</title>
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

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
       
        <div class="table-responsive mt-2">
          <table class="table table-bordered table-striped text-center">
            <thead>
              <tr>
                <td colspan="7">
                  <h4 class="text-center text-info m-0">Products in your cart!</h4>
                </td>
              </tr>
              <tr>
                 <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>
                  <a href="ClearCart.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                </th>
              </tr>
            </thead>
            <tbody>
                
                <?php
                session_start();
                if(isset($_SESSION['Lusername']) )
{
                    
                    $cu = $_SESSION['Lusername'];
   $host = "localhost";
		$dbusername = "root";
		$dbpassword = "password";
		$dbname = "ecommerce";
		
		$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
                
                //$sql = "SELECT * FROM cart";		//SQL code that writes data into the database.
                //
                $sql = "SELECT ID, PRODUCT_NAME, PRICE, QUANTITY, (PRICE * QUANTITY) AS TOTAL FROM cart WHERE customer_username = '$cu'";
                
                
		$result = mysqli_query($conn, $sql);
                
			if($conn->query($sql))		//when information is added to the databse successfully the messgage below is what the user will see.
			{
                            
                          // start a table tag in the HTML
                        $count = mysqli_num_rows($result);
                        
                            while($row = mysqli_fetch_array($result))
                            {   //Creates a loop to loop through results
                               
                                
                                $pID = $row['ID'];
                                $pn = $row['PRODUCT_NAME'];
                                $pp = $row['PRICE'];
                                $pq = $row['QUANTITY'];
                                $pt = $row['TOTAL'];
                                 
                                echo <<<_END
                                
                                    <tr>
                                        <td>$pn</td>
                                        <input type="hidden" class="pid" value="">
                                        <td>$pp</td>
                                        <td>$pq</td>
                                        <td>
                                          <i class="fas fa-r-sign">R $pt</i>
                                        </td>
                                        <input type="hidden" class="pprice" name="PID" value="">

                                        <td>
                                          <a href="DeleteFromCart.php?id=$pID"  class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>

                                _END;    
                                
                            }
  
                            $sql2 = "SELECT SUM(PRICE * QUANTITY) AS GTOTAL, SUM(QUANTITY) AS TOTALITEMS from cart WHERE customer_username = '$cu'";
                            $result2 = mysqli_query($conn, $sql2);
                
                            if($conn->query($sql2))		//when information is added to the databse successfully the messgage below is what the user will see.
                            {

                              // start a table tag in the HTML

                                while($row2 = mysqli_fetch_array($result2))
                                {   //Creates a loop to loop through results

                                    $ptt = $row2['GTOTAL'];
                                     $ti = $row2['TOTALITEMS'];

                                    echo <<<_END
                                <tr>

                                        <td colspan="5" ><b>Grand Total: R$ptt</b></td>

                                      </tr>
                                _END;   
                                }
                                
                                
                                $_SESSION['NoItems'] = $ti;   
                                $_SESSION['GT'] = $ptt;
                      
                                

                            }
                            else		//If information was not added this is what will be shown
                            {
                                    echo "Error: ". $sql2 . "<br>" . $conn->error;
                            }
                        }
			else		//If information was not added this is what will be shown
			{
				echo "Error: ". $sql . "<br>" . $conn->error;
			}
                        
                        if($count != 0)
                            {
                                echo <<<_END
                            
                                    
                                    <td colspan="2">
                                    <a href="checkout.php" class="btn btn-info"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                                    </td>
                            
                                    _END;
                            }
                         
			$conn->close();        
}
else
{
    echo header("Location: index.php");
}
                

                ?>
              
                    <td colspan="3">
                                    <a href="Product.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                                    Shopping</a>
                                    </td>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
