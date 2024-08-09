<div class="drawer-side z-40" style="scroll-behavior: smooth; scroll-padding-top: 5rem;"><label for="drawer"
        class="drawer-overlay" aria-label="Close menu"></label>
    <aside class="bg-base-100 min-h-screen w-80">
        <div data-sveltekit-preload-data
            class="bg-base-100 sticky top-0 z-20 hidden items-center gap-2 bg-opacity-90 px-4 py-2 backdrop-blur lg:flex shadow-md">
            <a href="#" aria-current="page" aria-label="Homepage" class="flex-0 btn btn-ghost px-2">
                <div class="font-title inline-flex text-lg md:text-2xl">Bentre-shtt</div>
            </a>
        </div>
        <div class="h-4"></div>
        <ul class="menu px-4 py-0">
            <li><a href="{{ route('dashboard') }}"
                    class="group font-bold {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fab fa-dashcube"></i>Bảng điều khiển
                </a>
            </li>
            <li></li>
            <li>
                <details
                    {{ Request::routeIs('admin.districts.*') || Request::routeIs('admin.communes.*') ? 'open' : '' }}>
                    <summary class="font-semibold group">
                        <i class="fad fa-map"></i>Hành chính
                    </summary>
                    <ul>
                        <li>
                            <a href="{{ route('admin.districts.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.districts.*') ? 'active' : '' }}">
                                <i class="far fa-map-marked"></i>
                                Huyện
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.communes.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.communes.*') ? 'active' : '' }}">
                                <i class="far fa-map-marked-alt"></i>
                                Xã
                            </a>
                        </li>
                    </ul>
                </details>
            </li>
            <li>
                <details
                    {{ Request::routeIs('admin.patents.*') || Request::routeIs('admin.patent_types.*') ? 'open' : '' }}>
                    <summary class="font-semibold group">
                        <i class="fab fa-creative-commons-remix"></i>Sáng chế toàn văn
                    </summary>
                    <ul>
                        <li>
                            <a href="{{ route('admin.patents.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.patents.*') ? 'active' : '' }}">
                                <i class="fad fa-registered"></i>
                                Danh sách sáng chế
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.patent_types.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.patent_types.*') ? 'active' : '' }}">
                                <i class="fad fa-bookmark"></i>
                                Lĩnh vực
                            </a>
                        </li>
                    </ul>
                </details>
            </li>
            <li>
                <details
                    {{ Request::routeIs('admin.trademarks.*') || Request::routeIs('admin.trademark_types.*') ? 'open' : '' }}>
                    <summary class="font-semibold group">
                        <i class="fad fa-trademark"></i>Bảo hộ nhãn hiệu
                    </summary>
                    <ul>
                        <li>
                            <a href="{{ route('admin.trademarks.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.trademarks.*') ? 'active' : '' }}">
                                <i class="fad fa-registered"></i>
                                Danh sách nhãn hiệu
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.trademark_types.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.trademark_types.*') ? 'active' : '' }}">
                                <i class="fad fa-bookmark"></i>
                                Nhóm ngành
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <li>
                <details
                    {{ Request::routeIs('admin.industrial_designs.*') || Request::routeIs('admin.industrial_design_types.*') ? 'open' : '' }}>
                    <summary class="font-semibold group">
                        <i class="fab fa-wizards-of-the-coast"></i>Kiểu dáng công nghiệp
                    </summary>
                    <ul>
                        <li>
                            <a href="{{ route('admin.industrial_designs.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.industrial_designs.*') ? 'active' : '' }}">
                                <i class="fas fa-stream"></i>
                                Danh sách KDCN
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.industrial_design_types.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.industrial_design_types.*') ? 'active' : '' }}">
                                <i class="fad fa-bookmark"></i>
                                Nhóm ngành
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <li>
                <details
                    {{ Request::routeIs('admin.initiatives.*') || Request::routeIs('admin.initiative_dossiers.*') || Request::routeIs('admin.initiative_evaluates*') ? 'open' : '' }}>
                    <summary class="font-semibold group">
                        <i class="far fa-magic"></i>Sáng kiến
                    </summary>
                    <ul>
                        <li>
                            <a href="{{ route('admin.initiatives.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.initiatives.*') ? 'active' : '' }}">
                                <i class="fas fa-tasks-alt"></i>
                                Danh sách sáng kiến
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.initiative_dossiers.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.initiative_dossiers.*') ? 'active' : '' }}">
                                <i class="fas fa-file-alt"></i>
                                Hồ sơ sáng kiến
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.initiative_evaluates.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.initiative_evaluates.*') ? 'active' : '' }}">
                                <i class="far fa-user-check"></i>
                                Hội đồng thông qua
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <li>
                <details
                    {{ Request::routeIs('admin.technical_innovation_dossiers.*') || Request::routeIs('admin.technical_innovation_committees.*') || Request::routeIs('admin.technical_innovation_results.*') ? 'open' : '' }}>
                    <summary class="font-semibold group">
                        <i class="fad fa-bezier-curve"></i>Sáng tạo kỹ thuật
                    </summary>
                    <ul>
                        <li>
                            <a href="{{ route('admin.technical_innovation_dossiers.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.technical_innovation_dossiers.*') ? 'active' : '' }}">
                                <i class="fas fa-file-alt"></i>
                                Hồ sơ
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.technical_innovation_committees.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.technical_innovation_committees.*') ? 'active' : '' }}">
                                <i class="fas fa-users"></i>
                                Hội đồng
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.technical_innovation_results.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.technical_innovation_results.*') ? 'active' : '' }}">
                                <i class="far fa-user-check"></i>
                                Kết quả
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <li><a {{ Request::routeIs('admin.geographical_indications.*') ? 'open' : '' }}
                    href="{{ route('admin.geographical_indications.index') }}"
                    class="group font-bold {{ Request::routeIs('admin.geographical_indications.*') ? 'active' : '' }}">
                    <i class="fas fa-atlas"></i>Chỉ dẫn địa lý
                </a>
            </li>

            <li><a {{ Request::routeIs('admin.products.*') ? 'open' : '' }} href="{{ route('admin.products.index') }}"
                    class="group font-bold {{ Request::routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fab fa-product-hunt"></i>Sản phẩm đăng ký xây dựng, phát triển thương hiệu
                </a>
            </li>

            <li><a {{ Request::routeIs('image.upload') ? 'open' : '' }} href="{{ route('image.upload') }}"
                    class="group font-bold {{ Request::routeIs('image.upload') ? 'active' : '' }}">
                    <i class="fab fa-product-hunt"></i>search image
                </a>
            </li>

            <li>
                <details {{ Request::routeIs('admin.advisory_supports.*') ? 'open' : '' }}>
                    <summary class="font-semibold group">
                        <i class="fad fa-bezier-curve"></i>Thông tin hỗ trợ, tư vấn
                    </summary>
                    <ul>
                        <li>
                            <a href="{{ route('admin.advisory_supports.categories.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.advisory_supports.categories.*') ? 'active' : '' }}">
                                <i class="fas fa-file-alt"></i>
                                Danh mục
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.advisory_supports.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.advisory_supports.*') && !Request::routeIs('admin.advisory_supports.categories.*') ? 'active' : '' }}">
                                <i class="fas fa-users"></i>
                                Tài liệu hỗ trợ, tư vấn
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <li><a {{ Request::routeIs('admin.infringements.*') ? 'open' : '' }}
                    href="{{ route('admin.infringements.index') }}"
                    class="group font-bold {{ Request::routeIs('admin.infringements.*') ? 'active' : '' }}">
                    <i class="fad fa-exclamation-triangle"></i>Vi phạm
                </a>
            </li>

            <li>
                <details
                    {{ Request::routeIs('admin.questions.*') || Request::routeIs('admin.answers.*') ? 'open' : '' }}>
                    <summary class="group font-bold">
                        <i class="fal fa-file-user"></i>Hỏi đáp
                    </summary>
                    <ul>
                        <li>
                            <a href="{{ route('admin.questions.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.questions.*') ? 'active' : '' }}">
                                <i class="fas fa-users"></i>
                                Danh sách câu hỏi
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.answers.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.answers.*') ? 'active' : '' }}">
                                <i class="far fa-user-lock"></i>
                                Danh sách câu trả lời
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <li>
                <details
                    {{ Request::routeIs('admin.users.*') || Request::routeIs('admin.roles.*') || Request::routeIs('admin.permissions*') ? 'open' : '' }}>
                    <summary class="group font-bold">
                        <i class="fal fa-file-user"></i>Tài khoản
                    </summary>
                    <ul>
                        <li>
                            <a href="{{ route('admin.users.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.users.*') ? 'active' : '' }}">
                                <i class="fas fa-users"></i>
                                Danh sách tài khoản
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.roles.index') }}"
                                class="group font-bold {{ Request::routeIs('admin.roles.*') ? 'active' : '' }}">
                                <i class="fas fa-users"></i>
                                Danh sách vai trò
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.permissions.create') }}"
                                class="group font-bold {{ Request::routeIs('admin.permissions.*') ? 'active' : '' }}">
                                <i class="far fa-user-lock"></i>
                                Thêm quyền
                            </a>
                        </li>
                    </ul>
                </details>
            </li>
            <li></li>
            <li><a target="_blank" href="{{ route('home') }}" class="font-semibold group">
                    <i class="fad fa-home-alt"></i>
                    Trang chủ
                </a>
            </li>

            <li><a href="{{ route('users.activity') }}" class="font-semibold group {{ Request::routeIs('users.activity') ? 'active' : '' }}">
                    <i class="fal fa-journal-whills"></i>
                    Nhật ký hoạt động
                </a>
            </li>
        </ul>
        <div
            class="bg-base-100 pointer-events-none sticky bottom-0 flex h-40 [mask-image:linear-gradient(transparent,#000000)]">
        </div>
    </aside>
</div>
