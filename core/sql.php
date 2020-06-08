<?php

namespace Database;

use Exception\DbConnectionException;

/**
 * Class sql
 * @package Database
 */
class sql extends \MySQLi
{

    /**
     * sql constructor.
     */
    private const alphabet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    public function __construct()
    {
        $config = json_decode(file_get_contents("config.json", true));

        parent::__construct($config->host, $config->user, $config->password, $config->database);

        if ($this->connect_errno) throw new DbConnectionException('Could not connect to MySQL server. ' . $this->connect_error);
        $this->set_charset('utf8');
    }

    /*
         * Users Table
         */

    /**
     * Registration
     * @param $login
     * @param $password
     * @return int inserted id
     */
    public function registerUser($login, $password)
    {
        $stmt = $this->prepare("insert into users (login, password) value (?, md5(?))");
        $stmt->bind_param("ss", $login, $password);
        $stmt->execute();
        if ($stmt->errno != 0) throw new DbConnectionException($stmt->error, $stmt->errno);
        $result = $stmt->insert_id;
        $stmt->close();
        return $result;
    }

    /**
     * Registration
     * @param $id
     * @param $permissions
     * @throws DbConnectionException in case of SQL error
     */
    public function setUserPermissions($id, $permissions)
    {
        $stmt = $this->prepare("update users set type = ? where id = ?");
        $stmt->bind_param("ii", $permissions, $id);
        $stmt->execute();
        if ($stmt->errno != 0) throw new DbConnectionException($stmt->error, $stmt->errno);
        $stmt->close();
    }

    /**
     * Authentication. Check user for valid with password
     * @param $login
     * @param $password
     * @return bool true if user exists, otherwise false
     * @throws DbConnectionException in case of SQL error
     */
    public function authentication($login, $password)
    {
        $stmt = $this->prepare("select count(*) from users where login = ? and password = md5(?)");
        $stmt->bind_param("ss", $login, $password);
        $stmt->execute();
        if ($stmt->errno != 0) throw new DbConnectionException($stmt->error, $stmt->errno);
        $result = (bool)$stmt->get_result()->fetch_array(MYSQLI_NUM)[0];
        $stmt->close();
        return $result;
    }

    /**
     * Authentication and authorization by token. Check user for valid with token
     * @param $id
     * @param $token
     * @return bool true if user exists with this token, otherwise false
     * @throws DbConnectionException in case of SQL error
     */
    public function authByToken($id, $token)
    {
        $stmt = $this->prepare("select count(*) from tokens t left join users u on t.user_id = u.id where u.id = ? and t.token = ? and current_timestamp() < t.expiration");
        $stmt->bind_param("is", $id, $token);
        $stmt->execute();
        if ($stmt->errno != 0) throw new DbConnectionException($stmt->error, $stmt->errno);
        $result = (bool)$stmt->get_result()->fetch_array(MYSQLI_NUM)[0];
        $stmt->close();
        return $result;
    }

    /**
     * Authorization. Token issuance
     * @param $userId
     * @return string 32 chars
     * @throws DbConnectionException in case of SQL error
     */
    public function authorization($userId)
    {
        do {
            $token = "";
            for ($i = 0; $i < 32; ++$i) {
                $token .= self::alphabet[rand(0, strlen(self::alphabet) - 1)];
            }
            $stmt = $this->prepare("select count(*) from tokens where token = ?");
            $stmt->bind_param("s", $token);
            $stmt->execute();
            if ($stmt->errno != 0) throw new DbConnectionException($stmt->error, $stmt->errno);
            $result = (bool)$stmt->get_result()->fetch_array(MYSQLI_NUM)[0];
            $stmt->close();
        } while ($result);
        $stmt = $this->prepare("insert into tokens (user_id, token, expiration) value (?, ?, current_timestamp() + interval 1 day)");
        $stmt->bind_param("is", $userId, $token);
        $stmt->execute();
        if ($stmt->errno != 0) throw new DbConnectionException($stmt->error, $stmt->errno);
        $stmt->close();
        return $token;
    }

    /**
     * Get user id by login
     * @param $login
     * @return int
     * @throws DbConnectionException in case of SQL error
     */
    public function getUserId($login)
    {
        $stmt = $this->prepare("select id from users where login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        if ($stmt->errno != 0) throw new DbConnectionException($stmt->error, $stmt->errno);
        $result = $stmt->get_result()->fetch_array(MYSQLI_NUM)[0];
        $stmt->close();
        return $result;
    }

    /**
     * Get user info by id
     * @param $id
     * @return array
     * @throws DbConnectionException in case of SQL error
     */
    public function getUserInfo($id)
    {
        $stmt = $this->prepare("select id, login, type from users where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        if ($stmt->errno != 0) throw new DbConnectionException($stmt->error, $stmt->errno);
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    /**
     * Get user permissions
     * @param $id
     * @return int
     * @throws DbConnectionException in case of SQL error
     */
    public function getUserPermissions($id)
    {
        $stmt = $this->prepare("select type from users where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        if ($stmt->errno != 0) throw new DbConnectionException($stmt->error, $stmt->errno);
        $result = $stmt->get_result()->fetch_array(MYSQLI_NUM)[0];
        $stmt->close();
        return $result;
    }

    /**
     * Check user exists by login
     * @param $login
     * @return bool
     * @throws DbConnectionException in case of SQL error
     */
    public function checkUserExists($login)
    {
        $stmt = $this->prepare("select count(*) from users where login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        if ($stmt->errno != 0) throw new DbConnectionException($stmt->error, $stmt->errno);
        $result = (bool)$stmt->get_result()->fetch_array(MYSQLI_NUM)[0];
        $stmt->close();
        return $result;
    }

    /**
     * Invalidate Token
     * @param $userId
     * @param $token
     * @throws DbConnectionException in case of SQL error
     */
    public function invalidateToken($userId, $token)
    {
        $stmt = $this->prepare("delete from tokens where user_id = ? and token = ?");
        $stmt->bind_param("is", $userId, $token);
        $stmt->execute();
        if ($stmt->errno != 0) throw new DbConnectionException($stmt->error, $stmt->errno);
        $stmt->close();
    }
}