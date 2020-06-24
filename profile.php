<link rel="stylesheet" type="text/css" href="css/profile.css" />
<?php

$sql = 'SELECT College_Name FROM college WHERE College_ID = ' . $array['College_ID'];
$college = $connection->query($sql);

if (isset($_POST["ic"])) {
    $updatesql = 'UPDATE student SET IC = ' . $_POST["ic"] . ' WHERE Student_ID = ' . $_SESSION['Student_ID'];
    $connection->query($updatesql);
}

if (isset($_POST["phone"])) {
    $updatesql = 'UPDATE student SET Phone_Number = ' . $_POST["phone"] . ' WHERE Student_ID = ' . $_SESSION['Student_ID'];
    $connection->query($updatesql);
}

// Check if image file is a actual image or fake image
if (isset($_POST["submit"]) && $_FILES["photo"]['error'] !== 4) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $rename = $target_dir . $_SESSION['Student_ID'] . $fileType;
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    // if ($_FILES["photo"]["size"] > 500000) {
    //     echo "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }

    // Allow certain file formats
    if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, & PNG are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        $updatesql = 'UPDATE student SET Photo = \'' . $target_file . '\' WHERE Student_ID = ' . $_SESSION['Student_ID'];
        if ($connection->query($updatesql) === true) {
            //echo "The file " . basename($_FILES["photo"]["name"]) . " has been uploaded.";
            move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// retrieve student data
$sql = 'SELECT * FROM student WHERE Student_ID = ' . $_SESSION["Student_ID"];
$query = $connection->query($sql);
$array = $query->fetch_assoc();

?>

<div class="content-container">
    <form class="needs-validation" novalidate method="post" action="dashboard.php?page=profile" enctype="multipart/form-data">
        <div class="form-row">
            <div class="col form-group">
                <div class="vertical-container">
                    <img class="profile-image mb-4" src="<?php echo $array['Photo'] ?>" />
                    <input type="file" class="file" id="photo" name="photo" />
                </div>
                <div></div>
            </div>
        </div>
        <div class="form-row">
            <div class="col form-group">
                <label for="fname">Full name</label>
                <input readonly type="text" class="form-control" id="fname" name="fname" value="<?php echo $array['Full_Name'] ?>" />
            </div>

            <div class="col-1"></div>
            <div class="col form-group">
                <label for="matrics">Matric number</label>
                <input readonly type="text" class="form-control" id="matrics" name="matrics" value="<?php echo $array['Matric_Number'] ?>" />
            </div>
        </div>
        <div class="form-row">
            <div class="col form-group">
                <label for="email">Email</label>
                <input readonly type="email" class="form-control" id="email" name="email" value="<?php echo $array['Email'] ?>" />
            </div>

            <div class="col-1"></div>
            <div class="col form-group">
                <label for="password">Password</label>
                <input readonly type="password" class="form-control" id="password" name="passw" value="<?php ?>" />
            </div>
        </div>
        <div class="form-row">
            <div class="col form-group">
                <label for="college">College</label>
                <input readonly type="text" class="form-control" id="college" name="college" value="<?php echo $college->fetch_assoc()['College_Name'] ?>" />
            </div>

            <div class="col-1"></div>

            <div class="col form-group">
                <label for="faculty">Faculty</label>
                <input readonly type="text" class="form-control" id="faculty" name="faculty" value="<?php echo $array['Faculty'] ?>" />
            </div>
        </div>
        <div class="form-row">
            <div class="col form-group">
                <label for="ic">Identification Card No.</label>
                <input type="text" class="form-control" id="ic" name="ic" pattern="[0-9]{12}" value="<?php echo $array['IC'] ?>" />
            </div>

            <div class="col-1"></div>
            <div class="col form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo '0' . $array['Phone_Number'] ?>" />
            </div>
        </div>
        <div class="form-row mt-5">
            <div class="col form-group horizontal-container">
                <input type="submit" name="submit" class="btn form-button px-5 py-3" style="background-color: #00df89; border-color: #00df89;" value="SAVE" />
                <button onclick=<?php echo 'deleteConfirmation(' . $_SESSION["Student_ID"] . ')'; ?> class="btn form-button px-5 py-3" style="background-color: #cc4a49; border-color: #cc2a49;">DELETE ACCOUNT</button>
            </div>
        </div>

</div>
</form>
<form class='delete-account' method='post' action='dashboard.php?page=profile'>
    <input type="hidden" name="delete" value="DELETE ACCOUNT" />
</form>