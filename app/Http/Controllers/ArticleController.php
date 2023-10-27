<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    // чтения
    public function index()
    {
        return response()->json(['status' => true, 'data' => Article::all()]);
    }

    public function show($id)
    {
        return response()->json(['status' => true, 'data' => Article::find($id)]);
    }

    // создания
    public function store(ArticleStoreRequest $request)
    {
        $path = '';

        if ($request->file('preview_image')) {
            $request->file('preview_image')->store('public');
            $path = 'storage/' . $request->file('preview_image')->hashName();
        }

        $article = new Article;
        $article->title = $request->title;
        $article->text = $request->text;
        $article->preview_image = $path;
        $article->author_id = Auth::id();
        $article->save();

        return response()->json(['status' => true, 'data' => $article]);
    }


    // обновления
    public function update(ArticleStoreRequest $request, $id)
    {
        $path = '';

        // validated coming image -- if user doesn't want to update image, we just send old image value of this article -- if it's user trying to upload new image, so it comes as file and we update it
        if ($request->file('preview_image')) {

            $request->file('preview_image')->store('public');

            $path = 'storage/' . $request->file('preview_image')->hashName();
        } else if (gettype($request->preview_image) == "string") {

            $path = $request->preview_image;
        }


        $article = Article::find($id);
        $article->title = $request->title;
        $article->text = $request->text;
        $article->preview_image = $path;
        $article->save();

        return response()->json(['status' => true, 'data' => $article]);
    }


    // удаления
    public function destroy($id)
    {
        $article = Article::where('author_id', Auth::id())->find($id);

        if ($article) {
            $article->delete();
        }

        return response(null, 204);
    }
}
