<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Location</h1>
    <div>
        @if(session()->has('success'))
        <div>
            {{ session('success') }}
        </div>
        @endif
    </div>
    <div>
        <div>
            <a href="{{ route('pages.management.locations.create') }}">Add New</a>
        </div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Action</th>
            </tr>
            @foreach($locations as $location)
            <tr>
                <td>{{$location->id}}</td>
                <td>{{$location->name}}</td>
                <td>{{$location->latitude}}</td>
                <td>{{$location->longitude}}</td>
                <td>
                    <a href="{{ route('pages.management.locations.edit', ['location' => $location]) }}">Edit</a>
                    <form method="post" action="{{ route('pages.management.locations.destroy', ['location' => $location]) }}">
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