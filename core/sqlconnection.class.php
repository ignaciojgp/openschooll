<?php
abstract class sqlconnection extends PDO
{
    public $tableName;
    public $tablecolumns=array();
    public $settings ="";
    
    public function __construct($tablename,$cols,$file = '../settings.ini')
    {
        $this->settings = $file;
        
        $this->tableName=$tablename;
        $this->tablecolumns=$cols;
        
       
        
        if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');
        
        $dns = $settings['dbconnection']['driver'] . ':host=' . $settings['dbconnection']['host'] .
        ((!empty($settings['dbconnection']['port'])) ? (';port=' . $settings['dbconnection']['port']) : '') .
        ';dbname=' . $settings['dbconnection']['database'];
        
        parent::__construct($dns, $settings['dbconnection']['user'], $settings['dbconnection']['pass']);
        
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND,"SET NAMES utf8");
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->query( 'SET CHARACTER SET utf8' );
    }
    
    public function getAll(){
        
        $sth = $this->prepare('SELECT * FROM '.$this->tableName);
        
        $sth->execute();
        
        return $sth->fetchAll();
    }
    
    
    public function count(){
        
        $sth = $this->prepare('SELECT count(*) FROM '.$this->tableName);
        
        $sth->execute();
        
        return $sth->fetch()[0];
    }
    
}
?>