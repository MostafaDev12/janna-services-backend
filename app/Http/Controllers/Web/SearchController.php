<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function __invoke(Request $request): View
    {
        $keyword = trim((string) $request->input('keyword', ''));

        $providers = collect();

        if ($keyword !== '') {
            $kw = '%'.$keyword.'%';
            $providers = ServiceProvider::active()
                ->with('category')
                ->where(fn ($q) => $q->where('name', 'like', $kw)
                    ->orWhere('short_description', 'like', $kw)
                    ->orWhere('description', 'like', $kw)
                    ->orWhere('address', 'like', $kw))
                ->ordered()
                ->paginate(12)
                ->withQueryString();
        }

        return view('web.search', compact('providers', 'keyword'));
    }
}
