    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //export
            const exportButton = document.getElementById('exportButton');
            const exportPdfButton = document.getElementById('exportPdfButton');
            const exportFormExcel = document.getElementById('exportFormExcel');
            const exportData = document.getElementById('exportData');

            function exportDataAndSubmit(action) {
                const tableBody = document.querySelector('#industrial_designsListExport table tbody');
                const rows = tableBody.querySelectorAll('tr');
                const data = [];

                rows.forEach(row => {
                    const rowData = {
                        district_name: row.querySelector('td:nth-child(2)').innerText.trim(),
                        commune_name: row.querySelector('td:nth-child(3)').innerText.trim(),
                        type_name: row.querySelector('td:nth-child(4)').innerText.trim(),
                        name: row.querySelector('td:nth-child(5)').innerText.trim(),
                        description: row.querySelector('td:nth-child(6)').innerText.trim(),
                        owner: row.querySelector('td:nth-child(7)').innerText.trim(),
                        address: row.querySelector('td:nth-child(8)').innerText.trim(),

                        application_number: row.querySelector('td:nth-child(9)').innerText.trim(),
                        submission_date: row.querySelector('td:nth-child(10)').innerText.trim(),
                        submission_status_text: row.querySelector('td:nth-child(11)').innerText.trim(),

                        publication_date: row.querySelector('td:nth-child(12)').innerText.trim(),
                        publication_number: row.querySelector('td:nth-child(13)').innerText.trim(),

                        design_date: row.querySelector('td:nth-child(14)').innerText.trim(),
                        design_out_of_date: row.querySelector('td:nth-child(15)').innerText.trim(),
                        design_status_text: row.querySelector('td:nth-child(16)').innerText.trim(),
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
                    exportDataAndSubmit('{{ route('admin.industrial_designs.export_excel') }}');
                });

                exportPdfButton.addEventListener('click', function() {
                    exportDataAndSubmit('{{ route('admin.industrial_designs.export_pdf') }}');
                });
            }
            //end export

            // Ajax cho 2 bảng
            function sendAjaxRequests() {
                const formData = new FormData(document.getElementById('filterForm'));

                // Fetch paginated data
                fetch("{{ route('admin.industrial_designs.ajax_list') }}", {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('industrial_designsList').innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));

                // Fetch export data (non-paginated)
                fetch("{{ route('admin.industrial_designs.ajax_export') }}", {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('industrial_designsListExport').innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
            }

            document.querySelectorAll('.input-bordered, #search').forEach(element => {
                element.addEventListener('input', function() {
                    sendAjaxRequests();
                });
            });
            //Phân trang cho ajax dùng GET
            document.getElementById('industrial_designsList').addEventListener('click', function(event) {
                if (event.target.tagName.toLowerCase() === 'a') {
                    event.preventDefault();
                    const url = event.target.href;
                    fetch(url, {
                            method: 'POST',
                            body: new FormData(document.getElementById('filterForm'))
                        })
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('industrial_designsList').innerHTML = data;
                        })
                        .catch(error => console.error('Error:', error));
                }
            });

            sendAjaxRequests();
        });
    </script>
