<?php

use \Pecee\Locale;
use \Pecee\Language;

$key = \Pecee\Registry::GetInstance();
$site = \Pecee\UI\Site::GetInstance();
/* ---------- Configuration start ---------- */

// Your custom namespace
$key->set('AppName', 'mp3vibez');

// Debug mode enabled
$site->setDebug(true);

/* Database */
$key->set('DBUsername', 'root');
$key->set('DBPassword', '');
$key->set('DBHost', '127.0.0.1');
$key->set('DBDatabase', 'mp3search');

/* Site main language */
Locale::GetInstance()->setLocale('da-DK');
Locale::GetInstance()->setDefaultLocale('da-DK');

Language::getInstance()->setType(Language::TYPE_XML);

// Add IP's that are allowed to debug, clear-cache etc.
$site->addAdminIp('127.0.0.1');
$site->addAdminIp('::1');
/* ---------- Configuration end ---------- */
