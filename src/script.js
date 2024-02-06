document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('getAllTicketsBtn').addEventListener('click', function() {
        ajaxRequest('actions/getAllTickets.php', 'result');
    });
});

function ajaxRequest(url, resultElementId) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById(resultElementId).innerHTML = this.responseText;
        }
    };
    xhr.send();
}
