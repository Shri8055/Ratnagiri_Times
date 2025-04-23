<?php
$conn = mysqli_connect("localhost", "root", "", "pmedia", 4306);
if (!$conn) {
    die("Failed to connect to database! " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['add'])) {
    $dbt_no=$_POST['dr-no'];
    $dbt_date=$_POST['dr-date'];
    $ac_no=$_POST['ac-no'];
    $ac_name=$_POST['ac-name'];
    $dbt_amt=$_POST['dr-nt-amt'];
    $pay_typ=$_POST['pay-typ'];
    $chq_no=$_POST['chq-no'] ?? '';
    $chq_date=$_POST['chq-date'] ?? '';
    $bank_name=$_POST['bank-na'] ?? '';
    $bank_bran=$_POST['bank-branc'] ?? '';
    $narr=$_POST['narr'];
    $cash_depo=$_POST['cash-de-in'];
    $current_bal=floatval($_POST['curr-bal']) + floatval($_POST['dr-nt-amt']);

    $l_type = 'Debit';
    $l_date = $dbt_date;
    $l_billno = $dbt_no;
    $l_ac_no = $ac_no;
    $l_ac_name = $ac_name;
    $l_narr = $narr;
    $l_damt = $dbt_amt;

    $sql = "INSERT INTO dbt (
        dbt_no, debit_date, ac_no, ac_name, amount, payment_type,
        cheque_no, cheque_date, bank_name, bank_branch,
        narration, cash_depo, current_balance
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
    mysqli_stmt_bind_param(
      $stmt,
      "ssssdsdsssssd",
      $dbt_no,
      $dbt_date,
      $ac_no,
      $ac_name,
      $dbt_amt,
      $pay_typ,
      $chq_no,
      $chq_date,
      $bank_name,
      $bank_bran,
      $narr,
      $cash_depo,
      $current_bal
    );
    if (mysqli_stmt_execute($stmt)) {
        $conn->query("UPDATE ad_mast SET cur_bal = $current_bal WHERE ac_no = '$ac_no'");
        $conn->query("UPDATE cre SET current_balance = $current_bal WHERE ac_no = '$ac_no'");
        $conn->query("UPDATE bills SET curr_bal = $current_bal WHERE ac_no = '$ac_no'");
        $conn->query("UPDATE rct SET current_balance = $current_bal WHERE ac_no = '$ac_no'");
        $conn->query("UPDATE ledger SET curr_bal = $current_bal WHERE l_ac_no = '$ac_no'");

        $stmt = $conn->prepare("INSERT INTO ledger (l_type, l_date, l_billno, l_ac_no, ac_name, l_narr, l_damt) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssd", $l_type, $l_date, $l_billno, $l_ac_no, $l_ac_name, $l_narr, $l_damt);
        
        if (!$stmt->execute()) {
            echo "<script>alert('⚠️ Ledger insert error: " . addslashes($stmt->error) . "');</script>";
        }
      echo "<script>alert('✅ Debit Note added successfully!');</script>";
      echo "<script>window.location.href = window.location.pathname;</script>";
    } else {
      echo "Error executing statement: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
    } else {
    echo "Error preparing statement: " . mysqli_error($conn);
    }
    mysqli_close($conn);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratnagiri Times | DEBIT NOTE</title>
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
    <h3>DEBIT NOTES</h3>
    <form id="form" action="debit.php" method="POST">
    <table>
            <tr>
              <td><label for="dr-no">Dr. Note No.:</label></td>
                <td><input id="dr-no" name="dr-no" type="text" tabindex="1" required></td>
                <td><label for="dr-date">Debit Date.:</label></td>
                <td><input id="dr-date" name="dr-date" type="date" tabindex="2"></td>
                <td><label for="ac-code">A/c No.:</label></td>
                <td><input id="ac-code" name="ac-no" type="text" style="text-align: center;" readonly></td>
            </tr>
            <tr>
                <td><label for="ac-na-ci">A/c Name:</label></td>
                <td>
                    <input id="ac-name" style="width: 230%;" name="ac-name" type="text" autocomplete="off" oninput="searchAccount(this.value)" tabindex="3" required>
                    <div id="search-results" style="position:absolute; z-index:1000; background-color: lightgreen; border:1px solid #ccc; width:40%; max-height: 250px; overflow-y:auto; display:none;">
                        <table id="results-table" border="1px" style="width:100%; background:white; border-collapse:collapse;">
                            <thead style="background:#bc2222;">
                                <tr>
                                    <th class="search-th" style="padding:5px;">A/c No</th>
                                    <th class="search-th" style="padding:5px;">Name</th>
                                    <th class="search-th" style="padding:5px;">Balance</th>
                                    <th class="search-th" style="padding:5px;">City</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <script>
                        let selectedIndex = -1;
                        let currentData = [];
                        const acNameInput = document.getElementById('ac-name');
                        const resultsBox = document.getElementById('search-results');
                        const tbody = document.querySelector('#results-table tbody');
                        acNameInput.addEventListener('input', function () {
                            const term = this.value;
                            selectedIndex = -1;
                            if (term.length < 1) {
                                tbody.innerHTML = '';
                                resultsBox.style.display = 'none';
                                currentData = [];
                                return;
                            }
                            fetch(`search_account.php?query=${encodeURIComponent(term)}`)
                                .then(res => res.json())
                                .then(data => {
                                    currentData = data;
                                    tbody.innerHTML = '';
                                    if (data.length === 0) {
                                        const noRow = document.createElement('tr');
                                        noRow.innerHTML = `<td colspan="3" style="text-align:center; color: crimson;">No result found</td>`;
                                        tbody.appendChild(noRow);
                                    } else {
                                        data.forEach((item, index) => {
                                            const row = document.createElement('tr');
                                            row.tabIndex = 0;
                                            row.dataset.index = index;
                                            row.innerHTML = `
                                                <td class="search-out out-ac" style="padding:5px;">${item.ac_no}</td>
                                                <td class="search-out" style="padding:5px;">${item.ac_name}</td>
                                                <td class="search-out out-bal" style="padding:5px;">${parseFloat(item.cur_bal).toFixed(2)}</td>
                                                <td class="search-out out-cit" style="padding:5px;">${item.city}</td>
                                            `;
                                            row.addEventListener('click', () => fillAccount(item));
                                            row.addEventListener('keydown', (e) => {
                                                if (e.key === "Enter") {
                                                    fillAccount(item);
                                                }
                                            });
                                            tbody.appendChild(row);
                                        });
                                    }
                                    resultsBox.style.display = 'block';
                                });
                        });
                        acNameInput.addEventListener('keydown', function (e) {
                            const rows = document.querySelectorAll('#results-table tbody tr');
                            if (!rows.length || currentData.length === 0) return;
                            if (e.key === 'ArrowDown') {
                                e.preventDefault();
                                selectedIndex = (selectedIndex + 1) % currentData.length;
                                highlight(rows);
                                rows[selectedIndex].focus();
                            } else if (e.key === 'ArrowUp') {
                                e.preventDefault();
                                selectedIndex = (selectedIndex - 1 + currentData.length) % currentData.length;
                                highlight(rows);
                                rows[selectedIndex].focus();
                            } else if (e.key === 'Enter') {
                                e.preventDefault();
                                if (selectedIndex === -1 && currentData.length > 0) {
                                    fillAccount(currentData[0]);
                                } else if (selectedIndex >= 0 && selectedIndex < currentData.length) {
                                    fillAccount(currentData[selectedIndex]);
                                }
                            }
                        });
                        function highlight(rows) {
                            rows.forEach((row, i) => {
                                row.style.background = i === selectedIndex ? '#cce5ff' : '';
                            });
                        }
                        function fillAccount(account) {
                            document.getElementById('ac-code').value = account.ac_no;
                            document.getElementById('ac-name').value = account.ac_name;
                            document.getElementById('curr-bal').value = parseFloat(account.cur_bal).toFixed(2);
                            resultsBox.style.display = 'none';
                            selectedIndex = -1;
                        }
                        document.addEventListener('click', function (e) {
                            if (!resultsBox.contains(e.target) && e.target.id !== 'ac-name') {
                                resultsBox.style.display = 'none';
                            }
                        });
                        document.addEventListener('keydown', function (e) {
                          if (e.key === 'Tab') {
                              const tabbable = Array.from(document.querySelectorAll('[tabindex]'))
                                  .filter(el => !el.disabled && el.tabIndex > 0)
                                  .sort((a, b) => a.tabIndex - b.tabIndex);

                              const focused = document.activeElement;
                              const currentIndex = tabbable.indexOf(focused);

                              if (e.shiftKey) {
                                  if (currentIndex === 0) {
                                      e.preventDefault();
                                      tabbable[tabbable.length - 1].focus();
                                  }
                              } else {
                                  if (currentIndex === tabbable.length - 1) {
                                      e.preventDefault();
                                      tabbable[0].focus();
                                  }
                              }
                          }
                      });
                    </script>
                </td>
                <td><label for=""></label></td>
                <td><input type="hidden"></td>
                <td><label for="dr-nt-amt">Dr. Note Amt.:</label></td>
                <td><input id="dr-nt-amt" name="dr-nt-amt" type="number" min="1" step="0.01" tabindex="4" required></td>
                <span id="dbt-amt-error" style="color: red; font-size: 14px;"></span>
            </tr>
            <tr>
                <td><label for="pay-ty">Payment Type:</label></td>
                <td><select name="pay-typ" id="pay-ty"  tabindex="5">
                        <option value="Cash">Cash</option>
                        <option value="Cheque">Cheque</option>
                        <option value="Demand Draft">Demand Draft</option>
                        <option value="NEFT">NEFT</option>
                        <option value="RTGS">RTGS</option>
                        <option value="UPI Payment">UPI Payment</option>
                    </select>        
                </td>
                <td><label for="chq-no">Cheque No.:</label></td>
                <td><input id="chq-no" name="chq-no" type="text" placeholder="" tabindex="6" required></td>
                <span id="len-error" style="color: red; font-size: 14px;"></span>
                <td><label for="chq-date">Cheque Date:</label></td>
                <td><input id="chq-date" name="chq-date" min="1" max="6" type="date" tabindex="7" required></td>
            </tr>
            <tr>
                <td><label for="bank-na">Bank Name:</label></td>
                <td><input id="bank-na" name="bank-na" type="text" tabindex="8" required></td>
                <td><label for=""></label></td>
                <td><input type="hidden"></td>
                <td><label for="bank-branc">Bank Branch:</label></td>
                <td><input id="bank-branc" name="bank-branc" type="text" tabindex="9" required></td>
            </tr>
            <tr>
                <td><label for="narr">Narration:</label></td>
                <td><input id="narr" name="narr" type="text" style="width: 230%;" tabindex="10" value="Against Bill - "></td>
            </tr>
            <tr> 
                <td><label for="cash-de-in">Cash Depo.in:</label></td>
                <td>
                    <select name="cash-de-in" id="cash-de-in" style="width: 140%;" tabindex="11">
                        <option value="Bank of Baroda">Bank of Baroda</option>
                        <option value="Bank of Maharashtra">Bank of Maharashtra</option>
                        <option value="Bank of India">Bank of India</option>
                        <option value="Axis Bank">Axis Bank</option>
                        <option value="ICICI Bank">ICICI Bank</option>
                    </select>
                </td>
                <td><label for=""></label></td>
                <td><input type="hidden"></td>
                <td><label for="curr-bal">Current Bal.:</label></td>
                <td><input id="curr-bal" name="curr-bal" type="text" value="0.00"></td>
            </tr>
            <script>
              let dbtInput = document.getElementById("dr-nt-amt");
                let currInput = document.getElementById("curr-bal");
                let dbtError = document.getElementById("dbt-amt-error");
                dbtInput.addEventListener("blur", function() {
                  const debit = parseFloat(dbtInput.value) || 0;
                  const current = parseFloat(currInput.value) || 0;
                  if(debit > 0){
                    if (debit > current) {
                        dbtError.textContent = " Debit amount should be less than CURRENT BALANCE ! ";
                    } else {
                        dbtError.textContent = "";
                    }
                  }
                  else{
                    dbtError.textContent = " Debit amount should be greater than 0 ! ";
                  }
                });
            </script>
        </table><br>
        <script>
          const paymentType = document.getElementById("pay-ty");
          const chequeNo = document.getElementById("chq-no");
          const chequeDate = document.getElementById("chq-date");
          const bankName = document.getElementById("bank-na");
          const bankBranch = document.getElementById("bank-branc");
          const chequeLabel = document.querySelector("label[for='chq-no']");
          const dateLabel = document.querySelector("label[for='chq-date']");
          let lenError = document.getElementById("len-error");
          function updateFields() {
            const type = paymentType.value;
            chequeNo.disabled = false;
            chequeDate.disabled = false;
            bankName.disabled = false;
            bankBranch.disabled = false;
            chequeNo.removeAttribute("maxlength");
            chequeNo.value = "";
            chequeDate.value = "";
            bankName.value = "";
            bankBranch.value = "";
            chequeNo.removeEventListener("input", validateChequeNo);
            chequeNo.removeEventListener("input", validateUPINo);
            chequeNo.removeEventListener("input", validateDDNo);
            if (type === "Cash") {
              chequeNo.disabled = true;
              chequeDate.disabled = true;
              bankName.disabled = true;
              bankBranch.disabled = true;
              chequeLabel.textContent = "";
              dateLabel.textContent = "-";
              dateLabel.textContent = "";
            } else if (type === "Cheque") {
              chequeNo.maxLength = 6;
              chequeLabel.textContent = "Cheque No.:";
              chequeNo.placeholder = "Cheque no 6 Digits only";
              dateLabel.textContent = "Cheque Date : ";
              chequeNo.addEventListener("blur", function() {
                if(this.value.length !== 6){
                  lenError.textContent = " Cheque number must be 6 digits! ";
                }else{
                  lenError.textContent = "";
                }
              });
              chequeNo.addEventListener("input", validateChequeNo);
            } else if (type === "Demand Draft") {
              chequeNo.maxLength = 6;
              chequeLabel.textContent = "D.D. No.:";
              chequeNo.placeholder = "DD no 6 Digits only";
              dateLabel.textContent = "D.D. Date :";
              chequeNo.addEventListener("blur", function() {
                if(this.value.length !== 6){
                  lenError.textContent = " D.D number must be 6 digits! ";
                }else{
                  lenError.textContent = "";
                }
              });
              chequeNo.addEventListener("input", validateDDNo);
            } else if (type === "UPI Payment") {
              chequeNo.maxLength = 12;
              chequeLabel.textContent = "UPI Ref. No.:";
              chequeNo.placeholder = "UPI no 12 Digits only";
              dateLabel.textContent = "UPI Ref Date :";
              chequeNo.addEventListener("blur", function() {
                if(this.value.length !== 12){
                  lenError.textContent = " UPI number must be 12 digits! ";
                }else{
                  lenError.textContent = "";
                }
              });
              chequeNo.addEventListener("input", validateUPINo);
            } else if (type === "NEFT" || type === "RTGS") {
              chequeLabel.textContent = `${type} Ref. No.:`;
              chequeNo.placeholder = "Length < 25 Digits only";
              dateLabel.textContent = "Date :";
              chequeNo.maxLength = 25;
            }
          }
          function validateChequeNo(e) {
            const val = e.target.value;
            if (!/^\d{0,6}$/.test(val)) {
              e.target.value = val.slice(0, 6).replace(/\D/g, '');
            }
          }
          function validateDDNo(e) {
            const val = e.target.value;
            if (!/^\d{0,6}$/.test(val)) {
              e.target.value = val.slice(0, 6).replace(/\D/g, '');
            }
          }
          function validateUPINo(e) {
            const val = e.target.value;
            if (!/^\d{0,12}$/.test(val)) {
              e.target.value = val.slice(0, 12).replace(/\D/g, '');
            }
          }
          paymentType.addEventListener("change", updateFields);
          window.addEventListener("DOMContentLoaded", updateFields);
        </script>
        <script>
          document.getElementById("form").addEventListener("submit", function(event) {
            const type = paymentType.value;
            const val = chequeNo.value.trim();
            let isValid = true;

            // Reset error
            lenError.textContent = "";

            if (type === "Cheque" || type === "Demand Draft") {
              if (val.length !== 6) {
                lenError.textContent = ` ${type} number must be 6 digits! `;
                isValid = false;
              }
            } else if (type === "UPI Payment") {
              if (val.length !== 12) {
                lenError.textContent = " UPI number must be 12 digits! ";
                isValid = false;
              }
            }
            let dbtInput = document.getElementById("dr-nt-amt");
            let currInput = document.getElementById("curr-bal");
            let dbtError = document.getElementById("dbt-amt-error");
            const debit = parseFloat(dbtInput.value) || 0;
            const current = parseFloat(currInput.value) || 0;
            if(debit > 0){
              if (debit > current) {
                dbtError.textContent = " Debit amount should be less than CURRENT BALANCE ! ";
                isValid = false;
              }
            }else{
              dbtError.textContent = " Debit amount should be greater than 0 ! ";
            }
            // Prevent form submission if invalid
            if (!isValid) {
              event.preventDefault();
            }
          });
        </script>

        <div class="buttons">
            <button type="submit" tabindex="12" name="add">ADD</button>
            <button type="submit" tabindex="13">Rct LIST</button>
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