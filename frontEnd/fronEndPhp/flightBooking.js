$(document).ready(function() {
    var trainNumber = getTrainNumberFromURL();
    if (trainNumber) {
        displayBookingDetails(trainNumber);
    }
    $("#bookingForm").submit(function(event) {
        event.preventDefault();
        var numberOfPersons = parseInt($("#numberOfPersons").val());
        var totalAmount = numberOfPersons * parseFloat($("#amount").text());
        $("#totalAmount").text("Total Amount: $" + totalAmount.toFixed(2));
    });
    $("#numberOfPersons").on("input", function() {
        var numberOfPersons = parseInt($(this).val());
        $("#personDetailsContainer").empty();

        for (var i = 1; i <= numberOfPersons; i++) {
            var personFields = $("<div></div>").addClass("person-fields");
            personFields.append($("<label>Name:</label>"));
            personFields.append($("<input type='text' name='name_" + i + "' required><br>"));
            personFields.append($("<label>Age:</label>"));
            personFields.append($("<input type='number' name='age_" + i + "' min='1' required><br>"));
            personFields.append($("<label>Contact Number:</label>"));
            personFields.append($("<input type='tel' name='contactNumber_" + i + "' pattern='[0-9]{10}' required><br><br>"));

            $("#personDetailsContainer").append(personFields);
        }
    });
});

function getTrainNumberFromURL() {
    var urlParams = new URLSearchParams(window.location.search);
    var trainNumber = urlParams.get("flight_no");
    return trainNumber;
}
function displayBookingDetails(trainNumber) {
    $.ajax({
        url: "http://localhost/test/practiceTest/flightBooking.php",
        type: "GET",
        data: { flight_no: trainNumber },
        dataType: "json",
        success: function(response) {
            if (response && response.length > 0) {
                var container = $("#bookingDetailsContainer");
                container.empty();
                var trainDiv = $("<div></div>").addClass("train");
                trainDiv.append($("<p></p>").text("Bus Number: " + response[0].flight_no));
                trainDiv.append($("<p></p>").text("Amount Per Person: $" + response[0].amount));
                container.append(trainDiv);
                container.append($("<p id='amount' style='display:none'>" + response[0].amount + "</p>"));
            } else {
                console.log("No data found for the given bus number.");
            }
        },
        error: function(xhr, status, error) {
            console.log("Error:", error);
        }
    });
}