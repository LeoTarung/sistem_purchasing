<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="{{ route('password.reset') }}">
        @csrf
        <input type="number" name="nrp" placeholder="Enter your nrp" required>
        <input type="password" name="password" placeholder="Enter new password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm new password" required>
        <button type="submit">Reset Password</button>
    </form>

</body>

</html>
