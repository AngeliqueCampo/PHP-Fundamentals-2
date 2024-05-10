<!DOCTYPE html>
<html>
<head>
    <title>Order Form</title>
</head>
<body>
    <h1>Welcome to my bakery!</h1>
    <h2>Order Form</h2>
    <p>Please place your order below~</p>
    <p>Prices:</p>
    <ul>
        <li>Cookies: PHP 20 each</li>
        <li>Cakes: PHP 150 each</li>
        <li>Cupcakes: PHP 40 each</li>
    </ul>
    <form action="index2.php" method="post">
        <label for="item">Menu:</label>
        <select id="item" name="item">
            <option value="Cookie">Cookie</option>
            <option value="Cake">Cake</option>
            <option value="Cupcake">Cupcake</option>
        </select><br><br>
        <label for="quantity">Quantity: </label>
        <input type="number" id="quantity" name="quantity" required><br><br>
        <label for="cash">Cash: </label>
        <input type="number" id="cash" name="cash" required><br><br>
        <input type="submit" value="Submit Order">
    </form>
    <p>Thank you so much!~</p>
</body>
</html>
<?php
session_start();

// Simulated database or array of user credentials
$users = [
    'user1' => 'password1',
    'user2' => 'password2'
];

// Initialize error messages
$login_error = $register_error = $registration_success = '';

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If login attempt
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validate login credentials
        if (!empty($username) && !empty($password)) {
            if (array_key_exists($username, $users) && $users[$username] === $password) {
                $_SESSION['username'] = $username;
                header('Location: index.php'); // Redirect to index.php after successful login
                exit();
            } else {
                $login_error = "Invalid username or password.";
            }
        } else {
            $login_error = "Please enter both username and password.";
        }
    }
    // If registration attempt
    elseif (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validate registration credentials
        if (!empty($username) && !empty($password)) {
            // Check if username already exists
            if (array_key_exists($username, $users)) {
                $register_error = "Username already exists.";
            } else {
                // Add new user
                $users[$username] = $password;
                $registration_success = "Registration successful.";
            }
        } else {
            $register_error = "Please enter both username and password.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login/Register</title>
</head>
<body>
    <h2>Login/Register</h2>
    <?php if (!empty($login_error)) { echo "<p>$login_error</p>"; } ?>
    <?php if (!empty($register_error)) { echo "<p>$register_error</p>"; } ?>
    <?php if (!empty($registration_success)) { echo "<p>$registration_success</p>"; } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" name="login" value="Login">
        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>
