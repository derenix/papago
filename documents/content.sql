# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.34)
# Datenbank: papago
# Erstellt am: 2017-05-02 09:23:25 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Export von Tabelle operators
# ------------------------------------------------------------

LOCK TABLES `operators` WRITE;
/*!40000 ALTER TABLE `operators` DISABLE KEYS */;

INSERT INTO `operators` (`id`, `operator_name`, `type`, `blacklist`, `premium`, `class`)
VALUES
	(1,'quertour','html',0,0,'Quertour'),
	(2,'onlineweg','html',0,0,'Onlineweg'),
	(3,'bsk','xml',0,0,'Bsk');

/*!40000 ALTER TABLE `operators` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle pages
# ------------------------------------------------------------

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;

INSERT INTO `pages` (`id`, `operator_id`, `url`)
VALUES
	(1,1,'http://www.quertour.de/');

/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle trips
# ------------------------------------------------------------

LOCK TABLES `trips` WRITE;
/*!40000 ALTER TABLE `trips` DISABLE KEYS */;

INSERT INTO `trips` (`id`, `operator_id`, `title`, `excerpt`, `description`, `image_teaser`, `image_detail`, `price`, `price_additional`, `url_detail`, `url_booking`, `booking_status`, `blacklist`, `date_from`, `date_to`)
VALUES
	(1,1,'Berlin','','Berlin, Berlin – wir fahren nach Berlin! – Berlin sehen und erleben –','','./quertour_files/ber-haus140.jpg','ab 645,00 €','','','http://www.quertour.de/reise/d-berlin-hotel-103-citytours/ber-020617','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,1,'Griechenland - Platamonas ','','Wunderschöne Gegend um Makedonien und am Olymp ','','./quertour_files/gr-pls-haus140.jpg','ab 1.545,00 €','','','http://www.quertour.de/reise/gr-olymp-platamonas/gr-pls-240517',' Ausgebucht',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(3,1,'Kanaren - Teneriffa ','','Die Insel des ewigen Frühlings -Vollständig rollstuhlgerechtes Hotel-','','./quertour_files/e-lcm-haus140.jpg','ab 1.555,00 €','','','http://www.quertour.de/reise/e-teneriffa-los-christianos/e-lcm-020617','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4,1,'Mallorca - Can Picafort','','4-Sterne-Komfort-Hotel ++ Jetzt mit Vollpension und allem Drum und Dran ++','','./quertour_files/e-cpj-haus-140.jpg','ab 1.545,00 €','','','http://www.quertour.de/reise/e-mallorca-can-picafort-janeiro-14/e-cpj-110517',' Ausgebucht',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(5,1,'Mallorca - Can Picafort','','Klasse Hotelanlage – direkt am Strand…','','./quertour_files/e-cpc-haus140.jpg','ab 1.515,00 €','','','http://www.quertour.de/reise/e-mallorca-can-picafort-concorde-14/e-cpc-100517','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(6,1,'Mallorca - Colonia de Sant Pere','','Kleines familiengeführtes Hotel in herrlicher Landschaft','','./quertour_files/e-css-haus140.jpg','ab 1.555,00 €','','','http://www.quertour.de/reise/e-mallorca-colonia-de-sant-pere/e-css-300517','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(7,1,'Mallorca - Cala Ratjada','','Kleines Gruppenhotel in bester Lage','','./quertour_files/e-crb-haus140.jpg','ab 1.385,00 €','','','http://www.quertour.de/reise/e-mallorca-cala-ratjada/e-crb-030517','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(8,1,'Portugal - Lagos / Allgarve','','Portugal / Algarve +++ inkl. Delfin- und Grottentour sowie einem Top-Appartement-Hotel ','','./quertour_files/p-laa-haus140.jpg','ab 1.565,00 €','','','http://www.quertour.de/reise/p-algarve-lagos/p-laa-170517','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(9,1,'Bulgarien - Burgas ','','WEISSER STRAND AM SCHWARZEN MEER','','./quertour_files/bg-bos-haus140.jpg','ab 1.395,00 €','','','http://www.quertour.de/reise/bg-bulgarien-burgas-sonnenstrand-2016/bg-bos-240517',' Ausgebucht',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(10,1,'Fehntjer Ferienland / Ostfriesland','','Cluburlaub – tolle Unterkunft bei bestem Service','','./quertour_files/feh-haus140.jpg','ab 590,00 €','','','http://www.quertour.de/reise/d-grossefehn-ostfriesland-clubtours/feh-100617','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(11,1,'Harz / Bad Sachsa ','','Bad Sachsa – beliebtes Urlaubsgebiet im Harz','','./quertour_files/bsa-haus140.jpg','ab 1.015,00 €','','','http://www.quertour.de/reise/harz-bad-sachsa/bsa-150717',' Ausgebucht',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(12,1,'Niederlande - Zoutelande','','Strandurlaub und Mee(h)r  – äußerst beliebtes Reiseziel direkt am Meer –','','./quertour_files/nl-zou-haus140.jpg','ab 1.015,00 €','','','http://www.quertour.de/reise/nl-niederlande-zoutelande-youngtours/nl-zou-220717-yt',' Ausgebucht',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(13,1,'Niederlande - Zoutelande','','Strandurlaub und Mee(h)r  – äußerst beliebtes Reiseziel direkt am Meer –','','./quertour_files/nl-zou-haus140.jpg','ab 1.015,00 €','','','http://www.quertour.de/reise/nl-niederlande-zoutelande/nl-zou-080717','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(14,1,'Österreich / Saalbach ','','Urlaub in traumhafter Landschaft – mit Tagestour nach Salzburg ','','./quertour_files/a-eib-haus140.jpg','ab 1.035,00 €','','','http://www.quertour.de/reise/a-saalbach-eibinghof/a-eib-150717','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(15,1,'Thüringen /  Mühlhausen','','young-tours – Tolle Unterkunft in mittelalterlicher Atmosphäre –','','./quertour_files/ant-haus140.jpg','ab 995,00 €','','','http://www.quertour.de/reise/d-thrueringen-antoniq-youngtours/ant-130817-yt','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(16,1,'Schwarzwald - Waldblick','','Zeit für wilde Schluchten und sonnige Höhen','','./quertour_files/wal-haus140.jpg','ab 975,00 €','','','http://www.quertour.de/reise/d-schwarzwald-schoenwald/wal-220717','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(17,1,'Ostsee / Liensfeld','','Zwischen Plöner See und Ostsee – mit Winnetou und Old Shatterhand','','./quertour_files/lie-haus140.jpg','ab 1.125,00 €','','','http://www.quertour.de/reise/d-liensfeld-bosau/lie-140717',' Ausgebucht',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(18,1,'Berlin','','Berlin, Berlin – wir fahren nach Berlin! – Berlin sehen und erleben –','','./quertour_files/ber-haus140.jpg','ab 645,00 €','','','http://www.quertour.de/reise/d-berlin-hotel-103-citytours/ber-020617','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(19,1,'Niederlande - Zoutelande','','Strandurlaub und Mee(h)r  – äußerst beliebtes Reiseziel direkt am Meer –','','./quertour_files/nl-zou-haus140.jpg','ab 1.015,00 €','','','http://www.quertour.de/reise/nl-niederlande-zoutelande-youngtours/nl-zou-220717-yt',' Ausgebucht',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(20,1,'Thüringen /  Mühlhausen','','young-tours – Tolle Unterkunft in mittelalterlicher Atmosphäre –','','./quertour_files/ant-haus140.jpg','ab 995,00 €','','','http://www.quertour.de/reise/d-thrueringen-antoniq-youngtours/ant-130817-yt','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(21,1,'Griechenland - Platamonas ','','Wunderschöne Gegend um Makedonien und am Olymp ','','./quertour_files/gr-pls-haus140.jpg','ab 1.545,00 €','','','http://www.quertour.de/reise/gr-olymp-platamonas/gr-pls-240517',' Ausgebucht',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(22,1,'Kanaren - Teneriffa ','','Die Insel des ewigen Frühlings -Vollständig rollstuhlgerechtes Hotel-','','./quertour_files/e-lcm-haus140.jpg','ab 1.555,00 €','','','http://www.quertour.de/reise/e-teneriffa-los-christianos/e-lcm-020617','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(23,1,'Mallorca - Colonia de Sant Pere','','Kleines familiengeführtes Hotel in herrlicher Landschaft','','./quertour_files/e-css-haus140.jpg','ab 1.555,00 €','','','http://www.quertour.de/reise/e-mallorca-colonia-de-sant-pere/e-css-300517','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(24,1,'Mallorca - Cala Ratjada','','Kleines Gruppenhotel in bester Lage','','./quertour_files/e-crb-haus140.jpg','ab 1.495,00 €','','','http://www.quertour.de/reise/e-mallorca-cala-ratjada/e-crb-130917',' Ausgebucht',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(25,1,'Bulgarien - Burgas ','','WEISSER STRAND AM SCHWARZEN MEER','','./quertour_files/bg-bos-haus140.jpg','ab 1.395,00 €','','','http://www.quertour.de/reise/bg-bulgarien-burgas-sonnenstrand-2016/bg-bos-240517',' Ausgebucht',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(26,1,'Fehntjer Ferienland / Ostfriesland','','Cluburlaub – tolle Unterkunft bei bestem Service','','./quertour_files/feh-haus140.jpg','ab 590,00 €','','','http://www.quertour.de/reise/d-grossefehn-ostfriesland-clubtours/feh-170617','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(27,1,'Mallorca - Can Picafort','','4-Sterne-Komfort-Hotel ++ Jetzt mit Vollpension und allem Drum und Dran ++','','./quertour_files/e-cpj-haus-140.jpg','ab 1.375,00 €','','','http://www.quertour.de/reise/e-mallorca-can-picafort-janeiro-10/e-cpj-250917','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(28,1,'Mallorca - Can Picafort','','Klasse Hotelanlage – direkt am Strand…','','./quertour_files/e-cpc-haus140.jpg','ab 1.355,00 €','','','http://www.quertour.de/reise/e-mallorca-can-picafort-concorde-10/e-cpc-260917','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(29,1,'Mallorca - Cala Ratjada','','Kleines Gruppenhotel in bester Lage','','./quertour_files/e-crb-haus140.jpg','ab 1.435,00 €','','','http://www.quertour.de/reise/e-mallorca-cala-ratjada-youngtours/e-crb-270917-yt','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(30,1,'Mallorca - Cala Millor ','','Schöne Hotelanlage in absoluter TOP-Lage','','./quertour_files/e-cmv-haus140.jpg','ab 1.375,00 €','','','http://www.quertour.de/reise/e-mallorca-cala-millor-10/e-cmv-071017','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(31,1,'Griechenland - Platamonas ','','Wunderschöne Gegend um Makedonien und am Olymp ','','./quertour_files/gr-pls-haus140.jpg','ab 1.565,00 €','','','http://www.quertour.de/reise/gr-olymp-platamonas/gr-pls-150917',' Ausgebucht',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(32,1,'Mallorca - Colonia de Sant Pere','','Kleines familiengeführtes Hotel in herrlicher Landschaft','','./quertour_files/e-css-haus140.jpg','ab 1.575,00 €','','','http://www.quertour.de/reise/e-mallorca-colonia-de-sant-pere/e-css-120917',' Ausgebucht',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(33,1,'Mallorca - Cala Ratjada','','Kleines Gruppenhotel in bester Lage','','./quertour_files/e-crb-haus140.jpg','ab 1.385,00 €','','','http://www.quertour.de/reise/e-mallorca-cala-ratjada/e-crb-130917','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(34,1,'Portugal - Lagos / Allgarve','','Portugal / Algarve +++ inkl. Delfin- und Grottentour sowie einem Top-Appartement-Hotel ','','./quertour_files/p-laa-haus140.jpg','ab 1.615,00 €','','','http://www.quertour.de/reise/p-algarve-lagos/p-laa-240917','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(35,1,'Bulgarien - Burgas ','','WEISSER STRAND AM SCHWARZEN MEER','','./quertour_files/bg-bos-haus140.jpg','ab 1.425,00 €','','','http://www.quertour.de/reise/bg-bulgarien-burgas-sonnenstrand-2016/bg-bos-170917',' Ausgebucht',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(36,1,'Berlin','','Berlin, Berlin – wir fahren nach Berlin! – Berlin sehen und erleben –','','./quertour_files/ber-haus140.jpg','ab 645,00 €','','','http://www.quertour.de/reise/d-berlin-hotel-103-citytours/ber-290917','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(37,1,'München','','Kultur und Spaß - hier kommt Einiges zusammen','','./quertour_files/mun-haus140.jpg','ab 645,00 €','','','http://www.quertour.de/reise/d-muenchen-4you-hostel-hotel-citytours/mun-061017','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(38,1,'Hamburg','','Hamburg hautnah erleben! – Auch für Musical-Fans –','','./quertour_files/ham-haus140.jpg','ab 665,00 €','','','http://www.quertour.de/reise/d-hamburg-altona-hotel-schanzenstern-citytours/ham-131017',' Ausgebucht',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(39,1,'Mallorca - Cala Ratjada','','Kleines Gruppenhotel in bester Lage','','./quertour_files/e-crb-haus140.jpg','ab 1.435,00 €','','','http://www.quertour.de/reise/e-mallorca-cala-ratjada-youngtours/e-crb-270917-yt','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(40,1,'Fehntjer Ferienland / Ostfriesland','','Cluburlaub – tolle Unterkunft bei bestem Service','','./quertour_files/feh-haus140.jpg','ab 545,00 €','','','http://www.quertour.de/reise/d-grossefehn-ostfriesland-clubtours/feh-020917','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(41,1,'Hunsrück - Die Mühle','','10 Tage über Weihnachten und Silvester in idyllischer Umgebung','','./quertour_files/mue-haus140.jpg','ab 775,00 €','','','http://www.quertour.de/reise/d-hunsrueck-hentern-winter/mue-231217',' Ausgebucht',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(42,1,'Schwarzwald - Waldblick','','– 10 Tage Schneevergnügen über Silvester –','','./quertour_files/wal-winter-haus140.jpg','ab 845,00 €','','','http://www.quertour.de/reise/d-schwarzwald-schoenwald-winter/wal-271217','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(43,1,'Thüringen /  Mühlhausen','','– Einwöchige Silvestertour –','','./quertour_files/ant-haus140.jpg','ab 645,00 €','','','http://www.quertour.de/reise/d-thueringen-muehlhausen-antoniq-winter/ant-271217','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(44,1,'Fehntjer Ferienland / Ostfriesland','','Cluburlaub – tolle Unterkunft bei bestem Service','','./quertour_files/feh-haus140.jpg','ab 590,00 €','','','http://www.quertour.de/reise/d-grossefehn-ostfriesland-clubtours/feh-231217','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `trips` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
