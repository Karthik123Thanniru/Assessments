$(document).ready(function () {
    var encodedData = decodeURIComponent(window.location.search.substr(1).split('=')[1]);
    var response = JSON.parse(encodedData);
    console.log(response)
    displayResponseData(response);
});
function displayResponseData(response) {
    var trainData = response;
    var container = $("#trainDataContainer");
    container.empty();
    if (trainData.length > 0) {
        $.each(trainData, function (index, train) {
            var trainDiv = $("<div></div>").addClass("train");
            trainDiv.append($("<p></p>").text("Bus Number: " + train.bus_no));
            trainDiv.append($("<p></p>").text("From: " + train.destination_from));
            trainDiv.append($("<p></p>").text("To: " + train.destination_to));
            trainDiv.append($("<p></p>").text("Timings: " + train.timings));
            var bookNowButton = $("<button></button>").text("Book Now");
            bookNowButton.click(function () {
                window.location.href = "busBooking.html?bus_no=" + encodeURIComponent(train.bus_no);
            });
            trainDiv.append(bookNowButton);
            container.append(trainDiv);
        });
    } else {
        container.text("No Buses details found for the given departure and destination.");
    }
}