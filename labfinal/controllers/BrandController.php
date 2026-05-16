<?php

require_once "../config/database.php";
require_once "../models/Brand.php";

class BrandController {

    private $brand;

    public function __construct(){
        $db = new Database();
        $this->brand = new Brand($db->connect());
    }

    public function store(){

        if(isset($_POST['submit'])){

            $this->brand->create(
                $_POST['name'],
                $_POST['category_id']
            );

            echo "Brand Added";
        }
    }
}
?>