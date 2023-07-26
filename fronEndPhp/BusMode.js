$(document).ready(function () {
    $.ajax({
        url: "http://localhost/test/BackEndPhp/busMode.php",
        dataType: "json",
        success: function (data) {
            var destination = data.destination;
            populateSelectOptions("departure", destination);
            populateSelectOptions("destination", destination);
        },
        error: function (xhr, status, error) {
            console.log("Error:", error);
        }
    });
    function populateSelectOptions(selectId, options) {
        var select = $("#" + selectId);
        $.each(options, function (index, value) {
            select.append($("<option></option>")
                .attr("value", value)
                .text(value));
        });
    }
    $("form").on("submit", function (e) {
        e.preventDefault();
        var departureValue = $("#departure").val();
        var destinationValue = $("#destination").val();
        var dateValue = new Date($("#selectDate").val());
        var currentTime = new Date();
        var valid = false;
        if (departureValue === destinationValue) {
            alert("Departure and Destination cannot be the same.");
        } else {
            if (dateValue < currentTime) {
                alert("Please choose a date in the future.");
            } else {
                valid = true;
                console.log("Departure: " + departureValue);
                console.log("Destination: " + destinationValue);
                console.log("Date: " + dateValue);
                var day = dateValue.getDay();
                console.log(day)
                $.ajax({
                    url: "http://localhost/test/BackEndPhp/busTraveller.php",
                    method: "POST",
                    data: {
                        departure: departureValue,
                        destination: destinationValue,
                        currentTime: dateValue
                    },
                    success: function (response) {
                        if (response.length > 0) {
                            console.log(response)
                            var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                            var day = days[dateValue.getDay()]
                            console.log(day)
                            var filteredData = response.filter(function (item) {
                                return item.days.toLowerCase().split(',').includes(day.toLowerCase());
                            });
                            redirectWithData(filteredData);
                        } else {
                            redirectWithData(response)
                        }

                        console.log(response)
                    },
                    error: function (xhr, status, error) {
                        console.log("Error:", error);
                        console.log("Status: ", status);
                    }
                });
            }

            function redirectWithData(response) {
                console.log(response)
                var encodedResponse = JSON.stringify(response);
                var encodedUriComponent = encodeURIComponent(encodedResponse);
                console.log(encodedUriComponent)
                var redirectUrl = "busTraveller.html?data=" + encodedUriComponent;
                window.location.href = redirectUrl;
            }
        }
    });
});