create table if not exists notifications
(
	id int auto_increment,
	eventid int not null,
	sent tinyint(1) null,
	timesent datetime null,
	constraint notifications_id_uindex
		unique (id)
);

