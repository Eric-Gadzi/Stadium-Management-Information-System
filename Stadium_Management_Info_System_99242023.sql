DROP DATABASE StadiumDB;
CREATE DATABASE StadiumDB;
USE stadiumDB;

CREATE TABLE Address
(
Ghgps_code varchar(16), 
town varchar(30) not null, 
Region enum
("Oti ", "Bono East ", "Western", "Ahafo", "North East", 
"Savannah", "Western North", "Volta", "Greater Accra", 
"Eastern", "Ashanti", "Central", "Northern", "Upper East", 
"Upper West") DEFAULT "Greater Accra", 
District varchar(100),
PRIMARY KEY(Ghgps_code)
);

CREATE TABLE Organiser
(
organiser_id varchar(5) NOT NULL, PRIMARY KEY(organiser_id),
organiser_name varchar(50) NOT NULL,
email varchar(30) NOT NULL UNIQUE,
telephone varchar(13) NOT NULL UNIQUE,
address varchar(13) not null, FOREIGN KEY(address) 
REFERENCES Address(Ghgps_code)
);

CREATE TABLE Stadium
(
Stadium_id int auto_increment, 
stadium_name varchar(50), 
stadium_type enum("park", "stadium") DEFAULT "stadium",
capacity int not null, 
Club_associated_with varchar(50) default "no club",
ghgps_code varchar(13),
year_built date, 
contact varchar(15), 
email varchar(30),
PRIMARY KEY(stadium_id),
FOREIGN KEY(ghgps_code) REFERENCES Address(Ghgps_code) ON DELETE CASCADE, 
CONSTRAINT email CHECK (email Like "%@%")
);

CREATE TABLE EVENT
(
Event_id int auto_increment, 
Event_name varchar(200) not null, 
Is_done bool default FALSE, 
Date_of_registration date, 
Date_of_event date, 
event_Type enum("sporting", "non-sporting"),
venue int, 
primary KEY(Event_id),
FOREIGN KEY(venue) REFERENCES Stadium(Stadium_id) ON UPDATE SET NULL 
);

CREATE TABLE Participant
(
Participant_id int auto_increment, 
First_name varchar(40), 
Last_name varchar(40), 
DOB date, 
Gender enum('m', 'f', 'x') default 'x', 
Nationality varchar(25), 
Phone varchar(18) unique, 
Email varchar(40) unique not null, 
address varchar(13),
PRIMARY KEY(Participant_id),
FOREIGN KEY(address) references Address(Ghgps_code) ON UPDATE CASCADE
);

CREATE TABLE Ticket
(
Ticket_id varchar(5), 
ticker_name varchar(20), 
ticket_type enum("regular", "VIP", "VVIP") default "regular", 
price_per_ticket double not null, 
Event_id int NOT NULL,
number_issued int not null,
PRIMARY KEY (Ticket_id),
FOREIGN KEY (Event_id) References Event(Event_id)
);
 
CREATE TABLE PAYMENT
(
transaction_id int auto_increment, 
ticket_id varchar(5), 
Participant_id int, 
Amount double(10, 2) , 
card_number varchar(30) not null,
card_name varchar(15) default "ecobank",
card_type enum("visa", "mastercard") default "visa",
nummber_of_ticket int default 1,
PRIMARY KEY(transaction_id),
foreign key(ticket_id) references Ticket(ticket_id),
foreign key(participant_id) references participant(participant_id) 
);


CREATE TABLE Sponsor
(
Sponsor_id varchar(5), 
Sponsor_name varchar(40), 
Tel varchar(13), 
Email varchar(30), 
address_id varchar(16),
PRIMARY KEY(Sponsor_id),
FOREIGN KEY(address_id) references address(Ghgps_code)
);

CREATE TABLE Sponsor_Event
(
Sponsor_id varchar(5), 
Event_id int, 
Amount double,
PRIMARY KEY(Sponsor_id, Event_id),
foreign key(Event_id) references Event(Event_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Event_Organiser
(
Organiser_id varchar(6), 
Event_id int,
FOREIGN KEY(Organiser_id) references Organiser(organiser_id),
FOREIGN KEY(Event_id) references Event(Event_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Football_Matches
( 
Event_id int,  
Home_Team varchar(30) not null, 
Away_Team varchar(30) not null,
FOREIGN KEY(Event_id) REFERENCES Event(Event_id)
);

CREATE INDEX stadium_name
ON Stadium(Stadium_name);

CREATE INDEX event_name
On Event(Event_name);

CREATE INDEX sponsor_name
ON Sponsor(Sponsor_name);

Create INDEX town
ON Address(town);

Create INDEX amount
ON Payment(Amount);



INSERT INTO ADDRESS(Ghgps_code, town, Region, District) VALUES
("AK-100-16739", "Kumasi", "Ashanti", "Kumasi Municipal Assembly"), -- 1
("GA-111-2771", "Ministries", "Greater Accra", "Korley Klote"),  -- 2
("AO-004-4404", "Obuasi Bogobiri", "Ashanti", "Obusai"), -- 3
("WR-359-6109", "Shama", "Western", "Shama"), -- I skip len clay -- 5 
("CC-139-4640", "PEDU", "Central", "Cape Coast"), -- 6
("GA-000-0503", "Jubilee House", "Greater Accra", "Ayawaso East"),
("GA-053-2296", "Haile Selassie Avenue","Greater Accra", "Korley Klote"),
("GA-069-6090", "FISE", "Greater Accra", "Ayawaso Central"),
("AO-318-2967", "Obuasi", "Ashanti", "Obuasi"),
("GS-0078-3249", "Accra", "Greater Accra", "Accra"),
("GA-309-1234", "Kwabenya", "Greater Accra", "Kwabenya"),
("GS-0088-3549", "Accra", "Greater Accra", 	"Airport Area")
;

INSERT INTO ORGANISER VALUES
("Org01", "Government Of Ghana", "govgh@gov.gh", "9191", "GA-000-0503"),
("Org02", "Ghana Football Association", "gfa@gov.gh", "+233304567890", "GA-053-2296"),
("P01", "National Democratic Congress", "ndc@gmail.com", "0501234567", "GA-069-6090"),
("P02", "New Patriotic Party", "npp@gmail.com", "0507654321", "AO-318-2967"),
("Org3", "Vodafone Ghana", "vodafone@gmail.com", "0200000001", "GS-0078-3249")
;

INSERT INTO STADIUM(stadium_name, stadium_type, capacity, club_associated_with, ghgps_code, year_built, contact, email) VALUE
("Baba Yara Stadium", "stadium", 40528, "Ashanti Kotoko", "AK-100-16739", "1959-06-10", "0304521350", "babayarastadium@gmail.com"),
("Accra Sports Stadium", "stadium", 40000, "Accra Hearts Of Aok", "GA-111-2771", "1952-08-21", "0501234566", "accrasportsstadium@gmail.com"),
("Len Clay Stadium", "stadium", 30000, "Ashanti Gold", "AO-004-4404", "1990-04-10 ", "030456789", "Lenclay@gmail.com"),
("Sekondi-Takoradi Stadium", "stadium", 20000, "Sekondi Hasacas FC", "WR-359-6109","2008-01-01", "0305678901", "sekonTaadi@gmail.com"),
("Cape Coast Stadium", "stadium", 15000, "Ebusua Dwarfs", "CC-139-4640","2016-04-03", "03056789012", "capecoaststadium@gmail.com");


INSERT INTO EVENT(Is_done, Event_name, date_of_registration, date_of_event, event_type, venue) VALUES
(true, "Independence Day Celebration", "2020-01-20", "2020-03-06", "non-sporting", 2),
(false, "Vodafone Music Awards", "2021-01-30", "2021-05-31", "non-sporting", 4),
(true, "Evangelical Presby National Congress" , "2020-08-23", "2020-12-31", "non-sporting", 5),
(true, "NDC National Rally", "2020-10-23", "2020-11-24", "non-sporting", 3),
(true, "NPP National Rally", "2019-12-20", "2020-09-24", "non-sporting", 1),
(true, "Greater Accra InterCollages Sports", "2020-12-20", "2021-01-31", "sporting", 1),
(false, "Shatta Music Concert", "2021-01-30", "2021-06-13", "non-sporting", 2),
(true, "Ghana Premier League", "2020-06-30", "2021-01-13", "sporting", 3),
(true, "Ghana Premier League", "2020-06-30", "2021-03-13", "sporting", 4),
(false, "CAF Championship", "2020-06-30", "2021-05-13", "sporting", 5),
(false, "League Of Nations", "2020-06-30", "2021-06-13", "sporting", 2) 
;


INSERT INTO Participant(First_name, Last_name, DOB, gender, nationality, phone, email,address) VALUES
("Kofi", "Ansah", "2000-12-23", 'm', "Ghanaian", "KoAn@gmail.com", "050987654", "GA-309-1234"),
("Eric", "Gadzi", "2005-01-13", 'm', "Ghanaian", "Eri@gmail.com","023324567", "WR-359-6109"),
("Erica", "Fauzi", "2002-12-13", 'x', "Ghanaian", "erga@gmail.com","05098765432", "AO-004-4404"),
("Hellen", "Amina", "1994-11-21", 'f', "Ghanaian", "helam@gmail.com","02012345678", "GA-309-1234"),
("Abena", "Ansah", "1990-12-28", 'f', "Ghanaian", "Abena@gmail.com", "0901234567","GA-309-1234"),
("Mavis", "Gadzi", "2003-01-13", 'f', "Ghanaian", "Madzi@gmail.com","03031234567", "WR-359-6109"),
("Celestina", "Hea", "1974-12-13", 'f', "Ghanaian", "celHea@gmail.com", "012345678", "AO-004-4404"),
("Tawina", "Chaposa", "2001-06-23", 'f', "Malawian", "Taaw@gmail.com","0541567890", "GA-309-1234"),
("Linda", "Autter", "2002-03-06", 'f', "Ghanaian", "liAut@gmail.com","05712345678", "WR-359-6109"),
("Evans", "Ghansah", "1999-11-07", 'm', "Ghanaian", "evgh@gmail.com","05512345678", "AO-004-4404"),
("David", "Quashie", "2000-07-23", 'm', "Ghanaian", "Daua@gmail.com","05012345678", "GA-309-1234"),
("Alhassan", "Hassan", "1998-03-19", 'm', "Ghanaian", "alhha@gmail.com","098765432", "WR-359-6109"),
("Kwame", "Ataapem", "2002-12-13", 'x', "Ghanaian", "kwata@gmail.com","034765432", "AO-004-4404"),
("Qunar", "Winner", "2000-10-23", 'x', "Ghanaian", "quwin@gmail.com","12345432", "GA-309-1234"),
("Zenate", "Zion", "2001-09-20", 'x', "Ghanaian", "Zeion@gmail.com","0501350987", "WR-359-6109"),
("Parica", "Fauzita", "2002-12-13", 'x', "Zimbabwaian", "pafau@gmail.com","098723456", "AO-004-4404"),

("Wisdom", "Adjei", "1974-11-13", 'm', "Ghanaian", "wisadj@gmail.com", "0542345678", "AO-004-4404"),
("Lordina", "Chaposa", "2001-08-23", 'f', "Malawian", "Loraaw@gmail.com","0251567890", "GA-309-1234"),
("Laud", "Arther", "2002-03-06", 'm', "Ghanaian", "lauAut@gmail.com","05798765678", "WR-359-6109"),
("Franks", "Ghansah", "2000-11-07", 'm', "Ghanaian", "frgh@gmail.com","055198745678", "AO-004-4404"),
("Daniel", "Quashie", "2003-07-23", 'm', "Ghanaian", "DaQua@gmail.com","05000345678", "GA-309-1234"),
("Fauzan", "Hassan", "1988-03-19", 'm', "Ghanaian", "fauha@gmail.com","0591765432", "WR-359-6109"),
("Kwakue", "Ataapem", "2000-10-13", 'x', "Ghanaian", "kwaata@gmail.com","0214765432", "AO-004-4404"),
("Luna", "Winter", "2003-10-23", 'x', "American", "luna@gmail.com","015412345432", "GA-309-1234"),
("Zenator", "Ziona", "2001-09-20", 'x', "Ghanaian", "ZeZn@gmail.com","0500350987", "WR-359-6109"),
("Papayae", "Fauzitar", "1990-12-13", 'x', "Zimbabwaian", "paefau@gmail.com","0598723456", "AO-004-4404")
;


 INSERT INTO TICKET VALUES
 ("T01", "Independence Day", "VIP", "0.00", 1, 200000),
 ("T02", "VGMA Ticket", "Regular", "1000.00", 2, 40000),
 ("T03", "Presby Church", "Regular", "5.40", 3, 5000),
 ("T04", "Premier_League", "Regular","90.00", 8, 15000),
 ("T05", "Inter Colleges", "Regular","30.00", 9, 15000),
 ("T06", "CAF Chapionship", "Regular","50.00", 8, 15000),
 ("T07", "NDC rally", "Regular","80.00", 4, 15000),
 ("T08", "NPP Rally", "Regular","70.00", 4, 15000)
 ;
 
 
 INSERT INTO PAYMENT(ticket_id, participant_id, amount, card_number, card_name ,card_type, nummber_of_ticket) VALUES
("T01", 1, 0, "WSC123456787654321", "Ecobank", "visa", 2),
("T01", 2, 0, "BBA1234e0000321","Ecobank", "mastercard", 20),
("T01", 3, 0, "KKZ123450006321","Ecobank", "visa", 12),
("T01", 4, 0, "ZZQ12340000321","Ecobank", "mastercard", 120),
("T01", 5, 0, "QQQ123456787654321","Ecobank", "visa", 25),
("T01", 6, 0, "PLM123411110ew321","GCB Bank", "mastercard", 320),
("T02", 7, 20000, "iii123456787654321","GCB Bank", "visa", 2),
("T02", 8, 400000, "qwe1234e0000321","GCB Bank", "mastercard", 20),
("T02", 9, 240000, "WER123450006321","GCB Bank", "visa", 12),
("T02", 10, 2000000, "TRY12340000321","GCB Bank", "mastercard", 120),
("T02", 11, 50000, "GYH123456787654321","GCB Bank", "visa", 25),
("T03", 16, 1600, "UIO123411110ew321","GCB Bank", "mastercard", 320),
("T03", 12, 6720, "POI123450006321","Fedelity Bank", "visa", 112),
("T03",11, 50, "ZXQ12340000321","Fedelity Bank", "mastercard", 10),
("T03",7, 675,"TTW123456787654321","Fedelity Bank", "visa", 125),
("T03",9, 1080, "YYB123411110ew321","Fedelity Bank", "mastercard", 200),
("T03",8, 113.4, "PP123456787654321","Fedelity Bank", "visa", 21),
("T03",1, 650,  "BB1234e0000321","Fedelity Bank", "mastercard", 130),
("T03",5, 630,  "KKQ3450006321","Fedelity Bank", "visa", 126),
("T04",6, 19500, "ZZQ140000321","Fedelity Bank", "mastercard", 190),
("T04", 11, 1250, "TT56787654321","Access Bank", "visa", 25),
("T04", 10, 19500, "ZZ12340000321","Access Bank", "mastercard", 190),
("T04", 11, 1250, "TTW123456787654321", "Access Bank","visa", 25),
("T04", 10, 19500, "WQQ12340000321","Access Bank", "mastercard", 190),
("T04", 16, 1250, "TTW123456787654321","Access Bank", "visa", 25),
("T05",17, 675,"TQW123456787654321","Fedelity Bank", "visa", 15),
("T05",20, 1080, "YQB123411110ew321","Fedelity Bank", "mastercard", 30),
("T05",18, 113.4, "QP123456787654321","Fedelity Bank", "visa", 11),
("T06",21, 650,  "BBQ1234e0000321","Fedelity Bank", "mastercard", 132),
("T06",20, 630,  "KQQ3450006321","Fedelity Bank", "visa", 16),
("T06",23, 19500, "QZQ140000321","Fedelity Bank", "mastercard", 120),
("T07", 24, 1250, "TQT56787654321","Access Bank", "visa", 20),
("T07", 22, 19500, "ZZQ12340000321","Access Bank", "mastercard", 10),
("T07", 19, 1250, "TWW123456787654321", "Access Bank","visa", 250),
("T07", 22, 19500, "WQW12340000321","Access Bank", "mastercard", 10),
("T07", 10, 1250, "TWpaymentW123456787654321","Access Bank", "visa", 125),
("T08",21, 19500, "QZQ140000321","Fedelity Bank", "mastercard", 120),
("T08", 24, 1250, "TQT56787654321","Access Bank", "visa", 20),
("T08", 21, 19500, "ZZQ12340000321","Access Bank", "mastercard", 10),
("T08", 24, 1250, "TWW123456787654321", "Access Bank","visa", 250),
("T05", 21, 19500, "WQW12340000321","Access Bank", "mastercard", 10),
("T05", 22, 1250, "TWpaymentW123456787654321","Access Bank", "visa", 125)
;


INSERT INTO SPONSOR VALUE 
("VG1", "Vodafone Ghana", "030000001", "vodafonegh@gmail.com", "AK-100-16739"),
("CH2", "Charter House", "0200000001", "charterH@gmail.com", "GS-0088-3549"),
("MG3", "Multimedia Group", "0240050612", "mmedia@gmail.com", null ),
("CC4", "Council Of Churches", "02020202020", "cchurches@gmail.com", "GS-0078-3249"),
("Co5", "Cowbel ", "02020202111", "cowbel@gmail.com", "WR-359-6109"),
("MT6", "Ministry Of Tourism", "0545562356", "minTour@gmail.com", "AK-100-16739"),
("PT7", "Poli Tank Ghana", "0551234567", "politank@gmail.com", "GS-0088-3549")
;

INSERT INTO Sponsor_Event VALUES
("VG1", 2, 100000.90),
("Co5", 2, 30000.89), 
("MG3", 2, 50000), 
("MG3", 1, 1000),
("MG3", 5, 30000),
("PT7", 7, 3000),
("PT7", 8, 30000),
("PT7", 4, 1000),
("CC4", 1, 599.90),
("CH2", 3, 1000.70),
("MT6", 1, 1000),
("MT6", 4, 20000),
("VG1", 4, 60000)
;

INSERT INTO Football_Matches VALUES
(8,"Heart Of Oak", "Kumasi Kotoko"),
(8, "Asanti Kotoko", "Ebusua Dwarfs"),
(9, "King Faizer", "Mediama"),
(9, "Chelsea", "Hasacas"),
(9, "Ashanti Gold", "Heart Of Oak"),
(10, "Citi Allies", "Young Dwarfs"),
(10, "Ghana ", "Togo")
;

INSERT INTO Event_Organiser VALUES 
("Org01", 1),
("Org01", 11),
("Org01", 10),
("Org3", 2),
("P01", 5),
("P02", 4),
("Org3", 7),
("Org3", 8),
("Org3", 3),
("Org3", 6);


-- The various stadiums/parks in the country and their locations sorted by their capacity.
SELECT stadium.stadium_name, stadium.capacity, address.town, address.region 
FROM stadium, address
WHERE stadium.ghgps_code = address.Ghgps_code
ORDER BY stadium.capacity desc
;


-- 	The various events that take place at the various stadiums. 
SELECT Event.event_name as Program, stadium.stadium_name as location, Event.Date_of_event as "Date"
FROM event, stadium
WHERE  stadium_id = venue;


-- Identify the amount of money made from the various event 
SELECT 
	ticket.ticker_name as "Event Name",
	sum(amount) as "Total Amount(Ghc)" 
fROM payment 
JOIN Ticket 
	ON Ticket.ticket_id = payment.ticket_id 
RIGHT OUTER JOIN Event
	ON Ticket.event_id = event.event_id
GROUP BY payment.ticket_id
ORDER BY amount desc
;

-- Identify participants that made payment for the events
SELECT 
	concat(Participant.first_name," ", Participant.last_name) AS Participant, 
    Payment.nummber_of_ticket,
    Payment.Amount,
	ticket.ticker_name as Event,  Stadium.Stadium_name
FROM Participant
JOIN Payment
	ON Payment.Participant_id = Participant.participant_id
LEFT OUTER JOIN Ticket
	ON Payment.ticket_id = Ticket.ticket_id
JOIN Event
	ON event.event_id = ticket.event_id 
JOIN Stadium
	ON Event.venue = stadium.stadium_id
WHERE Payment.Amount > 100
;


-- The various sponsors of the event 
SELECT Sponsor.Sponsor_name, Event.event_name, sum(amount) as "total Amount" 
FROM sponsor_event
JOIN EVENT
ON Event.event_id = sponsor_event.event_id
JOIN Sponsor
ON Sponsor.sponsor_id = sponsor_event.sponsor_id
GROUP BY Sponsor.sponsor_name;


-- Identify the various football matches and the clubs that had most funs or revenue.

SELECT 
	Football_Matches.Home_Team, 
    Football_Matches.Away_Team, 
	Stadium.Stadium_name, 
    Event.event_name, 
    Event.date_of_event, 
    Payment.Amount 
FROM Football_Matches
JOIN Event
	ON EVENT.event_id = Football_Matches.event_id
JOIN stadium
	On Stadium.stadium_id = Event.venue
JOIN Ticket
	On ticket.event_id = event.event_id
JOIN Payment
	ON Payment.ticket_id = ticket.ticket_id
GROUP BY Football_Matches.Home_Team
;



 