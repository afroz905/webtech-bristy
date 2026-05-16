<?php

require_once "../config/database.php";
require_once "../models/Category.php";

class CategoryController {

    private $category;

    public function __construct(){
        $db = new Database();
        $this->category = new Category($db->connect());
    }

    public function store(){

        if(isset($_POST['submit'])){

            $name = $_POST['name'];
            $parent_id = $_POST['parent_id'] ?? null;

            $this->category->create($name, $parent_id);

            echo "Category Added";
        }
    }

    public function delete($id){
        $this->category->delete($id);
    }
}
?>