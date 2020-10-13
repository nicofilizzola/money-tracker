CREATE TABLE users (
	id_users INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	email_users TINYTEXT NOT NULL,
	uid_users TINYTEXT NOT NULL,
	pwd_users LONGTEXT NOT NULL
);

CREATE TABLE accounts (
	id_accounts INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	name_accounts TINYTEXT NOT NULL,
	country_accounts TINYTEXT NOT NULL,
	currency_accounts TINYTEXT NOT NULL
);

CREATE TABLE moves (
	id_moves INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_users INT(11) NOT NULL,
	FOREIGN KEY (id_users) REFERENCES users(id_users),
	id_accounts INT(11) NOT NULL,
	FOREIGN KEY (id_account) REFERENCES accounts(id_accounts),
	amount_moves INT(255) NOT NULL,
	ref_moves TINYTEXT,
	date_moves DATE NOT NULL
);


/* BANKS FRANCE */

INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Société Générale","France","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("HSBC France","France","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("LCL Banque et assurance","France","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("BNP Paribas","France","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Banque Populaire","France","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Crédit Agricole","France","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Caisse d'Épargne","France","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("La Banque Postale","France","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Crédit Mutuel (CIC)","France","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Boursorama","France","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Orange Bank","France","€");

/* BANKS USA */
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Chase Bank","United States of America","$");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Bank of America","United States of America","$");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Wells Fargo Bank","United States of America","$");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Citibank","United States of America","$");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("US Bank National Association","United States of America","$");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Truist Bank","United States of America","$");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("PNC Bank","United States of America","$");

/* BANKS SPAIN */
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Santander","España","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("BBVA","España","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("CaixaBank","España","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Bankia","España","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Sabadell","España","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Bankinter","España","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Unicaja","España","€");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Abanca","España","€");

/* BANKS UK */
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Barclays","United Kingdom","£");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Lloyds","United Kingdom","£");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("HSBC","United Kingdom","£");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Santander","United Kingdom","£");
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("The Royal Bank of Scotland","United Kingdom","£");

/* BANK CHILE */
INSERT INTO accounts(name_accounts, country_accounts, currency_accounts) VALUES ("Banco del Estado de Chile","Chile","$");

UPDATE accounts SET currency_accounts = '&euro;' WHERE currency_accounts = '€';

UPDATE accounts SET currency_accounts = '&pound;' WHERE currency_accounts = '£';

