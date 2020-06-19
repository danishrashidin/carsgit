<?php

include_once("applicationconfig.php");

if(isset($_POST['update']))
{	
	
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);	
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$age = mysqli_real_escape_string($mysqli, $_POST['age']);
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);	
	

	if(empty($name) || empty($age) || empty($email)) {	
			
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($age)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}		
	} else {	
		//Step 3. Execute the SQL query.
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE users SET name='$name',age='$age',email='$email' WHERE id=$id");
		
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
		
	
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	$age = $res['age'];
	$email = $res['email'];
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />

    <!-- Fonting -->
    <link
      href="https://fonts.googleapis.com/css2?family=Manrope:wght@800&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap"
      rel="stylesheet"
    />
    <title>Accommodation Application</title>

    <link rel="stylesheet" href="./css/application.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />
    <link rel="stylesheet" href="css/login.css" />
  </head>
  <body id = "body">
  <div class="nav-content-wrapper">
      <!-- Navigation bar -->
      <nav class="navbar-expand-lg transitive" id="navbar">
        <!-- Nav Container -->
        <div class="nav-container transitive" id="nav-container">
          <!-- Home brand -->
          <a class="" href="index.html" style="float: left; padding: 0;">
            <img src="" height="30px" alt="" />
            College Activity Registration System
          </a>

          <!-- Menus -->
          <div class="menu" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item active px-4">
                <a class="nav-link" href="index.html"
                  >HOME <span class="sr-only">(current)</span></a
                >
              </li>
              <li class="nav-item px-4">
                <a class="nav-link" href="activity.html">ACTIVITIES</a>
              </li>
              <li class="nav-item px-4">
                <a class="nav-link" href="food.html">FOOD</a>
              </li>
              <li class="nav-item px-4">
                <a class="nav-link" href="application.html">ACCOMMODATION</a>
              </li>
              <li class="nav-item px-4" style="margin-right: 64px;">
                <a class="nav-link" href="report.html">REPORT</a>
              </li>
              <!-- two buttons -->
              <li class="nav-item">
                <button
                  type="button"
                  class="btn nav-btn px-4 py-2"
                  style="background-color: #00df89; border-color: #00df89;"
                >
                  CONTACT US
                </button>
              </li>
              <li class="nav-item">
                <button type="button" id="button-log-in" class="btn btn-outline-light nav-btn px-4 py-2">
                  LOGIN
                </button>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <header id="header">
        <h1 class="title-header text-center">Apply for Accommodation</h1>
      </header>
    </div>

    <main id = "main">
      <div class="container">
        <div
          class="jumbotron"
          style="
            text-align: left;
            background-size: 150px;
            background-color: white;
          "
        >
      <form id="report-form" name="reportForm" method="post" action="applicationadd.php" >
          <input type="hidden" name="add" value="Add">

          <div class="row">
            <div class="col-3 text-right">
              <label for="Name" class="application-label">Name :</label>
            </div>
            <div class="col-9">
              <input id="Name" name="name" class="form-control" readonly value="<?php echo $name['Full_Name'] ?>"/>
            </div>
          </div>

          <div class="row">
            <div class="col-3 text-right">
              <label for="IC" class="application-label">IC NO/Passport No :</label>
            </div>
            <div class="col-9">
              <input id="IC" name="ic" class="form-control" readonly value="<?php echo $name['IC'];?>"/>
            </div>
          </div>


          <div class="row">
            <div class="col-3 text-right">
              <label for="Faculty" class="application-label">Faculty :</label>
            </div>
            <div class="col-9">
              <input id="Faculty" name="faculty" class="form-control" readonly value="<?php echo $name['Faculty'];?>"/>
            </div>
          </div>

          <div class="row">
            <div class="col-3 text-right">
              <label for="Phonenumber" class="application-label">Phone Number :</label>
            </div>
            <div class="col-9">
              <input
                id="Phonenumber"
                name="phonenumber"
                class="form-control"
                readonly value="<?php echo $name['Phone_Number'];?>"
              />
            </div>
          </div>

          <div class="row">
            <div class="col-3 text-right">
              <label class="application-label">Duration of stay (Date) from :</label>
            </div>
            <div class="col-9">
                <input type="date" value="<?php echo $Initial_Date;?>" class="form-control" id="pick_date" name="Initial_Date" onchange="cal()" required=""/>until  
                <input type="date" class="form-control" id="drop_date" name="Final_Date" onchange="cal()" required=""/>
            </div>
          </div>

          <div class="row">
            <div class="col-3 text-right">
              <label for="NoDays" class="application-label">No of days :</label>
            </div>
            <div class="col-9">
              <input id="numdays2" name="numdays" class="form-control" readonly />
            </div>
          </div>

          <div class="row">
            <div class="col-3 text-right">
              <label for="Cost" class="application-label">Total cost :</label>
            </div>
            <div class="col-9">
              <input id="totalcost" name="cost" class="form-control" readonly />
            </div>
          </div>

          <div class="row">
            <div class="col-3 text-right">
              <label for="Reason" class="">Reason of stay :</label>
            </div>
            <div class="col-9">
              <textarea
                name="reason"
                rows="4"
                cols="60"
                class="form-control"
                id="reason"
                placeholder="Please state your reason of stay"
                required=""
              ></textarea>
            </div>
          </div>

          <br />
          <br />

          <div class="text-center bgimg">
          <input type="hidden" name="Application_ID" value=<?php echo $editID;?>>
            <div class="btn-group">
              <button class="btn btn-primary" id="submitBtn"><i class="fa fa-check" type="submit" value="Update" name="update"></i>Update</button>
            </div>
            <div class="btn-group">
              <button type="button" class="btn btn-primary" onClick="window.location.reload();">Cancel</button>
            </div>
          </div>
      </form>
        </div>
      </div>
    </main>
    <footer>
      <div class="copyright">
        <p>&copy 2020 - Try Guess</p>
      </div>
      <div class="social">
        <a href="#" class="support">Contact Us</a>
        <a href="#" class="face">f</a>
        <a href="#" class="tweet">t</a>
        <a href="#" class="linked">ig</a>
      </div>
    </footer>


    <script type="text/javascript" src="js/application.js"></script>
  </body>
</html>

