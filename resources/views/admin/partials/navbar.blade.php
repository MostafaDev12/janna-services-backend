<nav class="topbar d-flex justify-content-between align-items-center px-4 py-2">
    <h5 class="m-0 text-muted">@yield('title', 'Admin')</h5>
    <div class="d-flex align-items-center gap-3">
        <span class="text-muted small">{{ auth()->user()?->name }}</span>
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</nav>
