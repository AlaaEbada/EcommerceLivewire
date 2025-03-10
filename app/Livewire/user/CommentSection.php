<?php

namespace App\Livewire\User;

use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class CommentSection extends Component
{
    public $comment;
    public $reply;
    public $commentId;
    public $post_id;


    public function add_comment()
    {
        if (Auth::check()) {

            if ($this->comment) {

                $user = Auth::user();
                $comment = new Comment;
                $comment->name = $user->name;
                $comment->comment = $this->comment;
                $comment->user_id = $user->id;
                $comment->post_id = $this->post_id;

                $comment->save();

                $this->comment = '';


                session()->flash('message', __('messages.comment_added'));
            } else {
                session()->flash('error', __('messages.comment_empty'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function add_reply()
    {
        if (Auth::check()) {

            if ($this->reply && $this->commentId) {
                $user = Auth::user();
                $reply = new Reply;
                $reply->name = $user->name;
                $reply->reply = $this->reply;
                $reply->user_id = $user->id;
                $reply->comment_id = $this->commentId;

                $reply->save();

                $this->reply = '';

                session()->flash('message', __('messages.reply_added'));
            } else {
                session()->flash('message', __('messages.reply_empty'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function toggle_reply_form($commentId)
    {
        $this->commentId = ($this->commentId === $commentId) ? null : $commentId;
    }

    public function close_reply_form()
    {
        $this->commentId = null;
    }


    public function clear_message()
    {
        session()->forget('message');
    }

    public function clear_error()
    {
        session()->forget('error');
    }


    // Comment Confirm Delete

    #[On('commentConfirmAction')]
    public function commentConfirmAction($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->delete();
            $this->dispatch('alert', type: 'success', title:  __('messages.comment_deleted'));
        } else {
            $this->dispatch('alert', type: 'error', title:  __('messages.comment_not_found'));
        }
    }

    #[On('commentActionCancel')]
    public function commentCancelAction($id)
    {
        $this->dispatch('alert', type: 'info', title: __('messages.action_canceld'));
    }

    public function commentDelete($id)
    {
        if (Auth::check())
        {
            $this->dispatch(
                'DeleteConfirm',
                type: 'warning',
                title: __('messages.alert_title'),
                message: __('messages.confirm_deletion_comment'),
                yes:__('messages.yes'), 
                no:__('messages.no'),
                id: $id
            );
        } else {
            redirect('/login');
        }
    }



    // Reply Confirm Delete

    public function replyDelete($id)
    {
        if (Auth::check())
        {
            $this->dispatch(
                'DeleteConfirm2',
                type: 'warning',
                title: __('messages.alert_title'),
                message:  __('messages.confirm_deletion_reply'),
                yes:__('messages.yes'), 
                no:__('messages.no'),
                id: $id
            );
        } else {
            redirect('/login');
        }
    }

    #[On('replyConfirmAction')]
    public function replyConfirmAction($id)
    {
        $reply = Reply::find($id);
        if ($reply) {
            $reply->delete();
            $this->dispatch('alert', type: 'success', title:  __('messages.reply_deleted'));
        } else {
            $this->dispatch('alert', type: 'error', title: __('messages.reply_not_found'));
        }
    }

    #[On('commentActionCancel')]
    public function ReplyCancelAction($id)
    {
        $this->dispatch('alert', type: 'info', title: __('messages.action_canceled'));
    }


    public function render()
    {
        return view('livewire.user.comment-section', [
        'comments' => Comment::where('post_id', $this->post_id)->latest()->get(),
            'replies' => Reply::all(),
    ]);
    }
}
