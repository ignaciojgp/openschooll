<?php
    
    include_once("../core/sqlconnection.class.php");
    
    class ModelLesson extends sqlconnection{
        
        const TABLENAME="lesson";
        const COL_ID="id";
        const COL_ID_THEME="id_theme";
        const COL_TITLE = "title";
        const COL_CREATED_AT = "createdAt";
        const COL_UPDATED_AT = "updatedAt";
        const COL_ENABLED = "enabled";
        const COL_VALUE = "value";
       
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
        
        public function getLessonsEnabledByLang($idTheme, $lang = "ES"){
            
            
            $query = 'SELECT '
                    .self::TABLENAME.'.'.self::COL_ID.', '
                    .self::TABLENAME.'.'.self::COL_TITLE.', '
                    .self::TABLENAME.'.'.self::COL_ENABLED.', '
                    .self::TABLENAME.'.'.self::COL_VALUE.', '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_TITLE.','
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_DESCRIPTION.''
                    
                    .' FROM '.self::TABLENAME                    
                    .' RIGHT JOIN '.self::LOCALE_CONTENT_TABLE.' ON '
                    
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ID_CONTAINER.' = '.self::TABLENAME.'.'.self::COL_ID
                    .' and '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_LANG.' = "'.$lang.'" '
                    .' and '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ID_CONTENTKIND.' = 3 '
                    .' and '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ENABLED.' = 1 '
                    
                    .' WHERE '.self::TABLENAME.'.'.self::COL_ID_THEME.' = '.$idTheme
                    .' AND '.self::TABLENAME.'.'.self::COL_ENABLED.' =  1 ';
            
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
        
        
        public function get($idLesson, $lang = "ES"){
            $query = 'SELECT '
                    .self::TABLENAME.'.'.self::COL_ID.', '
                    .self::TABLENAME.'.'.self::COL_TITLE.', '
                    .self::TABLENAME.'.'.self::COL_ENABLED.', '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_TITLE.','
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_DESCRIPTION.''
                    
                    .' FROM '.self::TABLENAME                    
                    .' RIGHT JOIN '.self::LOCALE_CONTENT_TABLE.' ON '
                    
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ID_CONTAINER.' = '.self::TABLENAME.'.'.self::COL_ID
                    .' and '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_LANG.' = "'.$lang.'" '
                    .' and '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ID_CONTENTKIND.' = 2 '
                    .' and '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ENABLED.' = 1 '
                    
                    .' WHERE '.self::TABLENAME.'.'.self::COL_ID.' = '.$idLesson
                    .' AND '.self::TABLENAME.'.'.self::COL_ENABLED.' =  1 ';
            
            //$query ='  SELECT * FROM '.self::TABLENAME.' WHERE '.self::TABLENAME.'.'.self::COL_ID_THEME.' = '.$idTheme .' AND '.self::TABLENAME.'.'.self::COL_ENABLED.' =  1 ';
        
        
        
           
            $sth = $this->prepare($query);
        
            $sth->execute();
            
            
            $rows = $sth->fetch();
            
            
            
            if($rows != null){
            
            
                include_once('media.class.php');
                
                $db2 = new ModelMedia($this->settings);
            
                $media = $db2->getMediaEnabledByLang($idLesson, $lang);
            
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