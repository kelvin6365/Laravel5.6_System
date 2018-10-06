
 {!! Form::open(['route'=>'favourite' , 'id'=>'likeform']) !!}
 <input id="like_token" name="like_token" type="hidden" value="{{csrf_token()}}">
 {!! Form::hidden('Post_id', $Post->id , array('id'=>'Post_id')) !!}
@if (!is_null($favourites)) 
<button id="like" type="submit" class="btn btn-template-main like " style="color: Red;">
 <i class="fa fa-heart" ></i>
</button>
@else
<button id="like" type="submit" class="btn btn-template-main like true" style="color: Red;">
<i class="far fa-heart"></i>
</button>
@endif
{!! Form::close() !!}
<script>
        var urlLike = '{{ route('favourite')}}';        
</script>