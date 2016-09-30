<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__."/../inc/ConnectionTest.php";
    require_once __DIR__."/../src/FirstClass.php";
    require_once __DIR__."/../src/SecondClass.php";

    class ClassTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            FirstClass::deleteAll();
            SecondClass::deleteAll();
        }

        function test_someFunction()
        {
            //Arrange


            //Act


            //Assert


       }

//End Test
    }
?>
