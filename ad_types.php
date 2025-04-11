<?php
$conn = mysqli_connect("localhost", "root", "", "pmedia", 4306);
if (!$conn) {
    die("Failed to connect to database! " . mysqli_connect_error());
}
$ad_id=$ad_cd=$ad_nm="";
if (isset($_GET['edit'])) {
    $ad_id = $_GET['edit'];
    $query = "SELECT * FROM ad WHERE ad_id='$ad_id'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $ad_cd = $row['ad_cd'];
        $ad_nm = $row['ad_nmae'];
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $ad_cd = strtoupper($_POST['ad_cd']);
        $ad_nm = strtoupper($_POST['ad_nm']);
        $conn->query("INSERT INTO ad (ad_cd, ad_nmae) VALUES ('$ad_cd', '$ad_nm')");
        header("Location: ad_types.php");
        exit();
    } elseif (isset($_POST['update'])) {
        $ad_id = $_POST['ad_id'];
        $ad_cd = strtoupper($_POST['ad_cd']);
        $ad_nm = strtoupper($_POST['ad_nm']);
        $conn->query("UPDATE ad SET ad_cd='$ad_cd', ad_nmae='$ad_nm' WHERE ad_id='$ad_id'");
        header("Location: ad_types.php");
        exit();
    } elseif (isset($_POST['del'])) {
        $id = $_POST['ad_id'];
        $conn->query("DELETE FROM ad WHERE ad_id='$id'");
        header("Location: ad_types.php");
        exit();
    }
}
$editions = $conn->query("SELECT * FROM ad");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratnagiri Times | Ad. TYPES</title>
    <link rel="stylesheet" href="ad_types.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
<a class="main-a" href="home.php" style="position: absolute; margin: 10px 0"><button class="btn-a">Home</button></a>
    <div class="container">
        <h1 style="text-align: center;">Ad. TYPE MASTER</h1>
        <form action="ad_types.php" method="POST">
            <input type="hidden" name="ad_id" value="<?php echo $ad_id; ?>">
            <table>
                <tr>
                    <td class="ad_cd"><label for="ad_cd">Ad. Code :</label></td>
                    <td><input id="ad_cd" name="ad_cd" type="text" style="text-transform: uppercase;" required value="<?php echo $ad_cd; ?>"></td>
                </tr>
                <tr>
                    <td class="ad_cd"><label for="ad_nm">Ad. Name :</label></td>
                    <td><input id="ad_nm" name="ad_nm" type="text" style="text-transform: uppercase;" required value="<?php echo $ad_nm; ?>"></td>
                    <td class="ad_rt"><label for="ad_rt">Ad. Rate :</label></td>
                    <td>
                        <input id="ad_rt" name="ad_rt" type="number" readonly>
                        <button class="btn" type="submit" name="<?php echo $ad_id ? 'update' : 'add'; ?>">
                            <?php echo $ad_id ? 'UPDATE' : 'ADD'; ?>
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div><hr>
    <div class="ed-container">
        <h3>Existing Ad. Types</h3><hr><br>
        <table>
            <tr>
                <th>Ad. ID</th>
                <th>Ad. Code</th>
                <th>Ad. Name</th>
                <th>Ad. Rate</th>
                <th>Delete</th>
            </tr>
            <?php while ($row = $editions->fetch_assoc()) { ?>
                <tr>
                    <td class="td"><a href="ad_types.php?edit=<?php echo $row['ad_id']; ?>"><?php echo $row['ad_id']; ?></a></td>
                    <td class="td"><?php echo $row['ad_cd']; ?></td>
                    <td class="td"><?php echo $row['ad_nmae']; ?></td>
                    <td class="td"><?php echo $row['ad_price'] == '' ? '-' : $row['ad_price']; ?></td>
                    <td class="td">
                        <form action="ad_types.php" method="POST" style="display:inline;">
                            <input type="hidden" name="ad_id" value="<?php echo $row['ad_id']; ?>">
                            <button type="submit" name="del"><i class="fa-solid fa-circle-xmark"></i></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>