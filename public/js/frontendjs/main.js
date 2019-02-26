$(document).ready(function(){

  //Change price & availabilty of stock with size
    $("#selSize").change(function(){
      var idSize = $(this).val();
      if(idSize == ""){
        return false;
      }
      $.ajax({
        type:'get',
        url:'/get-product-price',
        data:{idSize:idSize},
        success:function(resp){
          // alert(resp); return false;
          var arr = resp.split('#');
          $('#getPrice').html("PHP "+ arr[0]);
          $('#price').val(arr[0]);
          if(arr[1] == 0){
            $("#cartButton").hide();
            $("#availability").text("Out of Stock");
          } else {
            $("#cartButton").show();
            $("#availability").text("In Stock");
          }
        },error:function(){
          alert("Error");
        }
      });
    });


    //Change price & availabilty of stock with size for MODAL
    $(".modal #selSize1").change(function(){       
      var idSize = $(this).val();
      if(idSize == ""){
        return false;
      }
      $.ajax({
        type:'get',
        url:'/get-product-price1',
        data:{idSize:idSize},
        success:function(resp){

          // alert(resp); return false;
          var arr = resp.split('#');
          $('.modal #getPrice1').html("PHP "+ arr[0]);
          $('#price').val(arr[0]);
          if(arr[1] == 0){
            $(".modal #cartButton1").hide();
            // $(".modal #availability1").text("Out of Stock");
          } else {
            $(".modal #cartButton1").show();
            // $(".modal #availability1").text("In Stock");
          }
        },error:function(){
          alert("Error");
        }
      });
    });

  //Replace Main Image with Alternate Image

    $(".changeImage").hover(function(){
      var image = $(this).attr('src');
      $("#mainImage").attr('src',image);
    });


});




$().ready(function() {
  //validate registerform n keyup and submit
  jQuery.validator.addMethod("lettersonly", function(value, element) 
  {
  return this.optional(element) || /^[a-z ]+$/i.test(value);
  }, "Letters and spaces only please");

 //Register Form VALIDATE 
  $('#registerForm').validate({
    rules:{
      name:{
        required:true,
        minlength:3,
        lettersonly:true
      },
      password:{
        required:true,
        minlength:6
      },
      email:{
        required:true,
        email:true,
        remote:"/check-email"
      }
    },
    messages:{
      name:{
        required:"Please enter your name",
        minlength:"Your name must be atleast 3 characters long",
        accept:"Your name must contain letters only"
      },
      password:{
        required:"Please enter password",
        minlength:"Your password must be atleast 6 characters long"
      },
      email:{
        required: "Please enter your email",
        email: "Please enter valid email",
        remote: "Email already exists!"
      }
    }
  });

  
//Login Form VALIDATE
  $('#loginForm').validate({
    rules:{
      email:{
        required:true,
        email:true
      },
      password:{
        required:true
      }     
    },
    messages:{
      email:{
        required: "Please enter your email",
        email: "Please enter valid email"
      },
      password:{
        required:"Please enter password",
      }
      
    }
  });
  

//Passwordform validate
  $('#passwordForm').validate({
    rules:{
      current_pwd:{
        required:true,
        minlength:6,
        maxlength:30
      },
      new_pwd:{
        required:true,
        minlength:6,
        maxlength:30
      },
      confirm_pwd:{
        required:true,
        minlength:6,
        maxlength:30,
        equalTo:"#new_pwd"
      }        
    },
    errorClass: "help-inline",
    errorElement: "span",
    highlight:function(element, errorClass, validClass){
      $(element).parents('.form-group').addClass('error');
    }
  });

//Check current password
$('#current_pwd').keyup(function(){
  var current_pwd = $(this).val();
  $.ajax({
    headers: {
      'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    },
    type:'post',
    'url':'/check-user-pwd',
    data:{current_pwd:current_pwd},
    success:function(resp){
      if(resp=="false"){
        $("#chkPwd").html("<font color='red'>Current Password is incorrect</font>");
      }else if(resp=="true"){
        $("#chkPwd").html("<font color='green'>Current Password is correct</font>");
      }
    },error:function(){
      alert("Error");
    }
    
  });
});



//Password strength
  $('#Password').passtrength({
    tooltip: true,
    textWeak: "Weak",
    textMedium: "Medium",
    textStrong: "Strong",
    textVeryStrong: "Very Strong",
    passwordToggle: true,
    eyeImg : "images/frontend_images/eye.svg" // toggle icon
  });


  //account form validate
  $('#accountForm').validate({
    rules:{
      name:{
        required:true,
        minlength:3,
        lettersonly:true
      },
      address:{
        required:true,
        minlength:6
      },
      city:{
        required:true,
        minlength:4
      },
      country:{
        required:true
      },
      pincode:{
        required:true
      },
      mobile:{
        required:true
      }
    },
    messages:{
      name:{
        required:"Please enter your name",
        minlength:"Your name must be atleast 3 characters long",
        accept:"Your name must contain letters only"
      },
      address:{
        required:"Please provide address",
        minlength:"Your password must be atleast 6 characters long"
      },
      city:{
        required: "Please provide city",
        minlength: "Your city must be atleast 4 characters long"
      },
      country:{
        required: "Please provide country",
      },
      pincode:{
        required: "Please provide pincode",
      },
      mobile:{
        required: "Please provide mobile number"
      }

      
    }
  });


  //Copy Billing Address to Shipping Address
  $("#billtoship").on('click', function(){
    if(this.checked){
      $("#shipping_name").val($("#billing_name").val());
      $("#shipping_address").val($("#billing_address").val());
      $("#shipping_city").val($("#billing_city").val());
      $("#shipping_country").val($("#billing_country").val());
      $("#shipping_pincode").val($("#billing_pincode").val());
      $("#shipping_mobile").val($("#billing_mobile").val());

    } else {
      $("#shipping_name").val('');
      $("#shipping_address").val('');
      $("#shipping_city").val('');
      $("#shipping_country").val('');
      $("#shipping_pincode").val('');
      $("#shipping_mobile").val('');
    }

  });


  
});

function selectPaymentMethod()
{
  if($('#paypal').is(':checked') || $('#cod').is(':checked')){
    // alert('checked');
  } else {
    alert('Please select payment method');
    return false;
  }
  
}

