<?php
    include_once __DIR__ . '/config/setting-configuration.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        input[type="email"],
        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
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

<h1>Forgot Password</h1>
<form action="dashboard/admin/authentication/admin-class.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token ?>">
    <input type="text" name="otp" placeholder="Enter OTP" required />
    <input type="password" name="new_password" placeholder="New Password" required />
    <button type="submit" name="btn-reset-password">Reset Password</button>
</form>

<!-- Back Button -->
<div style="text-align: center; margin-top: 15px;">
    <a href="index.php" style="
        display: inline-block;
        padding: 10px 20px;
        background-color: #6c757d;
        color: white;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
    ">Back</a>
</div>

</body>
</html>

