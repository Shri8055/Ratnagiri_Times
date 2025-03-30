<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratnagiri Times | RECEIPTS</title>
    <link rel="stylesheet" href="receipt.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <h1>RECEIPTS</h1><hr>
    <form action="receipt.php" method="POST">
        <table>
            <tr>
                <td><label for="r-no">Receipt No.:</label></td>
                <td><input id="r-no" name="r-no" type="text"></td>
                <td><label for=""></label></td>
                <td><input type="hidden"></td>
                <td><label for="r-date">Receipt Date.:</label></td>
                <td><input id="r-date" name="r-date" type="date"></td>
            </tr>
            <tr>
                <td><label for="ac-code">A/c Code:</label></td>
                <td><input id="ac-code" type="text"></td>
                <td><label for=""></label></td>
                <td><input type="hidden"></td>
                <td><label for="r-amt">Receipt Amt.:</label></td>
                <td><input id="r-amt" name="r-amt" type="text"></td>
            </tr>
            <tr>
                <td><label for="ac-na-ci">A/c Name & City:</label></td>
                <td><input id="ac-na-ci" name="ac-na-ci" type="text"></td>
            </tr>
            <tr>
                <td><label for="pay-ty">Payment Type:</label></td>
                <td><input id="pay-ty" name="pay-ty" type="text"></td>
                <td><label for="chq-no">Cheque No.:</label></td>
                <td><input id="chq-no" name="chq-no" type="text" style="text-transform: uppercase;"></td>
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
                <td><label for="cash-de-in">Cash Depo.in:</label></td>
                <td><input id="cash-de-in" name="cash-de-in" type="text"></td>
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
    <!-- <form action="receipt.php" method="POST">
        <div class="first-form">
            <div class="Ffirst-form">
                <label for="r-no">Receipt No.:</label>
                <input id="r-no" name="r-no" type="text">
            </div>
            <div class="Fsecond-form">
                <label for="r-date">Receipt No.:</label>
                <input id="r-date" name="r-date" type="date">
            </div>
        </div>
        <div class="second-form">
            <div class="Sfirst-form">
                <label for="ac-code">A/c Code:</label>
                <input id="ac-code" name="ac-code" type="text">
            </div>
            <div class="Ssecond-form">
                <label for="r-amt">Receipt Amt.:</label>
                <input id="r-amt" name="r-amt" type="number">
            </div>
        </div>
        <div class="third-form">
            <div class="Tfirst-form">
                <label for="ac-na-ci">A/c Name & City:</label>
                <input id="ac-na-ci" name="ac-na-ci" type="text">
            </div>
        </div>
        <div class="fourth-form">
            <div class="Ffirst-form">
                <label for="p-type">Payment type:</label>
                <input id="p-type" name="p-type" type="text">
            </div>
            <div class="Fsecond-form">
                <label for="chk-no">Cheque No.:</label>
                <input id="chk-no" name="chk-no" type="number">
            </div>
            <div class="Fthird-form">
                <label for="r-amt">Check Date:</label>
                <input id="r-amt" name="r-amt" type="date">
            </div>
        </div>
        <div class="second-form">
            <div class="Sfirst-form">
                <label for="b-name">Bank Name:</label>
                <input id="b-name" name="b-name" type="text">
            </div>
            <div class="Ssecond-form">
                <label for="b-branch">Bank Branch:</label>
                <input id="b-branch" name="b-branch" type="number">
            </div>
        </div>
        <div class="third-form">
            <div class="Tfirst-form">
                <label for="narr">Narration:</label>
                <input id="narr" name="narr" type="text">
            </div>
        </div>
        <div class="second-form">
            <div class="Sfirst-form">
                <label for="cash-dep-i">Cash Depo.in:</label>
                <input id="cash-dep-i" name="cash-dep-i" type="text">
            </div>
            <div class="Ssecond-form">
                <label for="cur-bal">Current Bal.:</label>
                <input id="cur-bal" name="cur-bal" type="number">
            </div>
        </div>
    </form> -->
    <script>
    function updateCurrentDate() {
        const now = new Date();
        const formattedDate = now.toISOString().split("T")[0]; 
        document.getElementById('r-date').value = formattedDate;
        document.getElementById('chq-date').value = formattedDate;
    }
    updateCurrentDate();
    </script>
</body>
</html>