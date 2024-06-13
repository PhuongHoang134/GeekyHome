-- DROP DATABASE IF EXISTS bookreview;

-- Since DROP DATABASE has been disabled by phpMyAdmin,
-- one has to remove a database manually via the "Databases" tab there.
--
-- Or modify (with caution) phpMyAdmin\libraries\config.default.php by
-- replacing $cfg['AllowUserDropDatabase'] = false; with
-- $cfg['AllowUserDropDatabase'] = true;


-- you may have to replace "bookreview" below by "db_zhuhan"
-- if this database is to be placed on the School's database server,
-- where "zhuhan" should be replaced by your own username on the server
CREATE DATABASE bookreview;
USE bookreview;


-- DROP TABLE Authorship, Report, Book, Author, Reviewer;

CREATE TABLE Book (
  bookId VARCHAR(10) PRIMARY KEY,
  title VARCHAR(100) NOT NULL
);

CREATE TABLE Author (
  authorId VARCHAR(10) PRIMARY KEY,
  authorName VARCHAR(50) NOT NULL
);

CREATE TABLE Reviewer (
  reviewerId VARCHAR(10) PRIMARY KEY,
  reviewerName VARCHAR(50) NOT NULL
);


CREATE TABLE Authorship (
  bookId VARCHAR(10), 
  FOREIGN KEY(bookId) REFERENCES Book(bookId),
  authorId VARCHAR(10),
  FOREIGN KEY(authorId) REFERENCES Author(authorId),
  PRIMARY KEY (bookId, authorId)
);

CREATE TABLE Report (
  bookId VARCHAR(10),
  FOREIGN KEY(bookId) REFERENCES Book(bookId),
  reviewerId VARCHAR(10),
  FOREIGN KEY(reviewerId) REFERENCES Reviewer(reviewerId),
  rating INT DEFAULT 1,
  reviewDate DATETIME,
  PRIMARY KEY (bookId, reviewerId)
);


-- insert some authors
INSERT INTO Author VALUES 
('A001', 'John Lewis'),
('A002', 'William Loftus'),
('A003', 'Paul Deitel'),
('A004', 'David'),
('A005', 'Jessica'),
('A006', 'Chris');

-- insert some reviewers
INSERT INTO Reviewer VALUES ('R001', 'Donald');
INSERT INTO Reviewer VALUES ('R002', 'Vladimir');
INSERT INTO Reviewer VALUES ('R003', 'Theresa');

-- insert some books
INSERT INTO Book VALUES ('B001', 'Java Software Solutions');
INSERT INTO Book VALUES ('B002', 'Internet and World Wide Web');
INSERT INTO Book VALUES ('B003', 'Mathematics');

-- who wrote which books
INSERT INTO Authorship VALUES 
('B001','A001'), ('B001','A002'),
('B002','A003'), 
('B003','A004'), ('B003','A005'), ('B003','A006');

-- insert book report/reviews
INSERT INTO Report VALUES 
('B001','R001', 5, '2024-06-21 11:11:59'), 
('B001','R003', 4, '2024-09-24 11:11:59'), 
('B002','R002', 4, '2024-07-22 12:11:59'), 
('B002','R003', 5, '2024-10-25 12:11:59'),
('B003','R003', 3, '2024-08-23 13:11:59');


-- ***************************************
-- Sample SQL to display report/review;
-- just uncomment the SQL code below
-- ***************************************

-- SELECT * FROM Report r, Reviewer w, Book b
-- WHERE r.reviewerId=w.reviewerid
-- AND b.bookId=r.bookId
-- AND b.title='Java Software Solutions';
