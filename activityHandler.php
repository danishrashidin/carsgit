<?php
include_once "config.php";

$response = array("status" => "", "generalError" => "", "activityName" => "");
if (isset($_SESSION['Student_ID'])) {
    $student_id = $_SESSION['Student_ID'];
}

// print_r(json_encode($_POST));
try {
    if (isset($_POST['position'])) {
        $position = $_POST['position'];
    }

    $activity_name = $_POST['activityName'];
    $collegeId = $_POST['collegeId'];
    $status = "pending";

    $query = "SELECT Activity_ID FROM Activity WHERE Activity_Name = '$activity_name' AND College_ID = '$collegeId' ";
    $result = $connectionString->query($query);
    $activity = $result->fetch_array();
    $ac_id = $activity['Activity_ID'];

    if ($_POST['action'] == "register") {
        $insertQuery = "INSERT INTO Registration(Activity_ID, Student_ID, Status, Position) VALUES ('$ac_id','$student_id','$status','$position')";
        $connectionString->query($insertQuery);
    }

    if ($_POST['action'] == "cancel register") {
        $deleteQuery = "DELETE FROM Registration WHERE Activity_ID = '$ac_id' AND Student_ID = '$student_id'";
        $connectionString->query($deleteQuery);
    }

    $response['status'] = 'success';
    $response['activityName'] = $activity_name;
    print_r(json_encode($response));
} catch (PDOException $err) {
    $response['status'] = 'failed';
    $response['generalError'] = $sql . "<br>" . $err->getMessage();
    print_r(json_encode($response));
}

?>
