<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = trim((string) $request->input('keyword', ''));

        if ($keyword === '') {
            return ProviderResource::collection(collect());
        }

        $kw = '%'.$keyword.'%';

        $providers = ServiceProvider::active()
            ->with('category')
            ->where(fn ($q) => $q->where('name', 'like', $kw)
                ->orWhere('short_description', 'like', $kw)
                ->orWhere('description', 'like', $kw)
                ->orWhere('address', 'like', $kw))
            ->ordered()
            ->paginate(15);

        return ProviderResource::collection($providers);
    }
}
