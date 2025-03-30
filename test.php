<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bills</title>
    <link rel="stylesheet" href="test.css">
</head>
<body>

    <div class="container">
        <div class="header">
            <div class="date-box">
                <p>Friday</p>
                <p>28-03-2025</p>
            </div>
            <h2>Bills</h2>
            <div class="time-box">
                <p>Time:</p>
                <p>09:51:43</p>
            </div>
        </div>

        <form>
            <div class="form-section">
                <div>
                    <label for="bill-no">Bill No.:</label>
                    <input type="number" id="bill-no" value="0">
                </div>
                <div>
                    <label for="bill-date">Bill Date:</label>
                    <input type="date" id="bill-date">
                </div>
                <div>
                    <label for="ac-no">A/c No.:</label>
                    <input type="number" id="ac-no" value="0">
                </div>
            </div>

            <div class="form-section">
                <div>
                    <label for="ac-name">A/c Name:</label>
                    <input type="text" id="ac-name">
                </div>
                <div>
                    <label for="client-name">Client Name:</label>
                    <input type="text" id="client-name">
                </div>
                <div>
                    <label for="mob-no">Mob No.:</label>
                    <input type="text" id="mob-no">
                </div>
            </div>

            <div class="form-section">
                <div>
                    <label for="captions">Captions:</label>
                    <input type="text" id="captions">
                </div>
                <div>
                    <label for="ro-no">R.O. No.:</label>
                    <input type="number" id="ro-no">
                </div>
                <div>
                    <label for="ro-date">R.O. Date:</label>
                    <input type="date" id="ro-date">
                </div>
            </div>

            <div class="form-section">
                <div>
                    <label for="pub-date">Pub. Date:</label>
                    <input type="date" id="pub-date">
                </div>
                <div>
                    <label for="edition">Edition:</label>
                    <select id="edition">
                        <option>Local</option>
                    </select>
                </div>
                <div>
                    <label for="ad-type">Ad. Type:</label>
                    <select id="ad-type">
                        <option>Small</option>
                    </select>
                </div>
            </div>

            <div class="form-section">
                <div>
                    <label for="column">Column:</label>
                    <input type="number" id="column" value="0">
                </div>
                <div>
                    <label for="sq-cms">Sq.Cms.:</label>
                    <input type="number" id="sq-cms" value="0">
                </div>
                <div>
                    <label for="total-cms">Total Cms.:</label>
                    <input type="number" id="total-cms" value="0">
                </div>
            </div>

            <div class="form-section">
                <div>
                    <label for="sp-position">Sp.Position Charges:</label>
                    <input type="number" id="sp-position" value="0.00">
                </div>
                <div>
                    <label for="color-charges">Color Charges:</label>
                    <input type="number" id="color-charges" value="0.00">
                </div>
                <div>
                    <label for="total-amt">Total Amt:</label>
                    <input type="number" id="total-amt" value="0.00">
                </div>
            </div>

            <div class="form-section">
                <div class="highlighted">
                    <label>Amt. Before Tax:</label>
                    <input type="number" value="0.00" readonly>
                </div>
                <div class="highlighted">
                    <label>CGST:</label>
                    <input type="number" value="0.00">
                </div>
                <div class="highlighted">
                    <label>SGST:</label>
                    <input type="number" value="0.00">
                </div>
            </div>

            <div class="form-section">
                <div class="highlighted">
                    <label>IGST:</label>
                    <input type="number" value="0.00">
                </div>
                <div class="highlighted">
                    <label>NET AMT Rs.:</label>
                    <input type="number" value="0.00">
                </div>
                <div class="highlighted green">
                    <label>NET in words:</label>
                    <input type="text" value="Rs. Only" readonly>
                </div>
            </div>

            <div class="button-container">
                <button>ADD</button>
                <button>EDIT</button>
                <button>DELETE</button>
                <button>DISPLAY</button>
                <button>FIND</button>
                <button>PRINT</button>
                <button>EXIT</button>
            </div>
        </form>

        <footer>
            Software Developed by: Vyanktesh Computers, Kolhapur, Ph. No.: 7972378977, 9307856854, Email: vyanktesh2001@gmail.com
        </footer>
    </div>

</body>
</html>
