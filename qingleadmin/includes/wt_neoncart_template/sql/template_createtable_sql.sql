CREATE TABLE IF NOT EXISTS wt_neoncart_template (
	opt_id int(11) NOT NULL AUTO_INCREMENT,
	lang_id int(11) NOT NULL DEFAULT '0',
	opt_name varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	opt_value text COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (opt_id)
);