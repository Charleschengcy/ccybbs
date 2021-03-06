<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

class CategoriesController extends Controller
{
    //
    public function show(Category $category, Request $request, Topic $topic)
    {
        //读取分类ID关联的话题，并每页15条分页
        // $topics = Topic::where('category_id', $category->id)->paginate(15);
        $topics = $topic->withOrder($request->order)->where('category_id', $category->id)->paginate(15);
        //传参变量话题和分类到模板中
        return view('topics.index', compact('topics', 'category'));
    }
}
