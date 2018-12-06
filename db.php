<?php
include 'dbConfiguration.php';

function connectDb()
{
    $link = @mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB)
    or die("Error: " . mysqli_error($link));
    if (!mysqli_set_charset($link, "utf8")) {
        printf("Error: " . mysqli_error($link));
    }
    return $link;
}

function writeDbArray($tableName, $text, $total_sms)
{
    $query = "";
    $link = connectDb();
    $text = mysqli_real_escape_string($link, $text);
    $text = preg_replace('/[^ a-zа-яё\d]/ui', '', $text);
    $query = "INSERT INTO `" . MYSQL_DB . "`.`" . $tableName . "`(text, total_sms) VALUES ('" . $text . "', '" . $total_sms. "'); ";
    $result = @mysqli_query($link, $query);
    mysqli_close($link);
    return $result;
}

function createTable($tableName)
{
    $slink = connectDb();
    $tquery = @mysqli_query($slink, "SELECT COUNT(*) FROM `" . MYSQL_DB . "`.`" . $tableName . "`");
    if (!$tquery) {
        $query = "CREATE TABLE `" . MYSQL_DB . "`.`" . $tableName . "` ( `id` INT NOT NULL AUTO_INCREMENT , `text` TEXT NULL DEFAULT NULL , `total_sms` INT NULL DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB";
        $result = mysqli_query($slink, $query);
    }
    return $result;
}
