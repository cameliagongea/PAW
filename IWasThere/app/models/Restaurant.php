<?php

class Restaurant extends Model
{
    public $restaurantName;

    public function getRestaurants($byName = '')
    {
        if($byName == '')
        {
            $sth = $this->db->prepare("SELECT * FROM restaurant");
        }
        else
        {
            $sth = $this->db->prepare("SELECT * FROM restaurant WHERE restaurantName LIKE '%$byName%'");
        }

        $sth->execute();
        $restaurants = $sth->fetchAll();
//        var_dump($restaurants);
        if(!empty($restaurants))
        {
            return $restaurants;
        }

        return array();
    }

    public function insertRestaurant($restaurantName, $category, $rating, $link)
    {
        //var_dump($id);
        $statement = $this->db->prepare("INSERT INTO restaurant(restaurantName, description, rating, link) VALUES (?, ?, ?, ?)");
        $statement->execute(array($restaurantName, $category, $rating, $link));
    }

    public function deleteRestaurant($id)
    {
        $statement = $this->db->prepare("DELETE FROM restaurant WHERE id = '$id'");
        $statement->execute();
    }

    public function updateRestaurant($id, $restaurantName, $rating, $category, $link)
    {
        $statement = $this->db->prepare("
                              UPDATE restaurant 
                              SET restaurantName = '$restaurantName', rating = '$rating', link = '$link', description = '$category'  WHERE id = '$id'");
//        var_dump($statement);
//        die("*_*");
        $statement->execute();
    }

    public function getRestaurantByNr($id)
    {
        $statement = $this->db->prepare("SELECT * FROM restaurant where id = '$id'");
        $statement->execute();
        $data = $statement->fetchAll();
       // print_r($data);
        return(array('id' => $data[0]['id'],
            'restaurantName' => $data[0]['restaurantName'],
            'rating' => $data[0]['rating'],
            'description' => $data[0]['description'],
            'link' => $data[0]['link']));
    }

}