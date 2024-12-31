<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 8px; }
    </style>
</head>
<body>
    <h2>Invitation Details</h2>
    <p><strong>Full Name:</strong> {{ $visitor->fullname }}</p>
    <p><strong>Email:</strong> {{ $visitor->email }}</p>
    <p><strong>Occupation:</strong> {{ $visitor->ocuppational }}</p>
    <p><strong>Citizenship:</strong> {{ $visitor->citizenship }}</p>
    <p><strong>Description:</strong> {{ $visitor->description }}</p>
    <h3>Personnel</h3>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Work</th>
                <th>Citizenship</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($personil as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ @$item['work'] }}</td>
                    <td>{{ $item['citizenship'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
