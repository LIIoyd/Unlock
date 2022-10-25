<?php
use Doctrine\DBAL\DriverManager;

return DriverManager::getConnection([
    'dbname' => 'Unlock',
    'user' => 'root',
    'password' => 'root',
    'host' => 'mariadb',
    'driver' => 'pdo_mysql',
]);