create table if not exists upcomingevents
(
	id int auto_increment
		primary key,
	name varchar(1000) null,
	date varchar(800) null,
	time varchar(3333) null,
	location text null,
	pdf text null comment 'link to pdf
',
	tag varchar(423) null,
	deleteable tinyint(1) default 1 null comment 'check if other events are being used with this',
	`long` double null,
	lat double null,
	url text null,
	zoomlink varchar(5000) null
)
comment 'upcoming events database';

