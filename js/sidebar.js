$(document).ready(function () {
    $("ul#months li.month").click(function () {
        $(this).next('ul.posts').toggle();
    });
    $("input#searchBar").keypress(function (e) {
        if (e.which == 13) {
            $("ul#searchResults").show();
            $("ul#searchResults").empty();
            var query = $("input#searchBar").val();
            $.ajax({
                url: "../controllers/Post?request=search&query=" + query, success: function (result) {
                    $("ul#searchResults").append(result);
                }
            });
        }
    });
    $('html').click(function () {
        $("ul#searchResults").hide();
    });
    $('ul#searchResults').click(function (event) {
        event.stopPropagation();
    });
});