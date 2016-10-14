<?php
class PDOFromInit extends PDO
{
    public $settings ="";

    public function __construct($s)
    {
        $this->settings = $s;

        $dns = $this->settings['dbconnection']['driver'] .':host=' . $this->settings['dbconnection']['host'] .((!empty($this->settings['dbconnection']['port'])) ? (';port=' .$this->settings['dbconnection']['port']) : '') . ';dbname=' . $this->settings['dbconnection']['database'];
        parent::__construct($dns, $this->settings['dbconnection']['user'],$this->settings['dbconnection']['pass']);

        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND,"SET NAMES utf8");
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->query( 'SET CHARACTER SET utf8' );
    }



}
?>
