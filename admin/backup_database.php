<?php
include('../config.php');

// Database Backup for site1.com
// Run via site1.com
define('DB_HOST', 'localhost');
define('DB_NAME', 'pymusic');
define('DB_USER', 'root');
define('DB_PASSWORD', 'ulut123');
define('BACKUP_SAVE_TO', '/var/www/pymusic.server1/admin/backups/'); // without trailing slash
$time = date("Y-m-d_H:i:s");
$backupFile = BACKUP_SAVE_TO . '/' . DB_NAME .$time.'.sql.gz';

//$command = 'mysqldump -u root -p ulut123 --ignore-table=pymusic.fingerprint | gzip > ' . $backupFile;

echo $command = 'mysqldump --ignore-table=pymusic.fingerprint -h ' . DB_HOST . ' -u ' . DB_USER . ' -p\'' . DB_PASSWORD . '\' ' . DB_NAME . ' | gzip > ' . $backupFile;
//system($command);
?>