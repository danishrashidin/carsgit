<title>Food - Menu</title>
<link rel="stylesheet" type="text/css" href="css/food.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">

<!-- for icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div id="menu-body">

    <header class="description">
        <?php
        include_once "config.php";
        $res_id = $_GET['Restaurant_ID'];
        $sql = "SELECT restaurant.Restaurant_Name, college.College_Name, restaurant.Restaurant_hours FROM restaurant INNER JOIN college ON restaurant.College_ID = college.College_ID WHERE restaurant.Restaurant_ID=$res_id";
        $result = $connection->query($sql);
        while ($res = $result->fetch_array()) {
            $res_name = $res['Restaurant_Name'];
            $res_location = $res['College_Name'];
            $res_hours = $res['Restaurant_hours'];
        }
        ?>
        <div id="menu-container">
            <style>
                #menu-container {
                    background: url("assets/restaurant/<?php echo $res_name; ?>.jpg");

                }
            </style>
            <div id="menu-container-inside" style="visibility: none">
                <h1 id="name"><?php echo $res_name; ?></h1>
                <h4 id="location"> Location: <?php echo $res_location; ?></h4>
                <h4 id="available-hours"> Available hours: <?php echo $res_hours; ?></h4>
                <!-- use form to go to search food -->
                <form method="GET" action="processOrder.php">
                    <div class="search-container">
                        <input type="text" placeholder="Search food..." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>

        </div>
        <!-- <div id="menu-container-overlay">
            <style>
                #menu-container-overlay {
                    background: url("assets/restaurant/<?php echo $res_name; ?>.jpg");

                }
            </style>
            <div id="menu-container-overlay-inside" style="visibility: none">
                <h1 id="name"><?php echo $res_name; ?></h1>
                <h4 id="location"> Location: <?php echo $res_location; ?></h4>
                <h4 id="available-hours"> Available hours: <?php echo $res_hours; ?></h4>
                <form action="/action_page.php">
                    <div class="search-container">
                        <input type="text" placeholder="Search food, restaurants..." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>

        </div> -->
    </header>
    <div class="overlayMessage" id="overlayFoundMessage" onclick="offFoundMessage()" title="Click anywhere to close this window">
        <div id="Message" style="color: 200; " }>Found!<table id="foundMessage">
                <tr>
                    <th>Food Name</th>
                    <th>Restaurant Name</th>
                </tr>
            </table>
        </div>
    </div>
    <div class="overlayMessage" id="overlayNotFoundMessage" onclick="offNotFoundMessage()" title="Click anywhere to close this window">
        <div id="Message">Sorry, food not found.</div>
    </div>
    <div class="overlayMessage" id="overlaySearchEmptyMessage" onclick="offSearchEmptyMessage()" title="Click anywhere to close this window">
        <div id="Message">You did not enter any key. </div>
    </div>

    <!--  NAVIGATION  -->
    <div class="main-nav">
        <ul>
            <li>
                <a href="dashboard.php?page=myorder">my order</a>
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
            <h2>Menu<span style="color: #321575;">
                    <div class="select-container">
                        <p>
                            Today:&nbsp
                            <script>
                                document.write(new Date().toLocaleDateString());
                            </script>
                        </p>
                    </div>
                </span></h2>

        </div>

        <div class="menu-card-group">
            <?php
            $sql2 = "SELECT * FROM food WHERE Restaurant_ID=$res_id ORDER BY Food_Name";
            $result = $connection->query($sql2);
            while ($food = $result->fetch_array()) {
                $food_name = $food['Food_Name'];
                $food_price = $food['Food_Price'];

                echo '<div class="food-card">
                        <div class="foodimage"><img id="food-img" alt="' . $food_name . '" src="assets/food/' . $food_name . '.jpg">
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
                    </div>';
            }
            // $connection->close();
            ?>
            <br>

        </div>

        <div class="sticky-cart" id="st-cart">
            <div class="store-cart-icon"><span><i id="cart-icon" class="fa fa-shopping-cart" style="color: #ffff"> <b class="n-items">0</b></i></span></div>
            <form id="order-form" method="post" action="processOrder.php?Restaurant_ID=<?php echo $res_id ?>" onSubmit="return confirm('Click \'cancel\' to cancel submitting.')">
                <div class="cart" id="cart">

                    <div class="cart-title">
                        <button type="button" class="close" aria-label="Close" onclick="close_cart()">&times;</button>
                        <h3 style="text-decoration: underline;"><b>My Cart</b><span style="float: right;"><i class="fa fa-shopping-cart">
                                    <b class="n-items" style="padding-left: 16px;">0</b></i></span></h3>
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
                        <button class="order-btn" name="order-now" value="order-now" onclick="order_function()">order for now</button>
                        <button class="preorder-btn" name="preorder" value="preorder" onclick="preorder_function()">pre-order</button>
                    </div>
                </div>
            </form>
        </div>


        <p class="food-card" style="text-align: center; background: white; box-shadow: none ;color: rgb(119, 119, 119);">You've seen all the menu items.</p>

        <!-- onclick="offOrderedMessage()" title="Click anywhere to proceed." -->
        <div class="overlayMessage" id="overlayOrderedMessage">
            <div id="Message">Order submitted. Please pick up your food from <?php echo $res_name ?> by TODAY. You can view your order at <a title="VIEW ORDER" href="dashboard.php?page=myorder">MY ORDER</a>.<br><br><a href="dashboard.php?page=menu&Restaurant_ID=<?php echo $res_id ?>">Create new order</a> </div>
        </div>
        <!-- onclick="offPreOrderedMessage()" title="Click anywhere to proceed." -->
        <div class="overlayMessage" id="overlayPreOrderedMessage">
            <div id="Message">Order submitted. You can view or cancel your order at <a title="VIEW PRE-ORDER" href="dashboard.php?page=mypreorder">MY PRE-ORDER</a>.<br><br><a href="dashboard.php?page=menu&Restaurant_ID=<?php echo $res_id ?>">Create new order</a></div>
        </div>
        <div class="overlayMessage" id="overlayCartEmptyMessage">
            <div id="Message">Failed to submit order. Your cart is empty. <br><br><a href="dashboard.php?page=menu&Restaurant_ID=<?php echo $res_id ?>">Back to previous</a></div>
        </div>
        <div class="overlayMessage" id="overlayDateInvalidMessage">
            <div id="Message">Failed to submit order. Your entered date is invalid. <br><br><a href="dashboard.php?page=menu&Restaurant_ID=<?php echo $res_id ?>">Back to previous</a></div>
        </div>

    </div>

    <script type="text/javascript" src="js/menu.js"></script>

    <?php
    // include_once("config.php");
    if (isset($_SESSION['Student_ID'])) {
        $student_id = $_SESSION['Student_ID'];
    }

    $is_ordernow = false;
    $is_preorder = false;
    date_default_timezone_set("Asia/Kuala_Lumpur");
    if (isset($_POST['order-now'])) {
        $is_ordernow = true;
        $order_date = date("Y/m/d");
        $pickup_date = null;
        $status = "Order";
    } elseif (isset($_POST['preorder'])) {
        $is_preorder = true;
        $order_date = null;
        $pickup_date = $_POST['pre-order-date'];
        $status = "Pre-Order";
    }

    if (isset($_POST['count'])) {
        $total_item = $_POST['count'];
    } else {
    ?>
        <script>
            onCartEmptyMessage()
        </script>

        // echo "Cart is empty!";
    <?php
    }

    if (isset($_POST['InvalidDate']) && $_POST['InvalidDate'] == 1) {
    ?>
        <script>
            onDateInvalidMessage();
            offCartEmptyMessage();
        </script>

        <?php
    }

    // echo $total_item;
    $generate_id_date = date("md");
    $generate_id_time = time();
    $generated_id = strval($generate_id_date) . strval($generate_id_time);

    for ($i = 1; $i <= $total_item; $i++) {
        $name = "food-name-" . $i;
        $quantity = "food-quantity-" . $i;
        $price = "food-price-" . $i;
        if (isset($_POST[$name])) {
            $food_name = $_POST[$name];
            $food_quantity = $_POST[$quantity];
            $food_price = $_POST[$price];
        }

        $sql3 = "SELECT * FROM food WHERE Food_Name='$food_name'";
        $result3 = $connection->query($sql3);
        while ($row = $result3->fetch_array()) {
            $food_id = $row['Food_ID'];
            $res_id = $row['Restaurant_ID'];
            // echo $res_id;
        }
        $order_id = $generated_id . "_" . $i;
        // echo $order_id;

        $sql4 = "INSERT INTO foodorder(Order_ID,Student_ID,Food_ID,Restaurant_ID,Order_No,Order_Date,Pickup_Date,Order_Status,Quantity,Total_Price ) VALUES ('$order_id','$student_id','$food_id','$res_id','$generated_id','$order_date','$pickup_date','$status','$food_quantity','$food_price')";

        // $connection->query($sql2);
        if ($connection->query($sql4) === true) {
            if ($is_ordernow == true) {
        ?>
                <script>
                    onOrderedMessage();
                </script>
            <?php
            } elseif ($is_preorder == true) {
            ?>
                <script>
                    onPreOrderedMessage();
                </script>

    <?php
            }
            // echo "New record created successfully";
        } else {
            echo "Error: " . $sql4 . "<br>" . $connection->error;
        }
    }
    ?>

    <?php
    include_once("searchFilterFood.php");
    ?>