<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class QuestionController extends Controller
{
    public function index(): View
    {
        $questions = Question::all();
        return view('admin.faqs.questions.index', compact('questions'));
    }

    public function create(): View
    {
        return view('admin.faqs.questions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name_sender' => 'required|string|max:255',
            'email' => 'required|email',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|integer|in:1,2',
        ]);

        Question::create(array_merge(
            $request->all(),
            ['question_date' => Carbon::now()]
        ));
        return redirect()->route('admin.questions.index');
    }

    public function edit(Question $question): View
    {
        return view('admin.faqs.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question): RedirectResponse
    {
        $request->validate([
            'name_sender' => 'required|string|max:255',
            'email' => 'required|email',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|integer|in:1,2',
        ]);

        $question->update($request->all());
        return redirect()->route('admin.questions.index');
    }

    public function destroy(Question $question): RedirectResponse
    {
        $question->delete();
        return redirect()->route('admin.questions.index');
    }
}
