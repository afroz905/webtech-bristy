<?php
class Database {
    public function connect(){
        return new PDO("mysql:host=localhost;dbname=computer_shop","root","");
    }
}