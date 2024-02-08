<div class="button-row">
    <button id="Login" onclick="window.location.href='/login.php'">Login</button>
</div>

<div class="container">
    <div>
        <label>
            <input type="text" id="name" name="name" placeholder="Name" required>
        </label>
    </div>

    <div>
        <label>
            <input type="email" id="email" name="email" placeholder="E-Mail" required>
        </label>
    </div>

    <br>

    <div class="button-row">
        <button id="createTicketBtn">Create Ticket</button>
    </div>
</div>

<script>
    document.getElementById('createTicketBtn').addEventListener('click', function() {
        const name  = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();

        if (name !== "" && email !== "") {
            const xhr = new XMLHttpRequest();

            xhr.open("POST", "../actions/createCustomer.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        window.location.href = "../ticket.php?name=" + encodeURIComponent(name) + "&email=" + encodeURIComponent(email);
                    } else {
                        console.error("Error: ", xhr.status);
                    }
                }
            };

            xhr.send("name=" + encodeURIComponent(name) + "&email=" + encodeURIComponent(email));
        } else {
            alert("Please fill in both name and email.");
        }
    });
</script>