$(document).ready(function() {
    var blocks = $(".block");
    var userDetails = localStorage.getItem("users");
    var clickedBlocks = localStorage.getItem("clickedBlocks");
    var clickedBlocksArray = [];
    var date = new Date();
    var time = date.getTime();

    if (clickedBlocks) {
        clickedBlocksArray = JSON.parse(clickedBlocks);
    }

    clickedBlocksArray.forEach(function(index) {
        blocks.eq(index).addClass("clicked");
    });

    blocks.on("click", function() {
        $(this).toggleClass("clicked");
        $("#timer").html("Your timing started now");

        var clickedBlocks = localStorage.getItem("clickedBlocks");
        var clickedBlocksArray = [];

        if (clickedBlocks) {
            clickedBlocksArray = JSON.parse(clickedBlocks);
        }

        var blockIndex = clickedBlocksArray.indexOf(blocks.index($(this)));

        if (blockIndex > -1) {
            clickedBlocksArray.splice(blockIndex, 1);
        } else {
            clickedBlocksArray.push(JSON.parse(userDetails));
            clickedBlocksArray.push(blocks.index($(this)));
            clickedBlocksArray.push(time);
        }

        localStorage.setItem("clickedBlocks", JSON.stringify(clickedBlocksArray));
    });
});
