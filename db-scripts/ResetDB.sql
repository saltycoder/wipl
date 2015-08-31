USE wipl;

-- Contact
DROP TABLE IF EXISTS contact;

CREATE TABLE IF NOT EXISTS contact(
   contact_id int(11) NOT NULL AUTO_INCREMENT,
   full_name varchar(100) NOT NULL,
   email varchar(150) NOT NULL,
   message varchar(500) NOT NULL,
   sent_on DATE NOT NULL,
   PRIMARY KEY (contact_id)
);

INSERT INTO contact (full_name, email, message, sent_on) VALUES ('Mickey Mouse','mmouse@example.com','How does the guy who drives the snowplow get to work in the mornings?','2015-01-01 06:23:45');
INSERT INTO contact (full_name, email, message, sent_on) VALUES ('Donald Duck','theduck@example.com','Why can''t we tickle ourselves?','2011-12-13 09:12:09');
INSERT INTO contact (full_name, email, message, sent_on) VALUES ('Luke Skywalker','usetheforce@example.com','When a cow laughs, does milk come out of its nose? ','2014-07-20 11:45:23');
INSERT INTO contact (full_name, email, message, sent_on) VALUES ('Forest Gump','boxof@example.com','If all the world is a stage, where is the audience sitting?','2015-07-07 11:23:56');


-- Customer
DROP TABLE IF EXISTS customer;

CREATE TABLE IF NOT EXISTS customer(
  customer_id int(11) NOT NULL AUTO_INCREMENT,
  customer_name varchar(100) NOT NULL,
  customer_email varchar(150) NOT NULL,
  customer_cc_nbr varchar(25) NOT NULL,
  customer_expire_date varchar(10) NOT NULL,
  PRIMARY KEY (customer_id)
);

-- Application User
DROP TABLE IF EXISTS user;

CREATE TABLE IF NOT EXISTS user(
  user_record_id int(11) NOT NULL,
  user_full_name varchar(100) NOT NULL,
  user_id varchar(25) NOT NULL,
  user_password varchar(250) NOT NULL,
  user_isadmin TINYINT(1) NOT NULL,
  PRIMARY KEY (user_record_id)
);

INSERT INTO user (user_record_id, user_full_name, user_id, user_password, user_isadmin) VALUES (1, 'Demo User', 'Demo', 'Demo777',0);
INSERT INTO user (user_record_id, user_full_name, user_id, user_password, user_isadmin) VALUES (22, 'Happy Gilmore', 'happy', 'TapItIn',1);