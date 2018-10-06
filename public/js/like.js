jQuery( document ).ready( function( $ ) {
    $('#likeform').on('submit', function(event) {
       event.preventDefault();  
       var post_id = $('#Post_id').val();
       var token = $('#like_token').val();
       var liked = '<i class="fa fa-heart " ></i>';
       var disliked = '<i class="far fa-heart"></i>';
       $.ajax({
            type: 'POST',
            url: urlLike,
            data: {'_token': token,'Post_id':post_id},})
            .done(function(data){
                if($('.like').hasClass("true") ){
                    $('.like').removeClass('true').html(liked);
                }
                else
                {
                    $('.like').addClass('true').html(disliked);
    
                }
            }
     
        );
            
    });
});

