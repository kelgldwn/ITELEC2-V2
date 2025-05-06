<?php
   include_once 'config/setting-configuration.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>
<body>
    <h1>Enter OTP</h1>
    <form action="dashboard/admin/authentication/admin-class.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token ?>">
        <input type="number" name="otp" placeholder="Enter OTP" required> <br>
        <button type="submit" name="btn-verify">Verify</button>
    </form>
</body>
</html>