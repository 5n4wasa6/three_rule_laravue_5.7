<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Discussion\Club as ClubDiscussionResource;
use App\Http\Requests\Discussion\Store as StoreRequest;
use App\Http\Requests\Discussion\Update as UpdateRequest;
use App\Http\Requests\Discussion\StoreComment as StoreCommentRequest;
use App\Http\Requests\Discussion\UpdateComment as UpdateCommentRequest;

use App\Models\Club;
use App\Models\Discussion;
use App\Models\DiscussionComment;
use App\Models\DiscussionCommentCount;
use App\Models\DiscussionCount;
use App\User;

class DiscussionController extends Controller
{
    public function index($id)
    {
        $discussions = ClubDiscussionResource::collection(
            Club::with(
                'club_member',
                'discussion','discussion.discussion_count','discussion.discussion_comment','discussion_comment.discussion_comment_count'
                )->where("id",$id)->get()
        );
        return $discussions;
    }
    public function create()
    {
        //
    }
    public function store(StoreRequest $request, $id)
    {
        // $exploded = explode(',', $request -> image);
        // $decoded= base64_decode($exploded[1]);
        
        // if(str_contains($exploded[0], 'jpeg')) {
        //     $extension = 'jpg';
        // }else {
        //     $extension = 'png';
        // }
        
        // $fileName = str_random().'.'.$extension;
        // $path = public_path().'/images/'.$fileName;
        // file_put_contents($path, $decoded);
        
        
        // $uploadedFile = $request->file('file');
        // $path = \Storage::disk('public')->putFile('/', $uploadedFile);
        // // $path = \Storage::disk('public')->putFile('/', $uploadedFile, 'public');
        // $uploadedUrl = \Storage::disk('public')->url($path);
        // return ['url' => $uploadedUrl];
        
        $uid = auth()->user()->id;
        
        $discussion = new Discussion;
        $discussion->user_id = $uid;
        $discussion->club_id = $id;
        $discussion->body    = $request->body;
        $discussion->image   = "test";
        // $discussion -> image   = $fileName;
        $discussion -> save();
        
        $discussions = ClubDiscussionResource::collection(
            Club::with(
                'club_member',
                'discussion','discussion.discussion_count','discussion.discussion_comment','discussion_comment.discussion_comment_count'
                )->where("id",$id)->get()
        );
        return $discussions;
    }
    public function show($id)
    {
        return Discussion::find($id);
    }
    public function edit($id)
    {
        return Discussion::find($id);
    }
    public function update(UpdateRequest $request, $club_id, $discussion_id)
    {
        $uid = auth()->user()->id;
        $discussion = Discussion::find($discussion_id);
        $discussion->user_id = $uid;
        $discussion->club_id = $club_id;
        $discussion->body    = $request->body;
        $discussion->image   = $request->image;
        $discussion->save();
        
        $discussions = ClubDiscussionResource::collection(
            Club::with(
                'club_member',
                'discussion','discussion.discussion_count','discussion.discussion_comment','discussion_comment.discussion_comment_count'
                )->where("id",$id)->get()
        );
        return $discussions;
    }
    public function destroy($club_id, $discussion_id)
    {
        $discussion = Discussion::find($discussion_id);
        
        if($discussion -> count()) {
            $discussion -> delete();
            
            $discussions = ClubDiscussionResource::collection(
            Club::with(
                'club_member',
                'discussion','discussion.discussion_count','discussion.discussion_comment','discussion_comment.discussion_comment_count'
                )->where("id",$id)->get()
        );
        return $discussions;
        }else {
            return response() -> json('error');
        }
    }
    
    public function like(Request $request, $club_id, $discussion_id)
    {
        $uid = auth()->user()->id;
        $discussion = DiscussionCount::where('user_id',$uid)->where('discussion_id', $discussion_id)->first();
        // $discussion = DiscussionCount::where('user_id', $request->user_id)->where('discussion_id', $request->discussion_id)->first();
        
        if(!$discussion) {
            $like = new DiscussionCount;
            $like->discussion_id = $discussion_id;
            $like->user_id       = $uid;
            $like->save();
            
            $discussions = ClubDiscussionResource::collection(
                Club::with(
                    'club_member',
                    'discussion','discussion.discussion_count','discussion.discussion_comment','discussion_comment.discussion_comment_count'
                    )->where("id",$club_id)->get()
                );
            return $discussions;
        }else {
            $discussion->delete();
            
            $discussions = ClubDiscussionResource::collection(
                Club::with(
                    'club_member',
                    'discussion','discussion.discussion_count','discussion.discussion_comment','discussion_comment.discussion_comment_count'
                    )->where("id",$club_id)->get()
                );
            return $discussions;
        }
    }
    
    public function storeComment(StoreCommentRequest $request, $club_id, $discussion_id)
    {
        $uid = auth()->user()->id;
        $comment = new DiscussionComment;
        $comment->club_id        = $club_id ;
        $comment->user_id        = $uid;
        $comment->discussion_id  = $discussion_id;
        // $comment->commentable_id = 1;
        $comment->comment        = $request->comment;
        $comment->image_comment  = 'test';
        $comment->save();
        
        $discussions = ClubDiscussionResource::collection(
            Club::with(
                'club_member',
                'discussion','discussion.discussion_count','discussion.discussion_comment','discussion_comment.discussion_comment_count'
                )->where("id",$club_id)->get()
            );
        return $discussions;
    }
    public function updateComment(UpdateCommentRequest $request, $club_id, $discussion_id, $discussion_comment_id) {
        
        $uid = auth()->user()->id;
        $comment = DiscussionComment::where('id', $discussion_comment_id)->first();
        
        if($comment->count()) {
            // $comment->update($request->all());
            // $comment = DiscussionComment::where('user_id',$uid)->where('discussion_id', $discussion_id)->first();
            // $comment = DiscussionComment::where('id', $discussion_comment_id);
            $comment->club_id        = $club_id;
            $comment->user_id        = $uid;
            $comment->discussion_id  = $discussion_id;
            // $comment->commentable_id = 1;
            $comment->comment        = $request->comment;
            $comment->image_comment  = 'test';
            $comment->save();
            
            $discussions = ClubDiscussionResource::collection(
                Club::with(
                    'club_member',
                    'discussion','discussion.discussion_count','discussion.discussion_comment','discussion_comment.discussion_comment_count'
                    )->where("id",$club_id)->get()
                );
            return $discussions;
        }else {
            return response() -> json('error');
        }
    }
    public function destroyComment(Request $request, $club_id, $user_id, $discussion_comment_id) {
        
        $uid = auth()->user()->id;
        $comment = DiscussionComment::where('id', $discussion_comment_id)->first();
        
        if($comment->count()) {
            $comment -> delete();
            
            $discussions = ClubDiscussionResource::collection(
                Club::with(
                    'club_member',
                    'discussion','discussion.discussion_count','discussion.discussion_comment','discussion_comment.discussion_comment_count'
                    )->where("id",$club_id)->get()
                );
            return $discussions;
        }else {
            return response() -> json('error');
        }
    }
    
    // public function likeComment(Request $request, $club_id, $discussion_comment_id)
    // {
    //     $uid = auth()->user()->id;
    //     $discussion = DiscussionCommentCount::where('user_id',$uid)->where('discussion_comment_id', $discussion_comment_id)->first();
        
    //     if(!$discussion) {
    //         $like = new DiscussionCommentCount;
    //         $like->discussion_comment_id = $discussion_comment_id;
    //         $like->user_id               = $uid;
    //         $like->save();
            
    //         $discussions = ClubDiscussionResource::collection(
    //             Club::with(
    //                 'club_member',
    //                 'discussion','discussion.discussion_count','discussion.discussion_comment','discussion_comment.discussion_comment_count'
    //                 )->where("id",$club_id)->get()
    //             );
    //         return $discussions;
    //     }else {
    //         $discussion->delete();
            
    //         $discussions = ClubDiscussionResource::collection(
    //             Club::with(
    //                 'club_member',
    //                 'discussion','discussion.discussion_count','discussion.discussion_comment','discussion_comment.discussion_comment_count'
    //                 )->where("id",$club_id)->get()
    //             );
    //         return $discussions;
    //     }
    // }
}
