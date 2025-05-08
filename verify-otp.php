<?php
   include_once 'config/setting-configuration.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
            background-color:rgb(244, 244, 244);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 400px;
            width: 100%;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        input[type="number"],
        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        @media (max-width: 500px) {
            .container {
                padding: 20px;
            }

            input, button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Enter OTP</h1>
    <form action="dashboard/admin/authentication/admin-class.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token ?>">
        <input type="number" name="otp" placeholder="Enter OTP" required>
        <button type="submit" name="btn-verify">Verify</button>
    </form>
</div>

</body>
</html>
