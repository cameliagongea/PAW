<?php

class Request extends Model
{
    public function getRequests()
    {

        $sth = $this->db->prepare("SELECT * FROM request");

        $sth->execute();
        $requests = $sth->fetchAll();
        if(!empty($requests))
        {
            return $requests;
        }

        return array();
    }

    public function insertRequest($requestName, $description, $email)
    {

        $date = date('Y-m-d H:i:s');
        $statement = $this->db->prepare("INSERT INTO request(restaurantName, restaurantDescription, email, requestStatus, requestDate) VALUES (?, ?, ?, ?, ?)");
        $statement->execute(array($requestName, $description, $email, 3, $date));
    }

    public function updateRequest($id,$action)
    {
        $status = 3;
        if($action == 'true')
            $status = 1;
        else
            $status = 0;
        $statement = $this->db->prepare("
                              UPDATE request 
                              SET requestStatus = $status WHERE id = '$id'");
        var_dump($statement);
        $statement->execute();
    }
}