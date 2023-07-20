$(document).ready(function() {
    $("input").on("focus", function() {
        $("body").addClass("dark");
        $("input").addClass("dark");
    });

    $("input").on("blur", function() {
        $("body").removeClass("dark");
        $("input").removeClass("dark");
    });
    $("form").submit(function(event) {
        event.preventDefault();
        $(".error").text("");
        var username = $("#username").val();
        var password = $("#password").val();
        var isValid = true;     
        var usernameRegex = /^[a-zA-Z0-9]+$/;
        var passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]).{6,}$/;

        if (username.trim() === "") {
            $("#username-error").text("Username is required.");
            isValid = false;
        } else if (!usernameRegex.test(username)) {
            $("#username-error").text("Username must contain only letters and numbers.");
            isValid = false;
        }

        if (password.trim() === "") {
            $("#password-error").text("Password is required.");
            isValid = false;
        } else if (!passwordRegex.test(password)) {
            $("#password-error").text("Password must contain at least one uppercase letter, one special character, one number, and be at least 6 characters long.");
            isValid = false;
        }
        $.ajax({
            url: "http://localhost/test/practiceTest/dataDisplay.php",
        dataType: "json",
        success:function(data)
        {
            var usernamePresent=false;
            for(var i=0;i<data.length;i++)
            {
                if(data[i].username===username && data[i].pass_word==password)
                {
                    usernamePresent=true;
                    break;
                }
            }
            if(usernamePresent)
            {
                window.location.href="travelMode.html"
            }
            else{
                $('#error').text("username and password doesnot match")
            } 
        }
        })  
        
    });
});