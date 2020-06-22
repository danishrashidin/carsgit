<link rel="stylesheet" type="text/css" href="css/food.css" />
<link rel="stylesheet" type="text/css" href="css/menu.css" />

<!-- for icon -->
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
/>
<div id="menu-body">
  <header class="description">
    <?php
        include_once "config.php";
        $res_id = $_GET['Restaurant_ID'];
        $sql = "SELECT restaurant.Restaurant_Name, college.College_Name, restaurant.Restaurant_hours FROM restaurant INNER JOIN college ON restaurant.College_ID = college.College_ID WHERE restaurant.Restaurant_ID=$res_id";
        $result = $connection->query($sql); while ($res =
    $result->fetch_array()) { $res_name = $res['Restaurant_Name']; $res_location
    = $res['College_Name']; $res_hours = $res['Restaurant_hours']; } ?>
    <div id="menu-container">
      <style>
        #menu-container {
          background: url("assets/restaurant/<?php echo $res_name; ?>.jpg");
        }
      </style>
      <div id="menu-container-inside" style="visibility: none;">
        <h1 id="name"><?php echo $res_name; ?></h1>
        <h4 id="location">
          Location:
          <?php echo $res_location; ?>
        </h4>
        <h4 id="available-hours">
          Available hours:
          <?php echo $res_hours; ?>
        </h4>
        <!-- use form to go to search food -->
        <form method="GET" action="menu.php">
          <div class="search-container">
            <input
              type="hidden"
              name="Restaurant_ID"
              value="<?php echo $res_id; ?>"
            />
            <input type="text" placeholder="Search food..." name="search" />
            <button type="submit"><i class="fa fa-search"></i></button>
          </div>
        </form>
      </div>
    </div>
  </header>
  <div
    class="overlayMessage"
    id="overlayFoundMessage"
    onclick="offFoundMessage()"
    title="Click anywhere to close this window"
  >
    <div id="Message" style="color: 200;">
      Found!
      <table id="foundMessage">
        <tr>
          <th>Food Name</th>
          <th>Restaurant Name</th>
        </tr>
      </table>
    </div>
  </div>
  <div
    class="overlayMessage"
    id="overlayNotFoundMessage"
    onclick="offNotFoundMessage()"
    title="Click anywhere to close this window"
  >
    <div id="Message">Sorry, food not found.</div>
  </div>
  <div
    class="overlayMessage"
    id="overlaySearchEmptyMessage"
    onclick="offSearchEmptyMessage()"
    title="Click anywhere to close this window"
  >
    <div id="Message">You did not enter any key.</div>
  </div>

  <!--  NAVIGATION  -->
  <div class="main-nav">
    <ul>
      <li>
        <a href="dashboard.php?page=myorder" class="active">my order</a>
      </li>
      <li>
        <a href="dashboard.php?page=mypreorder">my pre-order</a>
      </li>
      <li>
        <a href="dashboard.php?page=orderhistory">order history</a>
      </li>
    </ul>
  </div>
  <!--  NAVIGATION END  -->

  <div>
    <div class="horizontal-bar-row">
      <h2>
        Menu<span style="color: #321575;">
          <div class="select-container">
            <p>
              Today:&nbsp
              <script>
                document.write(new Date().toLocaleDateString());
              </script>
            </p>
          </div>
        </span>
      </h2>
    </div>

    <div class="menu-card-group">
      <?php
            $sql2 = "SELECT * FROM food WHERE Restaurant_ID=$res_id ORDER BY Food_Name";
            $result = $connection->query($sql2); while ($food =
      $result->fetch_array()) { $food_name = $food['Food_Name']; $food_price =
      $food['Food_Price']; echo '
      <div class="food-card">
        <div class="foodimage">
          <img
            id="food-img"
            alt="' . $food_name . '"
            src="assets/food/' . $food_name . '.jpg"
          />
        </div>

        <div class="food-content">
          <div class="namendes">
            <div id="food-name"><b>' . $food_name . '</b></div>
          </div>
          <div class="pricenorder">
            <div id="food-price"><b>RM ' . $food_price . '</b></div>
            <div><button class="add-btn">add</button></div>
          </div>
        </div>
      </div>
      '; } // $connection->close(); ?>

      <br />
    </div>

    <div class="sticky-cart" id="st-cart">
      <div class="store-cart-icon">
        <span
          ><i id="cart-icon" class="fa fa-shopping-cart" style="color: #ffff;">
            <b class="n-items">0</b></i
          ></span
        >
      </div>

      <form
        id="order-form"
        method="post"
        action="dashboard.php?page=processorder&Restaurant_ID=<?php echo $res_id ?>"
        onSubmit="return confirm('Are you sure you want to submit the order?')"
      >
        <div class="cart" id="cart">
          <div class="cart-title">
            <button
              type="button"
              class="close"
              aria-label="Close"
              onclick="close_cart()"
            >
              &times;
            </button>
            <h3 style="text-decoration: underline;">
              <b>My Cart</b
              ><span style="float: right;"
                ><i class="fa fa-shopping-cart">
                  <b class="n-items" style="padding-left: 16px;">0</b></i
                ></span
              >
            </h3>
          </div>

          <!--
                        <div class="cart-item">
                            <div class="item-text">
                                <div class="item-title" name="food-name" value="food name"><b>Food name here</b></div>
                                <div class="item-price" name="food=price" value="food price">RM 00.00</div>
                                <div class="store-remove-icon" value="delete"><i class="fa fa-trash"></i></div>
                            </div>
                        </div>
                    -->

          <div class="cart-total">
            <i>Cart is empty!</i>
          </div>

          <div class="cart-btn">
            <button
              class="order-btn"
              name="order-now"
              value="order-now"
              onclick="order_function()"
            >
              order for now
            </button>
            <button
              class="preorder-btn"
              name="preorder"
              value="preorder"
              onclick="preorder_function()"
            >
              pre-order
            </button>
          </div>
        </div>
      </form>
    </div>

    <p
      class="food-card"
      style="
        text-align: center;
        background: white;
        box-shadow: none;
        color: rgb(119, 119, 119);
      "
    >
      You've seen all the menu items.
    </p>
  </div>
  <script type="text/javascript" src="js/menu.js"></script>
</div>

<?php
include_once("searchFilterFood.php");
?>
