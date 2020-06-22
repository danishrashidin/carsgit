<?php
include_once "config.php";

if(isset($_SESSION['Student_ID'])){
  $student_id = $_SESSION['Student_ID'];
}
$student_id = 1;

?>


<link rel="stylesheet" type="text/css" href="css/activity.css" />

<header id="header">
  <h1 class="title-header text-center">All College Activities</h1>
</header>

<div class="card-container">
  <div id="wrapper">
    <?php
    $sql = "SELECT * FROM Activity";
    $result = $connection->query($sql);
    echo '<div class="card-row">';
    while ($a = $result->fetch_array()) {
      $activity_id = $a['Activity_ID'];
      $activity_no = substr($activity_id, 0, 1);
      $activity_name = $a['Activity_Name'];
      $college = $a['College_ID'];
      $reg_date = $a['Reg_Dead'];

      $rem = strtotime($reg_date . ' 00:00:00') - time();
      $day = floor($rem / 86400);
      $hr = floor(($rem % 86400) / 3600);
      $min = floor(($rem % 3600) / 60);
      $sec = ($rem % 60);

      $registrationQuery = "SELECT * FROM Registration WHERE Student_ID= '$student_id' AND Activity_ID = '$activity_id'";

      $registrationResult = $connection->query($registrationQuery);
      $registration = $registrationResult->fetch_array();

    ?>
      <div class="card-<?php echo $activity_no; ?> cards fancycard" style="margin: auto;">
        <div class="wrapper">
          <div class="header">
            <div class="countdown">
              <ul>
                <li><span class="days"> <?php echo $day ?> </span>Days</li>
                <li><span class="hours"> <?php echo $hr ?> </span>Hours</li>
                <li><span class="minutes"> <?php echo $min ?> </span>Minutes</li>
              </ul>
            </div>
            <div class="menu-content">
              <span class="college --noDisplay" style="display:none"><?php echo $college; ?></span>
              <span class="college">KK<?php echo $college; ?></span>
            </div>
            <div class="menu-status">
              <span class="status">
                <?php
                if (isset($registration)) {
                  echo $registration['Status'];
                } else {
                  echo "Available";
                }
                ?></span>
            </div>
          </div>

          <div class="data">
            <div class="content">
              <h1 class="title">
                <a href="#"><?php echo $activity_name; ?></a><input type="hidden" name="activity_name" class="activity_name" value="<?php echo $activity_name; ?>"></input>
              </h1>
              <?php
              if (isset($registration)) {
                echo '<a  class="button --cancelRegister">Cancel Registration</a>';
              } else {
                echo '<a  class="button --register">Register Now!</a>';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
  </div>

  <div class="activityModal --registration">
    <form id="msform" method="POST" class="msform --registration">
      <ul id="progressbar">
        <li class="active">Register As</li>
        <li>Confirmation</li>
      </ul>
      <a class="close --register" type="button">x</a>

      <fieldset>
        <h2 class="fs-title">Choose your position</h2>
        <h3 class="fs-subtitle">Please choose your position</h3>
        <label>
          <input type="radio" name="position" value="highcomm" />
          <span>High-Committee</span>
        </label>
        <label>
          <input type="radio" name="position" value="member" checked />
          <span>Member</span>
        </label>
        <button type="button" name="next" class="next action-button --register">Next </button>
        <input type="hidden" name="collegeId" class="collegeId" value="">
        <input type="hidden" name="activityName" class="activityName" value="">
        <input type="hidden" name="action" value="register">
      </fieldset>

      <fieldset>
        <h2 class="fs-title">Confirmation</h2>
        <h3 class="fs-content --register"></h3>
        <input type="button" class="close action-button --register" value="Done" />
      </fieldset>
    </form>

  </div>

  <div class="activityModal --cancelRegistration">
    <form id="msform" method="POST" class="msform --cancelRegistration">
      <ul id="progressbar">
        <li class="active">Cancellation</li>
        <li>Confirmation</li>
      </ul>
      <a class="close --cancel" type="button">x</a>

      <fieldset>
        <h2 class="fs-title">Cancellation</h2>
        <h3 class="fs-subtitle"></h3>
        <label>
          <input class="yesCheck" type="radio" name="cancel" checked />
          <span>Yes</span>
        </label>
        <label>
          <input type="radio" name="cancel" />
          <span>No</span>
        </label>
        <button type="button" name="next" class="next action-button --cancelRegister">Next </button>
        <input type="hidden" name="collegeId" class="collegeId" value="">
        <input type="hidden" name="activityName" class="activityName" value="">
        <input type="hidden" name="action" value="cancel register">
      </fieldset>

      <fieldset>
        <h2 class="fs-title">Confirmation</h2>
        <h3 class="fs-content --cancelRegister"></h3>
        <input type="button" class="close action-button --cancel" value="Done" />
      </fieldset>
    </form>
  </div>


</div>
<script src="js/activity.js"></script>
