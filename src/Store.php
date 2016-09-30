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
