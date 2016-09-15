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
                    .self::TABLENAME.'.'.self::COL_LANG.','
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
        
        public function save($id,$name, $description, $content, $lang){
		
		$queryInsert = "INSERT INTO ".self::TABLENAME." ("
				.self::COL_NAME.", "
				.self::COL_DESCRIPTION.", "
				.self::COL_CONTENT.", "
				.self::COL_LANG.", "
				.self::COL_UPDATED_AT
				." )
				values (?,?,?,?, CURRENT_TIMESTAMP)";
		
		$queryUpdate = "UPDATE ".self::TABLENAME." SET  "
						.self::COL_NAME." = ? ,  "
						.self::COL_DESCRIPTION." = ?  , "
						.self::COL_CONTENT." = ?  , "
						.self::COL_UPDATED_AT." = CURRENT_TIMESTAMP  "
						." WHERE id = ? "; 
		
		$paramsInser = [$name, $description, $content, $lang];
		$paramsUpdate = [$name, $description, $content, $id];
		
		
		
		 $sth = $this->prepare($id == null ? $queryInsert : $queryUpdate );
        
		 $sth->execute($id == null ? $paramsInser : $paramsUpdate);
		    
		    
		 $rows = $sth->fetchAll();
		    
		  $retid = $this->lastInsertId();
		  
	
		    
		if($retid != 0 && $id == null){
		
			return Array("code"=>200,"insertedId"=>$retid);
			
		}else if($id != null){
		      
			return Array("code"=>200,"message"=>"updated");
		      
		}else{
		      
			return Array("code"=>404,"message"=>null);
		} 
		    
		
		
	}
        
        
    }
    
    
?>