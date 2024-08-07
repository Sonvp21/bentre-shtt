$(document).ready(function() {
    var isEditMode = $('input[name="_method"]').length > 0; // Check if it's edit mode

    // Load selected district from session storage on page load (only in create mode)
    if (!isEditMode) {
        var selectedDistrict = sessionStorage.getItem('selectedDistrict');
        if (selectedDistrict) {
            $('select[name="district_id"]').val(selectedDistrict);
            fetchCommunes(selectedDistrict); // Fetch communes for the selected district on page load
        }
    }

    // Handle district selection change
    $('select[name="district_id"]').change(function() {
        var selectedDistrict = $(this).val();
        sessionStorage.setItem('selectedDistrict', selectedDistrict);
        sessionStorage.removeItem('selectedCommune'); // Clear selected commune when district changes
        fetchCommunes(selectedDistrict); // Fetch communes when district changes
    });

    // Handle form submission to clear session storage
    $('form').submit(function() {
        sessionStorage.clear(); // Clear all session storage on form submit
    });

    // Handle cancel button to clear session storage
    $('.btn-danger').click(function() {
        sessionStorage.clear(); // Clear all session storage on cancel button click
    });

    // Clear session storage when leaving the page (going back to index)
    window.onunload = function() {
        sessionStorage.clear();
    };

    // Fetch communes function
    function fetchCommunes(districtId) {
        if (typeof getCommunesUrl !== 'undefined') {
            $.ajax({
                url: getCommunesUrl + "/" + districtId,
                method: 'GET',
                success: function(data) {
                    var communeSelect = $('select[name="commune_id"]');
                    communeSelect.empty();

                    communeSelect.append('<option value="">Chọn xã</option>');
                    data.forEach(function(commune) {
                        communeSelect.append('<option value="' + commune.id + '">' + commune.name + '</option>');
                    });

                    // Select the previously selected commune if available
                    var selectedCommune = sessionStorage.getItem('selectedCommune');
                    if (selectedCommune) {
                        communeSelect.val(selectedCommune);
                    }
                },
                error: function(error) {
                    console.log('Lỗi khi lấy danh sách xã:', error);
                }
            });
        } else {
            console.error('Biến getCommunesUrl chưa được định nghĩa');
        }
    }

    // Handle commune selection change to store in session storage
    $('select[name="commune_id"]').change(function() {
        var selectedCommune = $(this).val();
        sessionStorage.setItem('selectedCommune', selectedCommune);
    });
});
