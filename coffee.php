<?php
session_start();
$loggedInEmail = ""; 
if (isset($_SESSION['EMAIL'])) {
    $loggedInEmail = $_SESSION['EMAIL'];
}
?>
<!DOCTYPE html>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <title>Order Coffee</title>
  <link rel="icon" href="favicon.jpg" type="image/jpeg">

</head>

<body>
  <div id="orderSummary"></div>

  <form id="coffeeForm" action="process_order.php" method="post" onsubmit="return validateForm()">

    <section class="vh-100" style="background-color: #eee;">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-lg-12 col-xl-11">
            <div class="card text-black" style="border-radius: 25px;">
              <div class="card-body p-md-5">
                <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Order Coffee</p>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example3c">Your Email:</label>
                        <input type="email" id="email" type="email" name="email" class="form-control"
                          value='<?php echo $loggedInEmail ?>' required />

                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Your Name:</label>
                        <input type="text" id="name" type="text" name="name" class="form-control" required />

                      </div>
                    </div>
                    <div>
                      <label>Coffee Type:</label>
                      <select id="coffeeType" name="coffeeType" class='form-control' required>
                        <option value="espresso">Espresso - Rs 116</option>
                        <option value="latte">Latte - Rs 126</option>
                        <option value="cappuccino">Cappuccino - Rs 350</option>
                        <option value="milk">Milk - Rs 142</option>
                        <option value="Classic Filter Coffee">Classic Filter Coffee - Rs 163</option>
                        <option value="Macchiato">Macchiato - Rs 147</option>
                        <option value="Cafe Americano">Cafe Americano - Rs 186</option>
                        <option value="Toffee Cappuccino">Toffee Cappuccino - Rs 144</option>
                        <option value="Vanilla Cappuccino">Vanilla Cappuccino - Rs 150</option>
                        <option value="Toffee Latte">Toffee Latte - Rs 178</option>
                        <option value="Devils Own Vanilla Cream">Devils Own Vanilla Cream - Rs 183</option>
                        <option value="Ethiopian Coffee">Ethiopian Coffee - Rs 172</option>
                        <option value="Kadak Chai">Kadak Chai - Rs 79</option>
                        <option value="Green Tea">Green Tea - Rs 125</option>
                        <option value="Darjeeling Tea">Darjeeling Tea - Rs 144</option>
                        <option value="Masala Chai">Masala Chai - Rs 155</option>
                        <option value="Tropical Iceberg">Tropical Iceberg - Rs 161</option>
                        <option value="Cold Toffee Coffee">Cold Toffee Coffee - Rs 172</option>
                        <option value="Cold Cafe Mocha">Cold Cafe Mocha - Rs 149</option>
                        <option value="Cold Coconut Milk Latte">Cold Coconut Milk Latte - Rs 161</option>
                        <option value="Cold Cocoa Latte">Cold Cocoa Latte - Rs 155</option>
                        <option value="Hot Gourmet Cocoa Cream">Hot Gourmet Cocoa Cream - Rs 147</option>
                      </select><br>

                      <label>Size:</label>
                      <select id="size" name="size" class='form-control' required>
                        <option value="small">Small</option>
                        <option value="medium">Medium</option>
                        <option value="large">Large</option>
                      </select><br>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example4c">Sugger</label>
                        <select id="sugar" name="sugar" class='form-control' required>
                          <option value="No-sugar">No-sugar</option>
                          <option value="5gm">5gm</option>
                          <option value="10gm">10gm</option>
                          <option value="15gm">15gm</option>
                        </select><br>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Quantity</label>
                       
<input type="number" id="quantity" name="quantity" class="form-control"
       title="minimum quantity 1" required min="1" value="1" />

                      </div>
                    </div>

                      <input type="checkbox" name="condition" id="condition"> <label for="condition">  I accept , <a href="#!" class="small text-muted">Terms of use.</a>
                                    <a href="#!" class="small text-muted">Privacy policy</a></label>
                

                    <div class="btn-group" role="group" aria-label="Basic example">

                      <button type="submit" value="Place Order" name="done" class="btn btn-primary">
                        Order</button>
                      <a class="btn btn-warning" href='../note-keeper/Otpregistration/customer_panel.php'
                        title='Back to Dashbord'>Home</a>

                    </div>

                  </div>
                  <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                    <img src="coffee.jpg" class="img-fluid" alt="Sample image">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>


  <script src="order_script.js"></script>
  <script>
  document.getElementById('coffeeForm').addEventListener('submit', function(event) {
    
    setTimeout(() => {
      this.reset();
      document.getElementById('quantity').value = 1; 
    }, 100); 
  });
</script>

</body>

</html>