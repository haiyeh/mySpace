<?php

namespace App\Http\Controllers\Admin;

use App\model\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = Comment::getAllComment();
        return view('admin.comment', ['comment' => $comment, 'title' => '评论列表']);
    }

}
