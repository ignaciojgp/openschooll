select 
	
	userthemesubscription.id_user,
	user.email,
	count(userthemesubscription.id_user) as numcursos
	
	from themeauthor 
	left join userthemesubscription on userthemesubscription.id_theme = themeauthor.id_theme 
	left join user on user.id = userthemesubscription.id_user

where themeauthor.id_user = 3 
 group by userthemesubscription.id_user