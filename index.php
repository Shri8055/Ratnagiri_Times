<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'pmedia', 4306);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$curr_date = date("Y-m-d");
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['add'])){
        $ac_open_date=$_POST['date'];
        $ac_open_date = date("Y-m-d", strtotime($ac_open_date));
        if ($ac_open_date > $curr_date) {
            echo "<script>alert('Select today\'s date or a previous date!'); window.history.back();</script>";
            exit;
        }
        $ac_no=$_POST['ac-no'];
        $category=$_POST['category1'];
        $ac_name=$_POST['ac-name'];
        $gstin=$_POST['gstin'];
        $address=$_POST['address'];
        $city=$_POST['city'];
        $pin_code=$_POST['p-code'];
        $district=$_POST['district'];
        $state_code=$_POST['state-code'];
        $state_name=$_POST['state-name'];
        $phone=$_POST['ph-no'];
        $cgst=$_POST['cgst'];
        $sgst=$_POST['sgst'];
        $igst=$_POST['igst'];
        $free_copies=$_POST['copies'];
        $copies=$_POST['copi'];
        $balance=$_POST['balance'];
        $deposit=$_POST['opdepo'];
        $tot_deposit=$_POST['totdep'];
        $current_bal=$_POST['currbal'];
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
    <title>Ratnagiti Times | MASTER</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <h2>Advertisement A/c's Master</h2>
        <form action="index.php" method="POST">
            <div class="first-form-section">
                <label for="date">A/c Opening Date:</label>
                <input id="date" name="date" type="date">

                <label for="ac-no">A/c No.:</label>
                <input id="ac-no" name="ac-no" type="text" required>

                <label for="category">Category:</label>
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
            </div><br>

            <div class="form-section">
                <div class="second-form-section">
                    <label for="ac-name">A/c Name:</label>
                    <input id="ac-name" name="ac-name" type="text" class="full-width">

                    <label for="gstin">GSTIN:</label>
                    <input id="gstin" name="gstin" type="text" maxlength="15" style="text-transform: uppercase;">
                </div>
            </div><br>

            <div class="form-section">
                <label for="address">Address:</label>
                <input id="address" name="address">
            </div><br>

            <div class="form-section">
                <div class="third-form-section">
                    <label class="city" for="city">City:</label>
                    <input id="city" name="city" type="text">

                    <label for="p-code">Pin-code:</label>
                    <input id="p-code" name="p-code"  type="text" maxlength='6' placeholder="6 digits only">

                    <label for="district">District:</label>
                    <input id="district" name="district" type="text">

                    <label for="state-code">State Code:</label>
                    <input id="state-code" name="state-code" maxlength="3" type="text" placeholder="3 Character only"  style="text-transform: uppercase;">
                </div>
            </div><br>

            <div class="form-section sixth-section">
                <label for="state-name">State Name: </label>
                <input id="state-name" name="state-name" type="text">
                <div class="inner-sixth-section">
                    <label for="phone">Phone: </label>
                    <input id="phone" name="ph-no" maxlength="11" placeholder="11 digits only" type="number">
                </div>
            </div><br><hr class="hr1">

            <div class="form-section">
                <div class="forth-form-section">
                    <label for="cgst">CGST:</label>
                    <input id="cgst" name="cgst" type="number" min="0" step="any" value="0.00">

                    <label for="sgst">SGST:</label>
                    <input id="sgst" name="sgst" type="number" min="0" step="any" value="0.00">

                    <label for="igst">IGST:</label>
                    <input id="igst" name="igst" type="number" min="0" step="any" value="0.00">
                </div>
            </div><br>

            <div class="form-section">
                <div class="fifth-form-section">
                    <label for="cop">Free Copies with Bill:</label>
                    <select id="cop" name="copies">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>

                    <label for="copi">Copies:</label>
                    <input id="copi" name="copi" type="number" value="1">
                </div>
            </div><hr class="hr2">

            <div class="form-section">
                <label for="bal">Op. Balance:</label>
                <input id="bal" name="balance" type="number" min="0" step="any" class="highlight-blue" value="0.00">

                <label for="opdepo">Op. Deposit:</label>
                <input id="opdepo" name="opdepo" type="number" min="0" step="any" class="highlight-yellow" value="0.00">

                <label class="totdep" for="totdep">Total Deposit:</label>
                <input id="totdep" name="totdep" type="number" min="0" step="any" class="highlight-green" value="0.00">

                <label for="currbal">Current Balance:</label>
                <input id="currbal" name="currbal" type="none" min="0" step="any" class="highlight-red" value="0.00">
            </div>

            <div class="buttons">
                <button type="submit" name="add">ADD</button>
                <button type="submit">BILL LIST</button>
                <button type="submit">PRINT <i class="fa-solid fa-print"></i></button>
            </div>
        </form>
        <p class="footer">Software Developed by: Vyanktesh Computers, Kolhapur, Ph.No.: 7972378977, 9307856854 , E-mail : vyanktesh2001@gmail.com</p>
    </div>
    <script>
    function updateCurrentDate() {
        const now = new Date();
        const formattedDate = now.toISOString().split("T")[0]; 
        document.getElementById('date').value = formattedDate;
    }
    updateCurrentDate();
    </script>
</body>
</html>
