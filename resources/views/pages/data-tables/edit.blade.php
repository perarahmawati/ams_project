<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Data</h1>
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <form method="post" action="{{ route('pages.data-tables.update', ['data_table' => $data_table]) }}">
        @csrf
        @method('put')
        <div>
            <label for="item_name">Item</label>
            <select name="item_name" id="item_name">
                <option selected disabled>Select Item</option>
                @foreach ($item_names as $option)
                    <option value="{{ $option->id }}" {{ $data_table->item_name == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="manufacture_name">Manufacture</label>
            <select name="manufacture_name" id="manufacture_name">
                <option selected disabled>Select Manufacture</option>
                @foreach ($manufacture_names as $option)
                    <option value="{{ $option->id }}" {{ $data_table->manufacture_name == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="serial_number">Serial Number</label>
            <input type="text" name="serial_number" placeholder="Serial Number" value="{{ $data_table->serial_number }}"></input>
        </div>
        <div>
            <label for="configurationstatus_name">Configuration Status</label>
            <select name="configurationstatus_name" id="configurationstatus_name">
                <option selected disabled>Select Configuration Status</option>
                @foreach ($configurationstatus_names as $option)
                    <option value="{{ $option->id }}" {{ $data_table->configurationstatus_name == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="location_name">Location</label>
            <select name="location_name" id="location_name">
                <option selected disabled>Select Location</option>
                @foreach ($location_names as $option)
                    <option value="{{ $option->id }}" {{ $data_table->location_name == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea type="text" name="description" placeholder="Description">{{ $data_table->description }}</textarea>
        </div>
        <div>
            <input type="submit" value="Update" />
        </div>
    </form>
</body>
</html>