<?php

    class Brand
    {
//Properties
        private $id;
        private $name;

//Constructor
        function __construct($name, $id = null)
        {
            $this->id = $id;
            $this->name = $name;
        }

//Getter and Setter Methods
        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

//Regular Methods
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update()
        {

        }

        function delete()
        {

        }

        function getJoinList()
        {

        }

        function addJoinList()
        {

        }

        function deleteFromJoinList()
        {

        }

        function deleteAllJoinList()
        {

        }

//Static Methods
        function getAll()
        {
            $brands = array();
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");

            foreach($returned_brands as $brand) {
                $id = $brand['id'];
                $name = $brand['name'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        function findById()
        {

        }

//End Class
    }
?>
