create table if not exists upcomingevents
(
	id int auto_increment
		primary key,
	name varchar(1000) null,
	date varchar(200) null,
	time varchar(3333) null,
	location text null,
	presentations text null,
	documents text null,
	officalmin text null,
	tag varchar(423) null
)
comment 'upcoming events database';

