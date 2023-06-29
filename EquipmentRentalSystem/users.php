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
    
      <span class="navbar-toggler-icon"></span>
    </button>
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
           
            <h1>Users</h1>
            <form>
                
                <div class="table-responsive" method="POST" action="">
                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Lastname</th>
                                <th>Gender</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Phone No</th>
                                <th>Email</th>
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
                
                $sql = "SELECT * FROM system_users";		
		$result = mysqli_query($conn, $sql);
                
			if($conn->query($sql))		
			{
                           
                            while($row = mysqli_fetch_array($result))
                            {   //Creates a loop to loop through results
                                
                                $pID = $row['ID'];
                                $pn = $row['FULLNAME'];
                                $pd = $row['SURNAME'];
                                $psize = $row['GENDER'];
                                $pcolour = $row['USERNAME'];
                                $pbn = $row['PASSWORD'];
                                $pp = $row['ROLE'];
                                $p = $row['PHONE'];
                                $pe = $row['EMAIL'];
                                
                                echo <<<_END

                                        <tr>
                                              <td>$pn</td>
                                              <td>$pd</td>
                                              <td>$psize</td>
                                              <td>$pcolour</td>
                                              <td>$pbn</td>    
                                              <td>$pp</td>
                                            <td>$p</td>
                                            <td>$pe</td> 
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
            
            <form method="POST" action="AdminEquipmentRentalSystem.php"><div id="left" >
                    <input type="submit" name="back" id="back" value="Back" class="btn-add"></div></form>
            
        </div>
    </body>
</html>