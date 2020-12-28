$(document).ready(function() {
    //-- Click on QUANTITY
    $(".btn-minus").on("click", function() {
        var now = $(".section > div > input").val();
        if ($.isNumeric(now)) {
            if (parseInt(now) - 1 > 0) { now--; }
            $(".section > div > input").val(now);
        } else {
            $(".section > div > input").val("1");
        }
    });
    $(".btn-plus").on("click", function() {
        var now = $(".section > div > input").val();
        if ($.isNumeric(now)) {
            $(".section > div > input").val(parseInt(now) + 1);
        } else {
            $(".section > div > input").val("1");
        }
    });
})


//Click on preview picture
function myFunction(imgs) {
    // Get the expanded image
    var expandImg = document.getElementById("expandedImg");
    // Use the same src in the expanded image as the image being clicked on from the grid
    expandImg.src = imgs.src;
    // Show the container element (hidden with CSS)
    expandImg.parentElement.style.display = "block";
};