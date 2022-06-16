<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NewsWebController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param string $slug
     * @return Application|Factory|View
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
