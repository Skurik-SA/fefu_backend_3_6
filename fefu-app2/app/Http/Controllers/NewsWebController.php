<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsWebController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $slug
     * @return void
     */
    public function __invoke(Request $request, string $slug)
    {
        $news = News::query()
            ->where('slug', $slug)
            ->first();
        if ($news === null)
            abort(404);

        return view('news', ['news'=> $news]);
    }
}
