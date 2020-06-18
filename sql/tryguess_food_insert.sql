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
  
