var data

// Ajax Call for signup form 

$("#signupform").submit(function(event){

    // hide meassage
    $("#signupmessage").hide();

    // show the spinner
    $("#spinner").css("display", "block");

    // prevent default PHP processing
    event.preventDefault();

    // Collect input form users
    var dataopost = $(this).serializeArray();
    console.log(dataopost);

    // Send data to php using ajax
    $.ajax({
        url: "lib/signup.php",
        type: "POST",
        data: dataopost,
        success: function(data){
            if(data)
            {
                $("#signupmessage").html(data);

                // hide spinner
                $("#spinner").css("display","none");

                // show message
                $("#signupmessage").slideDown();
            }  
        },
        error: function()
        {
            $("#signupmessage").html("<div class='alert alert-danger'>There was error calling to Ajax. Please try again</div>");

            // hide spinner
            $("#spinner").css("display","none");

            // show message
            $("#signupmessage").slideDown();
        }
    });
});

// Ajax Call for Loginup form 

$("#loginform").submit(function(event){

    // hide meassage
    $("#loginmessage").hide();

    // show the spinner
    $("#spinner").css("display", "block");

    // prevent default PHP processing
    event.preventDefault();

    // Collect input form users
    var dataopost = $(this).serializeArray();

    // Send data to php using ajax
    $.ajax({
        url: "lib/login.php",
        type: "POST",
        data: dataopost,
        success: function(data){
            if(data == "success")
            {
                window.location = "/index.php";
            }
            else{
                $('#loginmessage').html(data); 

                //hide spinner
                $("#spinner").css("display", "none");

                //show message
                $("#loginmessage").slideDown();
            } 
        },
        error: function()
        {
            $("#loginmessage").html("<div class='alert alert-danger'>There was error calling to Ajax. Please try again</div>");

            // hide spinner
            $("#spinner").css("display","none");

            // show message
            $("#loginmessage").slideDown();
        }
    });
});