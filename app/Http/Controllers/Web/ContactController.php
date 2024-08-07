<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('web.contacts.index', [
            'contacts' => Contact::query()
                ->orderByDesc('updated_at')
                ->paginate(6),
        ]);
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        Contact::create($request->all());

        return back()->with('success', trans('web.alerts.success.contact'));
    }
}
