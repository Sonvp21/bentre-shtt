<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        return view('web.faqs.index', [
            'faqs' => Faq::query()
                ->orderByDesc('updated_at')
                ->paginate(6),
        ]);
    }

    public function store(FaqRequest $request): RedirectResponse
    {
        Faq::create($request->all());

        return back()->with('success', trans('web.alerts.success.contact'));
    }
}
