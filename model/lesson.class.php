<?php
    
    include_once("../core/sqlconnection.class.php");
    
    class ModelLesson extends sqlconnection{
        
        const TABLENAME="lesson";
        const COL_ID="id";
        const COL_ID_THEME="id_theme";
        const COL_TITLE = "title";
        const COL_DESCRIPTION = "description";
        const COL_CONTENT = "content";
        const COL_CREATED_AT = "createdAt";
        const COL_UPDATED_AT = "updatedAt";
        const COL_ENABLED = "enabled";
        const COL_VALUE = "value";
        const COL_ORD = "ord";
       
       
        
        public function __construct($file = '../settings.ini'){
            
            parent ::__construct(self::TABLENAME,array(),$file);
            
        }
        
        public function getLessonsEnabled($idTheme){
            
            
            $query = 'SELECT '
			
			.self::COL_ID.", "
			.self::COL_TITLE.", "
			.self::COL_DESCRIPTION
			
		    .' FROM '.self::TABLENAME
                    
                    .' WHERE '.self::TABLENAME.'.'.self::COL_ID_THEME.' = '.$idTheme
                    .' AND '.self::TABLENAME.'.'.self::COL_ENABLED.' =  1 '
		    .' ORDER BY '.self::COL_ORD  ;
            
            //$query ='  SELECT * FROM '.self::TABLENAME.' WHERE '.self::TABLENAME.'.'.self::COL_ID_THEME.' = '.$idTheme .' AND '.self::TABLENAME.'.'.self::COL_ENABLED.' =  1 ';
        
           
            $sth = $this->prepare($query);
        
            $sth->execute();
            
            
            $rows = $sth->fetchAll();
            
            
            
            if($rows != null){
                
                return Array("code"=>200,"message"=>$rows);
            }else{
                return Array("code"=>404,"message"=>null);
            } 
            
        }
        
        
        public function get($idLesson){
            
			$query = 'SELECT * from lesson where id = ?';
            
            $sth = $this->prepare($query);
        
            $sth->execute([$idLesson]);
            
            $rows = $sth->fetch();
            
            
            
            if($rows != null){
            
            
                include_once('media.class.php');
                
                $db2 = new ModelMedia($this->settings);
            
                $media = $db2->getMediaEnabledByLang($idLesson);
            
                if($media['code']==200){
                    $rows['media']= $media['message'];
                }
            
                
                return Array("code"=>200,"message"=>$rows);
            }else{
                return Array("code"=>404,"message"=>null);
            } 
        }
        
        
    }
?>