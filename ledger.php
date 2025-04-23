<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratnagiri Times | LEDGER</title>
    <link rel="stylesheet" href="ledger.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    
</body>
</html> -->

<?php
$conn = new mysqli("localhost", "root", "", "pmedia", 4306);

$where = [];
$params = [];

// Apply filters if submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['ac_no'])) {
        $where[] = "l_ac_no = ?";
        $params[] = $_GET['ac_no'];
    }
    if (!empty($_GET['l_type'])) {
        $where[] = "l_type = ?";
        $params[] = $_GET['l_type'];
    }
    if (!empty($_GET['date_from']) && !empty($_GET['date_to'])) {
        $where[] = "l_date BETWEEN ? AND ?";
        $params[] = $_GET['date_from'];
        $params[] = $_GET['date_to'];
    }
    if (!empty($_GET['max_amt'])) {
        $where[] = "l_damt <= ?";
        $params[] = $_GET['max_amt'];
    }
}

$sql = "SELECT * FROM ledger";
if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$stmt = $conn->prepare($sql);
if ($params) {
    $types = str_repeat("s", count($params));
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ratnagiri Times | Ledger</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="ledger.css">
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
<div id="ledgerContent">
    <h3 style="text-align: center; margin-top: 40px;">Ledger Report</h3><br>
    <div style="padding: 0 40px">
    <form method="GET">
        <label>Account No: <input type="text" name="ac_no" value="<?= $_GET['ac_no'] ?? '' ?>"></label>
        <label>Type: 
            <select name="l_type" onchange="this.form.submit()">
                <option value="">All</option>
                <option value="Bill" <?= (@$_GET['l_type'] == 'Bill') ? 'selected' : '' ?>>Bill</option>
                <option value="Receipt" <?= (@$_GET['l_type'] == 'Receipt') ? 'selected' : '' ?>>Receipt</option>
                <option value="Debit" <?= (@$_GET['l_type'] == 'Debit') ? 'selected' : '' ?>>Debit</option>
                <option value="Credit" <?= (@$_GET['l_type'] == 'Credit') ? 'selected' : '' ?>>Credit</option>
            </select>
        </label>
        <label>Date From: <input type="date" name="date_from" value="<?= $_GET['date_from'] ?? '' ?>"></label>
        <label>To: <input type="date" name="date_to" value="<?= $_GET['date_to'] ?? '' ?>"></label>
        <label>Max Amount: <input type="number" step="0.01" name="max_amt" value="<?= $_GET['max_amt'] ?? '' ?>"></label>
        <button type="submit">Filter</button>
        <button type="button" onclick="previewPDF()">Print 🖨️</button>
        <style>
          #pdfWrapper {
              font-size: 14px;
              padding: 10px 20px;
          }
          #pdfWrapper h3 {
              margin-bottom: 20px;
          }
          #pdfWrapper table {
              width: 100%;
              border-collapse: collapse;
              font-size: 14px;
          }
          #pdfWrapper th, #pdfWrapper td {
              text-align: center;
          }
          #pdfWrapper td:nth-child(8),
          #pdfWrapper td:nth-child(9),
          #pdfWrapper td:nth-child(10),
          #pdfWrapper th:nth-child(8),
          #pdfWrapper th:nth-child(9),
          #pdfWrapper th:nth-child(10) {
              text-align: end;
          }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
        <script>
          function previewPDF() {
              const content = document.getElementById('ledgerTable').outerHTML;

              const heading = `<h3 style="text-align: center; margin-bottom: 20px;">Ledger Report</h3>`;

              const wrapper = document.createElement('div');
              wrapper.id = 'pdfWrapper';
              wrapper.innerHTML = heading + content;

              const opt = {
                  margin: 0,
                  filename: 'Ledger_Report.pdf',
                  image: { type: 'jpeg', quality: 0.98 },
                  html2canvas: { scale: 2 },
                  jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' }
              };

              html2pdf().from(wrapper).set(opt).outputPdf('blob').then(function (pdfBlob) {
                  const pdfURL = URL.createObjectURL(pdfBlob);
                  window.open(pdfURL);
              });
          }
          </script>
    </form>

    <table id="ledgerTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Date</th>
                <th>Bill No</th>
                <th>Ac No</th>
                <th>Ac Name</th>
                <th>Narration</th>
                <th>Debit Amt</th>
                <th>Credit Amt</th>
                <th>Current Bal</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['l_id'] ?></td>
                    <td><?= $row['l_type'] ?></td>
                    <td><?= $row['l_date'] ?></td>
                    <td><?= $row['l_billno'] ?></td>
                    <td><?= $row['l_ac_no'] ?></td>
                    <td><?= $row['ac_name'] ?></td>
                    <td><?= $row['l_narr'] ?></td>
                    <td class="td" style="width: 7.5%;"><div class="inr-td"><?= number_format($row['l_damt'], 2) ?></div></td>
                    <td class="td" style="width: 7.5%;"><div class="inr-td"><?= number_format($row['l_ramt'], 2) ?></div></td>
                    <td class="td" style="width: 7.5%;"><div class="inr-td"><?= number_format($row['curr_bal'], 2) ?></div></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#ledgerTable').DataTable({
                "paging": false,
                "ordering": true,
                "searching": true
            });
        });
    </script>
</body>
</html>
