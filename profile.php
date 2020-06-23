<link rel="stylesheet" type="text/css" href="css/profile.css" />
<?php

$sql = 'SELECT College_Name FROM college WHERE College_ID = '.$array['College_ID'];
$college = $connection->query($sql);

if(isset($_POST["ic"])){
    $updatesql = 'UPDATE student SET IC = '.$_POST["ic"].' WHERE Student_ID = '.$_SESSION['Student_ID'];
    $connection->query($updatesql);
}

if(isset($_POST["phone"])){
    $updatesql = 'UPDATE student SET Phone_Number = '.$_POST["phone"].' WHERE Student_ID = '.$_SESSION['Student_ID'];
    $connection->query($updatesql);
}

?>

<div class="content-container">
    <form class="needs-validation" novalidate method="post" action="dashboard.php?page=profile">
        <div class="form-row">
            <div class="col form-group">
                <div class="vertical-container">
                    <img class="profile-image mb-4" src="<?php echo $array['Image']?>" />
                    <a href="#">Update Photo</a>
                </div>
                <div></div>
            </div>
        </div>
        <div class="form-row">
            <div class="col form-group">
                <label for="fname">Full name</label>
                <input readonly type="text" class="form-control" id="fname" name="fname"
                    value="<?php echo $array['Full_Name']?>" />
            </div>

            <div class="col-1"></div>
            <div class="col form-group">
                <label for="matrics">Matric number</label>
                <input readonly type="text" class="form-control" id="matrics" name="matrics" value="<?php echo $array['Matric_Number']?>" />
            </div>
        </div>
        <div class="form-row">
            <div class="col form-group">
                <label for="email">Email</label>
                <input readonly type="email" class="form-control" id="email" name="email"
                    value="<?php echo $array['Email']?>" />
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
                <input readonly type="text" class="form-control" id="college" name="college" value="<?php echo $college->fetch_assoc()['College_Name']?>" />
            </div>

            <div class="col-1"></div>

            <div class="col form-group">
                <label for="faculty">Faculty</label>
                <input readonly type="text" class="form-control" id="faculty" name="faculty"
                    value="<?php echo $array['Faculty']?>" />
            </div>
        </div>
        <div class="form-row">
            <div class="col form-group">
                <label for="ic">Identification Card No.</label>
                <input type="text" class="form-control" id="ic" name="ic" pattern="[0-9]{12}" value="<?php echo $array['IC']?>" />
            </div>

            <div class="col-1"></div>
            <div class="col form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo '0'.$array['Phone_Number']?>" />
            </div>
        </div>
        <div class="form-row mt-5">
            <div class="col form-group horizontal-container">
                <button type="submit" class="btn form-button px-5 py-3"
                    style="background-color: #00df89; border-color: #00df89;">
                    SAVE
                </button>

                <button type="submit" class="btn form-button px-5 py-3"
                    style="background-color: #cc4a49; border-color: #cc2a49;">
                    DELETE ACCOUNT
                </button>
            </div>
        </div>
</div>
</form>
</div>