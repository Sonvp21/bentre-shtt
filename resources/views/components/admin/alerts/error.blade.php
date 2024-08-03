<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition:leave="transition ease-out duration-1000"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    @if (session('error'))
        <div class="alert alert-error shadow-lg w-fit absolute top-40 ml-[20%] h-8 content-center">
            <strong>Đã có lỗi xảy ra!</strong> {{ session('error') }}
        </div>
    @endif
</div>
