<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Tugas Final SIG | Kelompok 3</title>
  <!-- Tambahkan pustaka Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <style>
    #map {
      height: 615px;
    }
  </style>
</head>

<body>
  <div id="map"></div>

  <script>
    // Buat peta menggunakan Leaflet
    var mymap = L.map('map').setView([-6.1150257, 120.4598026], 12);

    // Tambahkan layer peta dasar
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(mymap);

    // Muat dan tambahkan GeoJSON ke peta
    fetch('lokasi.geojson')
      .then(response => response.json())
      .then(data => {
        var studioLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            if (feature.properties) {
              layer.bindPopup('<b>' + feature.properties.nama + '</b><br>' + 'Koordinat: ' + feature.properties.titik + '<br>' + 'Alamat: ' + feature.properties.alamat + '<br>' + '<img src="' + feature.properties.gambar_url + '" style="width:305px; margin-top:5px">');

              layer.on('click', function(e) {
                mymap.setView(e.latlng, 16);
              });
            }
          }
        }).addTo(mymap);
      });
  </script>
</body>

</html>