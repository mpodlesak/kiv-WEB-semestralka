-- noinspection SqlDialectInspectionForFile

-- noinspection SqlNoDataSourceInspectionForFile

-- MySQL Script generated by MySQL Workbench
-- Mon Nov  9 15:33:48 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `pravo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pravo` ;

CREATE TABLE IF NOT EXISTS `pravo` (
  `id_pravo` INT NOT NULL AUTO_INCREMENT,
  `nazev` VARCHAR(20) NOT NULL,
  `vaha` INT NOT NULL,
  PRIMARY KEY (`id_pravo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uzivatel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `uzivatel` ;

CREATE TABLE IF NOT EXISTS `uzivatel` (
  `id_uzivatel` INT NOT NULL AUTO_INCREMENT,
  `id_pravo` INT NOT NULL,
  `jmeno` VARCHAR(50) NOT NULL,
  `prijmeni` VARCHAR(50) NOT NULL,
  `login` VARCHAR(50) NOT NULL,
  `heslo` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_uzivatel`),
  INDEX `fk_uzivatel_pravo_id_pravo_idx` (`id_pravo` ASC),
  CONSTRAINT `fk_uzivatel_pravo_id_pravo`
    FOREIGN KEY (`id_pravo`)
    REFERENCES `pravo` (`id_pravo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `recenze`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `recenze` ;

CREATE TABLE IF NOT EXISTS `recenze` (
  `id_recenze` INT NOT NULL AUTO_INCREMENT,
  `id_recenzent` INT NOT NULL,
  `hodnoceni` DECIMAL(1,1) NOT NULL,
  PRIMARY KEY (`id_recenze`),
  INDEX `id_recenze_recenzent_uzivatel_uzivatel_idx` (`id_recenzent` ASC),
  CONSTRAINT `id_recenze_recenzent_uzivatel_uzivatel`
    FOREIGN KEY (`id_recenzent`)
    REFERENCES `uzivatel` (`id_uzivatel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prispevek`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prispevek` ;

CREATE TABLE IF NOT EXISTS `prispevek` (
  `id_prispevek` INT NOT NULL AUTO_INCREMENT,
  `id_autor` INT NOT NULL,
  `id_recenze` INT NULL,
  `nazev` VARCHAR(100) NOT NULL,
  `text` LONGTEXT NOT NULL,
  `obrazky` MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`id_prispevek`),
  INDEX `fk_prispevek_autor_id_uzivatel_idx` (`id_autor` ASC),
  INDEX `fk_prispevek_recenze_id_recenze_idx` (`id_recenze` ASC),
  CONSTRAINT `fk_prispevek_autor_id_uzivatel`
    FOREIGN KEY (`id_autor`)
    REFERENCES `uzivatel` (`id_uzivatel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_prispevek_recenze_id_recenze`
    FOREIGN KEY (`id_recenze`)
    REFERENCES `recenze` (`id_recenze`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `pravo`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `pravo` (`id_pravo`, `nazev`, `vaha`) VALUES (1, 'Admin', 10);
INSERT INTO `pravo` (`id_pravo`, `nazev`, `vaha`) VALUES (2, 'Recenzent', 5);
INSERT INTO `pravo` (`id_pravo`, `nazev`, `vaha`) VALUES (3, 'Autor', 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `uzivatel`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `uzivatel` (`id_uzivatel`, `id_pravo`, `jmeno`, `prijmeni`, `login`, `heslo`, `email`) VALUES (1, 1, 'Admin', 'Hlavni', 'admin', 'admin', 'admin@gmail.com');
INSERT INTO `uzivatel` (`id_uzivatel`, `id_pravo`, `jmeno`, `prijmeni`, `login`, `heslo`, `email`) VALUES (2, 2, 'Recenzent', 'Pokusny', 'recenzent', 'recenzent', 'recenzent@gmail.com');
INSERT INTO `uzivatel` (`id_uzivatel`, `id_pravo`, `jmeno`, `prijmeni`, `login`, `heslo`, `email`) VALUES (3, 3, 'Autor', 'Pokusny', 'autor', 'autor', 'autor@gmail.com');
INSERT INTO `uzivatel` (`id_uzivatel`, `id_pravo`, `jmeno`, `prijmeni`, `login`, `heslo`, `email`) VALUES (4, 3, 'Franta', 'Vořežplech', 'franta', 'vorezplech', 'fvorez@seznam.cz');
INSERT INTO `uzivatel` (`id_uzivatel`, `id_pravo`, `jmeno`, `prijmeni`, `login`, `heslo`, `email`) VALUES (5, 2, 'Jaromir', 'Rybicka', 'jaromir', 'rybicka', 'jararyba@centrum.cz');

COMMIT;


-- -----------------------------------------------------
-- Data for table `recenze`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `recenze` (`id_recenze`, `id_recenzent`, `hodnoceni`) VALUES (1, 5, 5.0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `prispevek`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `prispevek` (`id_prispevek`, `id_autor`, `id_recenze`, `nazev`, `text`, `obrazky`) VALUES (1, 4, 1, 'Proc je BMW superior?', 'Roman Goldberg considers himself well-versed in classic BMWs, and understandably so. In his garage, you\'ll find a stunning example of a Dakar Yellow E36 M3, and an E12 528i. Parked between them? This gorgeous M635CSi, one of just 5,859 BMW Motorsport-developed 6ers built for a worldwide audience. That tidbit, though, was part of a lesson learned by Roman after discovering the car in an online classified ad. Lacking the North American \"M6\" designation, Roman was curious if the car was in fact, the real deal. Euro bumpers caught his attention, but it was the engine bay photos featuring the M88\'s six individual throttle bodies that had Roman\'s interest piqued. As he soon came to find,  not only is it the real deal... with 30 more horsepower than the North American counterpart, the M635CSi is as real as it gets. Roman\'s childhood was spent growing up in Israel, where car culture is \"scarce,\" as he puts it. Roman relied on the media -- movies or magazines -- to feed his growing interest in automobiles. At the age of 15, his family up and moved to Montreal, Canada, and it was the sudden saturation of a newfound culture of automobiles that kept him from ever looking back. Today, he\'s fully submersed, with a trio of BMWs and an aircooled 911 to call his own. When it comes to the M635CSi, Roman caught the classified ad just 30 minutes after it went live on the web. The photos stopped Roman\'s heart in its place, but unfamiliarity with the early M car\'s nomenclature had him second guessing. \"Not knowing exactly what a M635CSi is I didn’t get too excited when I saw the listing,\" he says. Before calling the number listed in the ad, Roman turned to google, and his expectations were immediately subverted. The M6, as we\'ve come to know it, began life in 1983 as the M635CSi, equipped with a modified version of the M88 inline six found in the legendary BMW M1. With 282 horsepower on tap, the M635CSi was a force to be reckoned with, too. The M6 name itself wasn\'t earned until the car was brought to the American and Japanese markets, for a namesake that more closely aligned with the M3 and M5 badging of its siblings. The M635CSi naming, on the other hand, bares resemblance only to its predecessor, the E12-based M535i, which predicated the E28 M5 of 1984. So, with an understanding that he was dealing with the third production car ever developed by BMW Motorsport, Roman wasted no time, and within the hour was at the seller\'s house, cash in hand. The single-stage paint was faded, and the fuel system needed a complete replacement: overall, the car wasn\'t what one might call \"well kept;\" however, that didn\'t stop Roman from making the purchase. As a 1988 grey market import from Nevada, the car spent its life in the states until 2007, when it was imported to Canada. The second North American owner kept the car stored outside for a decade, where the cold Canadian weather managed to chip away at its cleanliness. The car was driven 2-3 times a year, but was at least taken to a shop on a yearly basis for upkeep. The mechanical fixes were relatively simple, but the paintwork was in dire need of attention. \"The paint was fully burnt and looked like it had a matte pink wrap on it,\" Roman says. A complete wet-sand and polish was required to begin breathing new life into the old paint. While it shines better than it has any time in the last decade, though, it\'s not without its imperfections. \"My favorite and least favorite part of the car is the paint. I love that this car has a ton of patina and war wounds which lets me drive it on a daily basis and not worry about value or condition. At the same time, I fight myself if I should respray the car and restore it back to brand new condition,\" he explains. It\'s an understandable predicament. With a gorgeous set of square BBS RS198s measuring out to 17x8.5 and wrapped in 235/45R17s, and paired with a set of Open Road Tuning coilovers, the car looks and drives better than ever before. A Remus exhaust allows the M88 to scream at full song. And of course, the elbow grease that has gone into preserving the car helps it shine in a unique, special light. It\'s no monster build: instead, it\'s a piece to a puzzle: an integral part of Roman\'s journey as a BMW enthusiast. Now, we\'ll just have to wait for a second feature showcasing his E36 M3, if he\'s willing to share it.', 'https://stanceworks.com/wp-content/uploads/2020/08/roman-goldberg-E24-m635csi-title.jpg;https://stanceworks.com/wp-content/uploads/2020/08/for-ph-19-of-30.jpg;https://stanceworks.com/wp-content/uploads/2020/08/for-ph-9-of-30.jpg;https://stanceworks.com/wp-content/uploads/2020/08/for-ph-4-of-30.jpg');
INSERT INTO `prispevek` (`id_prispevek`, `id_autor`, `id_recenze`, `nazev`, `text`, `obrazky`) VALUES (2, 4, NULL, 'VW vyrabi mrdky exposed!', 'The American market has never been all too hot on the whole \"hatchback\" thing. We\'ve got a handful, of course, but chances are the first hatchback to come to mind for most Americans will be an EG or EK Honda Civic. That\'s likely to be followed by the Golf and GTi. Past that, it\'s anyone\'s guess. For one reason or another, it never caught on, and if you ask me, it\'s a tragedy. Not because we need more GTis on the road, but because of the cars automakers precluded us from getting. Over the years, countless cars have come and gone, each forbidden from landing on American shores: the Escort Cosworth RS, the Sierra RS Cosworth, the R5 Turbo, the 205 Turbo 16, the Delta HF Integrale Evo... and the list goes on. What they\'ve got in common, of course, is that they\'re all hot hatches. <br> It\'s a term that originated in the 1980s, and it\'s held on tight ever since. It followed with the Clio V6 in the early 2000s, and 2009\'s return of the Focus RS set the automotive world ablaze once again. One of the more recent cars that led Americans to lament the state of affairs is Europe\'s third-generation Volkswagen Scirocco. Launched in 2008, the hatchback brought the Scirocco namesake back to life. 2009\'s Scirocco R upped the ante, too, bringing an eventual 275 horsepower to the table, and it sent power to all four wheels. A hot hatch, indeed. <br> Stateside, though, we never got them. Neither the R nor the base model were suited for the American\'s general distaste for anything other than wildly lame crossovers and SUVs. Some of us, though, have been drooling ever since. Bringing André Sinzinger\'s example to the table only amplifies the sentiments. <br> Underneath, André began with the best the platform offers: the R model. Tidbits here and there like a carbon intake and a custom exhaust give embrace the \"R\" ethos, but the core of André\'s build is all about style. Needless to say, he\'s nailed it.', 'https://stanceworks.com/wp-content/uploads/2020/01/scirocco-2020-title.jpg;https://stanceworks.com/wp-content/uploads/2020/01/DSC03865.jpg;https://stanceworks.com/wp-content/uploads/2020/01/DSC03958.jpg;https://stanceworks.com/wp-content/uploads/2020/01/DSC03893.jpg');

COMMIT;
