let map;
let marker;

function initMap() {
    const initialLat =
        parseFloat(document.getElementById("latitude").value) || 10.243;
    const initialLng =
        parseFloat(document.getElementById("longitude").value) || 106.372;
    const initialPosition = {
        lat: initialLat,
        lng: initialLng,
    };

    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 10,
        center: initialPosition,
    });

    marker = new google.maps.Marker({
        position: initialPosition,
        map: map,
        draggable: true,
    });

    google.maps.event.addListener(marker, "dragend", function (event) {
        document.getElementById("latitude").value = event.latLng
            .lat()
            .toFixed(6);
        document.getElementById("longitude").value = event.latLng
            .lng()
            .toFixed(6);
    });
}

document
    .getElementById("getCurrentLocation")
    .addEventListener("click", function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const lat = position.coords.latitude.toFixed(6);
                    const lng = position.coords.longitude.toFixed(6);

                    document.getElementById("latitude").value = lat;
                    document.getElementById("longitude").value = lng;

                    const newPosition = new google.maps.LatLng(lat, lng);
                    marker.setPosition(newPosition);
                    map.setCenter(newPosition);
                },
                function () {
                    alert("Không thể lấy vị trí của bạn.");
                }
            );
        } else {
            alert("Trình duyệt của bạn không hỗ trợ Geolocation.");
        }
    });
