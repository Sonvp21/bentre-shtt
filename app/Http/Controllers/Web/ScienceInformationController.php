<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ScienceInformation;
use Illuminate\View\View;

class ScienceInformationController extends Controller
{
    public function index(): View
    {
        return view('web.science-information.index', [
            'scienceInformations' => ScienceInformation::query()
                ->published()
                ->where('keep_on_top', 1)
                ->latest('published_at')
                ->latest('updated_at')
                ->paginate(10),
        ]);
    }

    public function show(ScienceInformation $scienceInformation): View
    {
        return view('web.science-information.show', [
            'scienceInformation' => $scienceInformation,
        ]);
    }
}
