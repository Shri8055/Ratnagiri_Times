<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratnagiri Times | HOME</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
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
<div class="navbar">
    <div class="dropdown">
      <button>Master</button>
      <div class="dropdown-content">
        <a href="index.php">A/c Master</a><hr>
        <a href="#">Personal Address</a><hr>
        <a href="edition.php">Edition Master</a><hr>
        <a href="ad_types.php">Ad Type Master</a><hr>
      </div>
    </div>

    <div class="dropdown">
      <button>Data Entry</button>
      <div class="dropdown-content">
        <a href="bills.php">Daily Bills</a><hr>
        <a href="receipt.php">Receipts</a><hr>
        <a href="debit.php">Debit Notes</a><hr>
        <a href="credit.php">Credit Notes</a><hr>
      </div>
    </div>

    <div class="dropdown">
      <button>Reports</button>
      <div class="dropdown-content">
        <div class="has-submenu">
          <a href="#">Billing <span class="arw">↦</span></a><hr>
          <div class="submenu">
            <a href="#">Daily Bill Summary</a><hr>
            <a href="#">A/c Wise Bill</a><hr>
            <a href="#">Particular A/c</a><hr>
            <a href="#">Editionwise Billing</a><hr>
          </div>
        </div>
        <a href="#">Monthly Reports</a><hr>
        <a href="#">Outstanding Statements</a><hr>
        <a href="ledger.php">Ledger</a><hr>
        <a href="#">Receipts, Credit & Debit Notes</a><hr>
      </div>
    </div>
 
    <div class="dropdown">
      <button>Print</button>
      <div class="dropdown-content">
        <a href="#">Bills Calculation and Printing</a><hr>
        <a href="#">Duplicate Bill Print</a><hr>
        <a href="#">Bill Register</a><hr>
        <a href="#">Receipt Register</a><hr>
      </div>
    </div>
    <div class="dropdown">
      <button>About</button>
    </div>
  </div>
    
    <div class="container holographic-container">
      <div class="inner-container holographic-card">
        <h1 class="container-h1">Softline Softwares</h1><hr>
        <h4>Softline Softwares, Kolhapur</h4>
        <p class="add">Plot 18, Ayodhya Colony Kalamba Ring Road,</p>
        <p class="pcode">Kolhapur - 416007</p>
        <p class="ph">Ph No. : 7972378977, 9307856854</p>
        <p class="email">E-mail : softlinesoftwares2001@gmail.com</p><hr>
        <p class="lic">This product is Licenced to:</p>
        <p class="lic-com">Daily Ratnagiri Times (Advt.)</p>
        <p class="lic-add">Dist - Ratnagiri, State - Maharashtra</p>
        <p class="pro-id">Product ID : MGK-270-52-015</p>
        <p class="copyright">Copyright(c) : 1993-2025 Vyanktesh Computers, Kolhapur</p>
        <p class="rights">All Rights Reserved.</p>
      </div>
    </div>
    <script>
        document.querySelectorAll('.menu > .dropdown > a').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const parent = link.parentElement;
            document.querySelectorAll('.dropdown').forEach(d => {
            if (d !== parent) d.classList.remove('open');
            });
            parent.classList.toggle('open');
        });
        });
    </script>
</body>
</html>