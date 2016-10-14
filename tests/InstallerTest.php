<?php
use PHPUnit\Framework\TestCase;

class InstallerTest extends TestCase{

    var $settings;


    public function setUp(){
        $this->settings = parse_ini_file("settings.ini", TRUE);
    }

    public static function tearDownAfterClass(){
        //borrar la base de datos
    //    echo "revirtiendo .....".PHP_EOL;
/*
        $settings = parse_ini_file("settings.ini", TRUE);

        $pdo = new PDOFromInit($settings);
        $statement = $pdo->prepare("drop table fake ");
        try{
            $statement->execute();
        }catch(PDOException $e) {
            die('SQL exeption');
        }*/
    }

    public function testCreateEntity(){


        $a = new Installer($this->settings);
        $result = $a->installEntity("model/fake.entity.json");
        $this->assertTrue($result == "create" || $result = "update");
        print($result.PHP_EOL);
        //$this->expectOutputString("exito: al crear la tabla ".PHP_EOL);


        //echo "asdals";


    }




}

?>
