USE tryguess_food;

INSERT INTO College VALUES
  (1, 'Kolej Kediaman Astar (KK1)'),
  (2, 'Kolej Kediaman Tuanku Bahiyah (KK2)'),
  (3, 'Kolej Kediaman Tuanku Kursiah (KK3)'),
  (4, 'Kolej Kediaman Bestari (KK4)'),
  (5, 'Kolej Kediaman Dayasari (KK5)'),
  (6, 'Kolej Kediaman Ibnu Sina (KK6)'),
  (7, "Kolej Kediaman Za'ba (KK7)"),
  (8, 'Kolej Kediaman Kinabalu (KK8)'),
  (9, 'Kolej Kediaman Tun Syed Zahiruddin (KK9)'),
  (10, 'Kolej Kediaman Tun Ahmad Zaidi (KK10)'),
  (11, 'Kolej Kediaman Ungku Aziz (KK11)'),
  (12, 'Kolej Kediaman Raja Dr. Nazrin Shah (KK12)');

INSERT INTO Student VALUES
  (1, 'Amy','Ng', 'amypass', 'FSKTM',8),
  (2, 'Nur Aqiela','Rashdan', 'pass','FSKTM', 12),
  (3, 'Mohamad Ali','Rasyid', 'pass','FSKTM', 3),
  (4, 'Lee Wern','Poh', 'pass','FS', 2);

INSERT INTO Restaurant VALUES
  (1, 'Restauran Mohamad Ali bin Mohd Ibrahim','Local Food','0900-2300', 8),
  (2, 'Zaujan Cafe','Roti Canai/ Bakar' ,'1000-2400', 8),
  (3, 'Cafe 8884','Western Food', '0900-2300', 8);

INSERT INTO Food VALUES
  (1,1,'Burger Daging', 5.50),
  (2,1,'Nasi Ayam Tomato', 5.00),
  (3,1,'Nasi Goreng Pattaya', 4.50),
  (4,1,'Bubur Nasi Ayam', 4.00),
  (5,2,'Roti Canai Kosong', 1.00),
  (6,2,'Roti Canai Telur', 2.00),
  (7,2,'Roti Tisu', 2.50),
  (8,2,'Roti Canai Telur Bawang', 3.00),
  (9,2,'Roti Canai Boom', 2.50),
  (10,2,'Roti Bakar Kaya', 2.50),
  (11,1,'Bihun Goreng', 3.50),
  (12,1,'Maggi Goreng', 3.50),
  (13,1,'Maggi Goreng Special', 4.50),
  (14,1,'Nasi Lemak', 3.00);

  
INSERT INTO Food VALUES
  (15,3,'Chicken Chop With Black Pepper Sauce', 7.00),
  (16,3,'Chicken Chop With Chilli Sauce', 6.00),
  (17,3,'French Fries', 3.00),
  (18,3,'Fruit Salad', 6.00),
  (19,3,'Loaded Cheese Fries', 4.00),
  (20,3,'Macaroni', 5.00),
  (21,3,'Mandarin Orange Salad', 6.00),
  (22,3,'Mushroom soup', 3.50),
  (23,3,'Spaghetti Bolognese', 6.00),
  (24,3,'Spaghetti Carbonara', 6.00),
  (25,3,'Vegetable Salad', 6.00),
  (26,1,'Kuey Teow Goreng', 3.50),
  (27,1,'Kuey Teow Soup', 4.00),
  (28,1,'Maggi Tomyam Soup', 4.50);
  
  