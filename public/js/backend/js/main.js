$(document).ready(function(){

    $("#new_pwd").click(function() {
      var current_pwd = $('#current_pwd').val();

      $.ajax({
        type:'get',
        url:'/admin/check-pwd',
        data:{current_pwd:current_pwd},
        success:function(resp){
          if(resp == "false"){
            $('#chkPwd').html("<font color='red'>Current Password Incorrect!</font>")
          } else if (resp== "true"){
            $('#chkPwd').html("<font color='green'>Current Password Correct!</font>");
          }
        },error:function(){
          alert("Error");
        }
        
        
      });

    });



});