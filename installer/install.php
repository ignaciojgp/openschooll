<?php
    header("Content-Type:text/plain");
    include("Installer.php");
    include("../core/PDOFromInit.php");

    echo "inicia prueba".PHP_EOL;
    $settings = parse_ini_file("../settings.ini", TRUE);


    $installer = new Installer($settings);
    $res = $installer->installEntity("../model/fake.entity.json");

    echo $res.PHP_EOL;

?>
