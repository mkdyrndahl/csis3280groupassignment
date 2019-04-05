USE Project01;

INSERT INTO Customer (FirstName,LastName,Address,City,Province,Country,Username,Password) VALUES 
    ('Jared','Northway','357 Magnum Avenue','New Westminster','British Columbia','Canada','JNorthway','$2y$10$fqMxRBZIAimewAu1OKDqZOPLUDmVXb7HRRC8AoJFMoIjy9YV90HHe'),
    ('Barry','Bonds','123 Apples Street','Edmonton','Alberta','Canada','BBonds','$2y$10$a0j9bC.afxIjsWBreOXywurtcdVQ7de1xn8GJOuNuO7aDn7EE7yya'),
    ('Perry','Palbert','456 Puppy Street','Winnepeg','Manitoba','Canada','PPalbert','$2y$10$Sz9I4GB0XFz7BVa.6nkLg.d7c.TTC3jOJnafVBf8e3kA3EFLwBv9O');

INSERT INTO Item (itemName, itemDesc, itemPrice, itemAvail) VALUES
    ('Apples','Fruit',1.99,1),
    ('Bananas','Fruit',0.99,1),
    ('Oranges','Fruit',1.39,1),
    ('Carrots','Vegetable',3.99,1),
    ('Lettuce','Vegetable',3.49,1),
    ('Kale','Vegetable',2.49,1),
    ('Milk','Dairy',2.99,1),
    ('Cheese','Dairy',4.99,1),
    ('Cream','Dairy',4.99,1);

INSERT INTO Orders (CustomerID,Amt,Dates) VALUES 
    (1,19.90,20100101),
    (2,19.80,20200202),
    (3,41.70,20300303);

Insert INTO OrdersItems (OrdersID, ItemID, ItemName, ItemQty) VALUES
    (1,1,'Apples',10),
    (2,2,'Bananas',20),
    (3,3,'Oranges',30);

INSERT INTO Payments (CustomerID, PaymentName, PaymentNumber) VALUES 
    (1,'Visa','123-456-789'),
    (2,'American Express','987-654-321'),
    (3,'Capital One','192-837-465');