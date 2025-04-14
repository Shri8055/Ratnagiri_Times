<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratnagiri Times | DEBIT NOTES</title>
    <link rel="stylesheet" href="debit.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
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
        <a href="#">Ledger</a>
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
    <h3>DEBIT NOTES</h3>
    <form action="debit.php" method="POST">
    <table>
            <tr>
                <td><label for="r-no">Dr. Note No.:</label></td>
                <td><input id="r-no" name="dr-nt" type="number" value="0"></td>
                <td><label for=""></label></td>
                <td><input type="hidden"></td>
                <td class="last"><label for="dr-date">Dr. Note Date.:</label></td>
                <td><input id="dr-date" name="dr-date" type="date"></td>
            </tr>
            <tr>
                <td><label for="ac-code">A/c Code:</label></td>
                <td><input id="ac-code" type="text"></td>
                <td><label for=""></label></td>
                <td><input type="hidden"></td>
                <td><label for="dr-nt-amt">Dr. Note Amt.:</label></td>
                <td><input id="dr-nt-amt" name="dr-nt-amt" type="text"></td>
            </tr>
            <tr>
                <td><label for="ac-na-ci">A/c Name & City:</label></td>
                <td><input id="ac-na-ci" name="ac-na-ci" type="text"></td>
            </tr>
            <tr>
                <td><label for="chq-no">Cheque No.:</label></td>
                <td><input id="chq-no" name="chq-no" type="text" style="text-transform: uppercase;"></td>
                <td><label for=""></label></td>
                <td><input type="hidden"></td>
                <td><label for="chq-date">Cheque Date:</label></td>
                <td><input id="chq-date" name="chq-date" type="date"></td>
            </tr>
            <tr>
                <td><label for="bank-na">Bank Name:</label></td>
                <td><input id="bank-na" name="bank-na" type="text"></td>
                <td><label for=""></label></td>
                <td><input type="hidden"></td>
                <td><label for="bank-branc">Bank Branch:</label></td>
                <td><input id="bank-branc" name="bank-branc" type="text"></td>
            </tr>
            <tr>
                <td><label for="narr">Narration:</label></td>
                <td><input id="narr" name="narr" type="text"></td>
            </tr>
            <tr>
                <td><label for="cash-de-in"></label></td>
                <td><input id="cash-de-in" name="cash-de-in" type="hidden"></td>
                <td><label for=""></label></td>
                <td><input type="hidden"></td>
                <td><label for="curr-bal">Current Bal.:</label></td>
                <td><input id="curr-bal" name="curr-bal" type="text" value="0.00"></td>
            </tr>
        </table>
        <div class="buttons">
                <button type="button">ADD</button>
                <button type="button">EDIT</button>
                <button type="button">DELETE</button>
                <button type="button">DISPLAY</button>
                <button type="button">FIND</button>
                <button type="button">EXIT</button>
            </div>
    </form>
    <script>
    function updateCurrentDate() {
        const now = new Date();
        const formattedDate = now.toISOString().split("T")[0]; 
        document.getElementById('dr-date').value = formattedDate;
        document.getElementById('chq-date').value = formattedDate;
    }
    updateCurrentDate();
    </script>
</body>
</html>