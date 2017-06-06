
var base_url = "http://127.0.0.1:122";
function addUser() {
    // get values
    var firstName = $("#firstName").val();
    var lastName = $("#lastName").val();
    var email = $("#email").val();


    $.post(base_url + "/IWasThere/public/users/create/", {
        firstName: firstName,
        lastName: lastName,
        email: email
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");
        console.log("in add");
        readUsers();

        // clear fields from the popup
        $("#firstName").val("");
        $("#lastName").val("");
        $("#email").val("");
    });
}

function readUsers() {
    var userName = $("#search_userName").val();

    if(userName == "")
    {
        $.get( base_url + "/IWasThere/public/users/usr/", {}, function (data, status) {
            $(".records_content").html(data);
        });
    }
    else
    {
        $.get(base_url + "/IWasThere/public/users/usr/" + userName, {
        }, function (data, status) {
            $(".records_content").html(data);
        });

    }

}

function DeleteUser(id) {

    var conf = confirm("Are you sure, do you really want to delete this user?");
    if (conf == true) {
        $.post(base_url + "/IWasThere/public/users/delete/", {
                id: id
            },
            function (data, status) {
                readUsers();
            }
        );
    }
}

function GetUserDetails(id) {

    $("#hidden_user_id").val(id);
    $.post(base_url + "/IWasThere/public/users/details/", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var restaurant = JSON.parse(data);
            console.log(restaurant);
            // Assigning existing values to the modal popup fields
            $("#update_firstName").val(user.firstName);
            $("#update_lastName").val(user.lastName);
            $("#update_email").val(user.email);
        }
    );
    // Open moda popup
    $("#update_user_modal").modal("show");
}


function UpdateRestaurantDetails() {
    // get values
    var blnOk = true;
    var restaurantName = $("#update_restaurantName").val();
    var description = $("#update_category").val();
    var rating = $("#update_rating").val();
    var link = $("#update_link").val();


    // get hidden field value
    var id = $("#hidden_restaurant_id").val();

// Update the details by requesting to the server using ajax
    if(blnOk)
    {
        $.post(base_url + "/IWasThere/public/users/update/", {
                id: id,
                firstName: firstName,
                lastName: lastName,
                email: email
            },
            function (data, status) {
                // hide modal popup
                $("#update_user_modal").modal("hide");
                readUsers();
            }
        );
    }

}

$(document).ready(function () {
    if($("#search_fistName").val() == "" )
    {
        readUsers();
    }


});