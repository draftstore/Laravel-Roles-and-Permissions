<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Unavailable</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2>Password Reset Unavailable</h2>
        <p>It appears you registered using Gmail authentication, so there is no password associated with your account.</p>
        <p>If you'd like to log in, please use the "Sign in with Google" option on the login page.</p>
        <a href="{{ url('/login') }}" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Go to Login Page</a>
    </div>
</body>
</html>
