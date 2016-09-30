<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    // require_once __DIR__."/../inc/ConnectionTest.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    class BrandTest extends PHPUnit_Framework_TestCase
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
            $name = "Doc Martens";
            $brand = new Brand($name, $id);

            //Act
            $result = $brand->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_getName()
        {
            //Arrange
            $id = 1;
            $name = "Doc Martens";
            $brand = new Brand($name, $id);

            //Act
            $result = $brand->getName();

            //Assert
            $this->assertEquals($name, $result);
        }



//End Test
    }
?>
