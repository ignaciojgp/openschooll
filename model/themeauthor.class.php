<?php
    
    include_once("../core/sqlconnection.class.php");
    include_once("lesson.class.php");
    
    class ModelThemeAuthor extends sqlconnection{
        
        const TABLENAME="themeauthor";
        const COL_ID="id";
        const COL_ID_USER = "id_user";
        const COL_ID_THEME = "id_theme";
        const COL_ROLE = "role";
       
        
        public function __construct($file = '../settings.ini'){
            
            
            
            parent ::__construct(self::TABLENAME,array(),$file);
            
            
        }
        
        public function getByUser($idUser){
		
            $query = 'select theme.id, theme.name, theme.createdAt, theme.enabled, theme.description from themeauthor left join theme on theme.id = themeauthor.id_theme where themeauthor.id_user = ?; ';
           
		
            $sth = $this->prepare($query);
            $sth->execute(Array($idUser));
            $rows = $sth->fetchAll();

			//para obtener lessons
			$ids = array_column($rows,'id');

			$lessonQuery = "select id, title, description, enabled, value, id_theme from lesson where id_theme in (".implode("," , $ids ).") ";
            $sth = $this->prepare($lessonQuery);
			
			
			$sth->execute();
			$lessons = $sth->fetchAll();
			
			foreach($rows as &$row){
				
				$row['lessons'] = [];
				
				foreach($lessons as &$lesson){
					
					if($lesson['id_theme'] == $row['id']){
						
						array_push($row['lessons'],$lesson); 
					} 
					
				}
				
			}
			
			
			
			
            if($rows != null){
                
                return Array("code"=>200,"message"=>$rows);
            }else{
                return Array("code"=>404,"message"=>null);
            } 
            
        }
	
	public function setCreatorToTheme($idUser,$idTheme){
		
		$query = "insert into themeauthor (id_user,id_theme,role) values (?,?,'creator'); ";
           
		
           
		$sth = $this->prepare($query);
		try{
		$sth->execute(Array($idUser, $idTheme));
            
            
		$lastId = $this->lastInsertId();
            
		
            
		    if($lastId != 0){
			return Array("code"=>200,"message"=>$lastId);
		    }else{
			return Array("code"=>404,"message"=>null);
		    } 
		    
		}catch( PDOException $Exception ) {
		    // Note The Typecast To An Integer!
		    // throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		    return Array("code"=>500,"message"=>$Exception->getMessage( ));
		}

	}
        
      
        
        
    }
    
    
?>