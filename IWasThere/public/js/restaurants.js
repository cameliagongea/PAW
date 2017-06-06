
var base_url = "http://127.0.0.1:122";
function addRestaurant() {
    // get values
    var restaurantName = $("#restaurantName").val();
    var description = $("#description").val();
    var rating = $("#rating").val();
    var link = $("#link").val();
    var image = $("#image").val();
    console.log(image);

    console.log(restaurantName);
    var isOk = true;
    var message = "";

    if (restaurantName == "" || description == "")
    {
        message = "<strong>Restaurant Name</strong> and <strong>Description</strong> fields are mandatory! Please complete it! ";
        isOk = false;
    }
    $('#error_div').append("<div id='err-message' style='margin-left: 30px;'> </div>");
    var div = document.getElementById('err-message');
    div.innerHTML = div.innerHTML + message;

    setTimeout(function(){
        if ($('#err-message').length > 0) {
            $('#err-message').remove();
        }
    }, 5000);

    if(isOk)
    {
        $.post(base_url + "/IWasThere/public/restaurants/create/", {
            restaurantName: restaurantName,
            description: description,
            rating: rating,
            link: link
        }, function (data, status) {
            // close the popup
            $("#add_new_record_modal").modal("hide");
            console.log("in add");
            readRestaurants();

            // clear fields from the popup
            $("#restaurantName").val("");
            $("#description").val("");
            $("#rating").val("");
            $("#link").val("");
        });
    }
}

function DeleteRestaurant(id) {

    var conf = confirm("Are you sure, do you really want to delete this restaurant?");
    if (conf == true) {
        $.post(base_url + "/IWasThere/public/restaurants/delete/", {
                id: id
            },
            function (data, status) {
                readRestaurants();
            }
        );
    }
}

function readRestaurants() {
    var restaurantName = $("#search_restaurantName").val();

    if(restaurantName == "")
    {
        $.get( base_url + "/IWasThere/public/restaurants/rest/", {}, function (data, status) {
            $(".records_content").html(data);
        });
    }
    else
    {
        $.get(base_url + "/IWasThere/public/restaurants/rest/" + restaurantName, {
        }, function (data, status) {
            $(".records_content").html(data);
        });

    }

}

function GetRestaurantDetails(id) {

    $("#hidden_restaurant_id").val(id);
    $.post(base_url + "/IWasThere/public/restaurants/details/", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var restaurant = JSON.parse(data);
            console.log(restaurant);
            // Assigning existing values to the modal popup fields
            $("#update_restaurantName").val(restaurant.restaurantName);
            $("#update_category").val(restaurant.description);
            $("#update_rating").val(restaurant.rating);
            $("#update_link").val(restaurant.link);
        }
    );
    // Open moda popup
    $("#update_restaurant_modal").modal("show");
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
        $.post(base_url + "/IWasThere/public/restaurants/update/", {
                id: id,
                restaurantName: restaurantName,
                description: description,
                rating: rating,
                link: link
            },
            function (data, status) {
                // hide modal popup
                $("#update_restaurant_modal").modal("hide");
                readRestaurants();
            }
        );
    }

}

$(document).ready(function () {
    if($("#search_restaurantName").val() == "" )
    {
         readRestaurants();
    }


});