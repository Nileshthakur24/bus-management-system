<?php
include ("connect.php");
if (isset($_POST['btnsubmit'])) {
    $fname = $_POST['txtfirstname'];
    $lname = $_POST['txtlastname'];
    $address = $_POST['txtaddress'];
    $mobile = $_POST['txtmobile'];
    $email = $_POST['txtemail'];
    $password = $_POST['txtpassword'];
    $insert = "insert into tbl_registration values(0,'$fname','$lname','$address','$email','$password',$mobile)";
    if (mysqli_query($connect, $insert)){
        $success = "Success: User Registered Successfully";
         header("location:login.php");}
         
    else {
        $error = "Error: Something Went Wrong";
    }
}
?>
<html>

<head>
    <title>Car Site</title>
</head>

<body>
    <center>
        <h1>Car Module</h1>
        <a href="login.php">Login</a>
        <h2>-- Registration --</h2>
        <?php
        if (isset($success)) {
            ?>
            <p style='color:green'>
                <?php echo $success; ?>
            </p>
        <?php } ?>
        <?php
        if (isset($error)) {
            ?>
            <p style='color:red'>
                <?php echo $error; ?>
            </p>
        <?php } ?>
        <form method="post">
            <table>
                <tr>
                    <td>Enter first name:</td>
                    <td><input type="text" name="txtfirstname" /></td>
                </tr>

                <tr>
                    <td>Enter Last name:</td>
                    <td><input type="text" name="txtlastname" /></td>
                </tr>

                <tr>
                    <td>Enter Address:</td>
                    <td><textarea cols="25" rows="3" name="txtaddress"></textarea></td>
                </tr>

                <tr>
                    <td>Enter Mobile no:</td>
                    <td><input type="text" name="txtmobile" /></td>
                </tr>

                <tr>
                    <td>Enter Email id:</td>
                    <td><input type="text" name="txtemail" /></td>
                </tr>

                <tr>
                    <td>Enter Password:</td>
                    <td><input type="password" name="txtpassword" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="btnsubmit" value="Submit" /></td>
                </tr>
            </table>
        </form>
        <h2><?php if (isset($result))
            echo $result; ?></h2>
    </center>
</body>

</html>