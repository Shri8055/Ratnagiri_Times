<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'pmedia', 4306);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$ed=$conn->query("SELECT * FROM ed");
$ad=$conn->query("SELECT * FROM ad");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $bill_no=$_POST['bill-no'];
        $bill_date=$_POST['bill-date'];
        $ac_no=$_POST['ac-no'];
        $ac_name=$_POST['ac-name'];
        $cli_name=$_POST['cli-name'];
        $mob_no=$_POST['CmobNo'];
        $cap=$_POST['caption'];
        $r_o_no=$_POST['r-o-no'];
        $r_o_date=$_POST['r-o-date'];
        $pub_date=$_POST['pub-date'];
        $page=$_POST['pg-no'];
        $ed_type=$_POST['edition'];
        $ad_type=$_POST['ad-type'];
        $column=$_POST['col'];
        $sp_pos_char=$_POST['col-pos-char'];
        $sp_pos_rs=$_POST['col-rs'];
        $sq_cm=$_POST['sqcms'];
        $colr_char=$_POST['col-char'];
        $colr_char_rs=$_POST['sq-col-rs'];
        $tot_cm=$_POST['tocms'];
        $tot_amt=$_POST['tot-col-rs'];
        $inserts=$_POST['inserts'];
        $less_com=$_POST['less-comm'];
        $less_com_rs=$_POST['ins-rs'];
        $rate=$_POST['rate'];
        $amt_bef_tax=$_POST['gr-rs'];
        $gross_amt=$_POST['gross-amt'];
        $cgst=$_POST['cgst'];
        $cgst_rs=$_POST['cgst-rs'];
        $sgst=$_POST['sgst'];
        $sgst_rs=$_POST['sgst-rs'];
        $igst=$_POST['igst'];
        $igst_rs=$_POST['igst-rs'];
        $ad_rep=$_POST['adbyrep'];
        $net_amt=$_POST['net-amt-rs'];
        $net_amt_w=$_POST['netinw'];
        $due_date_bill=$_POST['du-date'];
        $color_ad=$_POST['col-ad'];
        $curr_bal=$_POST['cur-bal-rs'];
    }
    echo "<pre>";
        print_r($_POST);
    echo "</pre>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratnagiri Times | BILLS</title>
    <link rel="stylesheet" href="bills.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <a class="main-a" href="home.php" style="position: absolute; margin: 10px 0"><button>Home</button></a>
    <div class="main">
        <div class="day">
            <p id="current-day"></p>
            <p id="current-date"></p>
        </div>
        <h2>RATNAGIRI TIMES</h2>
        <div class="time">
            <p>Time:</p>
            <p id="current-time"></p>
        </div>
    </div>
    <hr>
    <form id="form" action="bills.php" method="POST">
        <h2 class="h2">Advitisement Bills</h2>
    <table>
        <tr>
            <td><label for="bill-no">Bill No.:</label></td>
            <td><input id="bill-no" name="bill-no" type="number" value="0" style="text-align: center;" readonly></td>
            <td><label for="bill-date">Bill Date:</label></td>
            <td><input id="bill-date" name="bill-date" type="date" tabindex="1"></td>
            <td><label for="ac-no">A/c No.:</label></td>
            <td><input id="ac-no" name="ac-no" type="text" value="0" readonly></td>
        </tr>
        <tr>
            <td><label for="ac-name">A/c Name:</label></td>
                <td>
                    <input id="ac-name" name="ac-name" type="text" autocomplete="off" oninput="searchAccount(this.value)"  tabindex="2">
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
                            document.getElementById('ac-no').value = account.ac_no;
                            document.getElementById('ac-name').value = account.ac_name;
                            document.getElementById('cur-bal-rs').value = parseFloat(account.cur_bal).toFixed(2);
                            document.getElementById('les-comm').value = parseFloat(account.commission).toFixed(2);
                            resultsBox.style.display = 'none';
                            selectedIndex = -1;
                        }

                        document.addEventListener('click', function (e) {
                            if (!resultsBox.contains(e.target) && e.target.id !== 'ac-name') {
                                resultsBox.style.display = 'none';
                            }
                        });
                    </script>
                </td>
        </tr>
        <tr>
            <td><label for="cli-name">Client Name:</label></td>
            <td><input id="cli-name" name="cli-name" type="text" tabindex="3"></td>
            <td><label for=""></label></td>
            <td><input type="hidden"></td>
            <td><label for="CmobNo">Mob No.:</label></td>
            <td><input id="CmobNo" name="CmobNo" type="number" tabindex="4"></td>
            <span id="mob-no-error" style="color: red; font-size: 14px;"></span>
            <script>
                let mobInput = document.getElementById("CmobNo");
                let mobError = document.getElementById("mob-no-error")
                mobInput.addEventListener("blur", function() {
                    if (this.value.length !== 10) {
                        mobError.textContent = " Mobile number must be 10 digit! ";
                    } else {
                        mobError.textContent = "";
                    }
                });
            </script>
        </tr>
        <tr>
            <td><label for="captions">Captions:</label></td>
            <td colspan="5"><input id="captions" name="caption" type="text" tabindex="5"></td>
        </tr>
        <tr>
            <td><label for="r-o-no">R.O. No.:</label></td>
            <td><input id="r-o-no" name="r-o-no" type="number" tabindex="6"></td>
            <td><label for="r-o-date">R.O. Date:</label></td>
            <td><input id="r-o-date" name="r-o-date" type="date" tabindex="7"></td>
            <td class="pub_date_td"><label for="pub-date">Pub. Date:</label></td>
            <td>
                <input id="pub-date" name="pub-date" type="date" tabindex="8">
                <label for="page-no" class="pg-no">Page No.:</label>
                <input id="page-no" name="pg-no" type="number" min="1" value="1" style="width: 50px;" tabindex="9">
            </td>
        </tr>
        <tr>
            <td><label for="ed-typ">Edition:</label></td>
            <td class="ed_typ">
                <select name="edition" id="ed-typ" tabindex="10">
                <?php while ($row = $ed->fetch_assoc()) { ?>
                    <option value="<?php echo $row['ed_nmae']; ?>"><?php echo $row['ed_nmae']; ?></option>
                <?php } ?>
                </select>
            </td>
            <td><label for=""></label></td>
            <td><input type="hidden"></td>
            <td class="ad_typ"><label for="ad-typ">Ad. Type:</label></td>
            <td>
                <select name="ad-type" id="ad-typ" tabindex="11">
                    <?php while ($row = $ad->fetch_assoc()) { ?>
                        <option value="<?php echo $row['ad_nmae']; ?>"><?php echo $row['ad_nmae']; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><hr></td>
            <td><hr></td>
            <td><hr></td>
            <td><hr></td>
            <td><hr></td>
            <td><hr></td>
        </tr>
        <tr>
            <td><label for="col">Column:</label></td>
            <td><input id="col" name="col" type="number" min="1" max="8" value="1" tabindex="12"></td>
            <td><label for="col-pos-char">Sp.Pos Charges(%):</label></td>
            <td><input id="col-pos-char" type="number" name="col-pos-char" value="0.00" tabindex="17"></td>
            <td><label for="col-rs">Rs:</label></td>
            <td><input id="col-rs" name="col-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for="sq-cms">Sq.Cms.:</label></td>
            <td><input id="sq-cms" name="sqcms" type="number" value="0" tabindex="13"></td>
            <td><label for="col-char">Color Charges(%):</label></td>
            <td><input id="col-char" name="col-char" type="number" value="0.00" tabindex="18"></td>
            <td><label for="sq-rs">Rs:</label></td>
            <td><input id="sq-rs" name="sq-col-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for="tocms">Total Cms.:</label></td>
            <td><input id="tocms" name="tocms" type="number" value="0" tabindex="14" readonly></td>
            <td><label for=""></label></td>
            <td><input type="hidden"></td>
            <td><label for="to-rs">Total Amt. Rs:</label></td>
            <td><input id="to-rs" name="tot-col-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for="ins">Inserts:</label></td>
            <td><input id="ins" name="inserts" type="number" value="1"  tabindex="15"></td>
            <td><label for="les-comm">Less Commi(%):</label></td>
            <td><input id="les-comm" name="less-comm" type="number" min="0" max="100" value="0.00" tabindex="19"></td>
            <td><label for="ins-rs">Rs:</label></td>
            <td><input id="ins-rs" name="ins-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for="rate">Rate:</label></td>
            <td><input id="rate" name="rate" type="number" value="0.00" tabindex="16"></td>
            <td><label for=""></label></td>
            <td><input type="hidden"></td>
            <td><label for="gr-rs">Amt. Bef Tax Rs:</label></td>
            <td><input id="gr-rs" name="gr-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for="gross-amt">Gross Amt.:</label></td>
            <td><input id="gross-amt" name="gross-amt" type="number" value="0.00"></td>
            <td><label class="gst" for="cgst">CGST : @</label></td>
            <td><input id="cgst" name="cgst" type="number" value="2.50" tabindex="20"></td>
            <td><label class="cgst-rs" for="cgst-rs">Rs: </label></td>
            <td><input id="cgst-rs" name="cgst-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for=""></label></td>
            <td><input type="hidden"></td>
            <td><label class="gst" for="sgst">SGST : @</label></td>
            <td><input id="sgst" name="sgst" type="number" value="2.50" tabindex="21"></td>
            <td><label class="sgst-rs" for="sgst-rs">Rs: </label></td>
            <td><input id="sgst-rs" name="sgst-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for=""></label></td>
            <td><input type="hidden"></td>
            <td><label class="gst" for="igst">IGST : @</label></td>
            <td><input id="igst" name="igst" type="number" value="0.00" tabindex="22"></td>
            <td><label class="igst-rs" for="igst-rs">Rs: </label></td>
            <td><input id="igst-rs" name="igst-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for="ad-rep">Ad. by Repre:</label></td>
            <td>
                <select name="adbyrep" id="ad-rep" tabindex="23">
                    <option value="-">-</option>
                    <option value="Reporters">Reporters</option>
                    <option value="Representative">Representative</option>
                    <option value="Office Staff">Office Staff</option>
                </select>
            </td>
            <td><label for=""></label></td>
            <td><input type="hidden"></td>
            <td><label for="net-amt">NET AMT Rs.:</label></td>
            <td><input id="net-amt" name="net-amt-rs" type="number" value="0.00" readonly></td>
        </tr>
        <tr>
            <td><label for="net-in-w">NET in words: </label></td>
            <td><input id="net-in-w" name="netinw" type="text" value="Rs. Only"></td>
        </tr>
        <tr>
            <td><label for="du-date">Due date of this bill:</label></td>
            <td><input id="du-date" name="du-date" type="date" tabindex="24"></td>
            <td><label for="col-ad">Color Ad.:</label></td>
            <td>
                <select name="col-ad" id="col-ad" tabindex="25">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </td>
            <td><label for="cur-bal-rs">Current Bal. Rs.:</label></td>
            <td><input id="cur-bal-rs" name="cur-bal-rs" type="decimal" value="0.00" readonly> Cr.</td>
        </tr>
        <script>
            function toWords(num) {
                const a = [
                    '', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven',
                    'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen',
                    'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'
                ];
                const b = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

                if ((num = num.toString()).length > 9) return 'Overflow';
                let n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
                if (!n) return; let str = '';
                str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + ' Crore ' : '';
                str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + ' Lakh ' : '';
                str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + ' Thousand ' : '';
                str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + ' Hundred ' : '';
                str += (n[5] != 0) ? ((str != '') ? 'and ' : '') +
                    (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + ' ' : '';
                return str + 'Rupees Only';
            }

            function updateAll() {
                const gross = parseFloat(document.getElementById('gross-amt').value) || 0;
                const spPerc = parseFloat(document.getElementById('col-pos-char').value) || 0;
                const colorPerc = parseFloat(document.getElementById('col-char').value) || 0;
                const commPerc = parseFloat(document.getElementById('les-comm').value) || 0;
                
                const colRs = (gross * spPerc) / 100;
                const sqRs = (gross * colorPerc) / 100;
                const totalAmt = gross + colRs + sqRs;
                const commRs = (totalAmt * commPerc) / 100;
                const beforeTax = totalAmt - commRs;

                document.getElementById('col-rs').value = colRs.toFixed(2);
                document.getElementById('sq-rs').value = sqRs.toFixed(2);
                document.getElementById('to-rs').value = totalAmt.toFixed(2);
                document.getElementById('ins-rs').value = commRs.toFixed(2);
                document.getElementById('gr-rs').value = beforeTax.toFixed(2);

                let cgstPerc = parseFloat(document.getElementById('cgst').value) || 0;
                let sgstPerc = parseFloat(document.getElementById('sgst').value) || 0;
                let igstPerc = parseFloat(document.getElementById('igst').value) || 0;

                if (igstPerc > 0) {
                    cgstPerc = 0;
                    sgstPerc = 0;
                    document.getElementById('cgst').value = "0.00";
                    document.getElementById('sgst').value = "0.00";
                } else {
                    igstPerc = 0;
                    document.getElementById('igst').value = "0.00";
                }

                const cgstRs = (beforeTax * cgstPerc) / 100;
                const sgstRs = (beforeTax * sgstPerc) / 100;
                const igstRs = (beforeTax * igstPerc) / 100;

                document.getElementById('cgst-rs').value = cgstRs.toFixed(2);
                document.getElementById('sgst-rs').value = sgstRs.toFixed(2);
                document.getElementById('igst-rs').value = igstRs.toFixed(2);

                const netAmt = beforeTax + cgstRs + sgstRs + igstRs;
                document.getElementById('net-amt').value = netAmt.toFixed(2);
                document.getElementById('net-in-w').value = toWords(Math.round(netAmt));
            }

            document.getElementById('cgst').addEventListener('input', function () {
                if (parseFloat(this.value) > 0) {
                    document.getElementById('sgst').value = this.value;
                    document.getElementById('igst').value = "0.00";
                }
                updateAll();
            });

            document.getElementById('sgst').addEventListener('input', function () {
                if (parseFloat(this.value) > 0) {
                    document.getElementById('cgst').value = this.value;
                    document.getElementById('igst').value = "0.00";
                }
                updateAll();
            });

            document.getElementById('igst').addEventListener('input', function () {
                if (parseFloat(this.value) > 0) {
                    document.getElementById('cgst').value = "0.00";
                    document.getElementById('sgst').value = "0.00";
                }
                updateAll();
            });
            ['gross-amt', 'col-pos-char', 'col-char', 'les-comm'].forEach(id => {
                document.getElementById(id).addEventListener('input', updateAll);
            });
        </script>
    </table>
        <div class="buttons">
            <button type="submit" name="add" tabindex="26">ADD</button>
            <button type="submit" tabindex="27">BILL LIST</button>
            <button type="submit" tabindex="28" class="print-logo">PRINT <i class="fa-solid fa-print"></i></button>
        </div>
    </form>
    <p class="footer">Software Developed by: Vyanktesh Computers, Kolhapur, Ph.No.: 7972378977, 9307856854 , E-mail : vyanktesh2001@gmail.com</p>
    <script>
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
        function calculateTotalCms() {
            const col = parseFloat(document.getElementById('col').value) || 0;
            const sqCms = parseFloat(document.getElementById('sq-cms').value) || 0;
            const total = col * sqCms;
            document.getElementById('tocms').value = total.toFixed(2);
            document.getElementById('gross-amt').value = gr_amt.toFixed(2);
        }
        document.getElementById('col').addEventListener('input', calculateTotalCms);
        document.getElementById('sq-cms').addEventListener('input', calculateTotalCms);
        
        function calculateGrossAmount() {
            const col = parseFloat(document.getElementById('col').value) || 0;
            const sqCms = parseFloat(document.getElementById('sq-cms').value) || 0;
            const rate = parseFloat(document.getElementById('rate').value) || 0;
            const inserts = parseFloat(document.getElementById('ins').value) || 0;
            const totalCms = col * sqCms;
            const grossAmt = totalCms * rate * inserts;
            document.getElementById('tocms').value = totalCms.toFixed(2);
            document.getElementById('gross-amt').value = grossAmt.toFixed(2);
        }
        document.getElementById('col').addEventListener('input', calculateGrossAmount);
        document.getElementById('sq-cms').addEventListener('input', calculateGrossAmount);
        document.getElementById('rate').addEventListener('input', calculateGrossAmount);
        document.getElementById('ins').addEventListener('input', calculateGrossAmount);

        document.getElementById("form").addEventListener("submit", function(event) {
        let mobInput = document.getElementById("CmobNo");
        let mobError = document.getElementById("mob-no-error");
        let isValid = true;
        if(mobInput.value.length!=''){
            if (mobInput.value.length !== 10) {
                mobError.textContent = " Phone number must be 10 digit!";
                isValid = false;
            }
        }else {
            mobError.textContent = "";
        }
        if (!isValid) {
            event.preventDefault();
        }
    });
        function updateDateTime() {
            const now = new Date();
            const options = { weekday: 'long' };
            const dayName = new Intl.DateTimeFormat('en-US', options).format(now);
            const formattedDate = now.toLocaleDateString('en-GB').split('/').join('-');
            const time = now.toLocaleTimeString('en-US', { hour12: false });

            document.getElementById('current-day').textContent = dayName;
            document.getElementById('current-date').textContent = formattedDate;
            document.getElementById('current-time').textContent = time;

            const today = new Date();
            const todayISO = today.toISOString().split("T")[0];

            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);
            const yesterdayISO = yesterday.toISOString().split("T")[0];

            // Set bill-date to today
            const billDateInput = document.getElementById('bill-date');
            if (billDateInput) {
                billDateInput.value = todayISO;
                billDateInput.max = todayISO;
            }

            // Set r-o-date and pub-date to yesterday
            ['r-o-date', 'pub-date'].forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    input.value = yesterdayISO;
                    input.max = todayISO;
                }
            });

            // Set due-date to today
            const dueDateInput = document.getElementById('du-date');
            if (dueDateInput) {
                dueDateInput.value = todayISO;
                dueDateInput.max = todayISO;
            }
        }

        function validateDate(input, allowToday = true) {
            const now = new Date();
            now.setHours(0, 0, 0, 0);
            const selected = new Date(input.value);
            selected.setHours(0, 0, 0, 0);

            const todayISO = new Date(now.getTime() - now.getTimezoneOffset() * 60000).toISOString().split("T")[0];
            const yesterday = new Date(now);
            yesterday.setDate(now.getDate() - 1);
            const yesterdayISO = new Date(yesterday.getTime() - yesterday.getTimezoneOffset() * 60000).toISOString().split("T")[0];

            if (selected > now) {
                if (input.id === 'bill-date') {
                    alert("You cannot select a future date! Please select today's date or a past date.");
                    input.value = todayISO;
                } else if (input.id === 'r-o-date' || input.id === 'pub-date') {
                    input.value = yesterdayISO;
                }
            } else if (!allowToday && selected.getTime() === now.getTime()) {
                input.value = yesterdayISO;
            }
        }
        window.onload = function () {
            updateDateTime();

            const billDateInput = document.getElementById('bill-date');
            if (billDateInput) {
                ['change', 'blur', 'input'].forEach(event =>
                    billDateInput.addEventListener(event, () => validateDate(billDateInput, true))
                );
            }

            ['r-o-date', 'pub-date'].forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    ['change', 'blur', 'input'].forEach(event =>
                        input.addEventListener(event, () => validateDate(input, false))
                    );
                }
            });
        };

        setInterval(() => {
            document.getElementById('current-time').textContent =
                new Date().toLocaleTimeString('en-US', { hour12: false });
        }, 1000);
    </script>
</body>
</html>