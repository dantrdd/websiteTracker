<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Clients</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 20px; }
        table { width: 60%; margin: 20px auto; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 20px; }
        button { cursor: pointer; padding: 5px 10px; }
    </style>
</head>
<body>
<h2>Manage Clients</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<!-- Add New Client Form -->
<form method="POST" action="{{ route('clients.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Client Name (Optional)">
    <input type="url" name="origin_url" placeholder="Enter client domain" required>
    <button type="submit">Add Client</button>
</form>

<!-- Clients Table -->
<table>
    <tr>
        <th>Client Name</th>
        <th>Client Origin</th>
        <th>Action</th>
    </tr>
    @foreach ($clients as $client)
        <tr>
            <td>{{ $client->name ?? 'N/A' }}</td>
            <td>{{ $client->origin_url }}</td>
            <td>
                <form method="POST" action="{{ route('clients.destroy', $client->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="color: red;">Remove</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

</body>
</html>
