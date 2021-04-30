create table if not exists meetingminutes
(
	id int auto_increment
		primary key,
	name text null,
	tag varchar(200) null,
	event int not null
);

