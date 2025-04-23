<?php
$conn = mysqli_connect("localhost", "root", "", "pmedia", 4306);
if (!$conn) {
    die("Failed to connect to database! " . mysqli_connect_error());
}
$ed_id=$ed_cd=$ed_nm="";
if (isset($_GET['edit'])) {
    $ed_id = $_GET['edit'];
    $query = "SELECT * FROM ed WHERE ed_id='$ed_id'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $ed_cd = $row['ed_cd'];
        $ed_nm = $row['ed_nmae'];
    }
} 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $ed_cd = strtoupper($_POST['ed_cd']);
        $ed_nm = strtoupper($_POST['ed_nm']);
        $conn->query("INSERT INTO ed (ed_cd, ed_nmae) VALUES ('$ed_cd', '$ed_nm')");
        header("Location: edition.php");
        exit();
    } elseif (isset($_POST['update'])) {
        $ed_id = $_POST['ed_id'];
        $ed_cd = strtoupper($_POST['ed_cd']);
        $ed_nm = strtoupper($_POST['ed_nm']);
        $conn->query("UPDATE ed SET ed_cd='$ed_cd', ed_nmae='$ed_nm' WHERE ed_id='$ed_id'");
        header("Location: edition.php");
        exit();
    } elseif (isset($_POST['del'])) {
        $id = $_POST['ed_id'];
        $conn->query("DELETE FROM ed WHERE ed_id='$id'");
        header("Location: edition.php");
        exit();
    }
}
$editions = $conn->query("SELECT * FROM ed");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratnagiri Times | EDITION</title>
    <link rel="stylesheet" href="edition.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
<div class="main">
        <div class="head-l">
            <p>© Softline Softwares, Kolhapur</p>
            <p>Ph No. : 7972378977, 9307856854</p>
            <p>E-mail : softlinesoftwares2001@gmail.com</p>
        </div>
        <div class="head">
            <h2 class="head-h2-1">RATNAGIRI TIMES</h2>
            <p class="head-p">H.O : Times Bhavan, Maruti lane, Ratnagiri</p>
            <h2 class="head-h2-2">Advertisement Section</h2>
        </div>
        <div class="head-r">
            <p class="time-p">Softline® Ver: v1.0</p>
            <p class="time-p">Release : (7a)</p>
            <p class="time-p">Valid upto : 31-Dec-2025</p>
        </div>
    </div>
  
    <div class="sidebar collapsed" id="sidebar">
  <div class="menu-content">
    <div class="dropdown">
      <a href="home.php"><button class="dropbtn action-button">Home</button></a>
    </div>
    <div class="dropdown">
      <button class="dropbtn action-button">Master</button>
      <div class="dropdown-content">
        <a href="index.php">A/c Master</a>
        <a href="#">Personal Address</a>
        <a href="edition.php">Edition Master</a>
        <a href="ad_types.php">Ad Type Master</a>
      </div>
    </div>

    <div class="dropdown">
      <button class="dropbtn action-button">Data Entry</button>
      <div class="dropdown-content">
        <a href="bills.php">Daily Bills</a>
        <a href="receipt.php">Receipts</a>
        <a href="debit.php">Debit Notes</a>
        <a href="credit.php">Credit Notes</a>
      </div>
    </div>

    <div class="dropdown">
      <button class="dropbtn action-button">Reports</button>
      <div class="dropdown-content">
        <div class="has-submenu">
          <a href="#">Billing <span class="arw">▶</span></a>
          <div class="submenu">
            <a href="#">Daily Bill Summary</a>
            <a href="#">A/c Wise Bill</a>
            <a href="#">Particular A/c</a>
            <a href="#">Editionwise Billing</a>
          </div>
        </div>
        <a href="#">Monthly Reports</a>
        <a href="#">Outstanding Statements</a>
        <a href="ledger.php">Ledger</a>
        <a href="#">Receipts, Credit & Debit Notes</a>
      </div>
    </div>

    <div class="dropdown">
      <button class="dropbtn action-button">Print</button>
      <div class="dropdown-content">
        <a href="#">Bills Calculation and Printing</a>
        <a href="#">Duplicate Bill Print</a>
        <a href="#">Bill Register</a>
        <a href="#">Receipt Register</a>
      </div>
    </div>

    <div class="dropdown">
      <button class="dropbtn action-button">About</button>
    </div>
  </div>
</div>

<!-- Toggle Button (outside sidebar) -->
<button class="toggle-btn" onclick="toggleSidebar(this)">▶</button>

<!-- Script -->
<script>
  function toggleSidebar(btn) {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('expanded');
    btn.textContent = sidebar.classList.contains('expanded') ? '◀' : '▶';

    // Toggle visibility of action buttons
    const buttons = document.querySelectorAll('.action-button');
    buttons.forEach(button => {
      button.classList.toggle('hide-buttons', !sidebar.classList.contains('expanded'));
    }); 
  } 
</script>
    <div class="container">
        <h3 style="text-align: center;">EDITION MASTER</h3>
        <form action="edition.php" method="POST">
            <input type="hidden" name="ed_id" value="<?php echo $ed_id; ?>">
            <table>
                <tr>
                    <td class="ed_cd"><label for="ed_cd">Edition Code :</label></td>
                    <td><input id="ed_cd" name="ed_cd" type="text" style="text-transform: uppercase;" required value="<?php echo $ed_cd; ?>"></td>
                </tr>
                <tr>
                    <td class="ed_cd"><label for="ed_nm">Edition Name :</label></td>
                    <td><input id="ed_nm" name="ed_nm" type="text" style="text-transform: uppercase;" required value="<?php echo $ed_nm; ?>"></td>
                    <td class="ed_rt"><label for="ed_rt">Edition Rate :</label></td>
                    <td>
                        <input id="ed_rt" name="ed_rt" type="number" readonly>
                        <button class="btn" type="submit" name="<?php echo $ed_id ? 'update' : 'add'; ?>">
                            <?php echo $ed_id ? 'UPDATE' : 'ADD'; ?>
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div><hr>
    <div class="ed-container">
        <h3>Existing Editions</h3><hr><br>
        <table>
            <tr>
                <th>Edition ID</th>
                <th>Edition Code</th>
                <th>Edition Name</th>
                <th>Edition Rate</th>
                <th>Delete</th>
            </tr>
            <?php while ($row = $editions->fetch_assoc()) { ?>
                <tr>
                    <td class="td"><a href="edition.php?edit=<?php echo $row['ed_id']; ?>"><?php echo $row['ed_id']; ?></a></td>
                    <td class="td"><?php echo $row['ed_cd']; ?></td>
                    <td class="td"><?php echo $row['ed_nmae']; ?></td>
                    <td class="td"><?php echo $row['ed_price'] == '' ? '-' : $row['ed_price']; ?></td>
                    <td class="td">
                        <form action="edition.php" method="POST" style="display:inline;">
                            <input type="hidden" name="ed_id" value="<?php echo $row['ed_id']; ?>">
                            <button type="submit" name="del"><i class="fa-solid fa-circle-xmark"></i></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>