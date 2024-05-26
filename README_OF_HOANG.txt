#SETUP TABLE IN PHP_MY_ADMIN

CREATE TABLE purchase_slip (
id INT AUTO_INCREMENT PRIMARY KEY,
supplier_name VARCHAR(255),
total_payment DECIMAL(10, 2),
payment_date DATE
);

CREATE TABLE suppliers (
id INT AUTO_INCREMENT PRIMARY KEY,
MaNCC VARCHAR(20) NOT NULL,
ten VARCHAR(255) NOT NULL,
diachi VARCHAR(255),
sdt VARCHAR(20)
);

CREATE TABLE purchase_products (
id INT AUTO_INCREMENT PRIMARY KEY,
purchase_code INT,
product_name VARCHAR(255),
unit_price DECIMAL(10, 2),
quantity INT,
total_price DECIMAL(10, 2),
FOREIGN KEY (purchase_code) REFERENCES purchase_slip(id)
);

CREATE TABLE products (
id INT AUTO_INCREMENT PRIMARY KEY,
product_name VARCHAR(255) NOT NULL,
price DECIMAL(10) NOT NULL,
quantity INT NOT NULL,
total_price DECIMAL(20) NOT NULL
);

INSERT INTO products (product_name, price, quantity) VALUES
('Laptop Dell XPS 13', 1500.00, 10),
('Tablet Samsung Galaxy Tab S7', 650.00, 15),
('Monitor LG UltraWide', 350.00, 30),
('Laptop HP Spectre x360', 1600.00, 8),
('Mouse Logitech MX Master 3', 100.00, 20),
('Keyboard Razer BlackWidow Elite', 200.00, 15);
