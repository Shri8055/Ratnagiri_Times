<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'pmedia', 4306);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$ac_no_query = "SELECT MAX(ac_no) AS max_ac_no FROM ad_mast";
$ac_no_result = $conn->query($ac_no_query);
$ac_no_row = $ac_no_result->fetch_assoc();
$ac_no = $ac_no_row['max_ac_no'] + 1;
if (!$ac_no) $ac_no = 1;
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $ac_open_date = $_POST['date'];
        $ac_no = $_POST['ac-no'];
        $category = $_POST['category1'];
        $ac_name = $_POST['ac-name'];
        $gstin = strtoupper($_POST['gstin']);
        $address = $_POST['address'];
        $city = $_POST['city'];
        $pin_code = $_POST['p-code'];
        $district = $_POST['district'];
        $state_code = $_POST['state-code'];
        $state_name = $_POST['state-name'];
        $Ofi_phone = $_POST['ph-no-o'];
        $Per_phone = $_POST['ph-no-p'];
        $Wha_phone = $_POST['ph-no-w'];
        $cgst = $_POST['cgst'];
        $sgst = $_POST['sgst'];
        $igst = $_POST['igst'];
        $free_copies = $_POST['copies'] ?? '';
        $copies = $_POST['copi'] ?? '';
        $commission = $_POST['comm'];
        $op_dep = $_POST['opdepo'];
        $out_lim = $_POST['out_lim'] ?? '';
        $out_lim_rs = $_POST['out_lim_rs'] ?? '';
        $tot_dep = $_POST['totdep'];
        $op_bal = $_POST['balance'];
        $status = $_POST['status'];
        $cur_bal = $_POST['currbal'];

        $check_sql = "SELECT COUNT(*) FROM ad_mast WHERE ac_no = ? AND ac_name = ?";
        $check_stmt = mysqli_prepare($conn, $check_sql);
        mysqli_stmt_bind_param($check_stmt, "ss", $ac_no, $ac_name);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_bind_result($check_stmt, $count);
        mysqli_stmt_fetch($check_stmt);
        mysqli_stmt_close($check_stmt);
        if ($count > 0) {
            echo "<script>alert('Error: Account already exists with this A/c No and A/c Name!');</script>";
        } else {
            $sql = "INSERT INTO ad_mast 
            (ac_open_date, ac_no, category, ac_name, gstin, address, city, p_code, district, state_code, state_name, 
                           ph_no_ofi, ph_no_per, ph_no_wa, cgst, sgst, igst, f_copies, copi, commission, op_dep, out_limt,
                           out_limt_rs, tot_dep, op_bal, status, cur_bal) 
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param(
                    $stmt,
                    "sssssssssssssssdddiddsdddsd",
                    $ac_open_date, $ac_no, $category, $ac_name, $gstin, $address, 
                    $city, $pin_code, $district, $state_code, $state_name, 
                    $Ofi_phone, $Per_phone, $Wha_phone,
                    $cgst, $sgst, $igst,
                    $free_copies, $copies,
                    $commission, $op_dep, $out_lim, $out_lim_rs, $tot_dep, $op_bal, 
                    $status, $cur_bal
                );

                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>
                        alert('✅ New record added successfully!');
                        window.location.href = 'index.php';
                    </script>";
                } else {
                    echo "<script>alert('❌ Error: " . mysqli_stmt_error($stmt) . "');</script>";
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "<script>alert('Error in preparing statement: " . mysqli_error($conn) . "');</script>";
            }
        }
    }
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratnagiri Times | MASTER</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
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
        <a href="bills.php">Multiple Ad's of one client</a>
        <a href="receipt.php">Receipts</a>
        <a href="debit.php">Debit Notes</a>
        <a href="credit.php">Credit Notes</a>
        <a href="#">Adjust ON ACCOUNTED RECEIPTS</a>
        <a href="#">Adjust ON ACCOUNTED CR.NOTES</a>
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
            <a href="#">District Billing</a>
            <a href="#">Ad. typewise Billing</a>
            <a href="#">Ratewise Billing</a>
            <a href="#">Commission on Billing</a>
            <a href="#">Pagewise Billing</a>
            <a href="#">Representative Billing</a>
            <a href="#">Representative Billing-Detailed</a>
          </div>
        </div>
        <a href="#">Monthly Reports</a>
        <a href="#">Outstanding Statements</a>
        <a href="ledger.php">Ledger</a>
        <a href="#">Abstract of A/c's</a>
        <a href="#">Receipts</a>
        <a href="#">Credit Notes</a>
        <a href="#">Debit Notes</a>
        <a href="#">Advitisements to Print</a>
        <a href="#">Summery</a>
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

        <h3>Advertisement A/c's Master</h3>
        <form id="form" action="index.php" method="POST">
            <table>
                <tr>
                    <td><label for="date">A/c Opening Date:</label></td>
                    <td><input id="date" name="date" type="date"></td>

                    <td><label for="ac-no">A/c No.:</label></td>                
                    <td><input id="ac-no" name="ac-no" type="text" style="text-align: end;" value="<?php echo $ac_no ?>" required readonly></td>                

                    <td><label for="category">Category:</label></td>
                    <td>
                        <select id="category" name="category1">
                            <option value="INS Agencies">INS Agencies</option>
                            <option value="Non-INS Agencies">Non-INS Agencies</option>
                            <option value="Local Agencies">Local Agencies</option>
                            <option value="Reporters">Reporters</option>
                            <option value="Representatives">Representatives</option>
                            <option value="Office Staff">Office Staff</option>
                            <option value="Advocate">Advocate</option>
                            <option value="Others">Others</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="ac-name">A/c Name:</label></td>
                    <td><input id="ac-name" name="ac-name" type="text" class="full-width" required></td>

                    <td><label for=""></label></td>
                    <td><input type="hidden"></td>

                    <td><label for="gstin">GSTIN:</label></td>
                    <td><input id="gstin" name="gstin" type="text" min="1" maxlength="15" style="text-transform: uppercase;" required></td>
                    <span id="gstin-error" style="color: red; font-size: 14px;"></span>
                    <script>
                        let gstinInput = document.getElementById("gstin");
                        let gstinError = document.getElementById("gstin-error");

                        gstinInput.addEventListener("input", function() {
                            this.value = this.value.toUpperCase();
                        });

                        gstinInput.addEventListener("blur", function() {
                            if (this.value.length !== 15) {
                                gstinError.textContent = " GSTIN number must be 15 chars! ";
                            } else {
                                gstinError.textContent = "";
                            }
                        });
                    </script>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><input id="address" name="address"></td>
                </tr>
                <tr>
                    <td><label class="city" for="city">City:</label></td>
                    <td><input id="city" name="city" type="text" required></td>
                    <td><label for="p-code">Pin-code:</label></td>
                    <td><input id="p-code" name="p-code"  type="text" maxlength='6' placeholder="6 digits only" required></td>
                    <span id="pcode-error" style="color: red; font-size: 14px;"></span>
                    <script>
                        let pincodeInput = document.getElementById("p-code");
                        let errorSpan = document.getElementById("pcode-error");

                        pincodeInput.addEventListener("input", function() {
                            this.value = this.value.replace(/\D/g, "");
                        });

                        pincodeInput.addEventListener("blur", function() {
                            if (this.value.length !== 6) {
                                errorSpan.textContent = " Pin-code must be 6 digits! ";
                            } else {
                                errorSpan.textContent = "";
                            }
                        });
                    </script>
                    <td><label for="district">District:</label></td>
                    <td><input id="district" name="district" type="text" required></td>
                </tr>
                <tr>
                    <td><label for="state-code">State Code:</label></td>
                    <td><input id="state-code" name="state-code" maxlength="3" type="text" placeholder="3 Character only"  style="text-transform: uppercase;" required></td>
                    <td><label for="state-name">State Name: </label></td>
                    <td><input id="state-name" name="state-name" type="text" required></td>
                </tr>
                <tr>
                    <td><label for="phone-o">Phone(O)<span style="color: red; font-size: 18px;">*</span>: </label></td>
                    <td><input id="phone-o" name="ph-no-o" placeholder="10 digits only" type="number" required></td>
                    <td><label for="phone-p">Phone(P): </label></td>
                    <td><input id="phone-p" name="ph-no-p" placeholder="10 digits only" type="number"></td>
                    <td><label for="phone-w">Phone(W): </label></td>
                    <td><input id="phone-w" name="ph-no-w" placeholder="10 digits only" type="number"></td>
                    <span id="ph-error-o" style="color: red; font-size: 14px;"></span>
                    <span id="ph-error-p" style="color: red; font-size: 14px;"></span>
                    <span id="ph-error-w" style="color: red; font-size: 14px;"></span>
                    <script>
                        let OphoneInput = document.getElementById("phone-o");
                        let OpherrorSpan = document.getElementById("ph-error-o");

                        OphoneInput.addEventListener("input", function() {
                            this.value = this.value.replace(/\D/g, "");
                        });

                        OphoneInput.addEventListener("blur", function() {
                            if (this.value.length !== 10) {
                                OpherrorSpan.textContent = " Office Phone Number must be 10 digits! ";
                            } else {
                                OpherrorSpan.textContent = "";
                            }
                        });
                        let PphoneInput = document.getElementById("phone-p");
                        let PpherrorSpan = document.getElementById("ph-error-p");

                        PphoneInput.addEventListener("input", function() {
                            this.value = this.value.replace(/\D/g, "");
                        });

                        PphoneInput.addEventListener("blur", function() {
                            if (this.value.length !== 10) {
                                PpherrorSpan.textContent = " Personal Phone Number must be 10 digits! ";
                            } else {
                                PpherrorSpan.textContent = "";
                            }
                        });
                        let WphoneInput = document.getElementById("phone-w");
                        let WpherrorSpan = document.getElementById("ph-error-w");

                        WphoneInput.addEventListener("input", function() {
                            this.value = this.value.replace(/\D/g, "");
                        });

                        WphoneInput.addEventListener("blur", function() {
                            if (this.value.length !== 10) {
                                WpherrorSpan.textContent = " What's App Number must be 10 digits! ";
                            } else {
                                WpherrorSpan.textContent = "";
                            }
                        });
                    </script>
                </tr>
                <tr>
                    <td><label for="cgst">CGST:</label></td>
                    <td><input id="cgst" name="cgst" type="number" min="0" step="any" value="2.50"></td>
                    <td><label for="sgst">SGST:</label></td>
                    <td><input id="sgst" name="sgst" type="number" min="0" step="any" value="2.50"></td>
                    <td><label for="igst">IGST:</label></td>
                    <td><input id="igst" name="igst" type="number" min="0" step="any" value="0.00"></td>
                    <script>
                        document.getElementById("cgst").addEventListener("input", function() {
                            let cgstValue = parseFloat(this.value) || 0;
                            document.getElementById("sgst").value = cgstValue.toFixed(2);
                            document.getElementById("igst").value = "0.00"; // Set IGST to 0 when CGST/SGST changes
                        });

                        document.getElementById("sgst").addEventListener("input", function() {
                            let sgstValue = parseFloat(this.value) || 0;
                            document.getElementById("cgst").value = sgstValue.toFixed(2);
                            document.getElementById("igst").value = "0.00"; // Set IGST to 0 when CGST/SGST changes
                        });

                        document.getElementById("igst").addEventListener("input", function() {
                            let igstValue = parseFloat(this.value) || 0;
                            if (igstValue > 0) {
                                document.getElementById("cgst").value = "0.00";
                                document.getElementById("sgst").value = "0.00";
                            }
                        });
                        document.querySelector("form").addEventListener("submit", function(event) {
                            let cgst = parseFloat(document.getElementById("cgst").value) || 0;
                            let sgst = parseFloat(document.getElementById("sgst").value) || 0;
                            let igst = parseFloat(document.getElementById("igst").value) || 0;

                            if (cgst === 0 && sgst === 0 && igst === 0) {
                                alert("At least one tax value must be greater than 0.00!");
                                event.preventDefault(); // Prevent form submission
                            }
                        });
                    </script>
                </tr>
                <tr>
                    <td><label for="copies">Free Copies with Bill:</label></td>
                    <td><select name="copies" id="copies">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </td>
                    <td><label for="copi">Copies:</label></td>
                    <td><input id="copi" name="copi" type="number" value="1"></td>
                </tr>
                <script>
                    document.getElementById("copies").addEventListener("change", function () {
                        let copiesInput = document.getElementById("copi");
                        if (this.value === "No") {
                            copiesInput.value = 0;
                            copiesInput.disabled = true;
                        } else {
                            copiesInput.value = 1;
                            copiesInput.disabled = false;
                        }
                    });
                </script>
                <tr>
                    <td><label for="comm">Commission(%):</label></td>
                    <td><input id="comm" name="comm" type="number" value="15.00"></td>
                    <td><label for=""></label></td>
                    <td><input type="hidden"></td>
                    <td><label for="opdepo">Op. Deposit:</label></td>
                    <td><input id="opdepo" name="opdepo" type="number" min="0" step="any" class="highlight-yellow" value="0.00"></td>
                </tr>
                <tr>
                    <td><label for="out_lim">Outstanding Limitiations: </label></td>
                    <td><select name="out_lim" id="out_lim">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </td>
                    <td><label for="rs">Rs.:</label></td>
                    <td><input id="rs" type="number" min="0" name="out_lim_rs" value="0.00"></td>
                    <td><label class="totdep" for="totdep">Total Deposit:</label></td>
                    <td><input id="totdep" name="totdep" type="number" min="0" step="any" class="highlight-green" value="0.00" readonly></td>
                </tr>
                <script>
                    document.getElementById("out_lim").addEventListener("change", function () {
                        let rsInput = document.getElementById("rs");
                        if (this.value === "No") {
                            rsInput.value = 0.00;
                            rsInput.disabled = true;
                        } else {
                            rsInput.value = 0.00;
                            rsInput.disabled = false;
                        }
                    });
                </script>
                <tr>
                    <td><label for="bal">Op. Balance:</label></td>
                    <td><input id="bal" name="balance" type="number" min="0" step="any" class="highlight-blue" value="0.00"></td>
                    <td><label for="stat">Status: </label></td>
                    <td><select name="status" id="stat">
                            <option value="Working">Working</option>
                            <option value="Not-Working">Not-Working</option>
                            <option value="Temp Closed">Temp Closed</option>
                            <option value="Blocked">Blocked</option>
                        </select>
                    </td>
                    <td><label for="currbal">Current Balance:</label></td>
                    <td><input id="currbal" name="currbal" type="text" min="0" step="any" class="highlight-red" value="0.00" readonly></td>
                </tr>
                <script>
                    document.getElementById("bal").addEventListener("input", function(){
                        let opbal=parseFloat(this.value) || 0;
                        document.getElementById("currbal").value=opbal.toFixed(2);
                    });
                </script>
            </table><br>
            <div class="buttons">
                <button type="submit" name="add">ADD</button>
                <button type="submit">A/c's LIST</button>
                <button type="submit">PRINT <i class="fa-solid fa-print"></i></button>
            </div>
        </form>
        <p class="footer">Software Developed by: Vyanktesh Computers, Kolhapur, Ph.No.: 7972378977, 9307856854 , E-mail : vyanktesh2001@gmail.com</p>
    </div>
    <script>
        document.getElementById("form").addEventListener("submit", function(event) {
        let gstinInput = document.getElementById("gstin");
        let gstinError = document.getElementById("gstin-error");

        let pincodeInput = document.getElementById("p-code");
        let pincodeError = document.getElementById("pcode-error");

        let OphoneInput = document.getElementById("phone-o");
        let OpherrorSpan = document.getElementById("ph-error-o");

        let PphoneInput = document.getElementById("phone-p");
        let PpherrorSpan = document.getElementById("ph-error-p");

        let WphoneInput = document.getElementById("phone-w");
        let WpherrorSpan = document.getElementById("ph-error-w");

        let isValid = true;
        if (gstinInput.value.length !== 15) {
            gstinError.textContent = "Must be 15 chars!";
            isValid = false;
        } else {
            gstinError.textContent = "";
        }
        if (!/^\d{6}$/.test(pincodeInput.value)) {
            pincodeError.textContent = "Must be 6 digits!";
            isValid = false;
        } else {
            pincodeError.textContent = "";
        }
        if (OphoneInput.value.length !== 10) {
            OpherrorSpan.textContent = "Office Phone number must be 10 numbers!";
            isValid = false;
        } else {
            OpherrorSpan.textContent = "";
        }
        if(PphoneInput.value.length!=''){
            if (PphoneInput.value.length !== 10) {
                PpherrorSpan.textContent = "Personal Phone number must be 10 numbers!";
                isValid = false;
            }
        }else {
            PpherrorSpan.textContent = "";
        }
        if(WphoneInput.value.length!=''){
            if (WphoneInput.value.length !== 10) {
                WpherrorSpan.textContent = "What's App number be must 10 numbers!";
                isValid = false;
            }
        } else {
            WpherrorSpan.textContent = "";
        }
        if (!isValid) {
            event.preventDefault();
        }
    });
    function updateCurrentDate() {
        const now = new Date();
        const formattedDate = now.toISOString().split("T")[0]; 
        const dateInput = document.getElementById('date');
        dateInput.value = formattedDate;
        dateInput.setAttribute("max", formattedDate);
    }
    document.getElementById('date').addEventListener('change', function() {
        let selectedDate = new Date(this.value);
        let today = new Date();
        today.setHours(0, 0, 0, 0);
        selectedDate.setHours(0, 0, 0, 0);

        if (selectedDate > today) {
            alert("You cannot select a future date! Please select today's date or a past date.");
            updateCurrentDate();
        }
    });
    updateCurrentDate();
</script>
</body>
</html>