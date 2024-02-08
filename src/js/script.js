document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('getAllTicketsBtn').addEventListener('click', function() {
        ajaxRequest('actions/getAllTickets.php', 'result');
    });

    document.getElementById('getTicketBtn').addEventListener('click', function(event) {
        event.preventDefault();
        const ticketIdValue = document.getElementById('ticketId').value;
        if (/^\d+$/.test(ticketIdValue)) {
            const data = 'ticketId=' + encodeURIComponent(ticketIdValue);
            ajaxRequest('actions/getTicket.php', 'result', data);
        } else {
            alert('Ticket ID must be an integer.');
            document.getElementById('ticketId').value = '';
        }
    });
});

function ajaxRequest(url, resultElementId, data) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById(resultElementId).innerHTML = this.responseText;
        }
    };
    xhr.send(data);
}
