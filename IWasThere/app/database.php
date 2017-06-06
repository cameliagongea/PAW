<?php

class Database extends PDO
{
    public function __construct()
    {
        try{
            parent::__construct(
                'mysql:host=127.0.0.1:3306;dbname=iwasthere;charset=utf8',
                'root',
                ''
            );

            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e)
        {
            echo 'Connection failed' . $e->getMessage();
        }

    }
}