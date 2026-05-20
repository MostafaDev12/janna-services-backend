@php
    $brandSettings  = \App\Models\AppSetting::current();
    $brandPrimary   = $brandSettings->primary_color   ?: '#0F4C45';
    $brandSecondary = $brandSettings->secondary_color ?: '#F2A11F';
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') | {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --brand-primary:   {{ $brandPrimary }};
            --brand-secondary: {{ $brandSecondary }};
            --brand-primary-dark: color-mix(in srgb, {{ $brandPrimary }} 80%, black);
            --brand-primary-soft: {{ $brandPrimary }}1a;
            --bs-primary: var(--brand-primary);
            --bs-primary-rgb: {{ implode(',', sscanf($brandPrimary, '#%02x%02x%02x')) }};
            --bs-link-color: var(--brand-primary);
            --bs-link-hover-color: var(--brand-primary-dark);
        }
        body { background: #f5f6fa; }
        .sidebar { min-height: 100vh; background: var(--brand-primary); color: rgba(255,255,255,.78); }
        .sidebar a { color: rgba(255,255,255,.82); text-decoration: none; display: block; padding: .55rem 1rem; border-radius: .375rem; }
        .sidebar a:hover, .sidebar a.active { background: var(--brand-primary-dark); color: #fff; }
        .sidebar .brand { color: #fff; font-weight: 700; padding: 1rem; font-size: 1.1rem; border-bottom: 1px solid rgba(255,255,255,.15); }
        .topbar { background: #fff; border-bottom: 1px solid #e5e7eb; }
        .card-stat { border: 0; box-shadow: 0 1px 3px rgba(0,0,0,.05); }
        .card-stat .num { font-size: 1.6rem; font-weight: 700; color: var(--brand-primary); }
        .img-preview { max-height: 120px; border-radius: .375rem; object-fit: cover; }
        .table thead th { font-size: .8rem; text-transform: uppercase; letter-spacing: .03em; color: #6b7280; }
        .form-label { font-weight: 600; font-size: .9rem; }
        .btn-primary {
            --bs-btn-bg: var(--brand-primary);
            --bs-btn-border-color: var(--brand-primary);
            --bs-btn-hover-bg: var(--brand-primary-dark);
            --bs-btn-hover-border-color: var(--brand-primary-dark);
            --bs-btn-active-bg: var(--brand-primary-dark);
            --bs-btn-active-border-color: var(--brand-primary-dark);
        }
        .btn-outline-primary {
            --bs-btn-color: var(--brand-primary);
            --bs-btn-border-color: var(--brand-primary);
            --bs-btn-hover-bg: var(--brand-primary);
            --bs-btn-hover-border-color: var(--brand-primary);
        }
        .bi-star-fill.text-warning { color: var(--brand-secondary) !important; }
        .form-control:focus, .form-select:focus { border-color: var(--brand-primary); box-shadow: 0 0 0 .2rem var(--brand-primary-soft); }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <aside class="col-md-3 col-lg-2 sidebar p-0">
            @include('admin.partials.sidebar')
        </aside>
        <main class="col-md-9 col-lg-10 p-0">
            @include('admin.partials.navbar')
            <div class="p-4">
                @include('admin.partials.flash')
                @yield('content')
            </div>
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
