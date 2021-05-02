create table if not exists following
(
	id int auto_increment,
	userid int not null,
	tag varchar(500) null,
	constraint following_id_uindex
		unique (id)
);

alter table following
	add primary key (id);

