@php
    // Side follows the reading direction: bottom-left for Arabic (RTL),
    // bottom-right for English (LTR). Flip by swapping this one value.
    $side = ($isRtl ?? app()->getLocale() === 'ar') ? 'left' : 'right';
    $openOnLoad = $errors->any() && old('_widget') === '1';
@endphp

<style>
    .msg-fab-wrap { position: fixed; bottom: 20px; {{ $side }}: 20px; z-index: 1050; }
    .msg-fab {
        width: 60px; height: 60px; border-radius: 50%; border: 0;
        background: var(--brand-secondary); color: #fff;
        box-shadow: 0 6px 18px rgba(0,0,0,.25);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem; cursor: pointer; transition: transform .15s;
    }
    .msg-fab:hover { transform: scale(1.06); }
    .msg-panel {
        position: absolute; bottom: 74px; {{ $side }}: 0;
        width: min(340px, calc(100vw - 40px));
        background: #fff; border-radius: 16px;
        box-shadow: 0 12px 40px rgba(0,0,0,.2);
        overflow: hidden;
        display: none;
        transform-origin: bottom {{ $side }};
    }
    .msg-panel.open { display: block; animation: msgPop .18s ease-out; }
    @keyframes msgPop { from { opacity: 0; transform: translateY(12px) scale(.96); } to { opacity: 1; transform: none; } }
    .msg-panel-head { background: var(--brand-primary); color: #fff; padding: .9rem 1rem; }
    .msg-panel-head h6 { margin: 0; font-weight: 700; }
    .msg-panel-body { padding: 1rem; }
    .msg-panel .btn-send { background: var(--brand-secondary); border: 0; color: #fff; font-weight: 600; }
    .msg-hp { position: absolute; left: -9999px; width: 1px; height: 1px; overflow: hidden; }
</style>

<div class="msg-fab-wrap">
    <div class="msg-panel {{ $openOnLoad ? 'open' : '' }}" id="msgPanel">
        <div class="msg-panel-head d-flex justify-content-between align-items-center">
            <h6>{{ __('messages.contact_us') }}</h6>
            <button type="button" class="btn-close btn-close-white btn-sm" id="msgClose" aria-label="Close"></button>
        </div>
        <div class="msg-panel-body">
            <form action="{{ route('web.contact.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_widget" value="1">
                {{-- Honeypot: hidden from humans, tempting to bots. --}}
                <div class="msg-hp" aria-hidden="true">
                    <label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                </div>

                <input type="text" name="name" class="form-control form-control-sm mb-2"
                       placeholder="{{ __('messages.contact_name') }}" value="{{ old('name') }}" maxlength="120">

                <input type="text" name="contact" class="form-control form-control-sm mb-2"
                       placeholder="{{ __('messages.contact_reply') }}" value="{{ old('contact') }}" maxlength="150">

                <input type="text" name="title" required maxlength="150"
                       class="form-control form-control-sm mb-2 @error('title') is-invalid @enderror"
                       placeholder="{{ __('messages.contact_title') }}" value="{{ old('title') }}">
                @error('title')<div class="invalid-feedback d-block small mb-2">{{ $message }}</div>@enderror

                <textarea name="body" required rows="4" maxlength="5000"
                          class="form-control form-control-sm mb-2 @error('body') is-invalid @enderror"
                          placeholder="{{ __('messages.contact_message') }}">{{ old('body') }}</textarea>
                @error('body')<div class="invalid-feedback d-block small mb-2">{{ $message }}</div>@enderror

                <button class="btn btn-send w-100"><i class="bi bi-send"></i> {{ __('messages.contact_send') }}</button>
            </form>
        </div>
    </div>

    <button type="button" class="msg-fab" id="msgFab" aria-label="{{ __('messages.contact_us') }}">
        <i class="bi bi-chat-dots-fill"></i>
    </button>
</div>

@if (session('contact_sent'))
    <div class="position-fixed bottom-0 start-50 translate-middle-x mb-3" style="z-index:1080">
        <div class="toast align-items-center text-bg-success border-0 show" role="alert">
            <div class="d-flex">
                <div class="toast-body"><i class="bi bi-check-circle"></i> {{ __('messages.contact_sent') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
@endif

<script>
    (function () {
        var fab = document.getElementById('msgFab');
        var panel = document.getElementById('msgPanel');
        var close = document.getElementById('msgClose');
        if (!fab || !panel) return;
        fab.addEventListener('click', function () { panel.classList.toggle('open'); });
        close.addEventListener('click', function () { panel.classList.remove('open'); });
    })();
</script>
