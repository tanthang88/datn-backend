<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductComment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductCommentController extends Controller
{

    /**
     * listComments
     *
     *
     * **/
    public function index()
    {
        return view('pages.comment.list');
    }
    public function dataComment()
    {
        $collects = collect();
        $comments = ProductComment::with(['product' => function ($query) {
            $query->select('id', 'product_name', 'product_image');
        }, 'childrenComment'])->where('parent_id', 0)->orderBy('id', 'DESC')->get();
        foreach ($comments as $comment) {
            $comment['product_id'] = $comment->product->id;
            $comment['product_name'] = $comment->product->product_name;
            $comment['product_image'] = $comment->product->product_image;
            $collects->push($comment);
        }
        $data['data'] = $collects;
        return $data;
    }
    public function accept(Request $request)
    {
        ProductComment::where('id', $request->id)->update(['comment_display' => 1]);
        return 1;
    }
    public function show($id)
    {
        $comment = ProductComment::with(['product', 'childrenComment'])->find($id);
        $countAll = ProductComment::where('parent_id', 0)->where('product_id', $comment->product->id)->count();
        // ProductComment::where('id',$id)->update(['comment_display' =>1]);
        return view('pages.comment.show', compact('comment', 'countAll'));
    }
    /**
     * store
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request)
    {
        $comment = new ProductComment();
        $data = [
            'product_id' => $request->product_id,
            'comment_name' => Auth::user()->name,
            'comment_phone' => Auth::user()->tel,
            'comment_email' => Auth::user()->email,
            'comment_content' => $request->reply_content,
            'comment_display' => 1,
            'parent_id' => $request->id,
        ];
        $comment->create($data);
        return back();
    }
}
