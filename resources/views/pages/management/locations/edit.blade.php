<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Location</h1>
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <form method="post" action="{{ route('pages.management.locations.update', ['location' => $location]) }}">
        @csrf
        @method('put')
        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" value="{{$location->name}}" />
        </div>
        <div>
            <label>Latitude</label>
            <input type="text" name="latitude" placeholder="Latitude" value="{{$location->latitude}}" />
        </div>
        <div>
            <label>Longitude</label>
            <input type="text" name="longitude" placeholder="Longitude" value="{{$location->longitude}}" />
        </div>
        <div>
            <input type="submit" value="Update" />
        </div>
    </form>
</body>
</html>