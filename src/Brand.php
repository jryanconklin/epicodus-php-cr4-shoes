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

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE brands SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
        }

        function getJoinList()
        {
            $results = $GLOBALS['DB']->query(
            "SELECT stores.* FROM brands
                JOIN stores_brands ON (stores_brands.brand_id = brands.id)
                JOIN stores ON (stores.id = stores_brands.store_id)
            WHERE brands.id = {$this->getId()};");
            $join_list = array();
            foreach ($results as $result) {
                $id = $result['id'];
                $name = $result['name'];
                $new_store = new Store($name, $id);
                array_push($join_list, $new_store);
            }
            return $join_list;
        }

        function addJoinList($store)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});");
        }

        function deleteFromJoinList()
        {

        }

        function deleteAllJoinList()
        {

        }

//Static Methods
        static function getAll()
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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        static function findById($search_id)
        {
            $brands = $GLOBALS['DB']->query("SELECT * FROM brands WHERE id = {$search_id};");
            foreach($brands as $brand) {
                $id = $brand['id'];
                $name = $brand['name'];
                $found_brand = new Brand($name, $id);
                return $found_brand;
            }
        }

//End Class
    }
?>
