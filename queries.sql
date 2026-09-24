

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


-- photo table

-- inser into photo table
INSERT into photo (`title`,`student_id`,`filename`,`description`,`date_time`)
VALUES(
"Candle",
1,
"1",
"a lit candle",
CURRENT_TIMESTAMP
)


-- student table 

-- insert student 
INSERT INTO student (first_name ,last_name ,email,password,description ,location,occupation ,isLogin)
VALUES ("Ali" ,"Othman" ,"ali@gmail.com","password","CS Bs student @eg.edu", "KH,UM" , "CS Student" ,"false")

-- update student
update student 
set password = "newpassword"
WHERE id = 2

-- delete student // sign out
DELETE FROM `student` WHERE `student`.`id` = 5


