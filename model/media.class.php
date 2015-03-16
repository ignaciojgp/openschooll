<?php
    
    include_once("../core/sqlconnection.class.php");
    
    class ModelMedia extends sqlconnection{
        
        const TABLENAME="media";
        const COL_ID="id";
        const COL_ID_LESSON="id_lesson";
        const COL_MEDIA_KIND = "id_mediaKind";
        const COL_SRC = "src";
        const COL_DESCRIPTION = "description";
        const COL_ENABLED = "enabled";
        const COL_CSS = "css";
       
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
        
        public function getMediaEnabledByLang($idLesson, $lang = "ES"){
            
            
            $query = 'SELECT '
                    .self::TABLENAME.'.'.self::COL_ID.', '
                    .self::TABLENAME.'.'.self::COL_MEDIA_KIND.', '
                    .self::TABLENAME.'.'.self::COL_SRC.', '
                    .self::TABLENAME.'.'.self::COL_DESCRIPTION.', '
                    .self::TABLENAME.'.'.self::COL_CSS.', '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_TITLE.','
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_DESCRIPTION.' AS longDescription'
                    
                    .' FROM '.self::TABLENAME                    
                    .' LEFT JOIN '.self::LOCALE_CONTENT_TABLE.' ON '
                    
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ID_CONTAINER.' = '.self::TABLENAME.'.'.self::COL_ID
                    .' and '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_LANG.' = "'.$lang.'" '
                    .' and '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ID_CONTENTKIND.' = 5 '
                    .' and '
                    .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ENABLED.' = 1 '
                    
                    .' WHERE '.self::TABLENAME.'.'.self::COL_ID_LESSON.' = '.$idLesson
                    .' AND '.self::TABLENAME.'.'.self::COL_ENABLED.' =  1 ';
            
            //$query ='  SELECT * FROM '.self::TABLENAME.' WHERE '.self::TABLENAME.'.'.self::COL_ID_LESSON.' = '.$idTheme .' AND '.self::TABLENAME.'.'.self::COL_ENABLED.' =  1 ';
        
           
            $sth = $this->prepare($query);
        
            $sth->execute();
            
            
            $rows = $sth->fetchAll();
            
            
            
            if($rows != null){
                
                return Array("code"=>200,"message"=>$rows);
            }else{
                return Array("code"=>404,"message"=>null);
            } 
            
        }
        
        //
        //public function get($idLesson, $lang = "ES"){
        //    $query = 'SELECT '
        //            .self::TABLENAME.'.'.self::COL_ID.', '
        //            .self::TABLENAME.'.'.self::COL_TITLE.', '
        //            .self::TABLENAME.'.'.self::COL_ENABLED.', '
        //            .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_TITLE.','
        //            .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_DESCRIPTION.''
        //            
        //            .' FROM '.self::TABLENAME                    
        //            .' RIGHT JOIN '.self::LOCALE_CONTENT_TABLE.' ON '
        //            
        //            .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ID_CONTAINER.' = '.self::TABLENAME.'.'.self::COL_ID
        //            .' and '
        //            .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_LANG.' = "'.$lang.'" '
        //            .' and '
        //            .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ID_CONTENTKIND.' = 2 '
        //            .' and '
        //            .self::LOCALE_CONTENT_TABLE.'.'.self::LC_COL_ENABLED.' = 1 '
        //            
        //            .' WHERE '.self::TABLENAME.'.'.self::COL_ID.' = '.$idLesson
        //            .' AND '.self::TABLENAME.'.'.self::COL_ENABLED.' =  1 ';
        //    
        //    //$query ='  SELECT * FROM '.self::TABLENAME.' WHERE '.self::TABLENAME.'.'.self::COL_ID_LESSON.' = '.$idTheme .' AND '.self::TABLENAME.'.'.self::COL_ENABLED.' =  1 ';
        //
        //
        //
        //   
        //    $sth = $this->prepare($query);
        //
        //    $sth->execute();
        //    
        //    
        //    $rows = $sth->fetch();
        //    
        //    
        //    
        //    if($rows != null){
        //    
        //    
        //    
        //    
        //    
        //    
        //    
        //        
        //        return Array("code"=>200,"message"=>$rows);
        //    }else{
        //        return Array("code"=>404,"message"=>null);
        //    } 
        //}
        //
        
    }
?>