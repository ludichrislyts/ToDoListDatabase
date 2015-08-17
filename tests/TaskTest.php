<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Task.php";

$server = 'mysql:host=localhost;dbname=to_do_test';
$username = 'root';
$password = '';
$DB = new PDO($server, $username, $password);

class TaskTest extends PHPUnit_Framework_TestCase
{
    //delete to_do_test database
    protected function tearDown()
    {
        Task::deleteAll();
    }
    //test save function
    function test_save()
    {
        //Arrange
        $description = "Wash the dog";
        $test_task = new Task($description);

        //Act
        $test_task->save();

        //Assert
        $result = Task::getAll();
        $this->assertEquals($test_task, $result[0]);
    }
    //test getAll function
    function test_getAll()
    {
        //Arrange
        $description = "Wash the dog";
        $description2 = "Water the lawn";
        $test_task = new Task($description);
        $test_task->save();
        $test_task2 = new Task($description2);
        $test_task2->save();

        //Act
        $result = Task::getAll();

        //Assert
        $this->assertEquals([$test_task, $test_task2], $result);
    }
}
 ?>
