<?php
$conn = new mysqli('localhost','root','','pmedia',4306);

$where  = [];
$params = [];

$in = fn($k)=>($_GET[$k] ?? '')!=='';

if ($in('ac_no'))      { $where[]='l_ac_no = ?';            $params[]=$_GET['ac_no']; }
if ($in('l_type'))     { $where[]='l_type  = ?';            $params[]=$_GET['l_type']; }
if ($in('date_from') && $in('date_to')){
    $where[]='l_date BETWEEN ? AND ?';        $params[]=$_GET['date_from']; $params[]=$_GET['date_to'];
}
if ($in('max_amt'))    { $where[]='l_damt <= ?';            $params[]=$_GET['max_amt']; }

$balMap = [];
$balRes = $conn->query("SELECT ac_no , cur_bal FROM ad_mast");
while($b=$balRes->fetch_assoc()){ $balMap[ $b['ac_no'] ] = $b['cur_bal']; }

$currBal = 0.00;
if ($in('ac_no')){
    $balStmt = $conn->prepare("SELECT cur_bal FROM ad_mast WHERE ac_no = ? LIMIT 1");
    $balStmt->bind_param("s", $_GET['ac_no']);  $balStmt->execute();
    $balStmt->bind_result($currBal);            $balStmt->fetch();   $balStmt->close();
}

$sql = "SELECT * FROM ledger".($where ? " WHERE ".implode(' AND ',$where) : '');
$stmt= $conn->prepare($sql);
if($params){ $stmt->bind_param(str_repeat('s',count($params)), ...$params); }
$stmt->execute(); $rows=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ratnagiri Times | Ledger</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="ledger.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
    <style>

td:nth-child(8),td:nth-child(9),th:nth-child(8),th:nth-child(9){text-align:end}

#balTip{position:fixed;display:none;padding:6px 8px;background:#333;color:#fff;
        font-size:12px;border-radius:6px;pointer-events:none;z-index:9999}
</style>
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

<button class="toggle-btn" onclick="toggleSidebar(this)">▶</button>

<script>
  function toggleSidebar(btn) {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('expanded');
    btn.textContent = sidebar.classList.contains('expanded') ? '◀' : '▶';

    const buttons = document.querySelectorAll('.action-button');
    buttons.forEach(button => {
      button.classList.toggle('hide-buttons', !sidebar.classList.contains('expanded'));
    });
  }
</script>
<h3 style="text-align:center;margin:25px 0 15px">Ledger Report</h3>

<div style="padding:0 40px">

<form method="get" id="fltForm" style="margin-bottom:10px">
  <label>Ac No : <input name="ac_no" value="<?=htmlspecialchars($_GET['ac_no']??'')?>"></label>
  <label>Type :
     <select name="l_type" onchange="document.getElementById('fltForm').submit()">
       <?php
         $types=[''=>'All','Bill'=>'Bill','Receipt'=>'Receipt','Debit'=>'Debit','Credit'=>'Credit'];
         foreach($types as $v=>$t){
             $sel=(@$_GET['l_type']==$v)?'selected':'';
             echo "<option value='$v' $sel>$t</option>";
         }
       ?>
     </select>
  </label>
  <label>From : <input type="date" name="date_from" value="<?= $_GET['date_from']??''?>"></label>
  <label>To : <input type="date" name="date_to"   value="<?= $_GET['date_to']??''?>"></label>
  <label>Max Amt : <input type="number" step="0.01" name="max_amt" value="<?= $_GET['max_amt']??''?>"></label>
  <button type="submit">Filter</button>
  <button type="button" id="pdfBtn">Print 🖨️</button>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
document.getElementById('pdfBtn').addEventListener('click', () => {

    const tableClone = document.getElementById('ledgerTable').cloneNode(true);
    tableClone.removeAttribute('id');

    const wrapper = document.createElement('div');
    wrapper.innerHTML = `
        <style>
            /* styles applied only inside the PDF */
            #pdfMini *        { font-size: 9px !important; }  /* << font size here */
            #pdfMini table    { width:100%; border-collapse:collapse; }
            #pdfMini th,#pdfMini td{ text-align:center; }
            #pdfMini td:nth-child(8),
            #pdfMini td:nth-child(9),
            #pdfMini th:nth-child(8),
            #pdfMini th:nth-child(9){ text-align:right; }
        </style>
        <div id="pdfMini">
            <h1 style="font-weight: 700;text-align:center;margin:5px 0">Ratnagiri Times</h1>
            <p style="text-align:center;margin-bottom:5px">H.O : Times Bhavan, Maruti Lane, Ratnagiri</p>
            <h3 style="text-align:center;margin-bottom:14px">Ledger Report</h3>
        </div>
        <p style="font-size: 6px;text-align:center;margin:5px 0;">Softline Softwares, Kolhapur</p>`;
    wrapper.querySelector('#pdfMini').appendChild(tableClone);

    
    html2pdf()
      .from(wrapper)
      .set({
          margin: 0,
          filename: 'Ledger_Report.pdf',
          image:    { type:'jpeg', quality:0.98 },
          html2canvas:{ scale: 5, useCORS: true },
          jsPDF:   { unit:'in', format:'a4', orientation:'portrait' }
      })
      .outputPdf('blob')
      .then(blob => {
           const url = URL.createObjectURL(blob);
           window.open(url, '_blank');
      });
});
</script>

  <label style="margin-left:20px">Curr Bal :
    <input class="curr-bal" readonly
           value="<?=number_format($currBal,2)?>" type="text"
           style="text-align:end;background:yellow;font-weight:700;width: 250px;">
  </label>
</form>

<table id="ledgerTable" class="display" style="width:100%">
  <thead>
    <tr><th>ID</th><th>Type</th><th>Date</th><th>Bill No</th>
        <th>Ac No</th><th>Ac Name</th><th>Narration</th>
        <th>Debit Amt</th><th>Credit Amt</th></tr>
  </thead>
  <tbody>
  <?php foreach($rows as $r):
        $bal = $balMap[$r['l_ac_no']] ?? 0; ?>
     <tr>
       <td style="width:40px"><?= $r['l_id'] ?></td>
       <td><?= $r['l_type'] ?></td>
       <td><?= date('d-m-Y', strtotime($r['l_date'])) ?></td>
       <td><?= $r['l_billno']?></td>
       <td class="ledger-ac" data-bal="<?=number_format($bal,2)?>"><?= $r['l_ac_no']?></td>
       <td class="ledger-ac" data-bal="<?=number_format($bal,2)?>"><?= htmlspecialchars($r['ac_name'])?></td>
       <td><?= htmlspecialchars($r['l_narr']) ?></td>
       <td style="width: 8.5%;"><div class="inr-td"><?= number_format($r['l_damt'],2) ?></div></td>
       <td style="width: 8.5%;"><div class="inr-td"><?= number_format($r['l_ramt'],2) ?></div></td>
     </tr>
  <?php endforeach;?>
  </tbody>
</table>

</div>

<div id="balTip"></div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
const dt = $('#ledgerTable').DataTable({
       paging:false, ordering:true, searching:true
});

const balBox = document.querySelector('.curr-bal'); 

dt.on('draw', () =>{
   const rows = dt.rows({page:'current', search:'applied'}).nodes();
   if(balBox.dataset.locked!=='1'){                    
        if(rows.length===1){
            const rd = rows[0].children[7].textContent.replace(/,/g,'')*1||0;
            const rc = rows[0].children[8].textContent.replace(/,/g,'')*1||0;
            balBox.value = (rc-rd).toFixed(2);
        }else{
            balBox.value = parseFloat(balBox.value)||0;
        }
   }
});

const tip = document.getElementById('balTip');

document.getElementById('ledgerTable')
  .addEventListener('mousemove', e=>{
      const cell = e.target.closest('.ledger-ac');
      if(cell){
          tip.textContent = 'Curr Bal : '+cell.dataset.bal;
          tip.style.cssText = `display:block;opacity:1;box-shadow: 0px 30px 40px rgba(0, 0, 0, 0.83); border: 4px solid rgba(135, 135, 135, 0.76);top:${e.clientY+15}px;left:${e.clientX+15}px`;
      }else tip.style.display='none';
});
document.getElementById('ledgerTable').addEventListener('mouseleave',()=>tip.style.display='none');
</script>
</body>
</html>