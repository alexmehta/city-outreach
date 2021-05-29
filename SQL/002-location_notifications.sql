create table if not exists location_notifications
(
	id int auto_increment,
	sent tinyint(1) default 0 null,
	event_id int null comment 'event user is getting email for
',
	time_sent datetime null,
	user_id int null,
	constraint location_notifications_id_uindex
		unique (id)
)
comment 'Logs when an email was sent, and the details.';

alter table location_notifications
	add primary key (id);

