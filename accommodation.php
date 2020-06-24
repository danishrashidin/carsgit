<?php

include_once("config.php");

$result = mysqli_query($connection, "SELECT Application_ID, Student_ID, Initial_Date, Final_Date, Duration, Total_Cost, Reason, Date_	 	
FROM accomodation ORDER BY Application_ID DESC");

?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/tabs.css" />
<div>

    <div class="container-fluid">
        <div class="tab">
            <button class="tablinks AllApplications">All Applications</button>
            <button class="tablinks Completed completed">Completed</button>
            <button class="tablinks Pending pending">Pending</button>
            <button class="tablinks InProgress inprogress">In Progress</button>
        </div>

        <div id="AllApplications" class="tabcontent">
            <div class="tablediv">
                <table>
                    <thead>
                        <tr>
                            <th>Application ID</th>
                            <th>Initial Date</th>
                            <th>Final Date</th>
                            <th>Duration</th>
                            <th>Total Cost</th>
                            <th>Date Submitted</th>
                            <th>Status</th>
                            <th>Update</th>
                        </tr>

                        <?php
                        while ($res = $result->fetch_array()) {
                            echo "<tr>";
                            $id = $res['Application_ID'];
                            echo "<td>" . $res['Application_ID'] . "</td>";
                            echo "<td>" . $res['Initial_Date'] . "</td>";
                            echo "<td>" . $res['Final_Date'] . "</td>";
                            echo "<td>" . $res['Duration'] . "</td>";
                            echo "<td>" . $res['Total_Cost'] . "</td>";
                            echo "<td>" . $res['Date_'] . "</td>";
                            $status = calculate($res['Date_'], date('Y-m-d'));
                            echo "<td>" . $status . "</td>";
                            mysqli_query($connection, "UPDATE accomodation SET Status_='$status' WHERE Application_ID='$id' ");
                            if ($status == 'Pending') {
                        ?>
                                <td><a href="<?php echo "dashboard.php?page=editaccommodation&id=" . $res['Application_ID'] ?>"><i class="fa fa-edit"></i></a> |
                                    <a href="<?php echo "dashboard.php?page=deleteaccommodation&id=" . $res['Application_ID'] ?>"><i class="fa fa-trash"></i></a></td>
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
                        <tr>
                            <th>Application ID</th>
                            <th>Initial Date</th>
                            <th>Final Date</th>
                            <th>Duration</th>
                            <th>Total Cost</th>
                            <th>Date Submitted</th>
                            <th>Status</th>
                            <th>Update</th>
                        </tr>
                        <?php
                        $result = mysqli_query($connection, "SELECT * FROM accomodation WHERE Status_='Pending' ");
                        while ($newReport = $result->fetch_array()) {
                            echo "<tr>";
                            echo "<td>" . $newReport['Application_ID'] . "</td>";
                            echo "<td>" . $newReport['Initial_Date'] . "</td>";
                            echo "<td>" . $newReport['Final_Date'] . "</td>";
                            echo "<td>" . $newReport['Duration'] . "</td>";
                            echo "<td>" . $newReport['Total_Cost'] . "</td>";
                            echo "<td>" . $newReport['Date_'] . "</td>";
                            echo "<td>" . $newReport['Status_'] . "</td>";
                        ?>
                            <td><a href="<?php echo "dashboard.php?page=editaccommodation&id=" . $newReport['Application_ID'] ?>"><i class="fa fa-edit"></i></a> | <a href="<?php echo "dashboard.php?page=deleteaccommodation&id=" . $newReport['Application_ID'] ?>"><i class="fa fa-trash"></i></a>
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
                        <tr>
                            <th>Application ID</th>
                            <th>Initial Date</th>
                            <th>Final Date</th>
                            <th>Duration</th>
                            <th>Total Cost</th>
                            <th>Date Submitted</th>
                            <th>Status</th>
                            <!-- <th>Update</th> -->
                        </tr>
                        <?php
                        $result = mysqli_query($connection, "SELECT * FROM accomodation WHERE Status_='Completed' ");
                        while ($newReport = $result->fetch_array()) {
                            echo "<tr>";
                            echo "<td>" . $newReport['Application_ID'] . "</td>";
                            echo "<td>" . $newReport['Initial_Date'] . "</td>";
                            echo "<td>" . $newReport['Final_Date'] . "</td>";
                            echo "<td>" . $newReport['Duration'] . "</td>";
                            echo "<td>" . $newReport['Total_Cost'] . "</td>";
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
                        <tr>
                            <th>Application ID</th>
                            <th>Initial Date</th>
                            <th>Final Date</th>
                            <th>Duration</th>
                            <th>Total Cost</th>
                            <th>Date Submitted</th>
                            <th>Status</th>
                            <!-- <th>Update</th> -->
                        </tr>
                        <?php
                        $result = mysqli_query($connection, "SELECT * FROM accomodation WHERE Status_='In Progress' ");
                        while ($newReport = $result->fetch_array()) {
                            echo "<tr>";
                            echo "<td>" . $newReport['Application_ID'] . "</td>";
                            echo "<td>" . $newReport['Initial_Date'] . "</td>";
                            echo "<td>" . $newReport['Final_Date'] . "</td>";
                            echo "<td>" . $newReport['Duration'] . "</td>";
                            echo "<td>" . $newReport['Total_Cost'] . "</td>";
                            echo "<td>" . $newReport['Date_'] . "</td>";
                            echo "<td>" . $newReport['Status_'] . "</td>";
                            echo "<td>" . "</td>";
                        }
                        ?>
                    </thead>
                </table>
            </div>
        </div>
        <!-- <button type="button" class="reportButton" > <a class="nav-link" href="html/report.html">Make a report</a></button> -->

        <script src="js/applicationindex.js"></script>
        <script src="https://kit.fontawesome.com/e881600de5.js" crossorigin="anonymous"></script>
    </div>

    <?php
    function calculate($Date1, $Date2)
    {
        $submittedDate = date_create($Date1);
        $currentdate = date_create($Date2);
        $interval = date_diff($submittedDate, $currentdate);
        $diff   = $interval->format('%a');
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