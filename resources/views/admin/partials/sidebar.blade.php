<div class="brand"><i class="bi bi-building"></i> Janna Admin</div>
<nav class="p-2">
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
        <i class="bi bi-tags"></i> Categories
    </a>
    <a href="{{ route('admin.providers.index') }}" class="{{ request()->routeIs('admin.providers.*') ? 'active' : '' }}">
        <i class="bi bi-shop"></i> Service Providers
    </a>
    <a href="{{ route('admin.important-numbers.index') }}" class="{{ request()->routeIs('admin.important-numbers.*') ? 'active' : '' }}">
        <i class="bi bi-telephone"></i> Important Numbers
    </a>
    <a href="{{ route('admin.banners.index') }}" class="{{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
        <i class="bi bi-image"></i> Banners
    </a>
    <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
        <i class="bi bi-gear"></i> App settings
    </a>
    <hr class="text-secondary">
    <a href="{{ url('/') }}" target="_blank">
        <i class="bi bi-box-arrow-up-right"></i> View Public Site
    </a>
</nav>
