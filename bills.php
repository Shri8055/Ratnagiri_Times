<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'pmedia', 4306);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        
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
    <h1 style="text-align: center;">BILLS</h1>
    <form id="form" action="bills.php" method="POST">
    <table>
        <tr>
            <td><label for="bill-no">Bill No.:</label></td>
            <td><input id="bill-no" name="bill-no" type="number" value="0"></td>
            <td><label for="bill-date">Bill Date:</label></td>
            <td><input id="bill-date" name="bill-date" type="date"></td>
            <td><label for="ac-no">A/c No.:</label></td>
            <td><input id="ac-no" name="ac-no" type="number" value="0"></td>
        </tr>
        <tr>
            <td><label for="ac-name">A/c Name:</label></td>
            <td><input id="ac-name" name="ac-name" type="text"></td>
            <td><label for="cli-name">Client Name:</label></td>
            <td><input id="cli-name" name="cli-name" type="text"></td>
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
            <td><label for="pub-date">Pub. Date:</label></td>
            <td>
                <input id="pub-date" name="pub-date" type="date">
                <label for="page-no">Page No.:</label>
                <input id="page-no" name="pg-no" type="number" value="1" style="width: 50px;">
            </td>
        </tr>
        <tr>
            <td><label for="ed-typ">Edition:</label></td>
            <td>
                <select name="edition" id="ed-typ">
                    <option value="Local">Local</option>
                    <option value="National">National</option>
                    <option value="International">International</option>
                </select>
            </td>
            <td><label for=""></label></td>
            <td><input type="hidden"></td>
            <td><label for="ad-typ">Ad. Type:</label></td>
            <td>
                <select name="ad-type" id="ad-typ">
                    <option value="Small">Small</option>
                    <option value="Large">Large</option>
                    <option value="Text based">Text Based</option>
                </select>
            </td>
        </tr>
    </table>
    </form>
    <div class="main">
        <div class="day">
            <p id="current-day"></p>
            <p id="current-date"></p>
        </div>
        <h2>BILLS</h2>
        <div class="time">
            <p>Time:</p>
            <p id="current-time"></p>
        </div>
    </div>
    <hr>
    <form id="form" action="bills.php" method="POST">
        
        <div class="forth-from">
            <div class="innerFofirst-form">
                
                
            </div>
            <div class="innerFosecond-form">
               
                
            </div>
        </div><hr class="second-hr">
        <div class="fifth-form">
            <div class="innerFifirst-form">
                <label for="col">Column:</label>
                <input id="col" name="col" type="number" value="0">
            </div>
            <div class="innerFisecond-form">
                <label for="col-pos-char">Sp.Position Charges:</label>
                <input id="col-pos-char" type="number" name="col-pos-char" value="0.00"> %
            </div>
            <div class="innerFithird-form">
                <label for="col-rs">Rs:</label>
                <input id="col-rs" name="col-rs" type="number" value="0.00">
            </div>
        </div>
        <div class="sixth-form">
            <div class="innerSifirst-form">
                <label for="sq-cms">Sq.Cms.:</label>
                <input id="sq-cms" name="sqcms" type="number" value="0">
            </div>
            <div class="innerSissecond-form">
                <label for="col-char">Color Charges:</label>
                <input id="col-char" name="col-char" type="number" value="0.00"> %
            </div>
            <div class="innerSithird-form">
                <label for="sq-rs">Rs:</label>
                <input id="sq-rs" name="sq-col-rs" type="number" value="0.00">
            </div>
        </div>
        <div class="sixth-form">
            <div class="innerSefirst-form">
                <label for="tocms">Total Cms.:</label>
                <input id="tocms" name="tocms" type="number" value="0">
            </div>
            <div class="innerSethird-form">
                <label for="to-rs">Total Amt. Rs:</label>
                <input id="to-rs" name="tot-col-rs" type="number" value="0.00">
            </div>
        </div>
        <div class="sixth-form">
            <div class="innerSiffirst-form">
                <label for="ins">Inserts:</label>
                <input id="ins" name="inserts" type="number" value="0">
            </div>
            <div class="innerSiseecond-form">
                <label for="les-comm">Less Commi(%):</label>
                <input id="les-comm" name="less-comm" type="number" value="0.00">
            </div>
            <div class="innerSithird-form">
                <label for="ins-rs">Rs:</label>
                <input id="ins-rs" name="ins-rs" type="number" value="0.00">
            </div>
        </div>
        <div class="sixth-form">
            <div class="innerSifffirst-form">
                <label for="rate">Rate:</label>
                <input id="rate" name="rate" type="number" value="0.00">
            </div>
            <div class="innerSifourth-form">
                <label for="gr-rs">Amt. Before Tax Rs:</label>
                <input id="gr-rs" name="gr-rs" type="number" value="0.00">
            </div>
        </div>
        <div class="eight-form">
            <div class="innerEffirst-form">
                <div class="innerSisecond-form">
                    <label for="gross-amt">Gross Amt.:</label>
                    <input id="gross-amt" name="gross-amt" type="number" value="0.00"> %
                </div>
            </div>
            <div class="innerEfirst-form">
                <div class="Efirst-form1">
                    <label for="cgst">CGST : @</label>
                    <input id="cgst" name="cgst" type="number" value="0.00">
                </div>
                <div class="Efirst-form2">
                    <label class="cgst-rs" for="cgst-rs">Rs: </label>
                    <input id="cgst-rs" name="cgst-rs" type="number" value="0.00">
                </div>
            </div>
        </div>
        <div class="eight-form">
            <div class="innerEfirst-form">
                <div class="Efirst-form1">
                    <label for="sgst">SGST : @</label>
                    <input id="sgst" name="sgst" type="number" value="0.00">
                </div>
                <div class="Efirst-form2">
                    <label class="sgst-rs" for="sgst-rs">Rs: </label>
                    <input id="sgst-rs" name="sgst-rs" type="number" value="0.00">
                </div>
            </div>
        </div>
        <div class="eight-form">
            <div class="innerEfirst-form">
                <div class="Efirst-form1">
                    <label for="igst">IGST : @</label>
                    <input id="igst" name="igst" type="number" value="0.00">
                </div>
                <div class="Efirst-form2">
                    <label class="igst-rs" for="igst-rs">Rs: </label>
                    <input id="igst-rs" name="igst-rs" type="number" value="0.00">
                </div>
            </div>
        </div>
        <div class="nineth-from">
            <div class="innerNfirst-form">
                <label for="ad-rep">Ad. by Repre:</label>
                <select name="adbyrep" id="ad-rep">
                    <option value="Local">Local</option>
                    <option value="National">National</option>
                    <option value="International">International</option>
                </select>
            </div>
            <div class="innerFosecond-form">
                <label for="net-amt">NET AMT Rs.:</label>
                <input id="net-amt" name="net-amt-rs" type="number" value="0.00">
            </div>
        </div>
        <div class="aux-form">
            <label for="net-in-w">NET in words: </label>
            <input id="net-in-w" name="netinw" type="text" value="Rs. Only">
        </div>
        <div class="tenth-from">
            <div class="innerTfirst-form">
                <label for="du-date">Due date of this bill:</label>
                <input id="du-date" name="du-date" type="date">
            </div>
            <div class="innerTsecond-form">
                <label for="col-ad">Color Ad.:</label>
                <select name="col-ad" id="col-ad">
                    <option value="Local">Local</option>
                    <option value="National">National</option>
                    <option value="International">International</option>
                </select>
            </div>
            <div class="innerTthird-form">
                <label for="cur-bal-rs">Current Bal. Rs.:</label>
                <input id="cur-bal-rs" name="cur-bal-rs" type="number" value="0.00"> Cr.
            </div>
        </div><hr class="second-hr">
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
            let today = now.toISOString().split("T")[0];
            let billDateInput = document.getElementById('bill-date');
            if (billDateInput) {
                billDateInput.value = today;
                billDateInput.setAttribute("max", today);
            }
            let dateFields = ['r-o-date', 'pub-date', 'du-date'];
            dateFields.forEach(id => {
                let input = document.getElementById(id);
                if (input) input.value = today;
            });
        }
        updateDateTime();
        setInterval(() => {
            document.getElementById('current-time').textContent = new Date().toLocaleTimeString('en-US', { hour12: false });
        }, 1000);
    </script>
</body>
</html>