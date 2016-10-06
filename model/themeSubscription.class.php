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


	    $count = $this->query("SELECT COUNT(*) as res from theme where id = ".intval($idTheme) , PDO::FETCH_ASSOC)->fetch();


	   if($count['res'] > 0){

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
			    return Array("code"=>400,"message"=>'el usuario está subscrito al tema');
			}

		    }
	    }

	     return Array("code"=>400,"message"=>'no existe el tema');

        }


	public function find($idUser,$idTheme){


		$query = " SELECT count(*)  as res from userThemeSubscription where id_user = ? and id_theme = ?";


		try{

		        $sth = $this->prepare($query);
			$sth->execute([$idUser,$idTheme]);
			$count = $sth->fetch();

			if($count['res'] > 0){

				return Array("code"=>200,"message"=>'Está suscrito');

			}
		}catch(PDOException $ex){


			return Array("code"=>500,"message"=>$ex->errorInfo);

		}

		return Array("code"=>400,"message"=>'No está suscrito');

        }

	public function getStudents($idAuthor){

		$query = "select".
					" userthemesubscription.id_user, ".
					" user.email, ".
					" userinfo.name, ".
					" userinfo.genre, ".
					" userinfo.Age ".
					" ".
					" from themeauthor ".
					" right join userthemesubscription on userthemesubscription.id_theme = themeauthor.id_theme ".
					" left join user on user.id = userthemesubscription.id_user ".
                    " left join userinfo on user.id = userinfo.id_user".
				" where themeauthor.id_user = ? ".
				" group by user.id ";


		try{

		        $sth = $this->prepare($query);
			$sth->execute([$idAuthor]);
			$rows = $sth->fetchAll();

			if($rows){

				return Array("code"=>200,"message"=>$rows);

			}
		}catch(PDOException $ex){


			return Array("code"=>500,"message"=>$ex->errorInfo);

		}

		return Array("code"=>400,"message"=>'No está suscrito');
	}

    }


?>
