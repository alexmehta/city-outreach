create table if not exists messages
(
	id int auto_increment,
	user int not null,
	event int not null,
	meeting_event int null,
	subject text null,
	message text null,
	constraint messages_id_uindex
		unique (id)
)
comment 'messages to admin';

alter table messages
	add primary key (id);

