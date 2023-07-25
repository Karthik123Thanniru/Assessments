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
        var newPassword = $("#newPassword").val();
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

        if (newPassword.trim() === "") {
            $("#newPassword-error").text("New Password is required.");
            isValid = false;
        } else if (!passwordRegex.test(newPassword)) {
            $("#newPassword-error").text("New Password must contain at least one uppercase letter, one special character, one number, and be at least 6 characters long.");
            isValid = false;
        } else if (password !== newPassword) {
            $("#newPassword-error").text("Password and New Password must be the same.");
            isValid = false;
        }
        $.ajax({
                url: "http://localhost/test/BackEndPhp/dataDisplay.php",
                success:function(response) {
                    var data = JSON.parse(response); 
                    var usernamePresent = false;
                    for(var i = 0; i < data.length; i++) {
                        if(data[i].username === username) {
                            usernamePresent = true;
                            break;
                        }
                    }
                    if(usernamePresent) {
                        $("#username-error").text("Username already exists");
                        isValid = false;
                    } 
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        if (isValid) {
            $.ajax({
                url: "http://localhost/test/BackEndPhp/registeredDetails.php",
                type: "POST",
                data: {
                    username: username,
                    password: password,
                    newPassword: newPassword
                },
                dataType: "json",
                success: function(response) {
             if (response.status === "success") {
                window.location.href = "travelMode.html";
                console.log("New record created successfully");
            }
            else if (response.status === "error") {
                    console.log(response.message); 
                }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
                
            });
        } 
    });

});