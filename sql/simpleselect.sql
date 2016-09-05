
select 
		menuoption.id as option_id, 
		menuoption.name, 
		content.content as label
		
		
		
	from menuoption
		
		right join content on content.id_container  = menuoption.id
		left join userrole on menuoption.id_role = userrole.id_role
		left join user on userrole.id_user = user.id
		
		
	where user.email like "'contacto@visualeaks.com'"
		
	order by menuoption.id_role