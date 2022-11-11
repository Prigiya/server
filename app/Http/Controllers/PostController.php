<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Likepost;
use App\Models\Dislike;

class PostController extends Controller
{
    
    public function index(){
        $posts = Post::withCount(['comments','likeposts','dislikes'])->orderBy('post_id','desc')->orderBy('id','desc')->get();

        $response = [];
        foreach ($posts as $index => $post) {
            $response[] = [
                'id' => $post->id,
                'commentCount' => $post->comments_count,
                'likeCount' => $post->likeposts_count,
                'dislikeCount' => $post->dislikes_count,
                'title' => $post->title,
                'body' => $post->body,
                'created_at' => $post->created_at
            ];
        }

        return $response;
    }

    public function userpost($userid){
        $posts = Post::withCount(['comments','likeposts','dislikes'])->where('user_id', $userid)->orderBy('id','desc')->get();

        $response = [];
        foreach ($posts as $index => $post) {
            $response[] = [
                'id' => $post->id,
                'commentCount' => $post->comments_count,
                'likeCount' => $post->likeposts_count,
                'dislikeCount' => $post->dislikes_count,
                'title' => $post->title,
                'body' => $post->body,
                'created_at' => $post->created_at
            ];
        }

        return $response;
    }

    public function store(Request $request)
    {
        try{
            $post = new Post();
            $post->title = $request->title;
            $post->body = $request->body;
            $post->user_id = $request->userid;
            if($post->save()){
                return response()->json(['status'=>'success', 'message'=>'Post created successfully']);
            }
        } catch (\Exception $e){
            return response()->json(['status'=>'failure', 'message'=> $e->getMessage()]);
        }
    }

    public function update(Request $request, $id){
        try{
            $post = Post::find($id);
            $post->title = $request->title;
            $post->body = $request->body;
            if($post->save()){
                return response()->json(['status'=>'success', 'message'=>'Post updated successfully']);
            }
        } catch (\Exception $e){
            return response()->json(['status'=>'failure', 'message'=> $e->getMessage()]);
        }
    }

    public function view($id){
            // $post = Post::find($id);
            // return Post::find($id);
            $post = Post::with(['user'])->find($id);        
            return [
                'id' => $post->id,
                'user'=> $post->user->name,
                'title' => $post->title,
                'body' => $post->body
            ];
    }


    public function destroy($id){
        try{
            $post = Post::findOrFail($id);
            if($post->delete()){
                return response()->json(['status'=>'success', 'message'=>'Post deleted successfully']);
            }
        } catch (\Exception $e){
            return response()->json(['status'=>'failure', 'message'=> $e->getMessage()]);
        }
    }

    public function commentpost(Request $request)
    {
        try{
            $comment = new Comment();
            $comment->post_id=  $request->postid;
            $comment->user_id=  $request->userid;
            $comment->comment_post = $request->commentpost;
            // dd($request->commentpost);
            if($comment->save()){
                return response()->json(['status'=>'success', 'message'=>'Comment Posted successfully']);
            }
        } catch (\Exception $e){
            return response()->json(['status'=>'failure', 'message'=> $e->getMessage()]);
        }
    }

    public function commentdata($postid){
        // return Comment::where('post_id',$postid)->get();
        $comments = Comment::with(['user'])->where('post_id',$postid)->orderBy('id','desc')->get();
        $response = [];
        foreach ($comments as $index => $comment) {
            $response[] = [
                'commentPost' => $comment->comment_post,
                'commentId' => $comment->id,
                'createdat' =>$comment->created_at,
                'user'=>$comment->user->name
            ];
        }

        return $response;      
        
    }

    public function commentdataall(){
        
        return Comment::count();
    }

    public function Likepost(Request $request)
    {
        try{
            $likedata = new Likepost();
            $likedata->likes = $request->likedata;
            $likedata->user_id=  $request->userid_like;
            $likedata->post_id = $request->likeid;
            if($likedata->save()){
                return response()->json(['status'=>'success', 'message'=>'Liked successfully']);
            }
        } catch (\Exception $e){
            return response()->json(['status'=>'failure', 'message'=> $e->getMessage()]);
        }
    }

    public function disLikepost(Request $request)
    {
        try{
            $dislikedata = new Dislike();
            $dislikedata->dislikes = $request->dislikedata_dis;
            $dislikedata->user_id=  $request->userid_dislike;
            $dislikedata->post_id = $request->dislikeid;
            if($dislikedata->save()){
                return response()->json(['status'=>'success', 'message'=>'Liked successfully']);
            }
        } catch (\Exception $e){
            return response()->json(['status'=>'failure', 'message'=> $e->getMessage()]);
        }
    }
}
