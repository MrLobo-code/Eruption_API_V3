use test

CREATE TABLE admin_users
( user_id int identity(1,1) Primary key,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  user_password varchar(255) NOT NULL
  );


 select * from admin_users