<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__."/../inc/ConnectionTest.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    class BrandTest extends PHPUnit_Framework_TestCase
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

        function test_setName()
        {
            //Arrange
            $id = 1;
            $name = "Doc Martens";
            $brand = new Brand($name, $id);

            $new_name = "Shock Martens";

            //Act
            $brand->setName($new_name);
            $result = $brand->getName();

            //Assert
            $this->assertEquals($new_name, $result);
        }

        function test_save()
        {
            //Arrange
            $id = 1;
            $name = "Doc Martens";
            $brand = new Brand($name, $id);

            //Act
            $brand->save();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$brand], $result);
        }

        function test_getAll()
        {
            //Arrange
            $id = null;
            $name = "Doc Martens";
            $brand = new Brand($name, $id);
            $brand->save();

            $id2 = null;
            $name2 = "Adidas";
            $brand2 = new Brand($name2, $id2);
            $brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$brand, $brand2], $result);
        }

        function test_findById()
        {
            //Arrange
            $id = null;
            $name = "Doc Martens";
            $brand = new Brand($name, $id);
            $brand->save();

            $id2 = null;
            $name2 = "Adidas";
            $brand2 = new Brand($name2, $id2);
            $brand2->save();

            //Act
            $search_id = $brand->getId();
            $result = Brand::findById($search_id);

            //Assert
            $this->assertEquals($brand, $result);
        }

        function test_update()
        {
            //Arrange
            $id = null;
            $name = "Doc Martens";
            $brand = new Brand($name, $id);
            $brand->save();

            $id2 = null;
            $name2 = "Adidas";
            $brand2 = new Brand($name2, $id2);
            $brand2->save();

            //Act
            $new_name = "Nike";
            $brand->setName($new_name);
            $brand->update();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$brand, $brand2], $result);
        }

        function test_delete()
        {
            //Arrange
            $id = null;
            $name = "Doc Martens";
            $brand = new Brand($name, $id);
            $brand->save();

            $id2 = null;
            $name2 = "Adidas";
            $brand2 = new Brand($name2, $id2);
            $brand2->save();

            //Act
            $brand->delete();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$brand2], $result);
        }


//End Test
    }
?>
