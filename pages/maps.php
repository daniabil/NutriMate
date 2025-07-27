<!DOCTYPE html>
<html>
  <head>
    <title>Jogging Tracker Sederhana</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />
    <style>
      #map {
        height: 70vh;
      }
      body {
        font-family: sans-serif;
        margin: 0;
        padding: 0;
      }
      #controls {
        padding: 10px;
        background: #f0f0f0;
      }
      select,
      button {
        margin: 5px;
      }
    </style>
  </head>
  <body>
    <div id="controls">
      <label>Jenis Aktivitas:</label>
      <select id="activity">
        <option value="jalan">Jalan</option>
        <option value="lari">Lari</option>
        <option value="bersepeda">Bersepeda</option>
      </select>
      <button id="start">Mulai</button>
      <button id="stop" disabled>Stop</button>
      <br />
      <strong>Jarak:</strong> <span id="distance">0</span> meter |
      <strong>Durasi:</strong> <span id="duration">0</span> detik |
      <strong>Kalori:</strong> <span id="calories">0</span> kkal
    </div>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
      let map = L.map("map").setView([0, 0], 15);
      let route = [];
      let polyline = L.polyline([], { color: "blue" }).addTo(map);
      let totalDistance = 0;
      let watchId = null;
      let startTime, endTime;

      const MET = {
        jalan: 3.5,
        lari: 7.0,
        bersepeda: 6.0,
      };

      const beratBadan = 70; // Misal user 70 kg

      // Tile layer
      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "© OpenStreetMap",
      }).addTo(map);

      function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371000;
        const toRad = (deg) => deg * (Math.PI / 180);
        const dLat = toRad(lat2 - lat1);
        const dLon = toRad(lon2 - lon1);
        const a =
          Math.sin(dLat / 2) ** 2 +
          Math.cos(toRad(lat1)) *
            Math.cos(toRad(lat2)) *
            Math.sin(dLon / 2) ** 2;
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
      }

      document.getElementById("start").onclick = function () {
        route = [];
        totalDistance = 0;
        document.getElementById("distance").innerText = 0;
        document.getElementById("duration").innerText = 0;
        document.getElementById("calories").innerText = 0;

        startTime = new Date();
        document.getElementById("start").disabled = true;
        document.getElementById("stop").disabled = false;

        if ("geolocation" in navigator) {
          watchId = navigator.geolocation.watchPosition(
            (position) => {
              const lat = position.coords.latitude;
              const lon = position.coords.longitude;
              const newPoint = [lat, lon];
              route.push(newPoint);

              if (route.length > 1) {
                const prev = route[route.length - 2];
                totalDistance += calculateDistance(prev[0], prev[1], lat, lon);
                document.getElementById("distance").innerText =
                  totalDistance.toFixed(1);
              }

              polyline.setLatLngs(route);
              map.setView(newPoint, 16);
              L.circleMarker(newPoint, { radius: 5, color: "red" }).addTo(map);
            },
            (err) => alert("Gagal mendapatkan lokasi: " + err.message),
            { enableHighAccuracy: true }
          );
        } else {
          alert("Geolocation tidak didukung browser ini.");
        }
      };

      document.getElementById("stop").onclick = function () {
        if (watchId) {
          navigator.geolocation.clearWatch(watchId);
        }
        endTime = new Date();
        const durasiDetik = Math.floor((endTime - startTime) / 1000);
        document.getElementById("duration").innerText = durasiDetik;

        const durasiJam = durasiDetik / 3600;
        const aktivitas = document.getElementById("activity").value;
        const metValue = MET[aktivitas];

        const kalori = metValue * beratBadan * durasiJam;
        document.getElementById("calories").innerText = kalori.toFixed(2);

        // Kirim ke backend pakai fetch
        fetch("save_aktivitas.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            jenis_aktivitas: aktivitas,
            durasi: durasiDetik,
            jarak: totalDistance,
            kalori: kalori,
          }),
        })
          .then((response) => response.json())
          .then((data) => {
            alert(data.msg);
          });

        document.getElementById("start").disabled = false;
        document.getElementById("stop").disabled = true;
      };
    </script>
  </body>
</html>
