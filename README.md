# daily-prayer-time
Wordpress widget to display daily prayer time

This widget requires a database table called 'timetable' in your wordpress database. 
The table definition must follow:
'CREATE TABLE `timetable` (
  `timetable_id` int(3) NOT NULL AUTO_INCREMENT,
  `timetable_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `d_date` date DEFAULT NULL,
  `fajr_begins` time DEFAULT NULL,
  `fajr_jamah` time DEFAULT NULL,
  `sunrise` time DEFAULT NULL,
  `zuhr_begins` time DEFAULT NULL,
  `zuhr_jamah` time DEFAULT NULL,
  `asr_mithl_1` time DEFAULT NULL,
  `asr_mithl_2` time DEFAULT NULL,
  `asr_jamah` time DEFAULT NULL,
  `maghrib_begins` time DEFAULT NULL,
  `maghrib_jamah` time DEFAULT NULL,
  `isha_begins` time DEFAULT NULL,
  `isha_jamah` time DEFAULT NULL,
  PRIMARY KEY (`timetable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=367 DEFAULT CHARSET=utf8;'
