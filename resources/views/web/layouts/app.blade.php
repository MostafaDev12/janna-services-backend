@php
    $isRtl = app()->getLocale() === 'ar';
    $otherLang = $isRtl ? 'en' : 'ar';
    $settings = \App\Models\AppSetting::current();
    $brandName = $settings->localized('app_name') ?: config('app.name');
    $brandTagline = $settings->localized('tagline');

    // Brand palette — Janna defaults match the Flutter `AppColors` and the
    // `app_settings` seeder. Admin-overridden values win.
    $brandPrimary   = $settings->primary_color   ?: '#0F4C45';
    $brandSecondary = $settings->secondary_color ?: '#F2A11F';
@endphp
<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $brandName)</title>
    @if ($settings->icon_url)
        <link rel="icon" href="{{ $settings->icon_url }}">
    @endif
    <meta name="description" content="@yield('meta_description', __('messages.hero_subtitle'))">
    @if ($isRtl)
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --brand-primary:   {{ $brandPrimary }};
            --brand-secondary: {{ $brandSecondary }};
            --brand-primary-soft: {{ $brandPrimary }}1a;   /* ~10% alpha */
            /* Override Bootstrap's primary so every text-primary / btn-primary
               / btn-outline-primary lights up in the brand color automatically. */
            --bs-primary: var(--brand-primary);
            --bs-primary-rgb: {{ implode(',', sscanf($brandPrimary, '#%02x%02x%02x')) }};
            --bs-link-color: var(--brand-primary);
            --bs-link-hover-color: var(--brand-primary);
        }
        body { font-family: {{ $isRtl ? "'Cairo', 'Tajawal'," : '' }} system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; background: #f7f8fa; }
        .navbar-brand { font-weight: 800; letter-spacing: -.02em; color: var(--brand-primary) !important; }
        .navbar .nav-link { color: #1f2937; }
        .navbar .nav-link:hover, .navbar .nav-link.active { color: var(--brand-primary); }
        .hero {
            background: linear-gradient(135deg, var(--brand-primary), color-mix(in srgb, var(--brand-primary) 65%, white));
            color: white;
            padding: 3rem 0 2.5rem;
        }
        .hero h1 { font-size: 2.2rem; font-weight: 800; }
        .hero .lead { font-size: 1.05rem; }
        @media (max-width: 575.98px) {
            .hero { padding: 2rem 0 1.75rem; }
            .hero h1 { font-size: 1.6rem; }
            .hero .lead { font-size: .95rem; }
        }
        .hero .btn-light { color: var(--brand-primary); font-weight: 600; }
        .card-cat { transition: .15s; border: 0; box-shadow: 0 1px 3px rgba(0,0,0,.06); }
        .card-cat:hover { transform: translateY(-3px); box-shadow: 0 6px 18px rgba(0,0,0,.08); }
        .card-cat .card-cat-body { min-width: 0; flex: 1; }
        .card-cat .card-cat-body .name { font-weight: 600; color: #111827; }
        .card-cat .card-cat-body .desc {
            font-size: .8rem; color: #6b7280;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .card-cat .icon-wrap {
            width: 56px; height: 56px; border-radius: 12px;
            background: var(--brand-primary-soft);
            color: var(--brand-primary);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem;
            flex-shrink: 0;
        }
        @media (max-width: 575.98px) {
            .card-cat { padding: .75rem !important; }
            .card-cat .icon-wrap { width: 44px; height: 44px; font-size: 1.25rem; border-radius: 10px; }
            .card-cat .card-cat-body .name { font-size: .9rem; }
            .card-cat .card-cat-body .desc { display: none; }
        }
        .banner-img {
            display: block; width: 100%;
            max-height: 280px; object-fit: cover;
        }
        @media (max-width: 575.98px) {
            .banner-img { max-height: 160px; }
        }
        .h5-mobile { font-size: 1.5rem; }
        @media (max-width: 575.98px) {
            .h5-mobile { font-size: 1.15rem; }
            .navbar-brand img { height: 60px !important; }
            .navbar-brand span { font-size: 1rem; }
            footer { padding: 1.5rem 0; margin-top: 2rem; }
        }
        .card-provider img.cover { height: 160px; width: 100%; object-fit: cover; }
        .card-provider .logo { width: 48px; height: 48px; object-fit: cover; border-radius: 50%; border: 2px solid #fff; margin-top: -32px; box-shadow: 0 1px 4px rgba(0,0,0,.1); background: #fff; }
        .btn-primary {
            --bs-btn-bg: var(--brand-primary);
            --bs-btn-border-color: var(--brand-primary);
            --bs-btn-hover-bg: color-mix(in srgb, var(--brand-primary) 85%, black);
            --bs-btn-hover-border-color: color-mix(in srgb, var(--brand-primary) 85%, black);
            --bs-btn-active-bg: color-mix(in srgb, var(--brand-primary) 75%, black);
            --bs-btn-active-border-color: color-mix(in srgb, var(--brand-primary) 75%, black);
        }
        .btn-outline-primary {
            --bs-btn-color: var(--brand-primary);
            --bs-btn-border-color: var(--brand-primary);
            --bs-btn-hover-bg: var(--brand-primary);
            --bs-btn-hover-border-color: var(--brand-primary);
        }
        footer { background: var(--brand-primary); color: rgba(255,255,255,.85); padding: 2rem 0; margin-top: 3rem; }
        footer a.text-light:hover { color: var(--brand-secondary) !important; }
        .badge-area { background: var(--brand-primary-soft); color: var(--brand-primary); font-weight: 500; }
        .bi-star-fill.text-warning { color: var(--brand-secondary) !important; }
        .number-card { border:0; background:#fff; box-shadow:0 1px 3px rgba(0,0,0,.05); }
        .form-control:focus { border-color: var(--brand-primary); box-shadow: 0 0 0 .2rem var(--brand-primary-soft); }
    </style>
    @if ($isRtl)
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    @endif
    @stack('head')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand text-primary d-flex align-items-center gap-2" href="{{ route('home') }}">
            @if ($settings->logo_url)
                <img src="{{ $settings->logo_url }}" alt="{{ $brandName }}" style="height:121px;width:auto;object-fit:contain;">
            @elseif ($settings->icon_url)
                <img src="{{ $settings->icon_url }}" alt="{{ $brandName }}" style="height:32px;width:32px;object-fit:contain">
            @else
                <i class="bi bi-building"></i>
            @endif
            <span>{{ $brandName }}</span>
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('web.categories.index') }}">{{ __('messages.categories') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('web.providers.index') }}">{{ __('messages.providers') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('web.important-numbers') }}">{{ __('messages.important_numbers') }}</a></li>
            </ul>
            <form class="d-flex me-2" action="{{ route('web.search') }}" method="GET">
                <input class="form-control me-2" name="keyword" value="{{ request('keyword') }}" placeholder="{{ __('messages.search') }}..." type="search">
                <button class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
            </form>
            <a class="btn btn-sm btn-outline-secondary" href="{{ request()->fullUrlWithQuery(['lang' => $otherLang]) }}">
                <i class="bi bi-translate"></i> {{ __('messages.language_switch') }}
            </a>
        </div>
    </div>
</nav>

@yield('content')

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h6 class="text-white d-flex align-items-center gap-2 mb-1">
                    @if ($settings->logo_url)
                        <img src="{{ $settings->logo_url }}" alt="" style="height:24px;width:auto;object-fit:contain;background:#fff;padding:2px;border-radius:4px">
                    @endif
                    {{ $brandName }}
                </h6>
                <p class="small mb-0">{{ $brandTagline ?: __('messages.footer_tagline') }}</p>
            </div>
            <div class="col-md-6 {{ $isRtl ? 'text-md-start' : 'text-md-end' }} small">
                <a href="{{ route('web.important-numbers') }}" class="text-light">{{ __('messages.important_numbers') }}</a>
                &nbsp;·&nbsp;
                <a href="{{ route('web.categories.index') }}" class="text-light">{{ __('messages.categories') }}</a>
                @if ($settings->google_play_url)
                    <div class="mt-3">
                        <a href="{{ $settings->google_play_url }}" target="_blank" rel="noopener"
                           aria-label="{{ __('messages.get_it_on_google_play') }}">
                            <img src="https://play.google.com/intl/{{ $isRtl ? 'ar' : 'en_us' }}/badges/static/images/badges/{{ $isRtl ? 'ar' : 'en' }}_badge_web_generic.png"
                                 alt="{{ __('messages.get_it_on_google_play') }}" style="height:56px;width:auto">
                        </a>
                    </div>
                @elseif ($settings->apk_url)
                    <div class="mt-3">
                        <a href="{{ $settings->apk_url }}" class="btn btn-light btn-sm fw-semibold" download>
                            <i class="bi bi-android2"></i> {{ __('messages.download_apk') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <hr class="text-secondary">
        <div class="small text-center">&copy; {{ date('Y') }} {{ $brandName }}</div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
