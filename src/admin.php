</head>

<div class="button-row">
    <button id="Logout" onclick="logout()">Logout</button>
</div>

<div class="container">
    <div class="button-row">
        <button id="getAllTicketsBtn">Get All Tickets</button>
    </div>

    <div class="button-row">
        <form id="ticketIdForm">
            <input type="text" id="ticketId" name="ticketId" placeholder="ticket id">
            <button id="getTicketBtn">Get Ticket</button>
        </form>
    </div>

    <div id="result"></div>
</div>

<script src="js/script.js"></script>
<script>
    function logout() {
        window.location.href = '/logout.php';
    }
</script>

<link href="css/style.css" rel="stylesheet">