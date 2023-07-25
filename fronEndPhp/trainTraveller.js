 $(document).ready(function() {
            var encodedData = decodeURIComponent(window.location.search.substr(1).split('=')[1]);
            var response = JSON.parse(encodedData);
            displayResponseData(response);
        });
        function displayResponseData(response) {
            var trainData = response;
            var container = $("#trainDataContainer");
            container.empty();
            if (trainData.length > 0) {
                $.each(trainData, function(index, train) {
                    var trainDiv = $("<div></div>").addClass("train");
                    trainDiv.append($("<p></p>").text("Train Number: " + train.train_no));
                    trainDiv.append($("<p></p>").text("From: " + train.destination_from));
                    trainDiv.append($("<p></p>").text("To: " + train.destination_to));
                    trainDiv.append($("<p></p>").text("Timings: " + train.timings));      
                    var bookNowButton = $("<button></button>").text("Book Now");
                    bookNowButton.click(function() {
                        window.location.href = "trainBooking.html?train_no=" + encodeURIComponent(train.train_no);
                      });
                    trainDiv.append(bookNowButton);
                    container.append(trainDiv);
                });
            } else {
                container.text("No train details found for the given departure and destination.");
            }
}