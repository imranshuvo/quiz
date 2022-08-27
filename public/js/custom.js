$(document).ready(function(){
    $.session.set('question_id',$('.form-group').first().attr('id'));
    var id = $.session.get('question_id');
    console.log(id);
    $('#next-question').on('click',function(){
        console.log($.session.get('question_id'));
    });

    //Showing the firs question on site load
    $('ul.questions li.list-group-item:first').addClass('current');
    $('a#submit-single-question').on('click',function(event){
        event.preventDefault();
        $current = $(this).parent().parent();
        $prev = $current;
        $next = $current.next();
        $next.addClass('current');
        $prev.removeClass('current');
        
    })

});
