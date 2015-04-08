<?php namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Student;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use View;

class FrontController extends Controller
{

    public function index()
    {
        $posts = Post::paginate(5);
        return view('front.index', compact('posts'));
    }


    public function ShowSingle($id)
    {
        $post = Post::find($id);

        return view('front.single', compact('post'));
    }

    public function showCategory($id)
    {
        $posts = Category::find($id)->posts;

        return view('front.category', compact('posts'));
    }

    public function showTag($id)
    {
        $posts = Tag::find($id)->posts;

        return view('front.tag', compact('posts'));
    }

    public function showStudent($id)
    {
        $student =  Student::find($id);

        return view('front.student', compact('student'));
    }

}
