<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Data Table</h1>
    <div>
        @if(session()->has('success'))
        <div>
            {{ session('success') }}
        </div>
        @endif
    </div>
    <div>
        <div>
            <a href="{{ route('pages.data-tables.create') }}">Add New</a>
        </div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>Manufacture</th>
                <th>Serial Number</th>
                <th>Configuration Status</th>
                <th>Location</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            @foreach($data_tables as $data_table)
            <tr>
                <td>{{ $data_table->id }}</td>
                <td>{{ $data_table->item->name }}</td>
                <td>{{ $data_table->manufacture->name }}</td>
                <td>{{ $data_table->serial_number }}</td>
                <td>{{ $data_table->configurationStatus->name }}</td>
                <td>{{ $data_table->location->name }}</td>
                <td>{{ $data_table->description }}</td>
                <td>
                    <a href="{{ route('pages.data-tables.edit', ['data_table' => $data_table]) }}">Edit</a>
                    <form method="post" action="{{ route('pages.data-tables.destroy', ['data_table' => $data_table]) }}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete" />
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>