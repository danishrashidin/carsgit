<?php

include_once("applicationconfig.php");

$result = mysqli_query($mysqli, "SELECT Application_ID, Student_ID, Initial_Date, Final_Date, Duration, Total_Cost, Reason, Date	 	
FROM accomodation ORDER BY Application_ID DESC"); 
// $sql = "SELECT Application_ID, Student_ID, Initial_Date, Final_Date, Duration, Total_Cost, Reason, Date	 	
//          FROM accomodation ORDER BY Application_ID DESC";
// $result = $mysqli->query($sql);
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/applicationindex.css"/> 
</head>
<body>
<h2>Applications</h2>

<div class="container-md">
<div class="tab">
<button class="tablinks AllApplications">All Applications</button>
<button class="tablinks Completed" style="color:green;">Completed</button>
<button class="tablinks Pending" style="color:orange">Pending</button>
<button class="tablinks InProgress" style="color:rgb(140, 51, 192)">In Progress</button>
</div>

<div id="AllTransactions" class="tabcontent">
    <div class="tablediv">
        <table>
            <thead>
            <tr>
                <td>Application ID</td>
                <td>Initial Date</td>
                <td>Final Date</td>
                <td>Duration</td>
                <td>Total Cost</td>
                <td>Date Submitted</td>
                <td>Status</td>
                <td>Update</td>  
            </tr>
            
            <?php
            while($res = $result->fetch_array()) {         
                echo "<tr>";
                $id=$res['Application_ID'];
                echo "<td>".$res['Application_ID']."</td>";
                echo "<td>".$res['Initial_Date']."</td>";
                echo "<td>".$res['Final_Date']."</td>";
                echo "<td>".$res['Duration']."</td>";
                echo "<td>".$res['Total_Cost']."</td>";
                echo "<td>".$res['Date']."</td>"; 
                $status= calculate($res['Date'],date('Y-m-d'));
                echo "<td>". $status . "</td>";   
                mysqli_query($mysqli, "UPDATE accomodation SET Status_='$status' WHERE Application_ID='$id' ");  
                if($status=='Pending'){       
                ?>
                <td><a href="<?php echo "edit.php?id=".$res['Application_ID'] ?>"><i
                class="fa fa-edit"></i></a> | 
                <a href="<?php echo "delete.php?id=".$res['Application_ID']?>"><i
                class="fa fa-trash"></i></a></td></tr>   
                <?php     
        } else{
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
            <td>Application ID</td>
                <td>Initial Date</td>
                <td>Final Date</td>
                <td>Duration</td>
                <td>Total Cost</td>
                <td>Date Submitted</td>
                <td>Status</td>
                <td>Update</td>   
            </tr>
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM accomodation WHERE Status_='Pending' ");  
            while($newReport = $result->fetch_array()) {         
                echo "<tr>";
                echo "<td>".$newReport['Application_ID']."</td>";
                echo "<td>".$newReport['Initial_Date']."</td>";
                echo "<td>".$newReport['Final_Date']."</td>";
                echo "<td>".$newReport['Duration']."</td>";
                echo "<td>".$newReport['Total_Cost']."</td>";
                echo "<td>".$newReport['Date']."</td>";                            
                echo "<td>".$newReport['Status_']. "</td>";   
                ?>
                <td><a href="<?php echo "edit.php?id=".$newReport['Application_ID'] ?>"><i
                class="fa fa-edit"></i></a> | <a href="<?php echo "delete.php?id=".$newReport['Application_ID']?>"><i
                class="fa fa-trash"></i></a>
                </td></tr>    
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
            <td>Application ID</td>
                <td>Initial Date</td>
                <td>Final Date</td>
                <td>Duration</td>
                <td>Total Cost</td>
                <td>Date Submitted</td>
                <td>Status</td>
                <td>Update</td>    
            </tr>
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM accomodation WHERE Status_='Completed' ");  
            while($newReport = $result->fetch_array()) {         
                echo "<tr>";
                echo "<td>".$newReport['Application_ID']."</td>";
                echo "<td>".$newReport['Initial_Date']."</td>";
                echo "<td>".$newReport['Final_Date']."</td>";
                echo "<td>".$newReport['Duration']."</td>";
                echo "<td>".$newReport['Total_Cost']."</td>";
                echo "<td>".$newReport['Date']."</td>";                            
                echo "<td>".$newReport['Status_']. "</td>";    
                echo "<td>"."</td>";
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
            <td>Application ID</td>
                <td>Initial Date</td>
                <td>Final Date</td>
                <td>Duration</td>
                <td>Total Cost</td>
                <td>Date Submitted</td>
                <td>Status</td>
                <td>Update</td>     
            </tr>
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM report WHERE Status_='In Progress' ");  
            while($newReport = $result->fetch_array()) {         
                echo "<tr>";
                echo "<td>".$newReport['Application_ID']."</td>";
                echo "<td>".$newReport['Initial_Date']."</td>";
                echo "<td>".$newReport['Final_Date']."</td>";
                echo "<td>".$newReport['Duration']."</td>";
                echo "<td>".$newReport['Total_Cost']."</td>";
                echo "<td>".$newReport['Date']."</td>";                            
                echo "<td>".$newReport['Status_']. "</td>";  
                echo "<td>"."</td>";    
        }
        ?>
        </thead>
        </table>
        </div>
</div>    
    <button type="button" class="reportButton" > <a class="nav-link" href="html/report.html">Make a report</a></button>
    <!-- <script src="../js/reportRecord.js"></script> -->
    <script src="https://kit.fontawesome.com/e881600de5.js" crossorigin="anonymous"></script>
</body>

    <?php
    function calculate($Date1, $Date2){
        $submittedDate=date_create($Date1);
        $currentdate=date_create($Date2);
        $interval = date_diff($submittedDate, $currentdate);
        $diff   = $interval->format('%a');
        if($diff<=1){
            return "Pending";
        }
        if($diff>1 && $diff<=3){
            return "In Progress";
        }
        else{
            return "Completed";
        }
    }
    ?>

</html>