<?php
use Pecee\Translation;
use Pecee\DB\Pdo;
use Pecee\Locale;

$key = \Pecee\Registry::getInstance();
$site = \Pecee\UI\Site::getInstance();
/* ---------- Configuration start ---------- */

// Debug mode enabled
$site->setDebug(true);

/* Database */
$key->set(Pdo::SETTINGS_CONNECTION_STRING, 'mysql:host=localhost;dbname=mp3search;charset=utf8');
$key->set(Pdo::SETTINGS_USERNAME, 'root');
$key->set(Pdo::SETTINGS_PASSWORD, '');

/* Site main language */
Locale::GetInstance()->setLocale('da-DK');
Locale::GetInstance()->setDefaultLocale('da-DK');

Translation::getInstance()->setType(Translation::TYPE_XML);

// Add IP's that are allowed to debug, clear-cache etc.
$site->addAdminIp('127.0.0.1');
$site->addAdminIp('::1');
/* ---------- Configuration end ---------- */
