<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Traffic Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 20px;
        }
        button {
            cursor: pointer;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
<h2>Website Traffic Report</h2>

<!-- Filter Form -->
<form method="GET" action="{{ route('report') }}">
    <label>From: <input type="date" name="from" value="{{ request('from', date('Y-m-d', strtotime('-7 days'))) }}"></label>
    <label>To: <input type="date" name="to" value="{{ request('to', date('Y-m-d')) }}"></label>
    <button type="submit">Filter</button>
</form>

<table>
    <thead>
    <tr>
        <th>Page URL</th>
        <th>Unique Visits</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($visits as $visit)
        <tr>
            <td>{{ $visit->page_url }}</td>
            <td>{{ $visit->unique_visits }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
