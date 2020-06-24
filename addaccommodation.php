<?php
$flag = false;
$student_id = $array['Student_ID'];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['add'])) {
        include_once "config.php";
        $Initial_Date = $_POST['Initial_Date'];
        $Final_Date = $_POST['Final_Date'];
        $Duration = $_POST['numdays'];
        $Total_Cost = $_POST['cost'];
        $Reason = $_POST['reason'];
        $status = "";

        //print_r($_POST);

        // checking empty fields
        if (empty($Initial_Date) || empty($Final_Date) || empty($Duration) || empty($Total_Cost) || empty($Reason)) {

            if (empty($Duration) || $Duration = 'Invalid date!') {
                echo "<font color='red'>Date field is empty.</font><br/>";
            }

            if (empty($Reason)) {
                echo "<font color='red'>Reason field is empty.</font><br/>";
            }
        } else {
            $sql = "INSERT INTO accomodation(Student_ID, Initial_Date, Final_Date, Duration, Total_Cost, Reason) VALUES('$student_id','$Initial_Date','$Final_Date','$Duration','$Total_Cost','$Reason')";
            $result = $connection->query($sql);
            $flag = true;
            if($result){
              echo '<script type="text/javascript">window.location.href="dashboard.php?page=report"</script>';
            }
        }
    }
}

?>

<link rel="stylesheet" href="css/application.css" />
<div id="div">
  <div class="application">
    <div class="container-fluid">
      <div class="jumbotron" style="
            text-align: left;
            background-color: white;
          ">
        <form id="report-form" name="reportForm" method="post" action="dashboard.php?page=addaccommodation">
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
              <input id="Phonenumber" name="phonenumber" class="form-control" readonly value="<?php echo '0' . $array['Phone_Number']; ?>" />
            </div>
          </div>

          <div class="row">
            <div class="col-3 text-right">
              <label class="application-label">Duration of stay (Date) from :</label>
            </div>
            <div class="col-9">
              <input type="date" class="form-control" id="pick_date" name="Initial_Date" onchange="cal()" required="" />until
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
            <div class="btn-group">
              <button class="btn btn-primary" id="submitBtn"><i class="fa fa-check" type="submit" value="Add" name="Submit"></i> Submit</button>
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