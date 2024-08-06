function convertDMSToDecimal(degree, minutes, seconds, direction) {
    var decimal = degree + minutes / 60 + seconds / 3600;
    return (direction === 'S' || direction === 'W') ? decimal * -1 : decimal;
}

document.getElementById('images').addEventListener('change', function(event) {
    var file = event.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = new Image();
            img.src = e.target.result;

            img.onload = function() {
                EXIF.getData(img, function() {
                    var lat = EXIF.getTag(this, "GPSLatitude");
                    var lon = EXIF.getTag(this, "GPSLongitude");
                    var latRef = EXIF.getTag(this, "GPSLatitudeRef");
                    var lonRef = EXIF.getTag(this, "GPSLongitudeRef");

                    if (lat && lon && latRef && lonRef) {
                        var latDecimal = convertDMSToDecimal(lat[0], lat[1], lat[2],
                        latRef);
                        var lonDecimal = convertDMSToDecimal(lon[0], lon[1], lon[2],
                        lonRef);

                        document.getElementById('latitude').value = latDecimal.toFixed(7);
                        document.getElementById('longitude').value = lonDecimal.toFixed(7);

                        // Cập nhật vị trí trên bản đồ
                        var newPosition = {
                            lat: parseFloat(latDecimal.toFixed(7)),
                            lng: parseFloat(lonDecimal.toFixed(7))
                        };
                        marker.setPosition(newPosition);
                        map.setCenter(newPosition);
                    } else {
                        console.error(
                            "Error: Không tìm thấy thông tin vị trí GPS trong hình ảnh");
                    }
                });
            };
        };
        reader.readAsDataURL(file);
    }
});

let map;
let marker;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 17,
        center: {
            lat: 10.243,
            lng: 106.372
        } // Vị trí ban đầu là {10.243, 106.372}
    });

    marker = new google.maps.Marker({
        position: {
            lat: 10.243,
            lng: 106.372
        }, // Vị trí ban đầu là {10.243, 106.372}
        map: map,
        draggable: true
    });

    // Cập nhật tọa độ khi kéo thả biểu tượng
    google.maps.event.addListener(marker, "dragend", function(event) {
        document.getElementById("latitude").value = event.latLng.lat().toFixed(6);
        document.getElementById("longitude").value = event.latLng.lng().toFixed(6);
    });

    // Cập nhật tọa độ khi nhấp vào nút lấy vị trí hiện tại của người dùng
    document.getElementById("getCurrentLocation").addEventListener("click", function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude.toFixed(6);
                const lng = position.coords.longitude.toFixed(6);

                // Cập nhật tọa độ vào các trường
                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lng;

                // Di chuyển marker đến vị trí hiện tại
                var newPosition = {
                    lat: parseFloat(lat),
                    lng: parseFloat(lng)
                };
                marker.setPosition(newPosition);
                map.setCenter(newPosition);
            }, function() {
                alert("Không thể lấy vị trí của bạn.");
            });
        } else {
            alert("Trình duyệt của bạn không hỗ trợ Geolocation.");
        }
    });
}