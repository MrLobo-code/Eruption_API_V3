use erution

CREATE TABLE admin_users
( user_id int identity(1,1) Primary key,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  user_password varchar(255) NOT NULL
  );

  select * from Products

  drop table Products

  insert into admin_users (username, email, user_password) values ('Oscar', 'oscarortiz016ags@gmail.com', 'P@ssw0rd')

  CREATE TABLE Products (
    id INT PRIMARY KEY IDENTITY(1,1),
    ProductName NVARCHAR(100) NOT NULL,
    productDescription NVARCHAR(MAX) NULL,
    CategoryID INT NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    Stock INT NOT NULL,
    SKU NVARCHAR(50) NOT NULL,
    Brand NVARCHAR(50) NULL,
    Product DECIMAL(10, 2) NULL,
    Dimensions NVARCHAR(50) NULL,
    Color NVARCHAR(50) NULL,
    Size NVARCHAR(50) NULL,
    /*ImageURL NVARCHAR(255) NULL,*/
    ThumbnailURL NVARCHAR(255) NULL,
    CreatedDate DATETIME DEFAULT GETDATE(),
    ModifiedDate DATETIME DEFAULT GETDATE(),
    IsActive BIT DEFAULT 1
);
