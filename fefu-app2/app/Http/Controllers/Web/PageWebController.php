<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageWebController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request, string $slug)
    {
        $page = Page::query()
            ->where('slug', $slug)
            ->first();
        if ($page === null)
            abort(404);

        return view('page', ['page'=> $page]);
    }
}
