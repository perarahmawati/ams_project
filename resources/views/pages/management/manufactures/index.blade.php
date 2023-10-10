<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Manufacture</h1>
    <div>
        @if(session()->has('success'))
        <div>
            {{ session('success') }}
        </div>
        @endif
    </div>
    <div>
        <div>
            <a href="{{ route('pages.management.manufactures.create') }}">Add New</a>
        </div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            @foreach($manufactures as $manufacture)
            <tr>
                <td>{{$manufacture->id}}</td>
                <td>{{$manufacture->name}}</td>
                <td>
                    <a href="{{ route('pages.management.manufactures.edit', ['manufacture' => $manufacture]) }}">Edit</a>
                    <form method="post" action="{{ route('pages.management.manufactures.destroy', ['manufacture' => $manufacture]) }}">
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