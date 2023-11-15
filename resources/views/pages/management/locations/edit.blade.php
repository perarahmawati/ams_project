<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">

    <!-- Leaflet's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <style>
        #map { height: 400px; }
    </style>
</head>
<body>
    <h1>Edit Location</h1>
    <div>
        @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        <div class="search">
            <input class="search-location" type="text" placeholder="Search Location" oninput="onTyping(this)" />
            <ul>
                <div id="search-result"></div>
            </ul>
        </div>
        <div id="map"></div>
        <form method="post" name="dataTableForm" id="dataTableForm" action="">
            @csrf
            @method('post')
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{$location->name}}" />
                <p></p>
            </div>
            <div>
                <label for="address">Address</label>
                <textarea type="text" name="address" id="address" placeholder="Address" class="form-control">{{ $location->address }}</textarea>
                <p></p>
            </div>
            <div>
                <label for="latitude">Latitude</label>
                <input type="text" name="latitude" id="latitude" placeholder="Latitude" class="form-control" value="{{$location->latitude}}" />
                <p></p>
            </div>
            <div>
                <label for="longitude">Longitude</label>
                <input type="text" name="longitude" id="longitude" placeholder="Longitude" class="form-control" value="{{$location->longitude}}" />
                <p></p>
            </div>
            <div>
                <input type="submit" value="Update" />
            </div>
        </form>
    </div>

    <!-- Leaflet's JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        const initialLatitude = parseFloat(document.getElementById('latitude').value);
        const initialLongitude = parseFloat(document.getElementById('longitude').value);
        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');
        const resultsWrapperHTML = document.getElementById("search-result");
        let marker;

        // Initial Map
        const Map = L.map("map");

        // Initial OSM Tile URL
        const osmTileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        const attrib = 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors';
        const osmTile = new L.tileLayer(osmTileUrl, { minZoom: 2, maxZoom: 20, attribution: attrib });

        // Add Layer
        Map.setView(new L.LatLng(initialLatitude, initialLongitude), 18);
        Map.addLayer(osmTile);

        // Add Marker
        marker = L.marker([initialLatitude, initialLongitude]).addTo(Map);

        // Input Value
        function inputValue() {
            const latitude = parseFloat(latitudeInput.value);
            const longitude = parseFloat(longitudeInput.value);

            if (isNaN(latitude) || isNaN(longitude)) {
                return;
            }

            if (marker) {
                Map.removeLayer(marker);
            }

            marker = L.marker([latitude, longitude]).addTo(Map);
            Map.setView([latitude, longitude], 18);
        }

        latitudeInput.addEventListener('input', inputValue);
        longitudeInput.addEventListener('input', inputValue);

        // Click Listener
        Map.on("click", function(e){
            const {lat, lng} = e.latlng;

            // Regenerate marker position
            if (marker) {
                Map.removeLayer(marker);
            }
            marker = L.marker([lat, lng]).addTo(Map);

            // Update latitude and longitude input values
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        })

        // Search Location Handler
        let typingInterval;

        // Typing Handler
        function onTyping(e) {
            clearInterval(typingInterval);
            const {value} = e;

            typingInterval = setInterval(() => {
                clearInterval(typingInterval);
                searchLocation(value);
            }, 500);
        }

        // Search Handler
        function searchLocation(keyword) {
            if(keyword) {
                // Request To Nominatim API
                fetch(`https://nominatim.openstreetmap.org/search?q=${keyword}&format=json`)
                .then((response) => {
                    return response.json()
                }).then(json => {
                    // Get Response Data From Nominatim
                    if(json.length > 0) return renderResults(json);
                    else {
                        resultsWrapperHTML.innerHTML = "<li>Location not found</li>";
                    }
                });
            }
        }

        // Render Results
        function renderResults(result) {
            let resultsHTML = "";
            
            result.map((n) => {
                let parsedDisplayName = n.display_name.replace(/^[^,]+,\s/, ''); // Menghapus kalimat pertama sebelum koma pertama
                parsedDisplayName = parsedDisplayName.trim(); // Menghilangkan spasi di awal dan akhir

                // Cek apakah di awal terdapat angka
                if (/^\d/.test(parsedDisplayName.split(",")[0])) {
                    parsedDisplayName = parsedDisplayName.replace(/^\d+\,\s/, ''); // Menghapus angka di depan jika ada
                }

                resultsHTML += `<li><a href="#" onclick="setLocation('${n.name}', '${parsedDisplayName}', ${n.lat}, ${n.lon})">${n.display_name}</a></li>`;
            })
            
            resultsWrapperHTML.innerHTML = resultsHTML;
        }

        // Clear Results
        function clearResults() {
            resultsWrapperHTML.innerHTML = "";
        }

        // Set Location From Search Result
        function setLocation(name, address, lat, lon) {
            // Set Map Focus
            Map.setView(new L.LatLng(lat, lon), 18);
            
            // Regenerate Marker Position
            if (marker) {
                Map.removeLayer(marker);
            }
            marker = L.marker([lat, lon]).addTo(Map);

            // Set input values
            document.getElementById('name').value = name;
            document.getElementById('address').value = address;
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lon;
            
            // Clear Results
            clearResults();
        }
    </script>

    <!-- JQuery -->
    <script src="/vendor/jquery/jquery.min.js"></script>

    <script type="text/javascript">
        $("#dataTableForm").submit(function(event){
            event.preventDefault();
            $("input[type=submit]").prop('disabled',true);
            $.ajax({
                url: "{{ route('pages.management.locations.update', $location->id) }}",
                data: $(this).serializeArray(),
                method: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(response){
                    $("input[type=submit]").prop('disabled',false);
                    if(response.status == true) {
                        window.location.href="{{ route('pages.management.locations.index') }}"; 
                    } else {
                        var errors = response.errors;
                        if (errors.name) {
                            $("#name").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.name)
                        } else {
                            $("#name").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("")
                        }

                        if (errors.address) {
                            $("#address").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.address)
                        } else {
                            $("#address").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("")
                        }

                        if (errors.latitude) {
                            $("#latitude").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.latitude)
                        } else {
                            $("#latitude").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("")
                        }

                        if (errors.longitude) {
                            $("#longitude").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.longitude)
                        } else {
                            $("#longitude").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("")
                        }
                    }
                }
            });
        }) ;
    </script>
</body>
</html>