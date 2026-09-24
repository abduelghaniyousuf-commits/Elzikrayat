

-- Comments Table
CREATE TABLE comment(
id int AUTO_INCREMENT PRIMARY KEY ,
comment varchar(255),
photo_id int,
student_id int ,
date_time timestamp,
FOREIGN KEY(photo_id) REFERENCES photo(id) on DELETE CASCADE,
FOREIGN KEY(student_id) REFERENCES student(id) on DELETE CASCADE
);




-- inser into photo table
INSERT into photo (`title`,`student_id`,`filename`,`description`,`date_time`)
VALUES(
"Candle",
1,
"1",
"a lit candle",
CURRENT_TIMESTAMP
)