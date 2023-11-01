<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Show Details</h1>
    <div>
        <p>{{ $data_table->item->name }}</p>
        <p>{{ $data_table->manufacture->name }}</p>
        <p>{{ $data_table->serial_number }}</p>
        <p>{{ $data_table->configurationStatus->name }}</p>
        <p>{{ $data_table->location->name }}</p>
        <p>{{ $data_table->description }}</p>
    </div>
    @foreach($data_tableImages as $image)
        <img src="{{ asset('uploads/data_tables/large/'.$image->name) }}" alt="Image">
        <p>{{ $image->caption }}</p>
    @endforeach
</body>
</html>