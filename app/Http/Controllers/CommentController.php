<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommentController extends Controller
{
    protected function viewComment()
    {
        $comment = Comment::where('parent_id',$_POST['parent_id'])->get();
        return $comment;
    }
    protected function insertComment()
    {
        $count = Comment::where('parent_id',$_POST['parent_id'])->count();
        DB::table('comments')->insert([
            'comment' => $_POST['comment'],
            'parent_id' => $_POST['parent_id'],
            'number' => $count+1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
    protected function changeComment()
    {
        DB::update('update comments set comment = ? where id = ?',[
            $_POST['comment'],
            $_POST['id']
        ]);
    }
    protected function removeComment()
    {
        $id = $_POST['id'];
        Comment::destroy($id);
    }
}
