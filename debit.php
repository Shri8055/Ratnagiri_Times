<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratnagiri Times | DEBIT NOTES</title>
    <link rel="stylesheet" href="debit.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
<a class="main-a" href="home.php" style="position: absolute; margin: 10px 0"><button class="btn-a">Home</button></a>
    <h1>DEBIT NOTES</h1>
    <form action="debit.php" method="POST">
    <table>
            <tr>
                <td><label for="r-no">Dr. Note No.:</label></td>
                <td><input id="r-no" name="dr-nt" type="number" value="0"></td>
                <td><label for=""></label></td>
                <td><input type="hidden"></td>
                <td class="last"><label for="dr-date">Dr. Note Date.:</label></td>
                <td><input id="dr-date" name="dr-date" type="date"></td>
            </tr>
            <tr>
                <td><label for="ac-code">A/c Code:</label></td>
                <td><input id="ac-code" type="text"></td>
                <td><label for=""></label></td>
                <td><input type="hidden"></td>
                <td><label for="dr-nt-amt">Dr. Note Amt.:</label></td>
                <td><input id="dr-nt-amt" name="dr-nt-amt" type="text"></td>
            </tr>
            <tr>
                <td><label for="ac-na-ci">A/c Name & City:</label></td>
                <td><input id="ac-na-ci" name="ac-na-ci" type="text"></td>
            </tr>
            <tr>
                <td><label for="chq-no">Cheque No.:</label></td>
                <td><input id="chq-no" name="chq-no" type="text" style="text-transform: uppercase;"></td>
                <td><label for=""></label></td>
                <td><input type="hidden"></td>
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
                <td><label for="cash-de-in"></label></td>
                <td><input id="cash-de-in" name="cash-de-in" type="hidden"></td>
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