<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        // Honeypot: real users never fill the hidden `website` field. Bots do.
        // Pretend success so we don't teach spammers what tripped the filter.
        if ($request->filled('website')) {
            return back()->with('contact_sent', true);
        }

        $data = $request->validate([
            'name'    => ['nullable', 'string', 'max:120'],
            'contact' => ['nullable', 'string', 'max:150'],
            'title'   => ['required', 'string', 'max:150'],
            'body'    => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::create($data);

        return back()->with('contact_sent', true);
    }
}
