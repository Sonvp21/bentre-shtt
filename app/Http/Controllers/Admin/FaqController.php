<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.faqs.index', [
            'faqs' => Faq::query()
                ->when(
                    $request->search,
                    fn ($query) => $query->where('name', 'like', '%'.$request->search.'%')
                )
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.faqs.create');
    }

    public function store(FaqRequest $request, Faq $faq): RedirectResponse
    {
        $faq = Faq::create($request->all());

        return redirect()->route('admin.faqs.index', compact('faq'))->with('success', trans('admin.alerts.success.create'));
    }

    /**
     * @return Factory|View
     */
    public function show(Faq $faq): View
    {
        $faq->timestamps = false;
        $faq->update([
            'read_at' => now()->format('d.m.Y h:i'),
        ]);
        $faq->timestamps = true;

        return view('admin.faqs.show', compact('faq'));
    }

    public function update(Faq $faq, Request $request): RedirectResponse
    {
        $request->validate([
            'answer' => 'required',
        ]);
        // dd($faq);
        $faq->update(['answer' => $request->answer]);

        if (! $faq->answer_at) {
            $faq->update(['answer_at' => now()->format('d.m.Y h:i')]);
        }

        return redirect()->route('admin.faqs.index')->with('success', 'Anwer successfully');
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return back()->with('success', trans('admin.alerts.success.deleted'));
    }
}
