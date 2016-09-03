<?php
include_once("../core/sqlconnection.class.php");

class ModelMenu extends sqlconnection{
	
	const TABLENAME="menuoption";
	
	
	public function __construct($file = '../settings.ini'){
            
            parent ::__construct(self::TABLENAME,array(),$file);
            
        }	
	
	public function getMenuForUser($userEmail,$lang){
		
		$query = 'select 
				menuoption.id as option_id, 
				menuoption.name, 
				content.content as label
				
				
				
			from menuoption
				
				right join content on content.id_container  = menuoption.id
				left join userrole on menuoption.id_role = userrole.id_role
				left join user on userrole.id_user = user.id
				
				
			where user.email like ?
				
			order by menuoption.id_role';
			
			
		$sth = $this->prepare($query);
        
		$sth->execute(Array($userEmail));
		
		$rows = $sth->fetchAll();
            
		if($rows != null){
			return Array("code"=>200,"message"=>$rows);
		}else{
			return Array("code"=>404,"message"=>null);
		} 
		
	}
	
	
}

?>