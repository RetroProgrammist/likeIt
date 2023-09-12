<?php

namespace Rzhanau\Main\DataManager;

class DBInstall
{
    public static function install(DBInterface $DB): bool
    {
        try {
            /**
             * Создаем Таблицу отзывов если нет
             */
            if (empty($DB->query('SHOW TABLES LIKE "user_reviews"'))) {
                $query = 'CREATE TABLE user_reviews (
                    id int NOT NULL AUTO_INCREMENT,
                    name varchar(255),
                    email varchar(255),
                    active smallint,
                    text text,
                    images varchar(255),
                    date datetime DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (id)
                )';
                $DB->query($query);
            }
        } catch (\Exception) {
            //log
            return false;
        }

        return true;
    }
}