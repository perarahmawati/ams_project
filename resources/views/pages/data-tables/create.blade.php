<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create New Data</h1>
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <form method="post" action="{{ route('pages.data-tables.store') }}" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div>
            <label for="item_name">Item</label>
            <select name="item_name" id="item_name">
                <option selected disabled>Select Item</option>
                @foreach ($item_names as $option)
                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="manufacture_name">Manufacture</label>
            <select name="manufacture_name" id="manufacture_name">
                <option selected disabled>Select Manufacture</option>
                @foreach ($manufacture_names as $option)
                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="serial_number">Serial Number</label>
            <input type="text" name="serial_number" placeholder="Serial Number"></input>
        </div>
        <div>
            <label for="configurationstatus_name">Configuration Status</label>
            <select name="configurationstatus_name" id="configurationstatus_name">
                <option selected disabled>Select Configuration Status</option>
                @foreach ($configurationstatus_names as $option)
                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="location_name">Location</label>
            <select name="location_name" id="location_name">
                <option selected disabled>Select Location</option>
                @foreach ($location_names as $option)
                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea type="text" name="description" placeholder="Description"></textarea>
        </div>
        <div>
            <label for="image">Upload Images</label>
            <input type="file" name="images[]" accept="image/*" multiple>
        </div>
        <div>
            <label for="file">Upload Files</label>
            <input type="file" name="files[]" accept="application/pdf,application/msword,application/vnd.ms-excel,application/vnd.ms-powerpoint" multiple>
        </div>
        <div>
            <input type="submit" value="Save" />
        </div>
    </form>
</body>
</html>