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

        }

        function deleteAll()
        {

        }

        function findById()
        {

        }

//End Class
    }
?>
