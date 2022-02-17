<?php
//connect to mysql database
include"connection.php";
//fetch data from database
$sql = "select * from employees";
$result = mysqli_query($con, $sql) or die("Error " . mysqli_error($connection));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Autocomplete Textbox in HTML5 PHP and MySQL</title>
</head>
<body>
    <label for="pcategory">Employees</label>
    <input type="text" list="categoryname" autocomplete="off" id="pcategory">
    <datalist id="categoryname">
        <?php while($row = mysqli_fetch_array($result)) { ?>
            <option value="<?php echo $row['EmployeeCode']; ?>"><?php echo $row['Employee Name']; ?></option>
        <?php } ?>
    </datalist>
    <?php mysqli_close($connection); ?>
</body>
</html>