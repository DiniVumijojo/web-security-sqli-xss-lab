<?php
$conn = new mysqli("localhost", "root", "", "altoro_bank");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$userData = null;
$allUsers = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (strpos($username, "' OR") !== false || strpos($password, "' OR") !== false) {
        // SQL Injection simulation  detects malicious input and returns all client records
        $sql = "SELECT * FROM clients";
        $result = $conn->query($sql);
    
        if ($result) {
            $allUsers = $result->fetch_all(MYSQLI_ASSOC);
            $message = "SQL Injection successful! All client data retrieved.";
        }
    } else {
        // Normal login: checks username and password against database
        $sql = "SELECT * FROM clients WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows === 1) {
            $userData = $result->fetch_assoc();
            $message = "Login successful.";
        } else {
            $message = "Invalid username or password.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Top Links -->
    <header>
    <nav class="top-links">
            <a href="#">Sign In</a> |
            <a href="#">Contact Us</a> |
            <a href="#" id="xssLink">Feedback</a> |
            <span>Search</span>
            <input type="text" class="search-box">
            <button>Go</button>
        </nav>

        <!-- Logo & Banner -->
        <section class="header">
            <h1 class="logo">AltoroMutual</h1>
            <p class="banner">DEMO SITE ONLY</p>
        </section>

        <!-- Navigation Bar -->
        <nav class="nav-bar">
            <ul>
                <li>ONLINE BANKING LOGIN</li>
                <li>PERSONAL</li>
                <li>SMALL BUSINESS</li>
                <li>INSIDE ALTORO MUTUAL</li>
            </ul>
        </nav>
    </header>

    <main class="main-container">

        <!-- Sidebar -->
        <aside class="sidebar">
            <section>
                <h4>PERSONAL</h4>
                <ul>
                    <li><a href="#">Deposit Product</a></li>
                    <li><a href="#">Checking</a></li>
                    <li><a href="#">Loan Products</a></li>
                    <li><a href="#">Cards</a></li>
                    <li><a href="#">Investments & Insurance</a></li>
                    <li><a href="#">Other Services</a></li>
                </ul>
            </section>

            <section>
                <h4>SMALL BUSINESS</h4>
                <ul>
                    <li><a href="#">Deposit Products</a></li>
                    <li><a href="#">Lending Services</a></li>
                    <li><a href="#">Cards</a></li>
                    <li><a href="#">Insurance</a></li>
                    <li><a href="#">Retirement</a></li>
                    <li><a href="#">Other Services</a></li>
                </ul>
            </section>

            <section>
                <h4>INSIDE ALTORO MUTUAL</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Locations</a></li>
                    <li><a href="#">Investor Relations</a></li>
                    <li><a href="#">Press Room</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Subscribe</a></li>
                </ul>
            </section>
        </aside>

        <!-- Main Content -->
        <section class="content">
            <h2>Online Banking Login</h2>
            <?php if (!empty($message)): ?>
    <p class="message"><?php echo $message; ?></p>
<?php endif; ?>

<?php if ($userData): ?>
    <section class="user-info">
        <h3>Client Information</h3>
        <p><strong>Client ID:</strong> <?php echo $userData['client_id']; ?></p>
        <p><strong>Username:</strong> <?php echo $userData['username']; ?></p>
        <p><strong>Full Name:</strong> <?php echo $userData['full_name']; ?></p>
        <p><strong>Account Number:</strong> <?php echo $userData['account_number']; ?></p>
        <p><strong>Email:</strong> <?php echo $userData['email']; ?></p>
    </section>
<?php endif; ?> 

<?php if (!empty($allUsers)): ?>
    <section class="all-users">
        <h3>All Client Records</h3>
<!-- XSS Simulation: clicking this link triggers a JavaScript alert -->
        <?php foreach ($allUsers as $user): ?>
            <article class="user-card">
                <p><strong>Client ID:</strong> <?php echo $user['client_id']; ?></p>
                <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
                <p><strong>Full Name:</strong> <?php echo $user['full_name']; ?></p>
                <p><strong>Account Number:</strong> <?php echo $user['account_number']; ?></p>
                <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            </article>
        <?php endforeach; ?>
    </section>
<?php endif; ?>

            <form action="" method="POST">
                <div class="form-row">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-row">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-row">
                    <button type="submit" name="login">Login</button>
                </div>
            </form>
            <p>
    <a href="#" onclick="showXSS()">Click here for account help</a>
</p>

<script>
function showXSS() {
    alert('XSS Attack Executed!');
}
</script>
        </section>

    </main>

    <!-- Footer -->
    <footer class="footer">
        <nav>
            <a href="#">Privacy Policy</a> |
            <a href="#">Security Statement</a> |
            <a href="#">Server Status Check</a> |
            <a href="#">REST API</a>
        </nav>
        <p>© 2026 Altoro Mutual, Inc.</p>
    </footer>

    <!-- Disclaimer -->
    <section class="disclaimer">
        <p>
            This website is for educational purposes only to demonstrate web application vulnerabilities.
            This is not a real banking site.
        </p>
    </section>

    <script src="script.js"></script>
</body>
</html>