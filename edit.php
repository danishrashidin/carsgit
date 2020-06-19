<?php
include_once "configReport.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['update'])) {
        $newCollege = $_POST['collegeName'];
        $newProb = $_POST['collegeProblem'];
        $newDes = $_POST['message1'];
        $newLoc = $_POST['hd_location'];
        $newFile = $_POST['uploadedfile'];
        $idid = $_POST['ReportID'];

        mysqli_query($mysqli, "UPDATE report SET Residential_College='$newCollege',
    Problem_Type='$newProb', Problem_Details='$newDes',
    Problem_Location='$newLoc', File_Upload='$newFile'
    WHERE ReportID='$idid'");

        header("Location:reportIndex.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $editID = $_GET['id'];
    $res = mysqli_query($mysqli, "SELECT * FROM report WHERE ReportID='$editID' ");

    $result = mysqli_fetch_array($res);

    $ReportID = $result['ReportID'];
    $collegeName = $result['Residential_College'];
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
    // $result = mysqli_query($mysqli, "UPDATE report SET Residential College='$collegeName',Problem Type='$collegeProblem', Problem Details='$message1', Problem Location='$hd_location', File='$fileuploaded' WHERE ReportID=$ReportID");

    // header("Location: reportIndex.php");
    // }
    ?>
<!DOCTYPE html>
<html>
<head>
  <title>Report issue</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/gh/yesiamrocks/cssanimation.io@1.0.3/cssanimation.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
  <link rel="stylesheet" href="css/report.css" />
  <link rel="stylesheet" type="text/css" href="css/styles.css" />

    <!-- Fonting -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet" />

</head>
<body>
  <div class="container bg-dark text-white"
      style="margin:auto; text-align:center;background-size: 150px;padding-top: 32px;padding-bottom: 30px;">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <!-- <div class="jumbotron" id="jumbotron" style="margin-bottom:0; width:800; text-align:center;background-size: 150px;padding-top: 32px;padding-bottom: 30px;"> -->
      <h4>REPORT COLLEGE ISSUE </h4>
      <p class="text-muted small">
      <div class="cssanimation fadeIn infinite">Are there any damages?
        Help us by filling up this form and we will fix it right away!
      </div>
      </p>
    </div>
    </div>
    <form id="report-form" name="reportForm" method="post" action="edit.php">
      <div class="container p-3" style="background-color: white; padding-top: 40px;">
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
                <span style="display: none; position: absolute; top: -5px; left: 10px;"><?php echo $collegeName; ?></span>
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
                <span style="display: none; position: absolute; top: -5px; left: 10px;"><?php echo $collegeProblem; ?></span>
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript"
    src=" https://cdn.jsdelivr.net/gh/yesiamrocks/cssanimation.io@1.0.3/letteranimation.min.js"></script>
  <script src="https://kit.fontawesome.com/e881600de5.js" crossorigin="anonymous"></script>
  <script src="js/edit.js"></script>
</body>
</html>
<?php
}