use eruption

select * from Oscar_cart
select * from admin_users
select * from someoneelse_cart
Select * from Products

drop table Products

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

insert into Products (
ProductName, 
productDescription, 
CategoryID, 
Price, 
Stock, 
SKU, 
Brand, 
Product, 
Dimensions, 
Color, 
Size, 
ThumbnailURL, 
CreatedDate, 
ModifiedDate, 
IsActive
) 
values(
'RG405V',
'Consola de videojuegos portátil, pantalla táctil IPS de 4 pulgadas, Android 12, T618, batería de 5500 mAh, 5G, Wi-Fi, Bluetooth, disipación automática de calor, 128 GB, 3154 juegos, RG405V, gris',
56,
3890.97,	
30,
'efgrjhry',
'Daxceirry',
 0,
'14,5 x 10,49 x 3,51 cm; 472 g',
'gris',
NULL,
NULL,
NULL,
NULL,
null
)

CREATE TABLE admin_users
( user_id int identity(1,1) Primary key,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  user_password varchar(255) NOT NULL
  );
