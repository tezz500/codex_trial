<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Login</title>
</head>
<body>
    <h1>Landlord Login</h1>

    @if ($errors->any())
        <div>
            <p>{{ $errors->first() }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('landlord.login.submit') }}">
        @csrf
        <div>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>
