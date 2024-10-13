<?php
session_start();
if (isset($_SESSION['username']))
    header('location:home.php');
include ("connect.php");
function login($email, $password)
{
    global $connect;
    $select = "select * from tbl_registration where emailid='$email' and password='$password'";
    $result = mysqli_query($connect, $select);
    $count = mysqli_num_rows($result);
    if (isset($_POST['chkRemember'])) {
        setcookie('useremail', $email, time() + (30 * 86400));
        setcookie('userpassword', $password, time() + (30 * 86400));
    }
    if ($count > 0) {
        $_SESSION['username'] = $email;
        header("location: home.php");
    } else {
        $error = "Either email or password wrong";
        return $error;
    }
}

if (isset($_POST['btnsubmit'])) {
    $error = login($_POST['txtemail'], $_POST['txtpassword']);
}
?>
<html>

<head>
    <title>Login program</title>
</head>

<body>
    <center>
        <h1>Car Module</h1>
        <a href="index.php">Registration</a>
        <h2>-- Login --</h2>
        <p style="color:red;"><?php if (isset($error))
            echo $error; ?></p>
        <form method="post">
            <table>
                <tr>
                    <td>Enter email:</td>
                    <td><input type="text" name="txtemail" value="<?php if (isset($_COOKIE['useremail']))
                        echo $_COOKIE['useremail']; ?>" /></td>
                </tr>

                <tr>
                    <td>Enter Password:</td>
                    <td><input type="password" name="txtpassword" value="<?php if (isset($_COOKIE['useremail']))
                        echo $_COOKIE['userpassword']; ?>" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="checkbox" name="chkRemember" />Remember Me </td>
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