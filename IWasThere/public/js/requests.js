var base_url = "http://127.0.0.1:122";

function readRequests() {

    $.get( base_url + "/IWasThere/public/requests/req/", {}, function (data, status)
    {
        $(".records_content").html(data);
    });
}

function addRequest() {
    // get values
    var restaurantName = $("#restaurantName").val();
    var description = $("#description").val();
    var email = $("#email").val();

    console.log("heree");
        $.post(base_url + "/IWasThere/public/requests/create/", {
            restaurantName: restaurantName,
            description: description,
            email: email
        }, function (data, status) {
            // close the popup

            // clear fields from the popup
            $("#restaurantName").val("");
            $("#description").val("");
            $("#email").val("");
        });

}
function ApproveRequest(id, approve) {

        $.post(base_url + "/IWasThere/public/requests/approve/", {
                id: id,
                approve: approve
            },
            function (data, status) {
                readRequests();
            }
        );

}

$(document).ready(function () {
    readRequests();
});

