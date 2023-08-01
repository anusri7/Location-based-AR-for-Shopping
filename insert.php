
<!DOCTYPE html>
<html>

<head>
    <title>Insert Page</title>
</head>

<body>
    <center>
        <?php
error_reporting(0);
// servername => localhost
// username => root
// password => empty
// database name => staff
$conn = mysqli_connect("localhost", "root", "", "ar");

// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. "
        . mysqli_connect_error());
}

// Taking all 5 values from the form data(input)
$id = $_REQUEST['id'];
$lat = $_REQUEST['lat'];
$lng = $_REQUEST['lng'];
$sd = $_REQUEST['sd'];
$pd = $_REQUEST['pd'];

$sql = "INSERT INTO purchase  VALUES ('$id','$lat',
            '$lng','$sd','$pd')";

if (mysqli_query($conn, $sql)) {
    echo "<h3>Data stored in a database successfully."
        . " Please browse your localhost php my admin"
        . " to view the updated data</h3>";

    echo nl2br("\n$id\n $lat\n "
        . "$lng\n $sd\n $pd");
} else {
    echo "ERROR: Hush! Sorry $sql. "
    . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
    </center>
</body>

</html>