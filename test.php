<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratnagiti Times | Bills</title>
    <link rel="stylesheet" href="bills.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main">
        <div class="day">
            <p id="current-day"></p>
            <p id="current-date"></p>
        </div>
        <h2>Bills</h2>
        <div class="time">
            <p>Time:</p>
            <p id="current-time"></p>
        </div>
    </div>
    <hr>
    <form action="bills.php" method="POST">
        <div class="first-form">
            <div class="inner-Ffirst-form">
                <label class="bill-no" for="bill-no">Bill No.:</label>
                <input id="bill-no" name="bill-no" type="number" value="0">

                <label id="bill-datel" for="bill-date">Bill Date:</label>
                <input id="bill-date" name="bill-date" type="date">
            </div>
            <div class="inner-Fsencond-form">
                <label for="ac-no">A/c No.:</label>
                <input id="ac-no" name="ac-no" type="number" value="0">
            </div>
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
            document.getElementById('bill-date').value = now.toISOString().split("T")[0];
            document.getElementById('current-time').textContent = time;
        }
        updateDateTime();
        setInterval(() => {
            document.getElementById('current-time').textContent = new Date().toLocaleTimeString('en-US', { hour12: false });
        }, 1000);
    </script>
</body>
</html>
