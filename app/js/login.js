var host = window.origin;

$(function() {
  $("#loginForm").validate({
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
        required: "*) Username cannot be empty"
      },
      password: {
        required: "*) Password cannot be empty"
      }
    },
    submitHandler: function(form) {
      ajaxAction();

      $("#loginForm").trigger("reset");
    }
  });
});

function ajaxAction() {
  data = $("#loginForm").serializeArray();
  v_dump = $.ajax({
    data: data,
    url: host + "/app/api/login/ajax.php",
    type: "post",
    dataType: "json",
    success: function(response) {
      if (response == 404) {
        alert("User tidak terdaftar");
      } else if (response == 0) {
        alert("username atau password salah!");
      } else if (response == 1) {
        window.location.href = host;
        // window.location.href = "../../index.php";
      }
    }
  });
}
