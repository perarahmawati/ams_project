<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Position Status</h1>
    <div>
        @if(session()->has('success'))
        <div>
            {{ session('success') }}
        </div>
        @endif
    </div>
    <div>
        <div>
            <a href="{{ route('pages.management.position-statuses.create') }}">Add New</a>
        </div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            @foreach($position_statuses as $position_status)
            <tr>
                <td>{{$position_status->id}}</td>
                <td>{{$position_status->name}}</td>
                <td>
                    <a href="{{ route('pages.management.position-statuses.edit', ['position_status' => $position_status]) }}">Edit</a>
                    <form method="post" action="{{ route('pages.management.position-statuses.destroy', ['position_status' => $position_status]) }}">
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