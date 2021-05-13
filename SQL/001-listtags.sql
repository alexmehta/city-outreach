create table if not exists listtags
(
	id int auto_increment,
	tags varchar(300) null,
	constraint listtags_id_uindex
		unique (id),
	constraint listtags_tags_uindex
		unique (tags)
);

alter table listtags
	add primary key (id);

