<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Dashboard</title>
</head>
<body>
    <h1>Landlord Dashboard</h1>
    <p>Welcome, {{ $landlord->name }} ({{ $landlord->email }}).</p>

    <form method="POST" action="{{ route('landlord.logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
