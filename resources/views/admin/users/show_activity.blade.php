<x-admin-layout>
    <style>
        header {
            display: none !important;
        }

        .user-activity-header {
            display: none !important;
        }

        .content {
            margin-top: 0px !important;
        }

        .badge.warning.edit_badge.ng-binding.ng-scope {
            width: auto;
        }

        .popup {
            left: 20% !important;
        }
    </style>
    <div class="flex-grow w-full">
        <div class="overflow-hidden text-sm bg-white shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                @include('LaravelUserActivity::index')
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const changeTextContent = () => {
                // Thay đổi nội dung của thẻ <option>
                document.querySelectorAll('option').forEach(cell => {
                    switch (cell.textContent.trim()) {
                        case 'advisory_supports':
                            cell.textContent = 'Thông tin hỗ trợ, tư vấn';
                            break;
                        case 'answers':
                            cell.textContent = 'Câu trả lời';
                            break;
                        case 'cache':
                            cell.textContent = 'Bộ nhớ đệm';
                            break;
                        case 'cache_locks':
                            cell.textContent = 'Khóa bộ nhớ đệm';
                            break;
                        case 'communes':
                            cell.textContent = 'Xã';
                            break;
                        case 'districts':
                            cell.textContent = 'Quận/Huyện';
                            break;
                        case 'documents':
                            cell.textContent = 'Tài liệu';
                            break;
                        case 'geographical_indications':
                            cell.textContent = 'Chỉ dẫn địa lý';
                            break;
                        case 'geography_columns':
                            cell.textContent = 'Cột địa lý';
                            break;
                        case 'geometry_columns':
                            cell.textContent = 'Cột hình học';
                            break;
                        case 'images':
                            cell.textContent = 'Hình ảnh';
                            break;
                        case 'industrial_design_types':
                            cell.textContent = 'Nhóm ngành - kiểu dáng công nghiệp';
                            break;
                        case 'industrial_designs':
                            cell.textContent = 'Kiểu dáng công nghiệp';
                            break;
                        case 'infringements':
                            cell.textContent = 'Vi phạm';
                            break;
                        case 'initiative_dossiers':
                            cell.textContent = 'Hồ sơ sáng kiến';
                            break;
                        case 'initiative_evaluates':
                            cell.textContent = 'Đánh giá sáng kiến';
                            break;
                        case 'initiatives':
                            cell.textContent = 'Danh sách sáng kiến';
                            break;
                        case 'patent_types':
                            cell.textContent = 'Lĩnh vực - sáng chế';
                            break;
                        case 'patents':
                            cell.textContent = 'Sáng chế';
                            break;
                        case 'permissions':
                            cell.textContent = 'Quyền hạn';
                            break;
                        case 'products':
                            cell.textContent = 'Sản phẩm';
                            break;
                        case 'questions':
                            cell.textContent = 'Câu hỏi';
                            break;
                        case 'roles':
                            cell.textContent = 'Vai trò';
                            break;
                        case 'science_innovations':
                            cell.textContent = 'Khoa học công nghệ và đổi mới sáng tạo';
                            break;
                        case 'technical_innovation_committees':
                            cell.textContent = 'Sáng tạo kỹ thuật';
                            break;
                        case 'technical_innovation_dossiers':
                            cell.textContent = 'Hồ sơ sáng tạo kỹ thuật';
                            break;
                        case 'technical_innovation_results':
                            cell.textContent = 'Kết quả sáng tạo kỹ thuật';
                            break;
                        case 'trademark_types':
                            cell.textContent = 'Nhóm ngành nhãn hiệu';
                            break;
                        case 'trademarks':
                            cell.textContent = 'Nhãn hiệu';
                            break;
                        case 'users':
                            cell.textContent = 'Người dùng';
                            break;
                        case 'create':
                            cell.textContent = 'Thêm mới';
                            break;
                        case 'edit':
                            cell.textContent = 'Chỉnh sửa';
                            break;
                        case 'delete':
                            cell.textContent = 'Xóa';
                            break;
                        case 'login':
                            cell.textContent = 'Đăng nhập';
                            break;
                    }
                });
                document.querySelectorAll('td').forEach(cell => {
                    switch (cell.textContent.trim()) {
                        case 'advisory_supports':
                            cell.textContent = 'Thông tin hỗ trợ, tư vấn';
                            break;
                        case 'answers':
                            cell.textContent = 'Câu trả lời';
                            break;
                        case 'cache':
                            cell.textContent = 'Bộ nhớ đệm';
                            break;
                        case 'cache_locks':
                            cell.textContent = 'Khóa bộ nhớ đệm';
                            break;
                        case 'communes':
                            cell.textContent = 'Xã';
                            break;
                        case 'districts':
                            cell.textContent = 'Quận/Huyện';
                            break;
                        case 'documents':
                            cell.textContent = 'Tài liệu';
                            break;
                        case 'geographical_indications':
                            cell.textContent = 'Chỉ dẫn địa lý';
                            break;
                        case 'geography_columns':
                            cell.textContent = 'Cột địa lý';
                            break;
                        case 'geometry_columns':
                            cell.textContent = 'Cột hình học';
                            break;
                        case 'images':
                            cell.textContent = 'Hình ảnh';
                            break;
                        case 'industrial_design_types':
                            cell.textContent = 'Nhóm ngành - kiểu dáng công nghiệp';
                            break;
                        case 'industrial_designs':
                            cell.textContent = 'Kiểu dáng công nghiệp';
                            break;
                        case 'infringements':
                            cell.textContent = 'Vi phạm';
                            break;
                        case 'initiative_dossiers':
                            cell.textContent = 'Hồ sơ sáng kiến';
                            break;
                        case 'initiative_evaluates':
                            cell.textContent = 'Đánh giá sáng kiến';
                            break;
                        case 'initiatives':
                            cell.textContent = 'Danh sách sáng kiến';
                            break;
                        case 'patent_types':
                            cell.textContent = 'Lĩnh vực - sáng chế';
                            break;
                        case 'patents':
                            cell.textContent = 'Sáng chế';
                            break;
                        case 'permissions':
                            cell.textContent = 'Quyền hạn';
                            break;
                        case 'products':
                            cell.textContent = 'Sản phẩm';
                            break;
                        case 'questions':
                            cell.textContent = 'Câu hỏi';
                            break;
                        case 'roles':
                            cell.textContent = 'Vai trò';
                            break;
                        case 'science_innovations':
                            cell.textContent = 'Khoa học công nghệ và đổi mới sáng tạo';
                            break;
                        case 'technical_innovation_committees':
                            cell.textContent = 'Sáng tạo kỹ thuật';
                            break;
                        case 'technical_innovation_dossiers':
                            cell.textContent = 'Hồ sơ sáng tạo kỹ thuật';
                            break;
                        case 'technical_innovation_results':
                            cell.textContent = 'Kết quả sáng tạo kỹ thuật';
                            break;
                        case 'trademark_types':
                            cell.textContent = 'Nhóm ngành nhãn hiệu';
                            break;
                        case 'trademarks':
                            cell.textContent = 'Nhãn hiệu';
                            break;
                        case 'users':
                            cell.textContent = 'Người dùng';
                            break;
                        case 'create':
                            cell.textContent = 'Thêm mới';
                            break;
                        case 'edit':
                            cell.textContent = 'Chỉnh sửa';
                            break;
                        case 'delete':
                            cell.textContent = 'Xóa';
                            break;
                        case 'login':
                            cell.textContent = 'Đăng nhập';
                            break;
                    }
                });
                // Thay đổi nội dung của thẻ <span> trong các <td ng-switch="log.log_type">
                document.querySelectorAll('td[ng-switch] span').forEach(cell => {
                    switch (cell.textContent.trim()) {
                        case 'login':
                            cell.textContent = 'Đăng nhập';
                            break;
                        case 'create':
                            cell.textContent = 'Thêm mới';
                            break;
                        case 'edit':
                            cell.textContent = 'Chỉnh sửa';
                            break;
                        case 'delete':
                            cell.textContent = 'Xóa';
                            break;
                        case 'from patents':
                            cell.textContent = ' bằng sáng chế';
                            break;
                        case 'to patents':
                            cell.textContent = ' bằng sáng chế';
                            break;
                        case 'from trademarks':
                            cell.textContent = ' nhãn hiệu';
                            break;
                        case 'to trademarks':
                            cell.textContent = ' nhãn hiệu';
                            break;
                        case 'from trademark_types':
                            cell.textContent = ' nhóm ngành nhãn hiệu';
                            break;
                        case 'to trademark_types':
                            cell.textContent = ' nhóm ngành nhãn hiệu';
                            break;
                        case 'from technical_innovation_results':
                            cell.textContent = ' kết quả sáng tạo kỹ thuật';
                            break;
                        case 'to technical_innovation_results':
                            cell.textContent = ' kết quả sáng tạo kỹ thuật';
                            break;
                        case 'from technical_innovation_dossiers':
                            cell.textContent = ' hồ sơ sáng tạo kỹ thuật';
                            break;
                        case 'to technical_innovation_dossiers':
                            cell.textContent = ' hồ sơ sáng tạo kỹ thuật';
                            break;
                        case 'from technical_innovation_committees':
                            cell.textContent = ' sáng tạo kỹ thuật';
                            break;
                        case 'to technical_innovation_committees':
                            cell.textContent = ' sáng tạo kỹ thuật';
                            break;
                        case 'from science_innovations':
                            cell.textContent = ' khoa học công nghệ và đổi mới sáng tạo';
                            break;
                        case 'to science_innovations':
                            cell.textContent = ' khoa học công nghệ và đổi mới sáng tạo';
                            break;
                        case 'from roles':
                            cell.textContent = ' vai trò';
                            break;
                        case 'to roles':
                            cell.textContent = ' vai trò';
                            break;
                        case 'from questions':
                            cell.textContent = ' câu hỏi';
                            break;
                        case 'to questions':
                            cell.textContent = ' câu hỏi';
                            break;
                        case 'from products':
                            cell.textContent = ' sản phẩm';
                            break;
                        case 'to products':
                            cell.textContent = ' sản phẩm';
                            break;
                        case 'from permissions':
                            cell.textContent = ' quyền hạn';
                            break;
                        case 'to permissions':
                            cell.textContent = ' quyền hạn';
                            break;
                        case 'from patent_types':
                            cell.textContent = ' lĩnh vực sáng chế';
                            break;
                        case 'to patent_types':
                            cell.textContent = ' lĩnh vực sáng chế';
                            break;
                        case 'from initiatives':
                            cell.textContent = ' danh sách sáng kiến';
                            break;
                        case 'to initiatives':
                            cell.textContent = ' danh sách sáng kiến';
                            break;
                        case 'from initiative_evaluates':
                            cell.textContent = ' đánh giá sáng kiến';
                            break;
                        case 'to initiative_evaluates':
                            cell.textContent = ' đánh giá sáng kiến';
                            break;
                        case 'from initiative_dossiers':
                            cell.textContent = ' hồ sơ sáng kiến';
                            break;
                        case 'to initiative_dossiers':
                            cell.textContent = ' hồ sơ sáng kiến';
                            break;
                        case 'from infringements':
                            cell.textContent = ' vi phạm';
                            break;
                        case 'to infringements':
                            cell.textContent = ' vi phạm';
                            break;
                        case 'from industrial_designs':
                            cell.textContent = ' kiểu dáng công nghiệp';
                            break;
                        case 'to industrial_designs':
                            cell.textContent = ' kiểu dáng công nghiệp';
                            break;
                        case 'from industrial_design_types':
                            cell.textContent = ' nhóm ngành - kiểu dáng công nghiệp';
                            break;
                        case 'to industrial_design_types':
                            cell.textContent = ' nhóm ngành - kiểu dáng công nghiệp';
                            break;
                        case 'from images':
                            cell.textContent = ' hình ảnh';
                            break;
                        case 'to images':
                            cell.textContent = ' hình ảnh';
                            break;
                        case 'from geometry_columns':
                            cell.textContent = ' cột hình học';
                            break;
                        case 'to geometry_columns':
                            cell.textContent = ' cột hình học';
                            break;
                        case 'from geography_columns':
                            cell.textContent = ' cột địa lý';
                            break;
                        case 'to geography_columns':
                            cell.textContent = ' cột địa lý';
                            break;
                        case 'from geographical_indications':
                            cell.textContent = ' chỉ dẫn địa lý';
                            break;
                        case 'to geographical_indications':
                            cell.textContent = ' chỉ dẫn địa lý';
                            break;
                        case 'from documents':
                            cell.textContent = ' tài liệu';
                            break;
                        case 'to documents':
                            cell.textContent = ' tài liệu';
                            break;
                        case 'from districts':
                            cell.textContent = ' quận/huyện';
                            break;
                        case 'to districts':
                            cell.textContent = ' quận/huyện';
                            break;
                        case 'from communes':
                            cell.textContent = ' xã';
                            break;
                        case 'to communes':
                            cell.textContent = ' xã';
                            break;
                        case 'from cache_locks':
                            cell.textContent = ' khóa bộ nhớ đệm';
                            break;
                        case 'to cache_locks':
                            cell.textContent = ' khóa bộ nhớ đệm';
                            break;
                        case 'from cache':
                            cell.textContent = ' bộ nhớ đệm';
                            break;
                        case 'to cache':
                            cell.textContent = ' bộ nhớ đệm';
                            break;
                        case 'from answers':
                            cell.textContent = ' câu trả lời';
                            break;
                        case 'to answers':
                            cell.textContent = ' câu trả lời';
                            break;
                        case 'from advisory_supports':
                            cell.textContent = ' thông tin hỗ trợ, tư vấn';
                            break;
                        case 'to advisory_supports':
                            cell.textContent = ' thông tin hỗ trợ, tư vấn';
                            break;
                        case 'emergency':
                            cell.textContent = 'Khẩn cấp';
                            break;
                        case 'warning':
                            cell.textContent = 'Cảnh báo';
                            break;
                        case 'info':
                            cell.textContent = 'Thông tin';
                            break;
                        default:
                            break;
                    }
                });
                document.querySelectorAll('div.top_content_left p.text_light').forEach(p => {
                    const text = p.textContent.trim();
                    // Phân tích cấu trúc chuỗi để dịch
                    const match = text.match(/Showing (\d+) to (\d+) of (\d+) records/);
                    if (match) {
                        const [_, start, end, total] = match;
                        p.textContent = `Hiển thị ${start} đến ${end} của ${total} bản ghi`;
                    }
                });
                document.querySelectorAll('div.filter_item button.btn_filter').forEach(button => {
                    if (button.textContent.trim() === 'FILTER') {
                        button.textContent = 'Lọc';
                    }
                });
                document.querySelectorAll('td.action_column.text_right button.btn_show').forEach(button => {
                    if (button.textContent.trim() === 'SHOW') {
                        button.textContent = 'Xem';
                    }
                    document.querySelectorAll('td').forEach(cell => {
                        if (cell.textContent.trim() === 'DATE') {
                            cell.textContent = 'Thời gian';
                        }
                        if (cell.textContent.trim() === 'LOG TYPE') {
                            cell.textContent = 'Thao tác';
                        }
                        if (cell.textContent.trim() === 'DONE BY') {
                            cell.textContent = 'Thực hiện bởi';
                        }
                        if (cell.textContent.trim() === 'ACTION') {
                            cell.textContent = 'Hành động';
                        }
                    });

                    document.querySelectorAll('label').forEach(cell => {
                        if (cell.textContent.trim() === 'TABLE') {
                            cell.textContent = 'Bảng';
                        }
                        if (cell.textContent.trim() === 'USER') {
                            cell.textContent = 'Tài khoản';
                        }
                        if (cell.textContent.trim() === 'LOG TYPE') {
                            cell.textContent = 'Thao tác';
                        }
                        if (cell.textContent.trim() === 'FROM DATE') {
                            cell.textContent = 'Từ ngày';
                        }
                        if (cell.textContent.trim() === 'TO DATE') {
                            cell.textContent = 'Đến ngày';
                        }
                    });

                });
            };

            // Gọi hàm thay đổi text ban đầu
            changeTextContent();

            // Sử dụng MutationObserver để theo dõi các thay đổi trong DOM
            const observer = new MutationObserver(mutations => {
                mutations.forEach(mutation => {
                    changeTextContent();
                });
            });

            // Bắt đầu quan sát các thay đổi trong toàn bộ tài liệu
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const translatePopup = () => {
                // Dịch tiêu đề của popup
                document.querySelectorAll('div.popup .header .title').forEach(title => {
                    if (title.textContent.trim() === 'Log Preview') {
                        title.textContent = 'Xem trước Nhật ký';
                    }
                });

                // Dịch tiêu đề của các ô trong bảng
                document.querySelectorAll('div.popup table thead td').forEach(td => {
                    switch (td.textContent.trim()) {
                        case 'FIELD':
                            td.textContent = 'TRƯỜNG';
                            break;
                        case 'INFO':
                            td.textContent = 'THÔNG TIN';
                            break;
                        case 'DATA':
                            td.textContent = 'DỮ LIỆU';
                            break;
                        case 'CURRENT':
                            td.textContent = 'HIỆN TẠI';
                            break;
                        default:
                            break;
                    }
                });

                // Dịch các trường trong bảng
                document.querySelectorAll('td.field_cell').forEach(cell => {
                    switch (cell.textContent.trim()) {
                        case 'Type':
                            cell.textContent = 'Thao tác';
                            break;
                        case 'Table':
                            cell.textContent = 'Bảng';
                            break;
                        case 'Time':
                            cell.textContent = 'Thời gian';
                            break;
                        case 'Done by':
                            cell.textContent = 'Thực hiện bởi';
                            break;
                        case 'district_id':
                            cell.textContent = 'ID khu vực';
                            break;
                        case 'commune_id':
                            cell.textContent = 'ID xã';
                            break;
                        case 'user_id':
                            cell.textContent = 'ID người dùng';
                            break;
                        case 'type_id':
                            cell.textContent = 'Nhóm ngành/Lĩnh vực';
                            break;
                        case 'title':
                            cell.textContent = 'Tiêu đề';
                            break;
                        case 'ipc_classes':
                            cell.textContent = 'Lớp IPC';
                            break;
                        case 'applicant':
                            cell.textContent = 'Người nộp đơn';
                            break;
                        case 'applicant_address':
                            cell.textContent = 'Địa chỉ người nộp đơn';
                            break;
                        case 'inventor':
                            cell.textContent = 'Người sáng chế';
                            break;
                        case 'inventor_address':
                            cell.textContent = 'Địa chỉ người sáng chế';
                            break;
                        case 'other_inventor':
                            cell.textContent = 'Người sáng chế khác';
                            break;
                        case 'abstract':
                            cell.textContent = 'Tóm tắt';
                            break;
                        case 'application_type':
                            cell.textContent = 'Loại đơn';
                            break;
                        case 'filing_number':
                            cell.textContent = 'Số đơn';
                            break;
                        case 'filing_date':
                            cell.textContent = 'Ngày nộp';
                            break;
                        case 'publication_number':
                            cell.textContent = 'Số công bố';
                            break;
                        case 'publication_date':
                            cell.textContent = 'Ngày công bố';
                            break;
                        case 'registration_number':
                            cell.textContent = 'Số đăng ký';
                            break;
                        case 'registration_date':
                            cell.textContent = 'Ngày đăng ký';
                            break;
                        case 'expiration_date':
                            cell.textContent = 'Ngày hết hạn';
                            break;
                        case 'representative_name':
                            cell.textContent = 'Tên đại diện';
                            break;
                        case 'representative_address':
                            cell.textContent = 'Địa chỉ đại diện';
                            break;
                        case 'status':
                            cell.textContent = 'Trạng thái';
                            break;
                        case 'updated_at':
                            cell.textContent = 'Cập nhật lúc';
                            break;
                        case 'created_at':
                            cell.textContent = 'Tạo lúc';
                        case 'deleted_at':
                            cell.textContent = 'Xoá lúc';
                            break;
                        case 'id':
                            cell.textContent = 'ID';
                            break;

                        case 'abstract':
                            cell.textContent = 'Tóm tắt';
                            break;
                        case 'application_type':
                            cell.textContent = 'Loại đơn';
                            break;
                        case 'mark':
                            cell.textContent = 'Nhãn hiệu';
                            break;
                        case 'mark_feature':
                            cell.textContent = 'Tính năng nhãn hiệu';
                            break;
                        case 'vienna_classes':
                            cell.textContent = 'Phân loại';
                            break;
                        case 'owner':
                            cell.textContent = 'Chủ sở hữu';
                            break;
                        case 'address':
                            cell.textContent = 'Địa chỉ chủ sở hữu';
                            break;
                        case 'geom':
                            cell.textContent = 'Toạ độ';
                            break;
                        case 'other_owner':
                            cell.textContent = 'Chủ sở hữu khác';
                            break;
                        case 'disclaimer':
                            cell.textContent = 'Yếu tố loại trừ';
                            break;
                        case 'mark_colors':
                            cell.textContent = 'Màu sắc';
                            break;
                        default:
                            break;
                    }
                });

                // Dịch nút đóng
                document.querySelectorAll('div.popup .header .close').forEach(button => {
                    if (button.textContent.trim() === 'x') {
                        button.textContent = 'Đóng';
                    }
                });
            };

            // Theo dõi sự kiện khi popup được mở
            const observer = new MutationObserver(mutations => {
                mutations.forEach(mutation => {
                    if (mutation.type === 'childList') {
                        // Kiểm tra nếu popup đang hiển thị
                        if (document.querySelector('div.popup') && document.querySelector(
                                'div.popup').style.display !== 'none') {
                            translatePopup();
                        }
                    }
                });
            });

            // Bắt đầu quan sát các thay đổi trong toàn bộ tài liệu
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });



            // Định nghĩa bản dịch
            const translations = {
                'Delete data older than 7 days': 'Xóa dữ liệu cũ hơn 7 ngày',
                'DELETE': 'XÓA'
            };

            // Hàm dịch văn bản
            function translateText(element) {
                for (const [key, value] of Object.entries(translations)) {
                    if (element.textContent.trim() === key) {
                        element.textContent = value;
                    }
                }
            }

            // Dịch các phần tử văn bản
            const elementsToTranslate = document.querySelectorAll('.footer_right span, .footer_right button');

            elementsToTranslate.forEach(translateText);

        });
    </script>
</x-admin-layout>
