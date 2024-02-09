<div class="button-row">
    <button id="home" onclick="window.location.href='/index.php'">Home</button>
</div>

<div class="containerTicket">
    <form id="createTicketForm" onsubmit="return validateForm()">
        <div>
            <label>
                <input type="text" id="title" name="title" placeholder="Title" required>
            </label>
        </div>

        <div>
            <label>
                <textarea id="description" name="description" placeholder="Description" required></textarea>
            </label>
        </div>

        <br>

        <div class="button-row">
            <button type="submit">Create Ticket</button>
        </div>
    </form>
</div>

<link href="css/style.css" rel="stylesheet">

<div id="result"></div>

<script>
    function validateForm() {
        const title         = document.getElementById("title").value.trim();
        const description   = document.getElementById("description").value.trim();

        if (title === "" || description === "") {
            alert("Please fill out all fields.");
            return false;
        }

        return true;
    }

    document.getElementById("createTicketForm").addEventListener("submit", function(event) {
        event.preventDefault();

        if (validateForm()) {
            const formData = new FormData(this);

            fetch("/actions/createTicket.php", {
                method: "POST",
                body: formData
            })
            .then(response  => response.text())
            .then(data      => {
                document.getElementById("result").innerHTML = data;
            })
            .catch(error    => {
                console.error("Error:", error);
            });
        }
    });
</script>