<?php
require_once 'authentication/admin-class.php';

$admin = new ADMIN();

if (!$admin->isUserLoggedIn()) {
    header("Location: ../../");
    exit;
}

$stmt = $admin->runQuery("SELECT * FROM user WHERE id = :id");
$stmt->execute(array(":id" => $_SESSION['adminSession']));
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN DASHBOARD</title>
    <style>
        body {
            margin: 0;
    padding: 20px;
    font-family: Arial, sans-serif;
    background-image: url('src/navyblue.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
        }

        .dashboard {
    background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent background */
    backdrop-filter: blur(4px); /* Optional: adds a soft blur behind the content */
    max-width: 400px;
    width: 100%;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    text-align: center;
}

        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 1.5em;
        }

        .logout-button {
            background-color: #dc3545;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        @media (max-width: 500px) {
            .dashboard {
                padding: 20px;
            }

            h1 {
                font-size: 1.3em;
            }
        }
    </style>
</head>
<body>

    <div class="dashboard">
        <h1>WELCOME, <?php echo htmlspecialchars($user_data['email']); ?></h1>
        <a href="authentication/admin-class.php?admin_signout=true" class="logout-button">SIGN OUT</a>
    </div>

</body>
</html>
