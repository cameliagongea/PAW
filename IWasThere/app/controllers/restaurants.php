<?php

class Restaurants extends Controller
{
    public function index()
    {
        $this->view('restaurants/index');
    }

    public function rest($restaurantName = '')
    {

        $restaurant =  $this->model('Restaurant');

        if($restaurantName == '')
        {
            $Restaurants = $restaurant->getRestaurants();
        }
        else
        {
            $Restaurants = $restaurant->getRestaurants($restaurantName);
        }

        session_start();

        if(!empty($Restaurants))
        {
            $data = '';
            foreach ($Restaurants as $restaurant) {
                $data  .= '<div class="col-sm-4 text-center">';
                for ($i= 0;  $i < $restaurant['rating']; $i++)
                          $data .= '<img src="../../../public/Photos/ratingPhoto.png" style ="horiz-align: center">';
                if($_SESSION['email'] != NULL)
                {
                    $data .='
                    <font color="#f0fff0"><i onclick="GetRestaurantDetails('.$restaurant['id'].')" class="fa fa-fw fa-pencil"></i></font>
                    <font color="#f0fff0"><i onclick="DeleteRestaurant('.$restaurant['id'].')" class="fa fa-fw fa-remove"></i></font>
                    ';
                }
                $data .='
                    <img class="img-responsive" src="../../../public/Photos/NotAvailable.png">
                    <h3><a href="' . $restaurant['link'] . '"><font weight="bold">' . $restaurant['restaurantName'] . '</font></a>
                    <small><font color="#f0fff0" weight="bold">' . $restaurant['description'] . '</small></font>
                    </h3>
                    </div>';
            }
        }
        else
        {
            $data = '<tr><td colspan="6"><font color="#f0fff0" weight="bold">No restaurant match your search query</font></td></tr>';
        }

        $data .= '</table>';

        echo $data;
    }

    public function create()
    {
        $restaurant =  $this->model('Restaurant');

        if( isset($_POST['restaurantName']) &&
            isset($_POST['description']) &&
            isset($_POST['rating']) &&
            isset($_POST['link'])
        )
        {
            var_dump($_FILES["file"]);
            var_dump($_POST);

            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

            $restaurant->insertRestaurant(
                $_POST['restaurantName'],
                $_POST['description'],
                $_POST['rating'],
                $_POST['link']
                );
        }
    }

    public function delete()
    {
        $restaurant = $this->model('Restaurant');

        if(isset($_POST['id']))
        {
            $restaurant->deleteRestaurant($_POST['id']);
        }
    }

    public function update()
    {
        $restaurant = $this->model('Restaurant');

        if( isset($_POST['id']) &&
            isset($_POST['restaurantName']) &&
            isset($_POST['rating']) &&
            isset($_POST['description']) &&
            isset($_POST['link'])
        )
        {
            $restaurant->updateRestaurant(
                $_POST['id'],
                $_POST['restaurantName'],
                $_POST['rating'],
                $_POST['description'],
                $_POST['link']
            );
        }
    }

    public function details()
    {
        $restaurant = $this->model('Restaurant');
        echo json_encode($restaurant->getRestaurantByNr($_POST['id']));
    }
}