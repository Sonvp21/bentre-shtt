let map;
let marker;

function initMap() {
    const benTre = {
        lat: 10.243,
        lng: 106.372,
    }; // Tọa độ trung tâm của Bến Tre

    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 10,
        center: benTre,
    });

    marker = new google.maps.Marker({
        position: benTre,
        map: map,
        title: "Bến Tre",
        draggable: true, // Cho phép kéo thả biểu tượng
    });

    // Cập nhật tọa độ khi kéo thả biểu tượng
    google.maps.event.addListener(marker, "dragend", function (event) {
        document.getElementById("latitude").value = event.latLng
            .lat()
            .toFixed(6); // Cập nhật giá trị vĩ độ
        document.getElementById("longitude").value = event.latLng
            .lng()
            .toFixed(6); // Cập nhật giá trị kinh độ
    });

    // Cập nhật tọa độ ban đầu vào các trường
    document.getElementById("latitude").value = benTre.lat;
    document.getElementById("longitude").value = benTre.lng;
}

// Xử lý sự kiện nhấp vào nút lấy tọa độ hiện tại của người dùng
document
    .getElementById("getCurrentLocation")
    .addEventListener("click", function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const lat = position.coords.latitude.toFixed(6);
                    const lng = position.coords.longitude.toFixed(6);

                    // Cập nhật tọa độ vào các trường
                    document.getElementById("latitude").value = lat;
                    document.getElementById("longitude").value = lng;

                    // Di chuyển marker đến vị trí hiện tại
                    marker.setPosition(new google.maps.LatLng(lat, lng));
                    map.setCenter(new google.maps.LatLng(lat, lng));
                },
                function () {
                    alert("Không thể lấy vị trí của bạn.");
                }
            );
        } else {
            alert("Trình duyệt của bạn không hỗ trợ Geolocation.");
        }
    });
