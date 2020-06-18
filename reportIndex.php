<?php

include_once("configReport.php");

$result = mysqli_query($mysqli, "SELECT ReportID, Residential_College, Problem_Type, Date 
FROM report ORDER BY ReportID DESC"); 

?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/reportRecord.css"/> 
</head>
<body>
<h2>Reports</h2>

<div class="container-md">
<div class="tab">
<button class="tablinks AllTransactions">All Transactions</button>
<button class="tablinks Completed" style="color:green;">Completed</button>
<button class="tablinks Pending" style="color:orange">Pending</button>
<button class="tablinks InProgress" style="color:rgb(140, 51, 192)">In Progress</button>
</div>

<div id="AllTransactions" class="tabcontent">
    <div class="tablediv">
        <table>
            <thead>
            <tr>
                <td>Report ID</td>
                <td>Residential College</td>
                <td>Problem Type</td>
                <td>Date Submitted</td>
                <td>Status</td>
                <td>Update</td>  
            </tr>
            
            <?php
            while($res = mysqli_fetch_array($result)) {         
                echo "<tr>";
                $id=$res['ReportID'];
                echo "<td>".$res['ReportID']."</td>";
                echo "<td>".$res['Residential_College']."</td>";
                echo "<td>".$res['Problem_Type']."</td>";
                echo "<td>".$res['Date']."</td>"; 
                $status= calculate($res['Date'],date('Y-m-d'));
                echo "<td>". $status . "</td>";   
                mysqli_query($mysqli, "UPDATE report SET Status_='$status' WHERE ReportID='$id' ");  
                if($status=='Pending'){       
                ?>
                <td><a href="<?php echo "edit.php?id=".$res['ReportID'] ?>"><i
                class="fa fa-edit"></i></a> | 
                <a href="<?php echo "delete.php?id=".$res['ReportID']?>"><i
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
            <td>Report ID</td>
                <td>Residential College</td>
                <td>Problem Type</td>
                <td>Date Submitted</td>
                <td>Status</td>
                <td>Update</td>  
            </tr>
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM report WHERE Status_='Pending' ");  
            while($newReport = mysqli_fetch_array($result)) {         
                echo "<tr>";
                echo "<td>".$newReport['ReportID']."</td>";
                echo "<td>".$newReport['Residential_College']."</td>";
                echo "<td>".$newReport['Problem_Type']."</td>";
                echo "<td>".$newReport['Date']."</td>";                            
                echo "<td>".$newReport['Status_']. "</td>";   
                ?>
                <td><a href="<?php echo "edit.php?id=".$newReport['ReportID'] ?>"><i
                class="fa fa-edit"></i></a> | <a href="<?php echo "delete.php?id=".$newReport['ReportID']?>"><i
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
            <td>Report ID</td>
                <td>Residential College</td>
                <td>Problem Type</td>
                <td>Date Submitted</td>
                <td>Status</td>
                <td>Update</td>  
            </tr>
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM report WHERE Status_='Completed' ");  
            while($newReport = mysqli_fetch_array($result)) {         
                echo "<tr>";
                echo "<td>".$newReport['ReportID']."</td>";
                echo "<td>".$newReport['Residential_College']."</td>";
                echo "<td>".$newReport['Problem_Type']."</td>";
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
                <td>Report ID</td>
                <td>Residential College</td>
                <td>Problem Type</td>
                <td>Date Submitted</td>
                <td>Status</td>
                <td>Update</td>  
            </tr>
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM report WHERE Status_='In Progress' ");  
            while($newReport = mysqli_fetch_array($result)) {         
                echo "<tr>";
                echo "<td>".$newReport['ReportID']."</td>";
                echo "<td>".$newReport['Residential_College']."</td>";
                echo "<td>".$newReport['Problem_Type']."</td>";
                echo "<td>".$newReport['Date']."</td>";                            
                echo "<td>".$newReport['Status_']. "</td>";  
                echo "<td>"."</td>";    
        }
        ?>
        </thead>
        </table>
        </div>
</div>    
    <script src="js/reportRecord.js"></script>
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