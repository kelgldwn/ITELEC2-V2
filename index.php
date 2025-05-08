<?php
    include_once __DIR__ . '/config/setting-configuration.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITELEC-ACTIVITY</title>
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

h1 {                              /* <‑‑ updated */
    text-align: center;
    margin-bottom: 10px;
    color: #ffffff;               /* white headings */
}

form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

form:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
}

input[type="text"],
input[type="email"],
input[type="password"],
button {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

input[type="text"]:hover,
input[type="email"]:hover,
input[type="password"]:hover {
    border-color: #007BFF;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

button {
    background-color: #007BFF;
    color: white;
    border: none;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

button:hover {
    background-color: #0056b3;
    transform: scale(1.03);
}

p {
    text-align: center;
    margin-top: 10px;
}

a {
    color: #007BFF;
    text


    </style>
    
</head>
<body>

<h1>SIGN IN</h1>
<form action="dashboard/admin/authentication/admin-class.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token ?>">
    <input type="email" name="email" placeholder="Enter Email" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <button type="submit" name="btn-signin">SIGN IN</button>
    <p><a href="forgot-password.php">Forgot Password?</a></p>
</form>

<h1>REGISTRATION</h1>
<form action="dashboard/admin/authentication/admin-class.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token ?>"/>
    <input type="text" name="username" placeholder="Enter Username" required>
    <input type="email" name="email" placeholder="Enter Email" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <button type="submit" name="btn-signup">SIGN UP</button>
</form>

</body>
</html>
