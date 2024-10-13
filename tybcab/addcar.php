<?php
session_start();
include ("connect.php");

if (isset($_GET['carid'])) {
    $carid = $_GET['carid'];
    $select = "select * from tbl_car where car_id=$carid";
    $result = mysqli_query($connect, $select);
    $data = mysqli_fetch_assoc($result);
}
if (isset($_POST['btnsubmit'])) {
    $carname = $_POST['txtcarname'];
    $carcompany = $_POST['txtcarcompany'];
    $cardetail = $_POST['txtdetail'];
    $carprice = $_POST['txtcarprice'];
    $carlaunchyear = $_POST['txtyear'];
    if (empty($_FILES['file']['name'])) {
        $carUploadName = $_POST['txtfilename'];
    } else {
        if (isset($_POST['txtfilename'])) {
            unlink($_POST['txtfilename']);
        }
        $checkType = $_FILES['file']['type'];
        $correct = 0;
        if ($checkType == "image/jpeg" || $checkType == "image/jpg") {
            $correct = 1;
        }
        $carUploadName = "./uploads/" . $_FILES['file']['name'];
        $cartmpname = $_FILES['file']['tmp_name'];
        move_uploaded_file($cartmpname, $carUploadName);
    }
    if (isset($_GET['carid'])) {
        $query = "update tbl_car set car_name='$carname',car_company='$carcompany',car_detail='$cardetail',car_price=$carprice,launch_year=$carlaunchyear,car_image='$carUploadName' where car_id=$_GET[carid]";
    } else {
        $query = "insert into tbl_car values(0,'$carname','$carcompany','$cardetail',$carprice,$carlaunchyear,'$carUploadName')";
    }
    if (mysqli_query($connect, $query)) {
        $_SESSION['msg'] = "Success: record saved successfully";
        header("location:home.php");
    } else {
        echo mysqli_error($connect);
    }
}
?>
<html>

<head>
    <title>Car Site</title>
</head>

<body>
    <center>
        Welcome <?php echo $_SESSION['username']; ?> |<a href="logout.php">Logout</a>
        <br />
        <a href="home.php">Back</a>
        <h2>-- Car Detail --</h2>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Enter car name:</td>
                    <td><input type="text" name="txtcarname" value="<?php if (isset($_GET['carid']))
                        echo $data['car_name']; ?>" /></td>
                </tr>

                <tr>
                    <td>Enter car company name:</td>
                    <td><input type="text" name="txtcarcompany" value="<?php if (isset($_GET['carid']))
                        echo $data['car_company']; ?>" /></td>
                </tr>

                <tr>
                    <td>Enter Description:</td>
                    <td><textarea cols="25" rows="3" name="txtdetail"><?php if (isset($_GET['carid']))
                        echo $data['car_detail']; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Enter Price:</td>
                    <td><input type="text" name="txtcarprice" value="<?php if (isset($_GET['carid']))
                        echo $data['car_price']; ?>" /></td>
                </tr>

                <tr>
                    <td>Enter Launch Year:</td>
                    <td><input type="text" name="txtyear" value="<?php if (isset($_GET['carid']))
                        echo $data['launch_year']; ?>" /></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="file" />
                        <?php
                        if (isset($_GET['carid'])) {
                            ?>
                            <input type="hidden" name="txtfilename" value="<?php echo $data['car_image'] ?>" />
                            <br /><img src="<?php echo $data['car_image'] ?>" width="100" height="100" />
                            <?php
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td><input type="submit" name="btnsubmit" value="Submit" /></td>
                </tr>
            </table>
        </form>
    </center>
</body>

</html>