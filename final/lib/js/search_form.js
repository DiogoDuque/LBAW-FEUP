$("#all_categories").click(function(event) {
    var cats = $(".category_checkbox");
    cats.prop("checked", true);
});

$("#no_categories").click(function(event) {
    var cats = $(".category_checkbox");
    cats.prop("checked", false);
});