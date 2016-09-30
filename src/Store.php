<?php

    class Store
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
            $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE store_id = {$this->getId()};");
        }

        function getJoinList()
        {
            $results = $GLOBALS['DB']->query(
            "SELECT brands.* FROM stores
                JOIN stores_brands ON (stores_brands.store_id = stores.id)
                JOIN brands ON (brands.id = stores_brands.brand_id)
            WHERE stores.id = {$this->getId()};");
            $join_list = array();
            foreach ($results as $result) {
                $id = $result['id'];
                $name = $result['name'];
                $new_brand = new Brand($name, $id);
                array_push($join_list, $new_brand);
            }
            return $join_list;
        }

        function addJoinList($brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");
        }


//Static Methods
        static function getAll()
        {
            $stores = array();
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");

            foreach($returned_stores as $store) {
                $id = $store['id'];
                $name = $store['name'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        static function findById($search_id)
        {
            $stores = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$search_id};");
            foreach ($stores as $store) {
                $id = $store['id'];
                $name = $store['name'];
                $found_store = new Store($name, $id);
                return $found_store;
            }
        }



//End Class
    }
?>
