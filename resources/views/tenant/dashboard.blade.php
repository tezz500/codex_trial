<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Dashboard</title>
</head>
<body>
    <h1>Tenant Dashboard</h1>
    <p>Tenant: {{ $tenant->name }} ({{ $tenant->slug }})</p>
    <p>User: {{ $tenantUser->name }} ({{ $tenantUser->email }})</p>

    <form method="POST" action="{{ route('tenant.logout', ['tenant' => $tenant->slug]) }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
