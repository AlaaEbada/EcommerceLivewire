<div>
    <div class="container pb-5">

        <!-- Show success or error messages with close button -->
        @if (session()->has('message'))
            <div class="bg-green-500 text-white p-3 rounded-lg mb-4 flex justify-between items-center">
                <span>{{ session('message') }}</span>
                <button wire:click="clear_message" class="text-white text-xl">&times;</button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-500 text-white p-3 rounded-lg mb-4 flex justify-between items-center">
                <span>{{ session('error') }}</span>
                <button wire:click="clear_error" class="text-white text-xl">&times;</button>
            </div>
        @endif

        <!-- Add comment form -->
        <form wire:submit.prevent="add_comment" class="mb-4">
            @csrf
            <div class="form-group">
                <textarea class="form-control w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-green-600 focus:ring-1 focus:ring-green-600"
                        wire:model="comment" rows="3" placeholder="{{ __('Comment Something Here') }}" required></textarea>
            </div>
            <button type="submit" class="hover:bg-green-700 bg-green-600 text-white py-2 px-4 rounded-lg">{{ __('Comment') }}</button>
        </form>
    </div>

    <!-- Conditionally render the comments section if there are comments -->
    @if ($comments->isNotEmpty())
        <div class="container pb-5">
            <h2 class="pb-4 text-2xl font-bold text-gray-800">{{ __('All Comments') }}</h2>

            @foreach ($comments as $comment)
                <div class="card mb-3 p-4 border border-gray-300 rounded-lg shadow-sm hover:shadow-lg">
                    <div class="card-body">
                        <b class="text-lg">{{ $comment->name }}</b>
                        <p>{{ $comment->comment }}</p>

                        <!-- Button to show reply form -->
                        <a href="javascript:void(0);" wire:click="toggle_reply_form({{ $comment->id }})" class="text-green-700">{{ __('Reply') }}</a>

                        <!-- Delete Button for Comment -->
                        <button wire:click="commentDelete({{ $comment->id }})" class="text-red-500 text-sm ml-4 mx-2">{{ __('Delete') }}</button>

                        <!-- Reply Section -->
                        @foreach ($replies as $reply)
                            @if ($reply->comment_id == $comment->id)
                                <div class="reply mt-3 pl-5 rtl:pr-5 border-l-2 rtl:border-l-0 rtl:border-r-2 border-gray-300">
                                    <b>{{ $reply->name }}</b>
                                    <p>{{ $reply->reply }}</p>

                                    <!-- Button to show reply form for this reply -->
                                    <a href="javascript:void(0);" wire:click="toggle_reply_form({{ $comment->id }})" class="text-green-700">{{ __('Reply') }}</a>

                                    <!-- Delete Button for Reply -->
                                    <button wire:click="replyDelete({{ $reply->id }})" class="text-red-500 text-sm mx-2 ">{{ __('Delete') }}</button>
                                </div>
                            @endif
                        @endforeach

                        <!-- Reply Form (Only visible if a comment is selected) -->
                        @if ($comment->id == $commentId)
                            <form wire:submit.prevent="add_reply" class="mt-3">
                                @csrf

                                <textarea class="form-control w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-green-600 focus:ring-1 focus:ring-green-600"
                                        wire:model="reply" rows="3" placeholder="{{ __('Reply Something Here') }}" required></textarea>

                                <button type="submit" class=" bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg mt-2">{{ __('Reply') }}</button>
                                <span wire:click="close_reply_form" class="bg-red-500 text-white p-2 rounded-lg mt-2 cursor-pointer">{{ __('Close') }}</span>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
