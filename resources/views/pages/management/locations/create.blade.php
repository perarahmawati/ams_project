<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create New Location</h1>
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <form method="post" action="{{ route('pages.management.locations.store') }}">
        @csrf
        @method('post')
        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" />
        </div>
        <div>
            <label>Latitude</label>
            <input type="text" name="latitude" placeholder="Latitude" />
        </div>
        <div>
            <label>Longitude</label>
            <input type="text" name="longitude" placeholder="Longitude" />
        </div>
        <div>
            <input type="submit" value="Save" />
        </div>
    </form>
</body>
</html>