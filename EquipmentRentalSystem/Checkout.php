<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<head>
  <title>Checkout - Equipment Rental Hire</title>
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
      <div class="col-lg-6 px-4 pb-4" id="order">
        <h4 class="text-center text-info p-2">Complete your order!</h4>
        
         <?php 
            session_start(); 
                
            if(isset($_SESSION['Lusername']) )
            {
            $Gt = $_SESSION['GT'];
                        $nooi = $_SESSION['NoItems'];

                       echo <<<_END

                        <div class="jumbotron p-3 mb-2 text-center">
                              <h6 class="lead"><b> $nooi : </b>Product(s)</h6>
                              <h5><b>Total Amount Payable : </b>R$Gt</h5>
                            </div>

                        _END;
            }
            else
            {
                echo header("Location: index.php");
            }
            
        ?>
        
        <form action="" method="post" id="placeOrder">
          <input type="hidden" name="products" value="">
          <input type="hidden" name="grand_total" value="">
          <div class="form-group">
            <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Enter Delivery Address Here..."></textarea>
          </div>
          <h6 class="text-center lead">Email</h6>
          <input class="form-control" type="email" name="email">
          <h6 class="text-center lead">Select Payment Mode</h6>
          <div class="form-group">
            <select name="pmode" class="form-control">
              <option value="" selected disabled>-Select Payment Mode-</option>
              <option value="cod">PayPal</option>
              <option value="netbanking">EFT Online Banking</option>
              <option value="cards">Debit/Credit Card</option>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Place Order" class="button2">
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>