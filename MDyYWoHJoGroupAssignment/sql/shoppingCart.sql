DROP DATABASE IF EXISTS Project01;

CREATE DATABASE Project01;

USE Project01;

CREATE TABLE Customer (
    CustomerID INT AUTO_INCREMENT NOT NULL,
    FirstName VARCHAR(20) NOT NULL,
    LastName VARCHAR(20) NOT NULL,
    Address VARCHAR (50) NOT NULL,
    City VARCHAR (20) NOT NULL,
    Province VARCHAR (20) NOT NULL,
    Country VARCHAR (20) NOT NULL,
    Username VARCHAR (20) NOT NULL,
    Password VARCHAR(250) NOT NULL,
    PRIMARY KEY (CustomerID)
);

CREATE TABLE Orders (
    OrdersID INT AUTO_INCREMENT NOT NULL,
    Amt Float (8,2),
    Dates DATE NOT NULL,
    CustomerID INT NOT NULL,
    PRIMARY KEY (OrdersID),
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID)
);

CREATE TABLE Item (
    ItemID INT AUTO_INCREMENT NOT NULL,
    itemName VARCHAR(20) NOT NULL,
    itemDesc VARCHAR(20) NOT NULL,
    itemPrice FLOAT (8,2) NOT NULL,
    itemAvail BOOLEAN NOT NULL,
    PRIMARY KEY (ItemID)
);

CREATE TABLE OrdersItems (
    OrdersID INT NOT NULL,
    ItemID INT NOT NULL, 
    ItemQty INT NOT NULL,
    PRIMARY KEY (OrdersID,ItemID),
    FOREIGN KEY (OrdersID) REFERENCES Orders (OrdersID),
    FOREIGN KEY (ItemID) REFERENCES Item (ItemID)
);

CREATE TABLE Payments (
    PaymentID INT AUTO_INCREMENT NOT NULL,
    CustomerID INT NOT NULL,
    PaymentName VARCHAR (20) NOT NULL,
    PaymentNumber CHAR (14) NOT NULL,
    PRIMARY KEY (PaymentID),
    FOREIGN KEY (CustomerID) References Customer(CustomerID)
);