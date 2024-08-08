    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //export
            const exportButton = document.getElementById('exportButton');
            const exportPdfButton = document.getElementById('exportPdfButton');
            const exportFormExcel = document.getElementById('exportFormExcel');
            const exportData = document.getElementById('exportData');

            function exportDataAndSubmit(action) {
                const tableBody = document.querySelector('#patentsListExport table tbody');
                const rows = tableBody.querySelectorAll('tr');
                const data = [];

                rows.forEach(row => {
                    const rowData = {
                        district_name: row.querySelector('td:nth-child(2)').innerText.trim(),
                        commune_name: row.querySelector('td:nth-child(3)').innerText.trim(),
                        type_name: row.querySelector('td:nth-child(4)').innerText.trim(),

                        title: row.querySelector('td:nth-child(5)').innerText.trim(),
                        ipc_classes: row.querySelector('td:nth-child(6)').innerText.trim(),
                        applicant: row.querySelector('td:nth-child(7)').innerText.trim(),
                        applicant_address: row.querySelector('td:nth-child(8)').innerText.trim(),
                        inventor: row.querySelector('td:nth-child(9)').innerText.trim(),
                        inventor_address: row.querySelector('td:nth-child(10)').innerText.trim(),
                        other_inventor: row.querySelector('td:nth-child(11)').innerText.trim(),
                        abstract: row.querySelector('td:nth-child(12)').innerText.trim(),

                        application_type: row.querySelector('td:nth-child(13)').innerText.trim(),
                        filing_number: row.querySelector('td:nth-child(14)').innerText.trim(),
                        filing_date: row.querySelector('td:nth-child(15)').innerText.trim(),

                        publication_number: row.querySelector('td:nth-child(16)').innerText.trim(),
                        publication_date: row.querySelector('td:nth-child(17)').innerText.trim(),

                        registration_number: row.querySelector('td:nth-child(18)').innerText.trim(),
                        registration_date: row.querySelector('td:nth-child(19)').innerText.trim(),
                        expiration_date: row.querySelector('td:nth-child(20)').innerText.trim(),
                        
                        representative_name: row.querySelector('td:nth-child(21)').innerText.trim(),
                        representative_address: row.querySelector('td:nth-child(22)').innerText.trim(),
                        status: row.querySelector('td:nth-child(23)').innerText.trim()
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
                    exportDataAndSubmit('{{ route('admin.patents.export_excel') }}');
                });

                exportPdfButton.addEventListener('click', function() {
                    exportDataAndSubmit('{{ route('admin.patents.export_pdf') }}');
                });
            }
            //end export

            // Ajax cho 2 bảng
            function sendAjaxRequests() {
                const formData = new FormData(document.getElementById('filterForm'));

                // Fetch paginated data
                fetch("{{ route('admin.patents.ajax_list') }}", {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('patentsList').innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));

                // Fetch export data (non-paginated)
                fetch("{{ route('admin.patents.ajax_export') }}", {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('patentsListExport').innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
            }

            document.querySelectorAll('.input-bordered, #search').forEach(element => {
                element.addEventListener('input', function() {
                    sendAjaxRequests();
                });
            });
            //Phân trang cho ajax dùng GET
            document.getElementById('patentsList').addEventListener('click', function(event) {
                if (event.target.tagName.toLowerCase() === 'a') {
                    event.preventDefault();
                    const url = event.target.href;
                    fetch(url, {
                            method: 'POST',
                            body: new FormData(document.getElementById('filterForm'))
                        })
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('patentsList').innerHTML = data;
                        })
                        .catch(error => console.error('Error:', error));
                }
            });

            sendAjaxRequests();
        });
    </script>
