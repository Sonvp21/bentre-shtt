    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //export
            const exportButton = document.getElementById('exportButton');
            const exportPdfButton = document.getElementById('exportPdfButton');
            const exportFormExcel = document.getElementById('exportFormExcel');
            const exportData = document.getElementById('exportData');

            function exportDataAndSubmit(action) {
                const tableBody = document.querySelector('#initiativesListExport table tbody');
                const rows = tableBody.querySelectorAll('tr');
                const data = [];

                rows.forEach(row => {
                    const rowData = {
                        name: row.querySelector('td:nth-child(2)').innerText.trim(),
                        author: row.querySelector('td:nth-child(3)').innerText.trim(),
                        owner: row.querySelector('td:nth-child(4)').innerText.trim(),
                        address: row.querySelector('td:nth-child(5)').innerText.trim(),
                        fields: row.querySelector('td:nth-child(6)').innerText.trim(),
                        recognition_year: row.querySelector('td:nth-child(7)').innerText.trim(),
                        status_text: row.querySelector('td:nth-child(8)').innerText.trim(),
                    };
                    data.push(rowData);
                });

                // Set data value to hidden input
                exportData.value = JSON.stringify(data);
                exportFormExcel.action = action;
                exportFormExcel.submit();
            }

            if (exportButton && exportFormExcel && exportData) {
                exportButton.addEventListener('click', function() {
                    exportDataAndSubmit('{{ route('admin.initiatives.export_excel') }}');
                });

                exportPdfButton.addEventListener('click', function() {
                    exportDataAndSubmit('{{ route('admin.initiatives.export_pdf') }}');
                });
            }
            //end export

            // Ajax cho 2 bảng
            function sendAjaxRequests() {
                const formData = new FormData(document.getElementById('filterForm'));

                // Fetch paginated data
                fetch("{{ route('admin.initiatives.ajax_list') }}", {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('initiativesList').innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));

                // Fetch export data (non-paginated)
                fetch("{{ route('admin.initiatives.ajax_export') }}", {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('initiativesListExport').innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
            }

            document.querySelectorAll('.input-bordered, #search').forEach(element => {
                element.addEventListener('input', function() {
                    sendAjaxRequests();
                });
            });
            //Phân trang cho ajax dùng GET
            document.getElementById('initiativesList').addEventListener('click', function(event) {
                if (event.target.tagName.toLowerCase() === 'a') {
                    event.preventDefault();
                    const url = event.target.href;
                    fetch(url, {
                            method: 'POST',
                            body: new FormData(document.getElementById('filterForm'))
                        })
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('initiativesList').innerHTML = data;
                        })
                        .catch(error => console.error('Error:', error));
                }
            });

            sendAjaxRequests();
        });
    </script>
