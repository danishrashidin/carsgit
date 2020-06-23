<?php

include_once "config.php";

$result = mysqli_query($connection, "SELECT Report_ID, College_ID, Problem_Type, Date_
FROM report ORDER BY Report_ID DESC");

?>
<link rel="stylesheet" href="css/tabs.css" />

<div class="container-fluid">
    <div class="tab">
        <button class="tablinks AllTransactions">All Transactions</button>
        <button class="tablinks Completed completed">Completed</button>
        <button class="tablinks Pending pending">Pending</button>
        <button class="tablinks InProgress inprogress">In Progress</button>
    </div>

    <div id="AllTransactions" class="tabcontent">
        <div class="tablediv">
            <table>
                <thead>
                    <tr class="t-category">
                        <th>Report ID</th>
                        <th>Residential College</th>
                        <th>Problem Type</th>
                        <th>Date Submitted</th>
                        <th>Status</th>
                        <th>Update</th>
                    </tr>

                    <?php
                    while ($res = mysqli_fetch_array($result)) {
                        echo '<tr>';
                        $id = $res['Report_ID'];
                        echo "<td>" . $res['Report_ID'] . "</td>";
                        echo "<td>" . $res['College_ID'] . "</td>";
                        echo "<td>" . $res['Problem_Type'] . "</td>";
                        echo "<td>" . $res['Date_'] . "</td>";
                        $status = calculate($res['Date_'], date('Y-m-d'));
                        echo "<td>" . $status . "</td>";
                        mysqli_query($connection, "UPDATE report SET Status_='$status' WHERE Report_ID='$id' ");
                        if ($status == 'Pending') {
                    ?>
                            <td><a href="<?php echo "dashboard.php?page=editreport&id=" . $res['Report_ID'] ?>"><i class="fa fa-edit"></i></a> |
                                <a href="<?php echo "dashboard.php?page=deletereport&id=" . $res['Report_ID'] ?>"><i class="fa fa-trash"></i></a></td>
                            </tr>
                    <?php
                        } else {
                            echo "<td>" . "</td>";
                        }
                    }
                    ?>
                </thead>
            </table>
        </div>
    </div>

    <div id="Pending" class="tabcontent">
        <div class="tablediv">
            <table>
                <thead>
                    <tr class="t-category">
                        <th>Report ID</th>
                        <th>Residential College</th>
                        <th>Problem Type</th>
                        <th>Date Submitted</th>
                        <th>Status</th>
                        <th>Update</th>
                    </tr>
                    <?php
                    $result = mysqli_query($connection, "SELECT * FROM report WHERE Status_='Pending' ");
                    while ($newReport = mysqli_fetch_array($result)) {
                        echo '<tr>';
                        echo "<td>" . $newReport['Report_ID'] . "</td>";
                        echo "<td>" . $newReport['College_ID'] . "</td>";
                        echo "<td>" . $newReport['Problem_Type'] . "</td>";
                        echo "<td>" . $newReport['Date_'] . "</td>";
                        echo "<td>" . $newReport['Status_'] . "</td>";
                    ?>
                        <td><a href="<?php echo "dashboard.php?page=editreport&id=" . $newReport['Report_ID'] ?>"><i class="fa fa-edit"></i></a> | <a href="<?php echo "dashboard.php?page=deletereport&id=" . $newReport['Report_ID'] ?>"><i class="fa fa-trash"></i></a>
                        </td>
                        </tr>
                    <?php
                    }
                    ?>
                </thead>
            </table>
        </div>
    </div>

    <div id="Completed" class="tabcontent">
        <div class="tablediv">
            <table>
                <thead>
                    <tr class="t-category">
                        <th>Report ID</th>
                        <th>Residential College</th>
                        <th>Problem Type</th>
                        <th>Date Submitted</th>
                        <th>Status</th>
                        <th>Update</th>
                    </tr>
                    <?php
                    $result = mysqli_query($connection, "SELECT * FROM report WHERE Status_='Completed' ");
                    while ($newReport = mysqli_fetch_array($result)) {
                        echo '<tr>';
                        echo "<td>" . $newReport['Report_ID'] . "</td>";
                        echo "<td>" . $newReport['College_ID'] . "</td>";
                        echo "<td>" . $newReport['Problem_Type'] . "</td>";
                        echo "<td>" . $newReport['Date_'] . "</td>";
                        echo "<td>" . $newReport['Status_'] . "</td>";
                        echo "<td>" . "</td>";
                    }
                    ?>
                </thead>
            </table>
        </div>
    </div>

    <div id="InProgress" class="tabcontent">
        <div class="tablediv">
            <table>
                <thead>
                    <tr class="t-category">
                        <th>Report ID</th>
                        <th>Residential College</th>
                        <th>Problem Type</th>
                        <th>Date Submitted</th>
                        <th>Status</th>
                        <th>Update</th>
                    </tr>
                    <?php
                    $result = mysqli_query($connection, "SELECT * FROM report WHERE Status_='In Progress' ");
                    while ($newReport = mysqli_fetch_array($result)) {
                        echo '<tr>';
                        echo "<td>" . $newReport['Report_ID'] . "</td>";
                        echo "<td>" . $newReport['College_ID'] . "</td>";
                        echo "<td>" . $newReport['Problem_Type'] . "</td>";
                        echo "<td>" . $newReport['Date_'] . "</td>";
                        echo "<td>" . $newReport['Status_'] . "</td>";
                        echo "<td>" . "</td>";
                    }
                    ?>
                </thead>
            </table>
        </div>
    </div>

    <script src="js/reportRecord.js"></script>
    <script src="https://kit.fontawesome.com/e881600de5.js" crossorigin="anonymous"></script>

    <?php
    function calculate($Date1, $Date2)
    {
        $submittedDate = date_create($Date1);
        $currentdate = date_create($Date2);
        $interval = date_diff($submittedDate, $currentdate);
        $diff = $interval->format('%a');
        if ($diff <= 1) {
            return "Pending";
        }
        if ($diff > 1 && $diff <= 3) {
            return "In Progress";
        } else {
            return "Completed";
        }
    }
    ?>