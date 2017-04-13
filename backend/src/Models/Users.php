<?php

namespace TailorTest\Models;

use Phalcon\Db\Adapter\Pdo\Postgresql;
use Phalcon\Mvc\Model;

/**
 * Class Users
 * @package TailorTest\Models
 * @author Tobias Derksen <t.derksen@gmx.de>
 *
 * @property int $id
 * @property string $username
 * @property string $mail
 */
class Users extends Model {

    public static function initTable(Postgresql $db) {

        $db->execute("CREATE TABLE IF NOT EXISTS users (id SERIAL PRIMARY KEY, username character varying(255) NOT NULL UNIQUE, mail character varying(255) NOT NULL);");

        $users = $db->fetchAll("SELECT * FROM users");

        if (empty($users)) {
            $db->execute("INSERT INTO users(username,mail) VALUES ('testuser1', 'test@no-reply.com'), ('testuser2', 'test2@no-replay.com');");
        }

    }

}