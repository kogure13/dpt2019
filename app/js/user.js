$(document).ready(function() {
    $.ajax({
        url: host+"/app/api/user/ajax.php?action=get",
        type: "post",
        dataType: "json",
        success: function(data) {
            $("#username").val(data.username);
            $("#password").val(data.password);
        } 
    });

    $("#formUser").validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Username is required"
            },
            password: {
                required: "Password is required"
            }
        },
        submitHandler: function(form) {
            ajaxAction();
          }
    });
});

function ajaxAction() {
    $form = $("#formUser");
    data = $form.serializeArray();

    $.ajax({
        url: host+"/app/api/user/ajax.php",
        type: "post",
        data: data,
        success: function(response) {
            alert("Update success");
        }
    })
}