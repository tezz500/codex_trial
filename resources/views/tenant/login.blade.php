<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Login</title>
</head>
<body>
    <h1>Tenant Login</h1>
    <p>Tenant: {{ $tenant->name }}</p>

    @if ($errors->any())
        <div>
            <p>{{ $errors->first() }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('tenant.login.submit', ['tenant' => $tenant->slug]) }}">
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
