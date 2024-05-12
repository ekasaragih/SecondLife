<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Goods;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function storeComment(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'comment' => 'required|string',
            'g_ID' => 'required|integer',
        ]);

        // Dapatkan nama pengguna yang saat ini login
        $loggedInUser = Auth::user();
        $us_name = $loggedInUser->us_name;

        // Simpan komentar ke dalam database bersama dengan us_name
        $comment = new Comment();
        $comment->comment_desc = $request->input('comment');
        $comment->us_ID = $loggedInUser->us_ID;
        $comment->us_name = $us_name;
        $comment->g_ID = $request->input('g_ID');
        $comment->save();

        // Berikan respons bahwa komentar telah disimpan
        return response()->json(['success' => 'Comment has been posted successfully']);
    }
    
    public function index()
    {
        // Return all comments
        $comments = Comment::getAllComments();
        return response()->json($comments);
    }

    public function getByProductId($g_ID)
    {
        // Return comments for a specific product (g_ID)
        $comments = Comment::with('user:us_ID,avatar,us_username')->where('g_ID', $g_ID)->get();
        return response()->json($comments);
    }
}