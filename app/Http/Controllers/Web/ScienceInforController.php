<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ScienceInfor;
use Illuminate\View\View;

class ScienceInforController extends Controller
{
    public function index(): View
    {
        return view('web.scienceinfors.index', [
            'scienceinfors' => ScienceInfor::query()
                ->where('keep_on_top', 1)
                ->orderByDesc('published_at')
                ->paginate(6),
        ]);
    }

    public function show(ScienceInfor $scienceinfor): View
    {
        return view('web.scienceinfors.show', [
            'scienceinfor' => $scienceinfor,
        ]);
    }
}
