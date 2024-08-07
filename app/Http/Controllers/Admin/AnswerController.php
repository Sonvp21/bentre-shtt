<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Answer;
use App\Models\Admin\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class AnswerController extends Controller
{
    public function index(): View
    {
        $answers = Answer::all();
        return view('admin.faqs.answers.index', compact('answers'));
    }

    public function create(): View
    {
        $questions = Question::all();
        return view('admin.faqs.answers.create', compact('questions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'question_id' => 'required',
            'responder' => 'required',
            'answer' => 'required',
            'status' => 'required|integer|in:1,2',
        ]);

        Answer::create([
            'question_id' => $request->question_id,
            'user_id' => auth()->id(),
            'responder' => $request->responder,
            'answer' => $request->answer,
            'answer_date' => Carbon::now(),
            'status' => $request->status
        ]);

        return redirect()->route('admin.answers.index')->with('success', 'Trả lời thành công.');
    }

    public function show(Answer $answer): View
    {
        return view('admin.faqs.answers.show', compact('answer'));
    }

    public function edit(Answer $answer): View
    {
        $questions = Question::all();
        return view('admin.faqs.answers.edit', compact('answer', 'questions'));
    }

    public function update(Request $request, Answer $answer): RedirectResponse
    {
        $request->validate([
            'question_id' => 'required',
            'responder' => 'required',
            'answer' => 'required',
            'status' => 'required|integer|in:1,2',
        ]);

        $answer->update([
            'question_id' => $request->question_id,
            'responder' => $request->responder,
            'answer' => $request->answer,
            'status' => $request->status,
            'answer_date' => Carbon::now(),
        ]);

        return redirect()->route('admin.answers.index')->with('success', 'Cập nhật câu trả lời thành công.');
    }

    public function destroy(Answer $answer): RedirectResponse
    {
        $answer->delete();
        return redirect()->route('admin.answers.index')->with('success', 'Xoá thành công.');
    }
}
