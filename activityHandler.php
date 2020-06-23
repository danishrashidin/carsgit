<?php
session_start();
include_once "config.php";

$response = array("status" => "", "generalError" => "", "activityName" => "");
if (isset($_SESSION['Student_ID'])) {
    $student_id = $_SESSION['Student_ID'];
}

try {
    if (isset($_POST['position'])) {
        $position = $_POST['position'];
    }

    $activity_name = $_POST['activityName'];
    $collegeId = $_POST['collegeId'];
    $status = "pending";

    $query = "SELECT Activity_ID FROM activity WHERE Activity_Name = '$activity_name' AND College_ID = '$collegeId' ";
    $result = $connection->query($query);
    $activity = $result->fetch_array();
    $ac_id = $activity['Activity_ID'];

    if ($_POST['action'] == "register") {
        $insertQuery = "INSERT INTO registration(Activity_ID, Student_ID, Status, Position) VALUES ('$ac_id','$student_id','$status','$position')";
        $connection->query($insertQuery);
    }

    if ($_POST['action'] == "cancel register") {
        $deleteQuery = "DELETE FROM registration WHERE Activity_ID = '$ac_id' AND Student_ID = '$student_id'";
        $connection->query($deleteQuery);
    }

    $response['status'] = 'success';
    $response['activityName'] = $activity_name;
    print_r(json_encode($response));
    // print_r($response);
} catch (PDOException $err) {
    $response['status'] = 'failed';
    $response['generalError'] = $sql . "<br>" . $err->getMessage();
    print_r(json_encode($response));
    // print_r($response);

}
