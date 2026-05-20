<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/// Resolves the request locale from (in order):
///   1. `?lang=` query parameter
///   2. session value (web only — persists across browser navigation)
///   3. `Accept-Language` header (mobile / API clients)
///   4. default `en`
///
/// The resolved locale is applied via `app()->setLocale()` so trans() and
/// `$model->localized('name')` both pick the same language.
class SetLocale
{
    public const SUPPORTED = ['en', 'ar'];
    public const DEFAULT  = 'en';

    public function handle(Request $request, Closure $next)
    {
        $locale = $this->resolve($request);
        app()->setLocale($locale);
        if ($request->hasSession()) {
            $request->session()->put('locale', $locale);
        }
        return $next($request);
    }

    protected function resolve(Request $request): string
    {
        // 1. Explicit query param wins.
        $param = $request->query('lang');
        if (is_string($param) && in_array($param, self::SUPPORTED, true)) {
            return $param;
        }

        // 2. Persisted session value (browser navigation).
        if ($request->hasSession()) {
            $stored = $request->session()->get('locale');
            if (is_string($stored) && in_array($stored, self::SUPPORTED, true)) {
                return $stored;
            }
        }

        // 3. Accept-Language header (mobile app, browser).
        $accept = strtolower((string) $request->header('Accept-Language', ''));
        if ($accept !== '') {
            // Match the FIRST preference: "ar,en;q=0.9" -> "ar"
            $first = trim(explode(',', $accept)[0] ?? '');
            $tag = explode('-', $first)[0] ?? '';
            if (in_array($tag, self::SUPPORTED, true)) {
                return $tag;
            }
        }

        return self::DEFAULT;
    }
}
