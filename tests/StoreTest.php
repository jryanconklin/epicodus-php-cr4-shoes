<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__."/../inc/ConnectionTest.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $id = 1;
            $name = "Fred Meyer";
            $store = new Store($name, $id);

            //Act
            $result = $store->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_getName()
        {
            //Arrange
            $id = 1;
            $name = "Fred Meyer";
            $store = new Store($name, $id);

            //Act
            $result = $store->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_setName()
        {
            //Arrange
            $id = 1;
            $name = "Fred Meyer";
            $store = new Store($name, $id);

            $new_name = "Ted Meyer";

            //Act
            $store->setName($new_name);
            $result = $store->getName();

            //Assert
            $this->assertEquals($new_name, $result);
        }

        function test_save()
        {
            //Arrange
            $id = null;
            $name = "Fred Meyer";
            $store = new Store($name, $id);

            //Act
            $store->save();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$store], $result);
        }

        function test_getAll()
        {
            //Arrange
            $id = null;
            $name = "Fred Meyer";
            $store = new Store($name, $id);
            $store->save();

            $id2 = null;
            $name2 = "Ted Meyer";
            $store2 = new Store($name2, $id2);
            $store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$store, $store2], $result);
        }

        function test_findById()
        {
            //Arrange
            $id = null;
            $name = "Fred Meyer";
            $store = new Store($name, $id);
            $store->save();

            $id2 = null;
            $name2 = "Ted Meyer";
            $store2 = new Store($name2, $id2);
            $store2->save();

            //Act
            $search_id = $store->getId();
            $result = Store::findById($search_id);

            //Assert
            $this->assertEquals($store, $result);
        }

        function test_update()
        {
            //Arrange
            $id = null;
            $name = "Fred Meyer";
            $store = new Store($name, $id);
            $store->save();

            $id2 = null;
            $name2 = "Ted Meyer";
            $store2 = new Store($name2, $id2);
            $store2->save();

            //Act
            $new_name = "Target";
            $store->setName($new_name);
            $store->update();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$store, $store2], $result);
        }



//End Test
    }
?>
