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

        if (isValid) {
            $.ajax({
                type: "POST",
                url: "http://localhost/test/BackEndPhp/dataDisplay.php",
                data: {username: username, password: password},
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        window.location.href = "travelMode.html";
                    } else {
                        $('#error').text("Username and password do not match.");
                    }
                },
                error: function() {
                    $('#error').text("An error occurred during authentication.");
                }
            });
        }
    });
});
