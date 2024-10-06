<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Crosstab in MySQL</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Peserta</th>
                @foreach ($uttpNames as $name)
                    <th>{{ $name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->peserta }}</td>
                    @foreach ($uttpNames as $name)
                        <td>{{ $row->$name ?? 0 }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
