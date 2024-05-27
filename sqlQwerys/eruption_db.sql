use eruption

CREATE TABLE admin_users
( user_id int identity(1,1) Primary key,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  user_password varchar(255) NOT NULL
  );

  select * from admin_users

  drop table admin_users

  insert into admin_users (username, email, user_password) values ('Oscar', 'oscarortiz016ags@gmail.com', 'P@ssw0rd')
