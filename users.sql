
# Privilegios para `adminShareFilm`@`localhost`

GRANT USAGE ON *.* TO 'adminShareFilm'@'localhost' IDENTIFIED BY PASSWORD '*C30ECB583C72D4D52BBDE80D5757D837FD21081E';

GRANT SELECT, INSERT, UPDATE, DELETE ON `sharefilm`.* TO 'adminShareFilm'@'localhost';
