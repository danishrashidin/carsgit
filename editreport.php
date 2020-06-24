<?php
include_once "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['update'])) {
        $newCollege = $_POST['collegeName'];
        $newProb = $_POST['collegeProblem'];
        $newDes = $_POST['message1'];
        $newLoc = $_POST['hd_location'];
        $newFile = $_POST['uploadedfile'];
        $idid = $_POST['ReportID'];

        mysqli_query($connection, "UPDATE report SET College_ID='$newCollege',
    Problem_Type='$newProb', Problem_Details='$newDes',
    Problem_Location='$newLoc', File_Upload='$newFile'
    WHERE ReportID='$idid'");

        echo '<script type="text/javascript">window.location.href="dashboard.php?page=report"</script>';
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $editID = $_GET['id'];
    $res = mysqli_query($connection, "SELECT * FROM report WHERE Report_ID='$editID' ");

    $result = mysqli_fetch_array($res);

    $ReportID = $result['Report_ID'];
    $collegeName = $result['College_ID'];
    $collegeProblem = $result['Problem_Type'];
    $message1 = $result['Problem_Details'];
    $hd_location = $result['Problem_Location'];
    $uploadedfile = $result['File_Upload'];

    // checking empty fields
    // if(empty($collegeName) || empty($collegeProblem) || empty($message1) || empty($hd_location)) {
    //     if(empty($collegeName)){
    //         echo "<font color='red'>Residential College is empty.</font><br/>";
    //     }

    //     if(empty($collegeProblem)) {
    //         echo "<font color='red'>College Problem field is empty.</font><br/>";
    //     }

    //     if(empty($message1)) {
    //         echo "<font color='red'>Problem Details field is empty.</font><br/>";
    //     }
    //     if(empty($hd_location)) {
    //         echo "<font color='red'>Problem Location field is empty.</font><br/>";
    //     }
    // } else {
    // $result = mysqli_query($connection, "UPDATE report SET Residential College='$collegeName',Problem Type='$collegeProblem', Problem Details='$message1', Problem Location='$hd_location', File='$fileuploaded' WHERE ReportID=$ReportID");

    // header("Location: reportIndex.php");
    // }
    ?>
  <link rel="stylesheet" href="css/report.css" />

<div class='report'>
  <div class="container-fluid bg-dark text-white"
      style="margin:auto; text-align:center;background-size: 150px;padding-top: 32px;padding-bottom: 30px; border-radius: 1rem 1rem 0 0;">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <!-- <div class="jumbotron" id="jumbotron" style="margin-bottom:0; width:800; text-align:center;background-size: 150px;padding-top: 32px;padding-bottom: 30px;"> -->
      <h4>REPORT COLLEGE ISSUE </h4>
      <p class="text-muted small">
      <div class="cssanimation fadeIn infinite">Are there any damages?
        Help us by filling up this form and we will fix it right away!
      </div>
      </p>
    </div>
    <form id="report-form" name="reportForm" method="post" action="dashboard.php?page=editreport">
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
                <span style="display: inline; position: absolute; top: 0.2rem; left: 10px;"><?php echo $collegeName; ?></span>
              </div>
              <input type="text" id="CollegeName" value="<?php echo $collegeName; ?>" name="collegeName" class="CollegeName" required style="border:none; outline: none;
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
                <span style="display: inline; position: absolute; top: 0.2rem; left: 10px;"><?php echo $collegeProblem; ?></span>
              </div>
              <input type="text" id="CollegeProblem"
              value="<?php echo $collegeProblem; ?>" name="collegeProblem"
              class="CollegeProblem" required style="border:none; outline: none;
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
            <textarea name="message1" value="<?php echo $message1; ?>" rows="3" cols="60" class="form-control ProblemDetails" id="message1"
              placeholder="Please describe your problem" required=""><?php echo $message1; ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-3 text-right">
            <label class="">Problem Location :</label>
          </div>
          <div class="col-9">
            <textarea name="hd_location" value="<?php echo $hd_location; ?>" rows="3" cols="60" class="form-control ProblemLocation" id="hd_location"
              placeholder="Please describe your problem location" required=""><?php echo $hd_location; ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-3 text-right">
            <label for="exampleInputFile" class="">Upload File :</label>
          </div>
          <div class="col-9">
            <input name="uploadedfile" value="<?php echo $uploadedfile; ?>" type="file" id="uploadedfile" class="fileUpload" />
            <p class="help-block">
              Note: only jpg , gif , png ,pdf , doc , docx and max size 5 MB.
            </p>
          </div>
        </div>
        <input type="hidden" name="ReportID" value=<?php echo $editID; ?>>
        <div class="btn-group">
        <button class="btn" id="submitBtn" value="Update" name="update"><i class="fa fa-check" type="submit" value="Update" name="update"></i> Update</button>
        </div>
    </form>
    </div>
  <script type="text/javascript"
    src=" https://cdn.jsdelivr.net/gh/yesiamrocks/cssanimation.io@1.0.3/letteranimation.min.js"></script>
  <script src="https://kit.fontawesome.com/e881600de5.js" crossorigin="anonymous"></script>
  <script src="js/edit.js"></script>
</div>
<?php
}