// $(document).ready(function () {
//     $('.ckeditor').ckeditor();
// });

// CKEDITOR.replace( 'details', {
// 	uiColor: '#14B8C4',
// 	toolbar: [
// 		[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
// 		[ 'FontSize', 'TextColor' ]
// 	]
// });
ClassicEditor
		.create( document.querySelector( '#editor' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ,'Underline','FontSize']
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );


let btn = $(".submit-btn");

$("#addNewTask").submit(function (e) {
    e.preventDefault();
    let obj = $(this);
    if (obj.valid()) {
        btn.prop("disabled", true);
        btn.html("Creating New Task Please wait...");
        dynamicAjax(
            $(this).attr("action"),
            $(this).attr("method"),
            new FormData($(this)[0]),
            "emCallback",
            "em-errors-print",
            "emhr-table"
        );
    }
});
function emCallback(response, errorClassName, table) {
    btn.prop("disabled", false);
    btn.html("Add New Task");
    if (response.status == 422) validationPrint(response, errorClassName);
    else if (response.status == 200) {
        makeToastr("success", response.response, "Action Successful. 😃");
        successFlow(errorClassName, response.response, "bg-success");
        $(".task-table").DataTable().ajax.reload();
        var oTable = $("." + table).dataTable();
        oTable.fnDraw(false);
    } else if (response.status == 409) {
        makeToastr(
            "error",
            response.responseJSON.response,
            "Exception occured 😢"
        );
    } else successFlow(errorClassName, response.response, "bg-danger");
}


$("body").on("click", ".update2", function () {
    $("#" + $(this).data("modal")).modal("toggle");
    dynamicAjax(
        window.location.pathname + "/" + $(this).data("id") + "/edit",
        "GET",
        "",
        "updateTask"
    );
});

function updateTask(response, errorClassName, table) {
    console.log(response);
    var input = $(
        '<input type="hidden" name="task_id" value="' + response.id + '">'
    );
    $("#addNewTask").append(input);
    $("[name=assigned_by]").val(response.assigned_by);
    $("[name=project_id]").val(response.project_id);
    $("[name=assigned_to]").val(response.assigned_to);
    $("[name=start_date]").val(response.start_date);
    $("[name=end_date]").val(response.end_date);
    $("[name=priority]").val(response.priority);
    $(".ckeditor").val(response.details);
    

    // alert(response.details);

    btn.prop("disabled", false);
    btn.html("Add/Update Task");
}

$("#add_task").on("hidden.bs.modal", function () {
    // do something…
    $("[name=task_id]").remove();
    $(this).find("form").trigger("reset");
});


function getStatus(val,id){
    $.ajax({
        url: "/dashboard/task-status",
        type: "POST",
        data: {id : id, status:val},
        success: function(response) {
            console.log("success", response);

            makeToastr('success', response.response,
                'Successful');
        },
      });
}


