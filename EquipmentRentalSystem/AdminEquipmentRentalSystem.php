<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

<form method="POST" action="EditProductInformation.html" class="btn btn-info">
                                <input type="submit" name="edit" value="edit">
                            </form>
-->
<html>
    <head>
        <title>Admin - Equipment Rental System</title>
        <link rel="stylesheet" type="text/css" href="styledesign.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
    </head>
    <body>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="index.php"><i class=""></i>&nbsp;&nbsp;Equipment Rental System</a>
    <!-- Toggler/collapsibe Button -->
    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
          <li class="nav-item">
          <a class="nav-link" href="users.php"><i class=""></i>Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Logout.php"><i class=""></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
        <div class="information" >
           
            <h1>Products</h1>
            <form>
                
                <div class="table-responsive" method="POST" action="EditProductInformation.html">
                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Item Code</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Size</th>
                                <th>Colour</th>
                                <th>Bin Number</th>
                                <th>Price</th>
                            </tr>    
                        </thead>    
                         <tbody>
                        
        <?php
        session_start();
                
                
                if(isset($_SESSION['Lusername']) )
                {
                    
                    $_SESSION['Lusername'];
                    $host = "localhost";
		$dbusername = "root";
		$dbpassword = "password";
		$dbname = "ecommerce";
		
		$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
                
                $sql = "SELECT * FROM items";		
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
                                
                                echo <<<_END

                                        <tr>
                                        <td>
                                
                                               <a href="EditItem.php?id=$pID" class="btn btn-info" onclick="" name="edit"> Edit</a>

    
                                                <a href="DeleteItem.php?id=$pID"
                                                class="btn btn-danger" onclick="return confirm('Are you sure want to remove this item?');" name="delete">Delete</a>
                                        </td>
                                              <td>$pID</td>
                                              <td>$pn</td>
                                              <td>$pd</td>
                                              <td>$psize</td>
                                              <td>$pcolour</td>
                                              <td>$pbn</td>    
                                              <td>R$pp</td> 
                                        </tr>
                                _END;   
                            }			
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
                
                        </tbody>
                    </table>
                </div>
                
                <br></br>
                
            </form>
            
            <form method="POST" action="AddProductInformation.html"><div id="left" >
                    <input type="submit" name="Add" id="add" value="Add" class="btn-add"></div></form>
            
        </div>
    </body>
</html>