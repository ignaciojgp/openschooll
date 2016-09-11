<?php
    
    include_once("../core/sqlconnection.class.php");
    include_once("lesson.class.php");
    
    class ModelTheme extends sqlconnection{
        
        const TABLENAME="theme";
        const COL_ID="id";
        const COL_NAME = "name";
        const COL_CREATED_AT = "createdAt";
        const COL_UPDATED_AT = "updatedAt";
        const COL_DESCRIPTION = "description";
        const COL_CONTENT = "content";
        const COL_LANG = "lang";
        const COL_ENABLED = "enabled";
       
        
        public function __construct($file = '../settings.ini'){
            
            
            
            parent ::__construct(self::TABLENAME,array(),$file);
            
            
        }
        
        public function get($id, $lang = "ES"){
            $query = 'SELECT '
                    .self::TABLENAME.'.'.self::COL_ID.', '
                    .self::TABLENAME.'.'.self::COL_NAME.', '
                    .self::TABLENAME.'.'.self::COL_ENABLED.', '
                    .self::TABLENAME.'.'.self::COL_DESCRIPTION.','
                    .self::TABLENAME.'.'.self::COL_CONTENT
                    
                    .' FROM '.self::TABLENAME                    
                    
                    .' WHERE '.self::TABLENAME.'.'.self::COL_ID.' = ? LIMIT 1';
            
           
            $sth = $this->prepare($query);
        
            $sth->execute(Array($id));
            
            
            $rows = $sth->fetch();
            
            
            
            if($rows != null){
                
                $db2 = new ModelLesson($this->settings);
                
                
                $lessons = $db2->getLessonsEnabled($id,$lang);
               
                if($lessons['code']== 200){ 
                
                    $rows['lessons'] = $lessons['message'];
                }
                
                return Array("code"=>200,"message"=>$rows);
            }else{
                return Array("code"=>404,"message"=>null);
            } 
            
        }
        
        public function getAllEnabledByLang($lang = "ES"){
            
	    
            
            $query = 'SELECT '
                    .self::TABLENAME.'.'.self::COL_ID.', '
                    .self::TABLENAME.'.'.self::COL_NAME
                    
                    .' FROM '.self::TABLENAME                    
                    
                    .' WHERE '.self::TABLENAME.'.'.self::COL_LANG.' like  ? ';
            
           
            $sth = $this->prepare($query);
        
            $sth->execute(Array($lang));
            
            
            $rows = $sth->fetchAll();
            
            
            
            if($rows != null){
                
                return Array("code"=>200,"message"=>$rows);
            }else{
                return Array("code"=>404,"message"=>null);
            } 
            
        }
        
        
        
        
    }
    
    
?>