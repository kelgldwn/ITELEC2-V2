<?php
    include_once __DIR__ . '/config/setting-configuration.php';

    $token = $_GET['token'] ?? '';
    $email = $_GET['email'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
    padding: 20px;
    margin: 0;
    background-image: url('src/navyblue.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        input[type="password"],
        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #ffc107;
            color: black;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #e0a800;
        }

        @media (max-width: 500px) {
            body {
                padding: 10px;
            }

            form {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<h1>Reset Your Password</h1>
<form action="dashboard/admin/authentication/admin-class.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token ?>">
    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email) ?>">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token) ?>">
    
    <input type="password" name="new_password" placeholder="Enter new password" required>
    <input type="password" name="confirm_password" placeholder="Confirm new password" required>
    <button type="submit" name="btn-reset-password">Reset Password</button>
</form>

</body>
</html>
