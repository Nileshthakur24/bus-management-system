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
    $update = "update tbl_car set car_name='$carname',car_company='$carcompany',car_detail='$cardetail',car_price=$carprice,launch_year=$carlaunchyear where car_id=$_GET[carid]";
    if (mysqli_query($connect, $update)) {
        $_SESSION['msg'] = "Success: record updated successfully";
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
        <form method="post">
            <table>
                <tr>
                    <td>Enter car name:</td>
                    <td><input type="text" name="txtcarname" value="<?php echo $data['car_name']; ?>" /></td>
                </tr>

                <tr>
                    <td>Enter car company name:</td>
                    <td><input type="text" name="txtcarcompany" value="<?php echo $data['car_company']; ?>" /></td>
                </tr>

                <tr>
                    <td>Enter Description:</td>
                    <td><textarea cols="25" rows="3" name="txtdetail"><?php echo $data['car_detail']; ?></textarea></td>
                </tr>

                <tr>
                    <td>Enter Price:</td>
                    <td><input type="text" name="txtcarprice" value="<?php echo $data['car_price']; ?>" /></td>
                </tr>

                <tr>
                    <td>Enter Launch Year:</td>
                    <td><input type="text" name="txtyear" value="<?php echo $data['launch_year']; ?>" /></td>
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