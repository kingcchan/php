<?php

// run command in server directory
// phpunit tests

class ServerTest extends PHPUnit_Framework_TestCase
{
    private $pid;

    protected function setUp()
    {
        exec("nohup php -S localhost:8081 server.php > /dev/null & echo $!", $op);
        $this->pid = (int)$op[0];
    }

    protected function tearDown()
    {
        $command = "kill -9 " . $this->pid;
        exec($command);
    }

    public function testCanAccess()
    {
        sleep(2);
        $data = file_get_contents("http://localhost:8081");
 
        // Assert
        $this->assertTrue(strpos($data, "<!DOCTYPE html>") !== false);
    }
}
?>
