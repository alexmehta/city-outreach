create table if not exists upcomingevents
(
	id int auto_increment
		primary key,
	name varchar(1000) null,
	date varchar(800) null,
	time varchar(3333) null,
	location text null,
	presentations text null,
	documents text null,
	officalmin text null,
	tag varchar(423) null,
	deleteable tinyint(1) default 1 null comment 'check if other events are being used with this'
)
comment 'upcoming events database';

