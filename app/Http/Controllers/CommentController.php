<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateCommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function createComment(CreateCommentRequest $request)
    {
        try {
            DB::beginTransaction();
//            $Comment = Comment::create([
//                'user_id1' => auth()->user()->id,
//                'user_id2' => $request->user_id,
//                'parent_id' => $request->parent_id,
//                'body' => $request->text,
//            ]);

            $user = $request->user();
//            dd($user->comments());
            $comment = $user->comments()->create([
                'user_id2' => $request->user_id,
                'parent_id' => $request->parent_id,
                'body' => $request->text,
            ]);
            DB::commit();
            return response($comment, 200);
        } catch (\Exception $exception) {
            DB::rollBack();
//            dd($exception);
            return response(['message' => 'خطایی رخ داده است .']);
        }
    }

    public function showCommentDoctor()
    {
        $listComment = Comment::where('user_id2', auth()->user()->id)->with('user')->get();
        $data['listComment'] = sort_comments($listComment);
        $data['length']=count($listComment);
        return $data;
    }


    public function deleteComment($id)
    {
        Comment::find($id)->delete();
    }

}
