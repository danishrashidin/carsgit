CREATE DATABASE cars;

USE cars;

CREATE TABLE College (
      College_ID INT UNSIGNED NOT NULL PRIMARY KEY,
      College_Name CHAR (50) NOT NULL
);

CREATE TABLE Student (
      Student_ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
      College_ID INT UNSIGNED NOT NULL,
      Full_Name varchar(255) NOT NULL,
      Matric_Number int(8) NOT NULL,
      Email varchar(255) DEFAULT NULL,
      Password_ varchar(255) NOT NULL,
      Activation_Hash varchar(255) NOT NULL,
      Verified tinyint(1) DEFAULT NULL,
      Faculty varchar(255) NOT NULL,
      IC varchar(255) NOT NULL,
      Phone_Number varchar(255) NOT NULL,
      Photo varchar(255) NOT NULL DEFAULT 'assets/user.png',
      reg_date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
      FOREIGN KEY (College_ID) REFERENCES College (College_ID) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE Restaurant (
      Restaurant_ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
      College_ID INT UNSIGNED NOT NULL,
      Restaurant_Name CHAR (100) NOT NULL,
      Restaurant_Type CHAR (50) NOT NULL,
      Restaurant_hours CHAR (20) NOT NULL,
      FOREIGN KEY (College_ID) REFERENCES College (College_ID) ON DELETE CASCADE
);

CREATE TABLE Food (
      Food_ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
      Restaurant_ID INT UNSIGNED NOT NULL,
      Food_Name CHAR (100) NOT NULL,
      Food_Price FLOAT (4, 2),
      FOREIGN KEY (Restaurant_ID) REFERENCES Restaurant (Restaurant_ID) ON DELETE CASCADE
);

CREATE TABLE FoodOrder (
      Order_ID CHAR(50) NOT NULL PRIMARY KEY,
      Student_ID INT UNSIGNED NOT NULL,
      Food_ID INT UNSIGNED NOT NULL,
      Restaurant_ID INT UNSIGNED NOT NULL,
      Order_No CHAR(50) NOT NULL,
      Order_Date DATE,
      Pickup_Date DATE,
      Order_Status CHAR (20) NOT NULL,
      Quantity INT UNSIGNED,
      Total_Price FLOAT (4, 2),
      FOREIGN KEY (Student_ID) REFERENCES Student (Student_ID) ON DELETE CASCADE,
      FOREIGN KEY (Food_ID) REFERENCES Food (Food_ID) ON DELETE CASCADE,
      FOREIGN KEY (Restaurant_ID) REFERENCES Restaurant (Restaurant_ID) ON DELETE CASCADE
);

CREATE TABLE Accomodation (
      Application_ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
      Student_ID INT UNSIGNED NOT NULL,
      Initial_Date date NOT NULL,
      Final_Date date NOT NULL,
      Duration text NOT NULL,
      Total_Cost text NOT NULL,
      Reason text NOT NULL,
      Date_ date NOT NULL DEFAULT current_timestamp(),
      Status_ varchar(30) NOT NULL,
      FOREIGN KEY (Student_ID) REFERENCES Student (Student_ID) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE Report (
      Report_ID int(30) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
      Student_ID INT UNSIGNED NOT NULL,
      College_ID INT UNSIGNED NOT NULL,
      Problem_Type text NOT NULL,
      Problem_Details text NOT NULL,
      Problem_Location text NOT NULL,
      File_Upload blob DEFAULT NULL,
      Date_ date NOT NULL DEFAULT current_timestamp(),
      Status_ varchar(30) NOT NULL,
      FOREIGN KEY (Student_ID) REFERENCES Student (Student_ID) ON DELETE CASCADE,
      FOREIGN KEY (College_ID) REFERENCES College (College_ID) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE Activity (
      Activity_ID int(11) UNSIGNED NOT NULL PRIMARY KEY,
      College_ID INT UNSIGNED NOT NULL,
      Activity_Name varchar(255) NOT NULL,
      Reg_Dead date NOT NULL,
      FOREIGN KEY (College_ID) REFERENCES College (College_ID) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE Registration (
      Registration_ID int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
      Activity_ID int(11) UNSIGNED NOT NULL,
      Student_ID int(11) UNSIGNED NOT NULL,
      Status varchar(50) NOT NULL,
      Position varchar(50) NOT NULL,
      FOREIGN KEY (Activity_ID) REFERENCES Activity (Activity_ID) ON DELETE CASCADE,
      FOREIGN KEY (Student_ID) REFERENCES Student (Student_ID) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE Siswaum (
      id int(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
      Matric_Number int(8) NOT NULL,
      reg_date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
      `College` (`College_ID`, `College_Name`)
VALUES
      (1, 'Astar Residential College (KK1)'),
      (2, 'Tuanku Bahiyah Residential College (KK2)'),
      (3, 'Tuanku Kursiah Residential College (KK3)'),
      (4, 'Bestari Residential College (KK4)'),
      (5, 'Dayasari Residential College (KK5)'),
      (6, 'Ibnu Sina Residential College (KK6)'),
      (7, 'Za\'ba Residential College (KK7)'),
      (8, 'Kinabalu Residential College (KK8)'),
      (
            9,
            'Tun Syed Zahiruddin Residential College (KK9)'
      ),
      (10, 'Tun Ahmad Zaidi Residential College (KK10)'),
      (11, 'Ungku Aziz Residential College (KK11)'),
      (
            12,
            'Raja Dr. Nazrin Shah Residential College (KK12)'
      ),
      (13, 'ULK');

INSERT INTO
      `Siswaum` (`Matric_Number`)
VALUES
      (17152200),
      (17079521),
      (17173793),
      (17161850),
      (17109382),
      (17162657);

INSERT INTO
      `Activity` (
            `Activity_ID`,
            `Activity_Name`,
            `College_ID`,
            `Reg_Dead`
      )
VALUES
      (
            101,
            'Sukan Mahasiswa Universiti Malaya(SUKMUM)',
            '1',
            '2020-06-30'
      ),
      (
            102,
            'Sukan Mahasiswa Universiti Malaya(SUKMUM)',
            '2',
            '2020-06-30'
      ),
      (
            103,
            'Sukan Mahasiswa Universiti Malaya(SUKMUM)',
            '3',
            '2020-06-30'
      ),
      (
            104,
            'Sukan Mahasiswa Universiti Malaya(SUKMUM)',
            '4',
            '2020-06-30'
      ),
      (
            105,
            'Sukan Mahasiswa Universiti Malaya(SUKMUM)',
            '5',
            '2020-06-30'
      ),
      (
            106,
            'Sukan Mahasiswa Universiti Malaya(SUKMUM)',
            '6',
            '2020-06-30'
      ),
      (
            107,
            'Sukan Mahasiswa Universiti Malaya(SUKMUM)',
            '7',
            '2020-06-30'
      ),
      (
            108,
            'Sukan Mahasiswa Universiti Malaya(SUKMUM)',
            '8',
            '2020-06-30'
      ),
      (
            109,
            'Sukan Mahasiswa Universiti Malaya(SUKMUM)',
            '9',
            '2020-06-30'
      ),
      (
            110,
            'Sukan Mahasiswa Universiti Malaya(SUKMUM)',
            '10',
            '2020-06-30'
      ),
      (
            111,
            'Sukan Mahasiswa Universiti Malaya(SUKMUM)',
            '11',
            '2020-06-30'
      ),
      (
            112,
            'Sukan Mahasiswa Universiti Malaya(SUKMUM)',
            '12',
            '2020-06-30'
      ),
      (
            201,
            'Festival Seni Universiti Malaya(FESENI)',
            '1',
            '2020-07-26'
      ),
      (
            202,
            'Festival Seni Universiti Malaya(FESENI)',
            '2',
            '2020-07-26'
      ),
      (
            203,
            'Festival Seni Universiti Malaya(FESENI)',
            '3',
            '2020-07-26'
      ),
      (
            204,
            'Festival Seni Universiti Malaya(FESENI)',
            '4',
            '2020-07-26'
      ),
      (
            205,
            'Festival Seni Universiti Malaya(FESENI)',
            '5',
            '2020-07-26'
      ),
      (
            206,
            'Festival Seni Universiti Malaya(FESENI)',
            '6',
            '2020-07-26'
      ),
      (
            207,
            'Festival Seni Universiti Malaya(FESENI)',
            '7',
            '2020-07-26'
      ),
      (
            208,
            'Festival Seni Universiti Malaya(FESENI)',
            '8',
            '2020-07-26'
      ),
      (
            209,
            'Festival Seni Universiti Malaya(FESENI)',
            '9',
            '2020-07-26'
      ),
      (
            210,
            'Festival Seni Universiti Malaya(FESENI)',
            '10',
            '2020-07-26'
      ),
      (
            211,
            'Festival Seni Universiti Malaya(FESENI)',
            '11',
            '2020-07-26'
      ),
      (
            212,
            'Festival Seni Universiti Malaya(FESENI)',
            '12',
            '2020-07-26'
      ),
      (301, 'College Dinner', '1', '2020-08-12'),
      (302, 'College Dinner', '2', '2020-08-12'),
      (303, 'College Dinner', '3', '2020-08-12'),
      (304, 'College Dinner', '4', '2020-08-12'),
      (305, 'College Dinner', '5', '2020-08-12'),
      (306, 'College Dinner', '6', '2020-08-12'),
      (307, 'College Dinner', '7', '2020-08-12'),
      (308, 'College Dinner', '8', '2020-08-12'),
      (309, 'College Dinner', '9', '2020-08-12'),
      (310, 'College Dinner', '10', '2020-08-12'),
      (311, 'College Dinner', '11', '2020-08-12'),
      (312, 'College Dinner', '12', '2020-08-12'),
      (
            401,
            'Karnival Teater Universiti Malaya(KARVITER)',
            '1',
            '2020-09-15'
      ),
      (
            402,
            'Karnival Teater Universiti Malaya(KARVITER)',
            '2',
            '2020-09-15'
      ),
      (
            403,
            'Karnival Teater Universiti Malaya(KARVITER)',
            '3',
            '2020-09-15'
      ),
      (
            404,
            'Karnival Teater Universiti Malaya(KARVITER)',
            '4',
            '2020-09-15'
      ),
      (
            405,
            'Karnival Teater Universiti Malaya(KARVITER)',
            '5',
            '2020-09-15'
      ),
      (
            406,
            'Karnival Teater Universiti Malaya(KARVITER)',
            '6',
            '2020-09-15'
      ),
      (
            407,
            'Karnival Teater Universiti Malaya(KARVITER)',
            '7',
            '2020-09-15'
      ),
      (
            408,
            'Karnival Teater Universiti Malaya(KARVITER)',
            '8',
            '2020-09-15'
      ),
      (
            409,
            'Karnival Teater Universiti Malaya(KARVITER)',
            '9',
            '2020-09-15'
      ),
      (
            410,
            'Karnival Teater Universiti Malaya(KARVITER)',
            '10',
            '2020-09-15'
      ),
      (
            411,
            'Karnival Teater Universiti Malaya(KARVITER)',
            '11',
            '2020-09-15'
      ),
      (
            412,
            'Karnival Teater Universiti Malaya(KARVITER)',
            '12',
            '2020-09-15'
      );

INSERT INTO
      `Restaurant` (
            `Restaurant_ID`,
            `Restaurant_Name`,
            `Restaurant_Type`,
            `Restaurant_hours`,
            `College_ID`
      )
VALUES
      (
            1,
            'Restauran Mohamad Ali bin Mohd Ibrahim',
            'Local Food',
            '0900-2300',
            8
      ),
      (
            2,
            'Zaujan Cafe',
            'Roti Canai/ Bakar',
            '1000-2400',
            8
      ),
      (3, 'Cafe 8884', 'Western Food', '0900-2300', 8);

INSERT INTO
      `Food` (
            `Food_ID`,
            `Restaurant_ID`,
            `Food_Name`,
            `Food_Price`
      )
VALUES
      (1, 1, 'Burger Daging', 5.50),
      (2, 1, 'Nasi Ayam Tomato', 5.00),
      (3, 1, 'Nasi Goreng Pattaya', 4.50),
      (4, 1, 'Bubur Nasi Ayam', 4.00),
      (5, 2, 'Roti Canai Kosong', 1.00),
      (6, 2, 'Roti Canai Telur', 2.00),
      (7, 2, 'Roti Tisu', 2.50),
      (8, 2, 'Roti Canai Telur Bawang', 3.00),
      (9, 2, 'Roti Canai Boom', 2.50),
      (10, 2, 'Roti Bakar Kaya', 2.50),
      (11, 1, 'Bihun Goreng', 3.50),
      (12, 1, 'Maggi Goreng', 3.50),
      (13, 1, 'Maggi Goreng Special', 4.50),
      (14, 1, 'Nasi Lemak', 3.00),
      (
            15,
            3,
            'Chicken Chop With Black Pepper Sauce',
            7.00
      ),
      (16, 3, 'Chicken Chop With Chilli Sauce', 6.00),
      (17, 3, 'French Fries', 3.00),
      (18, 3, 'Fruit Salad', 6.00),
      (19, 3, 'Loaded Cheese Fries', 4.00),
      (20, 3, 'Macaroni', 5.00),
      (21, 3, 'Mandarin Orange Salad', 6.00),
      (22, 3, 'Mushroom soup', 3.50),
      (23, 3, 'Spaghetti Bolognese', 6.00),
      (24, 3, 'Spaghetti Carbonara', 6.00),
      (25, 3, 'Vegetable Salad', 6.00),
      (26, 1, 'Kuey Teow Goreng', 3.50),
      (27, 1, 'Kuey Teow Soup', 4.00),
      (28, 1, 'Maggi Tomyam Soup', 4.50);