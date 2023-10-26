<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Leaflet's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <style>
        #map { height: 400px; }
    </style>

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
    <div class="search">
        <input class="search-location" type="text" placeholder="Search Location" oninput="onTyping(this)" />
        <ul>
            <div id="search-result"></div>
        </ul>
    </div>
    <div id="map"></div>
    <form method="post" action="{{ route('pages.management.locations.store') }}">
        @csrf
        @method('post')
        <div>
            <label>Name</label>
            <input type="text" name="name" id="name" placeholder="Name" />
        </div>
        <div>
            <label>Address</label>
            <textarea type="text" name="address" id="address" placeholder="Address"></textarea>
        </div>
        <div>
            <label>Latitude</label>
            <input type="text" name="latitude" id="latitude" placeholder="Latitude" />
        </div>
        <div>
            <label>Longitude</label>
            <input type="text" name="longitude" id="longitude" placeholder="Longitude" />
        </div>
        <div>
            <input type="submit" value="Save" />
        </div>
    </form>

    <!-- Leaflet's JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        const DEFAULT_COORD = [-6.1754067410036955, 106.82716950774196];
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
        Map.setView(new L.LatLng(DEFAULT_COORD[0], DEFAULT_COORD[1]), 15);
        Map.addLayer(osmTile);

        // Add Marker
        marker = L.marker(DEFAULT_COORD).addTo(Map);

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
                    return response.json();
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
</body>
</html>