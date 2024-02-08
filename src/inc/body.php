<div class="button-row">
    <button id="Login" onclick="window.location.href='/login.php'">Login</button>
</div>

<div class="container">
    <div>
        <label>
            <input type="text" id="name" name="name"
                   value="<?php if(!empty($_POST["name"])) { echo $_POST["name"]; } ?>"
                   placeholder="Name" required>
        </label>
    </div>

    <div>
        <label>
            <input type="email" id="email" name="email"
                   value="<?php if(!empty($_POST["email"])) { echo $_POST["email"]; } ?>"
                   placeholder="E-Mail" required>
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
            window.location.href = "../ticket.php?name=" + encodeURIComponent(name) + "&email=" + encodeURIComponent(email);
        } else {
            alert("Please fill in both name and email.");
        }
    });
</script>