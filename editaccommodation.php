<?php

include_once("config.php");

if (isset($_POST['update'])) {

  $id = mysqli_real_escape_string($connection, $_POST['id']);
  $name = mysqli_real_escape_string($connection, $_POST['name']);
  $age = mysqli_real_escape_string($connection, $_POST['age']);
  $email = mysqli_real_escape_string($connection, $_POST['email']);


  if (empty($name) || empty($age) || empty($email)) {

    if (empty($name)) {
      echo "<font color='red'>Name field is empty.</font><br/>";
    }

    if (empty($age)) {
      echo "<font color='red'>Age field is empty.</font><br/>";
    }

    if (empty($email)) {
      echo "<font color='red'>Email field is empty.</font><br/>";
    }
  } else {
    //Step 3. Execute the SQL query.
    //updating the table
    $result = mysqli_query($connection, "UPDATE users SET name='$name',age='$age',email='$email' WHERE id=$id");

    //redirectig to the display page. In our case, it is index.php
    header("Location: dashboard.php");
  }
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($connection, "SELECT * FROM users WHERE id=$id");

while ($res = mysqli_fetch_array($result)) {
  $name = $res['name'];
  $age = $res['age'];
  $email = $res['email'];
}
?>


<link rel="stylesheet" href="./css/application.css" />
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
<link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />
<div id="div">
  <div class="application">
    <div class="container-fluid">
      <div class="jumbotron" style="
            text-align: left;
            background-size: 150px;
            background-color: white;
          ">
        <form id="report-form" name="reportForm" method="post" action="applicationadd.php">
          <input type="hidden" name="add" value="Add">

          <div class="row">
            <div class="col-3 text-right">
              <label for="Name" class="application-label">Name :</label>
            </div>
            <div class="col-9">
              <input id="Name" name="name" class="form-control" readonly value="<?php echo $array['Full_Name'] ?>" />
            </div>
          </div>

          <div class="row">
            <div class="col-3 text-right">
              <label for="IC" class="application-label">IC NO/Passport No :</label>
            </div>
            <div class="col-9">
              <input id="IC" name="ic" class="form-control" readonly value="<?php echo $array['IC']; ?>" />
            </div>
          </div>


          <div class="row">
            <div class="col-3 text-right">
              <label for="Faculty" class="application-label">Faculty :</label>
            </div>
            <div class="col-9">
              <input id="Faculty" name="faculty" class="form-control" readonly value="<?php echo $array['Faculty']; ?>" />
            </div>
          </div>

          <div class="row">
            <div class="col-3 text-right">
              <label for="Phonenumber" class="application-label">Phone Number :</label>
            </div>
            <div class="col-9">
              <input id="Phonenumber" name="phonenumber" class="form-control" readonly value="<?php echo $array['Phone_Number']; ?>" />
            </div>
          </div>

          <div class="row">
            <div class="col-3 text-right">
              <label class="application-label">Duration of stay (Date) from :</label>
            </div>
            <div class="col-9">
              <input type="date" value="<?php echo $Initial_Date; ?>" class="form-control" id="pick_date" name="Initial_Date" onchange="cal()" required="" />until
              <input type="date" class="form-control" id="drop_date" name="Final_Date" onchange="cal()" required="" />
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
              <textarea name="reason" rows="4" cols="60" class="form-control" id="reason" placeholder="Please state your reason of stay" required=""></textarea>
            </div>
          </div>

          <br />
          <br />

          <div class="text-center bgimg">
            <input type="hidden" name="Application_ID" value=<?php echo $editID; ?>>
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
  </div>


  <script type="text/javascript" src="js/application.js"></script>
</div>