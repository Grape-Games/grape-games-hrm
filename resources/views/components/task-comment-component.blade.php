<style>
   
</style>
<div>
<div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Comments</h4>
            </div>
            <div class="card-body" style="color:#444444bf">
                @foreach($comments as $comment)
                <div class="comments mb-5">
                <p>{{ $loop->iteration }}. {{$comment->comment}}</p>
                        <div class="row">
                            <div class="col-md-9" style="display: flex;justify-content: space-between;">
                                <small>{{$comment->user->name}}</small>
                                <small>{{$comment->created_at->diffForHumans()}}</small>
                            </div>
                            <div class="col-md-3">
                            <i class="fa fa-trash" aria-hidden="true" onclick="commentDelete('{{$comment->id}}')"></i>
                            </div>
                        </div>
                        
                    </div><hr>
                @endforeach
             
                <textarea name="comment" class="form-control mt-3" id="comment" cols="5" rows="3"></textarea>
                <input name="task_id" type="hidden" value="{{$task_id}}">
                <button class="btn btn-sm btn-info mt-3 add-comment">Add comment</button>
            </div>
        </div>
</div>
