$(function () {
  $("#register-link").click(function () {
    $("#login-box").hide();
    $("#register-box").show();
  });
  $("#login-link").click(function () {
    $("#login-box").show();
    $("#register-box").hide();
  });
  $("#forgot-link").click(function () {
    $("#login-box").hide();
    $("#forgot-box").show();
  });
  $("#back-link").click(function () {
    $("#login-box").show();
    $("#forgot-box").hide();
  });
});
  // Register Ajax Resquest
  $("#register-btn").click(function(e) {
    if($("#register-form")[0].checkValidity()) {
      e.preventDefault();
      $("#register-btn").val('Por Favor Aguarde...');
      if($("#rpassword").val() != $("#cpassword").val()){
        $("#passError").text('* Password did not matched');
         $("#register-btn").val('Sign Up');
      }
      else{
        $("#passError").text('');
        $.ajax({
          url: 'assets/php/action.php',
          method: 'post',
          data: $("#register-form").serialize()+'&action=register',
          success:function(response){
            $("#register-btn").val('Sign Up');
            if (response === 'register') {
              window.location = 'home.php';
            }
            else {
              $("#regAlert").html(response);
            }
          }
        });
      }
    }
});

  //login Ajax Resquest...
  $("#login-btn").click(function(e) {
    if($("#login-form")[0].checkValidity()) {
      e.preventDefault();
      $("#login-btn").val('Por Favor Aguarde...');
      $.ajax({
        url: 'assets/php/action.php',
        method: 'post',
        data: $("#login-form").serialize()+'&action=login',
        success:function(response) {
          // console.log(response);
          $("#login-btn").val('Sign In');
          if (response === 'login') {
            window.location = 'home.php';
          }
          else {
            $("#loginAlert").html(response);
          }
        }
      });
    }
  });

  //Forgot Password Ajax...
  $("#forgot-btn").click(function(e) {
    if($("#forgot-form")[0].checkValidity()) {
      e.preventDefault();

      $("#forgot-btn").val('Por Favor Aguarde...');

      $.ajax({
        url: 'assets/php/action.php',
        method: 'post',
        data: $("#forgot-form").serialize()+'&action=forgot',
        success:function(response){
          $("#forgot-btn").val('Reset Password');
          $("#forgot-form")[0].reset();
          $("#forgotAlert").html(response);
        }
      });
    }
  });
  