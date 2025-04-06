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
        $bill_no;
        $bill_date;
        $ac_no;
        $ac_name;
        $cli_name;
        $mob_no;
        $cap;
        $r_o_no;
        $r_o_date;
        $pub_date;
        $page;
        $ed_type;
        $ad_type;
        $column;
        $sp_pos_char;
        $sp_pos_rs;
        $sq_cm;
        $colr_char;
        $colr_char_rs;
        $tot_cm;
        $tot_amt;
        $inserts;
        $less_com;
        $less_com_rs;
        $rate;
        $amt_bef_tax;
        $gross_amt;
        $cgst;
        $cgst_rs;
        $sgst;
        $sgst_rs;
        $igst;
        $igst_rs;
        $ad_rep;
        $net_amt;
        $net_amt_w;
        $due_date_bill;
        $color_ad;
        $curr_bal;
    }
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
            <td><input id="bill-no" name="bill-no" type="number" value="0"></td>
            <td><label for="bill-date">Bill Date:</label></td>
            <td><input id="bill-date" name="bill-date" type="date"></td>
            <td><label for="ac-no">A/c No.:</label></td>
            <td><input id="ac-no" name="ac-no" type="number" value="0" readonly></td>
        </tr>
        <tr>
            <td><label for="ac-name">A/c Name:</label></td>
            <td><input id="ac-name" name="ac-name" type="text"></td>
        </tr>
        <tr>
            <td><label for="cli-name">Client Name:</label></td>
            <td><input id="cli-name" name="cli-name" type="text"></td>
            <td><label for=""></label></td>
            <td><input type="hidden"></td>
            <td><label for="CmobNo">Mob No.:</label></td>
            <td><input id="CmobNo" name="CmobNo" type="number"></td>
        </tr>
        <tr>
            <td><label for="captions">Captions:</label></td>
            <td colspan="5"><input id="captions" name="caption" type="text"></td>
        </tr>
        <tr>
            <td><label for="r-o-no">R.O. No.:</label></td>
            <td><input id="r-o-no" name="r-o-no" type="number"></td>
            <td><label for="r-o-date">R.O. Date:</label></td>
            <td><input id="r-o-date" name="r-o-date" type="date"></td>
            <td class="pub_date_td"><label for="pub-date">Pub. Date:</label></td>
            <td>
                <input id="pub-date" name="pub-date" type="date">
                <label for="page-no" class="pg-no">Page No.:</label>
                <input id="page-no" name="pg-no" type="number" value="1" style="width: 50px;">
            </td>
        </tr>
        <tr>
            <td><label for="ed-typ">Edition:</label></td>
            <td class="ed_typ">
                <select name="edition" id="ed-typ">
                <?php while ($row = $ed->fetch_assoc()) { ?>
                    <option value="<?php echo $row['ed_nmae']; ?>"><?php echo $row['ed_nmae']; ?></option>
                <?php } ?>
                </select>
            </td>
            <td><label for=""></label></td>
            <td><input type="hidden"></td>
            <td class="ad_typ"><label for="ad-typ">Ad. Type:</label></td>
            <td>
                <select name="ad-type" id="ad-typ">
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
            <td><input id="col" name="col" type="number" value="1"></td>
            <td><label for="col-pos-char">Sp.Pos Charges(%):</label></td>
            <td><input id="col-pos-char" type="number" name="col-pos-char" value="0.00"></td>
            <td><label for="col-rs">Rs:</label></td>
            <td><input id="col-rs" name="col-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for="sq-cms">Sq.Cms.:</label></td>
            <td><input id="sq-cms" name="sqcms" type="number" value="0"></td>
            <td><label for="col-char">Color Charges(%):</label></td>
            <td><input id="col-char" name="col-char" type="number" value="0.00"></td>
            <td><label for="sq-rs">Rs:</label></td>
            <td><input id="sq-rs" name="sq-col-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for="tocms">Total Cms.:</label></td>
            <td><input id="tocms" name="tocms" type="number" value="0"></td>
            <td><label for=""></label></td>
            <td><input type="hidden"></td>
            <td><label for="to-rs">Total Amt. Rs:</label></td>
            <td><input id="to-rs" name="tot-col-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for="ins">Inserts:</label></td>
            <td><input id="ins" name="inserts" type="number" value="0"></td>
            <td><label for="les-comm">Less Commi(%):</label></td>
            <td><input id="les-comm" name="less-comm" type="number" value="0.00"></td>
            <td><label for="ins-rs">Rs:</label></td>
            <td><input id="ins-rs" name="ins-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for="rate">Rate:</label></td>
            <td><input id="rate" name="rate" type="number" value="0.00"></td>
            <td><label for=""></label></td>
            <td><input type="hidden"></td>
            <td><label for="gr-rs">Amt. Bef Tax Rs:</label></td>
            <td><input id="gr-rs" name="gr-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for="gross-amt">Gross Amt.:</label></td>
            <td><input id="gross-amt" name="gross-amt" type="number" value="0.00"> %</td>
            <td><label class="gst" for="cgst">CGST : @</label></td>
            <td><input id="cgst" name="cgst" type="number" value="0.00"></td>
            <td><label class="cgst-rs" for="cgst-rs">Rs: </label></td>
            <td><input id="cgst-rs" name="cgst-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for=""></label></td>
            <td><input type="hidden"></td>
            <td><label class="gst" for="sgst">SGST : @</label></td>
            <td><input id="sgst" name="sgst" type="number" value="0.00"></td>
            <td><label class="sgst-rs" for="sgst-rs">Rs: </label></td>
            <td><input id="sgst-rs" name="sgst-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for=""></label></td>
            <td><input type="hidden"></td>
            <td><label class="gst" for="igst">IGST : @</label></td>
            <td><input id="igst" name="igst" type="number" value="0.00"></td>
            <td><label class="igst-rs" for="igst-rs">Rs: </label></td>
            <td><input id="igst-rs" name="igst-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for="ad-rep">Ad. by Repre:</label></td>
            <td>
                <select name="adbyrep" id="ad-rep">
                    <option value="Local">Local</option>
                    <option value="National">National</option>
                    <option value="International">International</option>
                </select>
            </td>
            <td><label for=""></label></td>
            <td><input type="hidden"></td>
            <td><label for="net-amt">NET AMT Rs.:</label></td>
            <td><input id="net-amt" name="net-amt-rs" type="number" value="0.00"></td>
        </tr>
        <tr>
            <td><label for="net-in-w">NET in words: </label></td>
            <td><input id="net-in-w" name="netinw" type="text" value="Rs. Only"></td>
        </tr>
        <tr>
            <td><label for="du-date">Due date of this bill:</label></td>
            <td><input id="du-date" name="du-date" type="date"></td>
            <td><label for="col-ad">Color Ad.:</label></td>
            <td>
                <select name="col-ad" id="col-ad">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </td>
            <td><label for="cur-bal-rs">Current Bal. Rs.:</label></td>
            <td><input id="cur-bal-rs" name="cur-bal-rs" type="number" value="0.00"> Cr.</td>
        </tr>
    </table>
        <div class="buttons">
            <button type="submit" name="add">ADD</button>
            <button type="submit">BILL LIST</button>
            <button type="submit" class="print-logo">PRINT <i class="fa-solid fa-print"></i></button>
        </div>
    </form>
    <p class="footer">Software Developed by: Vyanktesh Computers, Kolhapur, Ph.No.: 7972378977, 9307856854 , E-mail : vyanktesh2001@gmail.com</p>
    <script>
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