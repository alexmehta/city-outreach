create table if not exists users
(
	id int auto_increment,
	email varchar(500) null,
	password varchar(255) not null,
	dob datetime null,
	address1 text null,
	address2 text null,
	city varchar(500) null,
	state varchar(50) null,
	zip int null,
	constraint users_email_uindex
		unique (email),
	constraint users_id_uindex
		unique (id)
);

alter table users
	add primary key (id);

