create table menuoption 
(
	id int(11) unsigned not null auto_increment,
	name varchar(128) not null,
	id_role int(11) unsigned,
	
	primary key (id)
)