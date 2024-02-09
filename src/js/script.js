document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('getAllTicketsBtn').addEventListener('click', function() {
        ajaxRequest('../actions/getAllTickets.php', 'result');
    });

    document.getElementById('getTicketBtn').addEventListener('click', function(event) {
        event.preventDefault();
        const ticketIdValue = document.getElementById('ticketId').value;
        if (/^\d+$/.test(ticketIdValue)) {
            const data = 'ticketId=' + encodeURIComponent(ticketIdValue);
            ajaxRequest('../actions/getTicket.php', 'result', data);
        } else {
            alert('Ticket ID must be an integer.');
            document.getElementById('ticketId').value = '';
        }
    });

	document.getElementById('newMessage').addEventListener('submit', function(event) {
		const message = document.getElementById('message').value.trim();
	
		if (message === '') {
			event.preventDefault();
			alert('Please enter a message before sending.');
		}
	});	

	// document.getElementById('submit').addEventListener('click', function(event) {
	// 	console.log('submit');
    //     event.preventDefault();
    //     const ticketIdValue = document.getElementById('ticketId').value;
	// 	const message = document.getElementById('message').value;
	// 	if (/^\d+$/.test(ticketIdValue)) {
	// 		const data = 'ticketId=' + encodeURIComponent(ticketIdValue) + '&message=' + encodeURIComponent(message);
	// 		ajaxRequest('../actions/createMessage.php', 'result', data);
	// 	} else {
	// 		alert('Ticket ID must be an integer.');
	// 		document.getElementById('ticketId').value = '';
	// 	}
    // });
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
