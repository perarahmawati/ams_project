<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Show Details</h1>
    @foreach ($data_tables as $data_table)
        <div>
            <p>{{ $data_table->item->name }}</p>
            <p>{{ $data_table->manufacture->name }}</p>
            <p>{{ $data_table->serial_number }}</p>
            <p>{{ $data_table->configurationStatus->name }}</p>
            <p>{{ $data_table->location->name }}</p>
            <p>{{ $data_table->description }}</p>
        </div>
    @endforeach
    @foreach ($images as $image)
        <div>
            <img src="/data_images/{{$image->image}}">
        </div>
    @endforeach
    @foreach ($files as $file)
        <div>
            <iframe src="/data_files/{{$file->file}}" width="600" height="800"></iframe>
        </div>
    @endforeach
</body>
</html> -->