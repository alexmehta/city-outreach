create table if not exists notifications
(
	id int auto_increment,
	eventid int not null,
	userid int not null,
	sent tinyint(1) default 0 not null,
	constraint notifications_id_uindex
		unique (id)
);

alter table notifications
	add primary key (id);

