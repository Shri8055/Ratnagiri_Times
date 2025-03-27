<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratnagiti Times | Master</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Advertisement A/c's Master</h2>
        <form action="index.php" method="POST">
            <div class="first-form-section">
                <label for="date">A/c Opening Date:</label>
                <input id="date" name="date" type="date">

                <label for="ac-no">A/c No.:</label>
                <input id="ac-no" name="ac-no" type="text">

                <label for="category">Category:</label>
                <select id="category" name="category1">
                    <option value="Reporters">INS Agencies</option>
                    <option value="Reporters">Non-INS Agencies</option>
                    <option value="Reporters">Local Agencies</option>
                    <option value="Reporters">Reporters</option>
                    <option value="Reporters">Representatives</option>
                    <option value="Reporters">Office Staff</option>
                    <option value="Reporters">Advocate</option>
                    <option value="Reporters">Reporters</option>
                    <option value="Reporters">Reporters</option>
                </select>
            </div><br>

            <div class="form-section">
                <div class="second-form-section">
                    <label for="ac-name">A/c Name:</label>
                    <input id="ac-name" name="ac-name" type="text" class="full-width">

                    <label for="gstin">GSTIN:</label>
                    <input id="gstin" name="gstin" type="text">
                </div>
            </div><br>

            <div class="form-section">
                <label for="address">Address:</label>
                <input id="address" name="address">
            </div><br>

            <div class="form-section">
                <div class="third-form-section">
                    <label for="city">City:</label>
                    <input id="city" name="city" type="text">

                    <label for="p-code">Pin-code:</label>
                    <input id="p-code" name="p-code" type="text">

                    <label for="district">District:</label>
                    <input id="district" name="district" type="text">

                    <label for="state-code">State Code:</label>
                    <input id="state-code" name="state-code" type="text">
                </div>
            </div><br>

            <div class="form-section sixth-section">
                <label for="state-name">State Name: </label>
                <input id="state-name" name="state-name" type="text">
                <div class="inner-sixth-section">
                    <label for="phone">Phone: </label>
                    <input id="phone" name="phone" type="text">
                </div>
            </div><br><hr class="hr1">

            <div class="form-section">
                <div class="forth-form-section">
                    <label for="cgst">CGST:</label>
                    <input id="cgst" name="cgst" type="number" value="0.00">

                    <label for="sgst">SGST:</label>
                    <input id="sgst" name="sgst" type="number" value="0.00">

                    <label for="igst">IGST:</label>
                    <input id="igst" name="igst" type="number" value="0.00">
                </div>
            </div><br>

            <div class="form-section">
                <div class="fifth-form-section">
                    <label for="cop">Free Copies with Bill:</label>
                    <select id="cop">
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
                <input id="bal" name="balance" type="number" class="highlight-blue" value="0.00">

                <label for="opdepo">Op. Deposit:</label>
                <input id="opdepo" name="opdepo" type="number" class="highlight-yellow" value="0.00">

                <label for="totdep">Total Deposit:</label>
                <input id="totdep" name="totdep" type="number" class="highlight-green" value="0.00">

                <label for="currbal">Current Balance:</label>
                <input id="currbal" name="currbal" type="number" class="highlight-red" value="0.00">
            </div>

            <div class="buttons">
                <button type="button">ADD</button>
                <button type="button">EDIT</button>
                <button type="button">DELETE</button>
                <button type="button">DISPLAY</button>
                <button type="button">FIND</button>
                <button type="button">EXIT</button>
            </div>
        </form>
        <p class="footer">Software Developed by: Vyanktesh Computers, Kolhapur, Ph.No.: 7972378977, 9307856854 , E-mail : vyanktesh2001@gmail.com</p>
    </div>
</body>
</html>
