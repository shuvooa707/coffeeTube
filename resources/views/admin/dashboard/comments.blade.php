@extends("admin.dashboard")

@section('pageSpecificStylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/comment.css')}}" />
@endsection

@section('pageSpecificScript')
<script src="{{ asset('js/comment.js') }}" defer></script>
@endsection



@section('main')
<!-- Comments -->
<div class="card mb-3 comments">
    <div class="card-header bg-dark text-white">
        Comments
    </div>
    <div class="card-body" style="min-height:751px;">
        {{ $comments->links() }}
        <table class="table border">
            <thead>
                <tr class="bg-dark text-light">
                    <th>
                        <i class="fas fa-hashtag"></i>
                    </th>
                    <th>
                        <i class="fas fa-comment mr-1"></i>
                        Comment
                    </th>
                    <th style="min-width: 170px!important;">
                        <i class="fas fa-user mr-1"></i>
                        Commentor
                    </th>
                    <th style="min-width: 140px;">
                        <i class="fas fa-clock mr-1"></i>
                        Date
                    </th>
                    <th>
                        <i class="fas fa-video mr-1"></i>
                        On
                    </th>
                    <th style="min-width:150px!important;">
                        <i class="fas fa-tools mr-1"></i>
                        Tools
                    </th>
                </tr>
            </thead>
            <tbody style="font-size: 17px">
                <!-- Sample Comment -->
                @foreach($comments as $comment)
                <tr class="comment-row {{ $comment->read == 'unread' ? 'unread' : '' }}" data-id="{{ $comment->id }}">
                    <td>{{ $comment->id }}</td>
                    <td style="width: 391px!important;">{{ strlen($comment->content) > 200 ? substr($comment->content,0,200)."...." : $comment->content }}</td>
                    <td>
                        <a href="{{ url('user/'. $comment->user->id ) }}">
                            {{ $comment->user->name }}
                        </a>
                    </td>
                    <td>
                        {{ $comment->created_at }}
                    </td>
                    <td>
                        <a href="{{ route('playvideo') }}/{{ $comment->video->slug }}/?cid={{$comment->id}}">
                            {{ $comment->video->title }}
                        </a>
                    </td>
                    <td>
                        <button class="btn btn-sm border-danger rounded" title="Delete the Comment..." onclick="deleteComment(this.parentElement.parentElement)">
                            <i class="fas fa-trash"></i>
                        </button>
                        @if($comment->read == 'unread')
                        <button class="btn btn-sm border-success rounded markAsReadButton" title="Mark As Read..." onclick="markAsRead(this.parentElement.parentElement, this)">
                            <i class="fas fa-check"></i>
                        </button>
                        @endif
                    </td>
                </tr>
                @endforeach
                <!-- /Sample Comment -->

            </tbody>
        </table>
    </div>
</div>
<!-- /Comments -->
@endsection
