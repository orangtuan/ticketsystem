<?php

include_once 'bootstrap.php';

$database = new Database();
$database->connect();

$employee = new Employee(1, 'admin', '123');

if ($employee->loggedIn()) {
    header("Location: admin.php");
}

$loginMessage = '';
if(!empty($_POST["name"]) && !empty($_POST["password"])) {
    $employee->setName($_POST["name"]);
    $employee->setPassword($_POST["password"]);

    if($employee->login($database)) {
        header("Location: admin.php");
        exit;
    } else {
        $loginMessage = 'Invalid login! Please try again.';
    }
} else if(!empty($_POST["login"])) {
    $loginMessage = 'Fill all fields.';
}

?>

<div class="button-row">
    <button id="home" onclick="window.location.href='/index.php'">Home</button>
</div>

<div class="container">
    <form action="login.php" method="post">
        <div>
            <span>
                <label for="name">
                    <input type="text" id="name" name="name" placeholder="Name" required>
                </label>
            </span>
        </div>

        <div>
            <span>
                <label for="password">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </label>
            </span>
        </div>

        <br>

        <div class="button-row">
            <input type="submit" name="login" value="Login">
        </div>

        <p>
            <h3>Login</h3>
            <strong>Name: </strong>admin
            <strong>Password: </strong>123
        </p>
    </form>
    <?php echo $loginMessage; ?>
</div>

<link href="css/style.css" rel="stylesheet">