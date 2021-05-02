create table if not exists listtags
(
	id int not null,
	tags text null,
	constraint listtags_id_uindex
		unique (id)
);

alter table listtags
	add primary key (id);

