<?php

/** @var rex_addon $this */

// Diese Datei ist keine Pflichtdatei mehr.

// SQL-Anweisungen können auch weiterhin über die install.sql ausgeführt werden.

// Abhängigkeiten (PHP-Version, PHP-Extensions, Redaxo-Version, andere Addons/Plugins) sollten in die package.yml eingetragen werden.
// Sie brauchen hier dann nicht mehr überprüft werden!

// Hier können zum Beispiel Konfigurationswerte in der rex_config initialisiert werden.
// Das if-Statement ist notwendig, um bei einem reinstall die Konfiguration nicht zu überschreiben.
if (!$this->hasConfig()) {
    //Tue etwas
}

// Mit einer rex_functional_exception kann die Installation mit einer Fehlermeldung abgebrochen werden.
$somethingIsWrong = false;
if ($somethingIsWrong) {
    throw new rex_functional_exception('Something is wrong');
}

// Alternativ kann ähnlich wie in R4 mit den Properties "install" und "installmsg" die Installation als nicht erfolgreich markiert werden.
// Im Gegensatz zu R4 muss für eine erfolgreiche Installation keine Property mehr gesetzt werden.
if ($somethingIsWrong) {
    $this->setProperty('installmsg', 'Something is wrong');
    $this->setProperty('install', false);
}

$mf_videohandbuch_table = '
CREATE TABLE '.rex::getTable("mf_videohandbuch").' (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(512) NOT NULL default \'\',
  `description` text NOT NULL,
  `videoid` text NOT NULL,
  PRIMARY KEY  (`id`)
  )
  ENGINE = INNODB, 
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
';

$mf_sql = rex_sql::factory();
$mf_sql->setQuery($mf_videohandbuch_table);
