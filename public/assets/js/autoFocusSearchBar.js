$(document).on("keypress", function (e) {
    if (e.key === "/") {
        e.preventDefault();
        $("#q").focus();
    }
});
