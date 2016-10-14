<?php
use PHPUnit\Framework\TestCase;

class PDOFromInitTest extends TestCase{

  public function testCrearPDO(){
    $settings = parse_ini_file("settings.ini", TRUE);
    $a = new PDOFromInit($settings);

    $this->assertNotEmpty($a);



  }

}

?>
