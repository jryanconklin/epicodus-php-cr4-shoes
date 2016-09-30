<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    // require_once __DIR__."/../inc/ConnectionTest.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Store::deleteAll();
        //     Brand::deleteAll();
        // }

        function test_getId()
        {
            //Arrange
            $id = 1;
            $name = "Fred Meyer";
            $store = new Store($name, $id);

            //Act
            $result = $store->getId();

            //Assert
            $this->assertEquals(1, $result);
        }




//End Test
    }
?>
