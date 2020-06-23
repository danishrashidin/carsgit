<?php

//including the database connection file
if (isset($_SESSION['Student_ID'])) {
  $student_id = $_SESSION['Student_ID'];
}
include_once 'config.php';
$flag = false;

$flag = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  if (isset($_POST['add'])) {
    include_once "config.php";
    $collegeID = $_POST['collegeName'];
    $collegeProblem = $_POST['collegeProblem'];
    $message1 = $_POST['message1'];
    $hd_location = $_POST['hd_location'];
    $uploadedfile = $_POST['uploadedfile'];
    $status = "";

    // checking empty fields

    if (empty($collegeID) || empty($collegeProblem) || empty($message1) || empty($hd_location)) {
      if (empty($collegeID)) {
        echo "<font color='red'>Residential College is empty.</font><br/>";
      }

      if (empty($collegeProblem)) {
        echo "<font color='red'>College Problem field is empty.</font><br/>";
      }

      if (empty($message1)) {
        echo "<font color='red'>Problem Details field is empty.</font><br/>";
      }
      if (empty($hd_location)) {
        echo "<font color='red'>Problem Location field is empty.</font><br/>";
      }
    } else {
      $sql = "INSERT INTO report(Student_ID, College_ID, Problem_Type, Problem_Details, Problem_Location, File_Upload )
            VALUES($student_id, $collegeID,'$collegeProblem','$message1','$hd_location','$uploadedfile')";

      $connection->query($sql);
      // $result = $connection->query("INSERT INTO report(College_ID, Problem_Type, Problem_Details, Problem_Location, File_Upload ) VALUES('$collegeID','$collegeProblem','$message1','$hd_location','$uploadedfile')");
      $flag = true;
    }
  }
}

?>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/gh/yesiamrocks/cssanimation.io@1.0.3/cssanimation.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" /> -->
<link rel="stylesheet" href="css/report.css" />
<!-- <link rel="stylesheet" type="text/css" href="css/styles.css" /> -->

<div class="report">
  <div>
    <div class="container-fluid bg-dark text-white" style="margin:auto; text-align:center;background-size: 150px;padding-top: 32px;padding-bottom: 30px; border-radius: 1rem 1rem 0 0;">
      <h4>REPORT COLLEGE ISSUE </h4>
      <p class="text-muted small">
        <div class="cssanimation fadeIn infinite">Are there any damages?
          Help us by filling up this form and we will fix it right away!
        </div>
      </p>
    </div>
    <form id="report-form" name="reportForm" method="post" action="dashboard.php?page=addReport">
      <input type="hidden" name="add" value="Add">
      <div class="container-fluid p-3" style="background-color: white; padding-top: 40px;">
        <div class="row">
          <div class="col-3 text-right">
            <label for="College" class="">
              Residential College :
            </label>
          </div>
          <div class="col-9">
            <div class="dropdown" tabindex="1">
              <label for="residential-college" class="dropdown-label"></label>
              <div class="select">
                <span style="display: none; position: absolute; top: -5px; left: 10px;"></span>
              </div>
              <input type="text" id="CollegeName" name="collegeName" class="CollegeName" required style="border:none; outline: none;
            background: red; position: absolute;
            top:13px; left:10px; opacity: 0;
            pointer-events: none;" />
              <ul class="dropdown-menu college">
                <li id="1">Astar Residential College</li>
                <li id="2">Tuanku Bahiyah Residential College</li>
                <li id="3">Tuanku Kursiah Residential College</li>
                <li id="4">Bestari Residential College</li>
                <li id="5">Dayasari Residential College</li>
                <li id="6">Ibnu Sina Residential College</li>
                <li id="7">Za'ba Residential College</li>
                <li id="8">Kinabalu Residential College</li>
                <li id="9">Tun Syed Zahiruddin Residential College</li>
                <li id="10">Tun Ahmad Zaidi Residential College</li>
                <li id="11">Ungku Aziz Residential College</li>
                <li id="12">Raja Dr. Nazrin Shah Residential College</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-3 text-right">
            <label for="Problem Type" class="" style="padding-left: 0px;"> Problem Type :</label>
          </div>
          <div class="col-9">
            <div class="dropdown" tabindex="1">
              <label for="residential-college" class="dropdown-label"></label>
              <div class="select">
                <span style="display: none; position: absolute; top: -5px; left: 10px;"></span>
              </div>
              <input type="text" id="CollegeProblem" name="collegeProblem" class="CollegeProblem" required style="border:none; outline: none;
            background: red; position: absolute;
            top:13px; left:10px; opacity: 0;
            pointer-events: none;" />
              <ul class="dropdown-menu">
                <li id="1">ACCOMMODATION FEE</li>
                <li id="2">ACRYLIC PLATE</li>
                <li id="3">AIR-CONDITIONER</li>
                <li id="4">AUTOGATE BARRIER</li>
                <li id="5">BED</li>
                <li id="6">BOOKSHELF</li>
                <li id="7">CABINET</li>
                <li id="8">CEILING</li>
                <li id="9">CHAIR</li>
                <li id="10">CISTERN</li>
                <li id="11">CLEANLINESS</li>
                <li id="12">CLOGGED</li>
                <li id="13">CLOTH HANGER</li>
                <li id="14">COUNTER SERVICE</li>
                <li id="15">CURTAIN</li>
                <li id="16">DOOR</li>
                <li id="17">DOOR LOCK</li>
                <li id="18">DRAIN</li>
                <li id="19">DRAWER/CUPBOARD</li>
                <li id="20">DRYER</li>
                <li id="21">EXHAUST FAN</li>
                <li id="22">FAN</li>
                <li id="23">FRIDGE</li>
                <li id="24">GAS STOVE</li>
                <li id="25">GRILL</li>
                <li id="26">GUTTER</li>
                <li id="27">INDUCTION COOKER</li>
                <li id="28">IRON</li>
                <li id="29">KETTLE</li>
                <li id="30">LAMP</li>
                <li id="31">LANDSCAPE</li>
                <li id="32">LEAKED</li>
                <li id="33">LIFT</li>
                <li id="34">LPG GAS</li>
                <li id="35">MAIN HOLE</li>
                <li id="36">MATTRESS</li>
                <li id="37">MCB</li>
                <li id="38">MICROWAVE</li>
                <li id="39">MIRROR</li>
                <li id="40">PA SYSTEM</li>
                <li id="41">PANEL FIRE ALARM</li>
                <li id="42">PEST CONTROL</li>
                <li id="43">PIPING</li>
                <li id="44">PLUG</li>
                <li id="45">ROAD</li>
                <li id="46">ROOF</li>
                <li id="47">SHOWER</li>
                <li id="48">SIGNAGE</li>
                <li id="49">SINK</li>
                <li id="50">TABLE</li>
                <li id="51">TELEVISION</li>
                <li id="52">TILE/FLOOR</li>
                <li id="53">TOILET BOWL</li>
                <li id="54">TOWEL HANGER</li>
                <li id="55">TRIP</li>
                <li id="56">WASHING MACHINE</li>
                <li id="57">WATER BOILER</li>
                <li id="58">WATER DISPENSER</li>
                <li id="59">WATER HEATER</li>
                <li id="60">WATER PREASURE</li>
                <li id="61">WATER PROOFING</li>
                <li id="62">WATER SUPPLY</li>
                <li id="63">WINDOW</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-3 text-right">
            <label for="exampleInputPassword1" class="">Problem Details :</label>
          </div>
          <div class="col-9">
            <textarea name="message1" rows="3" cols="60" class="form-control ProblemDetails" id="message1" placeholder="Please describe your problem" required=""></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-3 text-right">
            <label class="">Problem Location :</label>
          </div>
          <div class="col-9">
            <textarea name="hd_location" rows="3" cols="60" class="form-control ProblemLocation" id="hd_location" placeholder="Please describe your problem location" required=""></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-3 text-right">
            <label for="exampleInputFile" class="" action="upload.php" enctype="multipart/form-data">Upload File :</label>
          </div>
          <div class="col-9">
            <input name="uploadedfile" type="file" id="uploadedfile" class="fileUpload" />
            <p class="help-block">
              Note: only jpg , gif , png ,pdf , doc , docx and max size 5 MB.
            </p>
          </div>
        </div>
        <div class="btn-group">
          <button class="btn" id="submitBtn"><i class="fa fa-check" type="submit" value="Add" name="Submit"></i> Submit</button>
          <?php
          if ($flag == true) { ?>
            <div id="myModal" class="modal  animate__animated animate__rotateIn">
              <div class="w3-modal-content" style="max-width:600px">
                <span class="close">&times;</span>
                <i class="fa fa-check-circle" style="font-size:48px;color:#15da6d"></i>
                <p class="submission">Thank You <br>
                  Your report was submitted successfully.</p>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
        <div class="btn-group">
          <button type="button" class="btn" id="cancel" onClick="window.location.reload();"><i class="fa fa-close"></i>
            Cancel</button>
        </div>
      </div>
    </form>
  </div>
  <script type="text/javascript" src=" https://cdn.jsdelivr.net/gh/yesiamrocks/cssanimation.io@1.0.3/letteranimation.min.js"></script>
  <script src="https://kit.fontawesome.com/e881600de5.js" crossorigin="anonymous"></script>
  <script src="js/report.js"></script>
</div>