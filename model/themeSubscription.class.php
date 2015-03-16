<?php
    
    include_once("../core/sqlconnection.class.php");
    
    
    class ModelThemeSubscription extends sqlconnection{
        
        const TABLENAME="userThemeSubscription";
        const COL_ID_USER="id_user";
        const COL_ID_THEME = "id_theme";
        const COL_CREATED_AT = "createdAt";
        const COL_STATUS = "status";
        
        
        public function __construct($file = '../settings.ini'){
            
            parent ::__construct(self::TABLENAME,array(),$file);
            
            
        }
        
        
        public function create($idUser,$idTheme){
            
            $query = 'INSERT INTO '.self::TABLENAME.' ('
                    .self::COL_ID_USER.', '
                    .self::COL_ID_THEME.', '
                    .self::COL_STATUS
                    .' ) VALUES ( '.$idUser.','.$idTheme.',1 )';
            
           
            $sth = $this->prepare($query);
            
            try{
                $sth->execute();
                    return Array("code"=>200,"message"=>'suscripcion agregada');                    
                
            }catch(PDOException $ex){
                if($ex->errorInfo[1] == 1062){
                    return Array("code"=>400,"message"=>'suscripcion duplicada');                    
                }
                
            }
            
        }
        
        
    }
    
    
?>