$(document).ready(function () {
    toggleFields();
    $("#Type").change(function () {
        toggleFields();
    });
});

function toggleFields() {
    if ($("#Type").val() === "location")
        $("#location").show();
    else
        $("#location").hide();

    if ($("#Type").val() === "vente")
        $("#vente").show();
    else
        $("#vente").hide();
}