
$(".add-comment").click(function(){
    if (!$('#comment').val()) {
          alert("Please type Comment...")
    }else{
        let comment = $('[name=comment]').val();
        let task_id = $('[name=task_id]').val();
       
        $.ajax({
        url: "/dashboard/task-comment ",
        type: "POST",
        data: { comment:comment,task_id : task_id},
        success: function(response) {
            console.log("success", response);
            makeToastr('success', response.response,
                'Successful');
        },
      });
    }

});


function commentDelete(id){
    $.ajax({
        url: "/dashboard/task-comment/"+id,
        type: "DELETE",
        success: function(response) {
            console.log("success", response);
            makeToastr('success', response.response,
                'Successful');
        },
      });
}