<?php
session_start();
include ("connect.php");
if (!isset($_SESSION['username']))
    header('location:login.php');

if (isset($_GET['deleteid'])) {
    $delete = "delete from tbl_car where car_id=$_GET[deleteid]";
    if (mysqli_query($connect, $delete)) {
        $deleteMsg = "Success: Record Deleted Successfully";
    } else {
        echo mysqli_error($connect);
    }
}
?>
<html>

<head></head>

<body>
    <center>
        Welcome <?php echo $_SESSION['username']; ?> |<a href="logout.php">Logout</a>
        <br />
        <a href="addcar.php">Add new Car</a><br />
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        if (isset($deleteMsg)) {
            echo $deleteMsg;
            unset($deleteMsg);
        }
        ?>
        <h2>Car Details</h2><br />
        <table border="1">
            <tr>
                <th>No.</th>
                <th>Car name</th>
                <th>Company name</th>
                <th>Detail</th>
                <th>Price</th>
                <th>Launch Year</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            $counter = 1;
            $select = "select * from tbl_car order by car_id desc";
            $result = mysqli_query($connect, $select);
            while ($data = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $data['car_name']; ?></td>
                    <td><?php echo $data['car_company']; ?></td>
                    <td><?php echo $data['car_detail']; ?></td>
                    <td><?php echo $data['car_price']; ?></td>
                    <td><?php echo $data['launch_year']; ?></td>
                    <td><img src="<?php echo $data['car_image'] ?>" width="100" height="100" /></td>
                    <td><a href="addcar.php?carid=<?php echo $data['car_id']; ?>">Edit</a></td>
                    <td><a href="home.php?deleteid=<?php echo $data['car_id']; ?>"
                            onclick="return confirm('Are you sure to delete?');">Delete</a></td>
                </tr>
                <?php
                $counter++;
            }
            ?>
        </table>
    </center>
</body>
</body>

</html>