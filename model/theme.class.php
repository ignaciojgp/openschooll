<?php
    
    include_once("../core/sqlconnection.class.php");
    include_once("lesson.class.php");
    
    class ModelTheme extends sqlconnection{
        
        const TABLENAME="theme";
        const COL_ID="id";
        const COL_NAME = "name";
        const COL_CREATED_AT = "createdAt";
        const COL_UPDATED_AT = "updatedAt";
        const COL_ENABLED = "enabled";
       
        const LOCALE_CONTENT_TABLE="content";
        const LC_COL_ID_CONTAINER="id_container";
        const LC_COL_ID_CONTENTKIND="id_contentKind";
        const LC_COL_LANG="lang";
        const LC_COL_TITLE="title";
        const LC_COL_DESCRIPTION="description";
        const LC_COL_ENABLED="enabled";
        
        
        
        
        public function __construct($file = '../settings.ini'){
            
            
            
            parent ::__construct(self::TABLENAME,array(),$file);
            
            
        }
        
        public function get($id, $lang = "ES"){
            $query = 'SELECT '
                    .self::TABLENAME.'.'.self::COL_ID.', '
                    .self::TABLENAME.'.'.self::COL_NAME.', '
                    .self::TABLENAME.'.'.self::COL_ENABLED.', '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_TITLE.','
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_DESCRIPTION.''
                    
                    .' FROM '.self::TABLENAME                    
                    .' RIGHT JOIN '.self::LOCALE_CONTENT_TABLE.' ON '
                    
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ID_CONTAINER.' = '.self::TABLENAME.'.'.self::COL_ID
                    .' and '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_LANG.' = "'.$lang.'" '
                    .' and '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ID_CONTENTKIND.' = 1 '
                    
                    .' WHERE '.self::TABLENAME.'.'.self::COL_ID.' = '.$id.' LIMIT 1';
            
           
            $sth = $this->prepare($query);
        
            $sth->execute();
            
            
            $rows = $sth->fetch();
            
            
            
            if($rows != null){
                
                $db2 = new ModelLesson($this->settings);
                
                
                $lessons = $db2->getLessonsEnabledByLang($id,$lang);
               
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
                    .self::TABLENAME.'.'.self::COL_NAME.', '
                    .self::TABLENAME.'.'.self::COL_ENABLED.', '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_TITLE.','
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_DESCRIPTION.''
                    
                    .' FROM '.self::TABLENAME                    
                    .' RIGHT JOIN '.self::LOCALE_CONTENT_TABLE.' ON '
                    
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ID_CONTAINER.' = '.self::TABLENAME.'.'.self::COL_ID
                    .' and '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_LANG.' = "'.$lang.'" '
                    .' and '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ID_CONTENTKIND.' = 1 '
                    
                    .' WHERE '.self::TABLENAME.'.'.self::COL_ENABLED.' =  1 ';
            
           
            $sth = $this->prepare($query);
        
            $sth->execute();
            
            
            $rows = $sth->fetchAll();
            
            
            
            if($rows != null){
                
                return Array("code"=>200,"message"=>$rows);
            }else{
                return Array("code"=>404,"message"=>null);
            } 
            
        }
        
        
        
        
    }
    
    
?>