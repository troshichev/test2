<?php

class CMySQL {

    // Перменные
    var $sDbName;
    var $sDbUser;
    var $sDbPass;

    var $vLink;

    // Конструктор
    function CMySQL() {
        $this->sDbName = '_DATABASE_NAME_';
        $this->sDbUser = '_DATABASE_USERNAME_';
        $this->sDbPass = '_DATABASE_USERPASS_';

        // Создаем соединение с сервером баз данных
        $this->vLink = mysql_connect("localhost", $this->sDbUser, $this->sDbPass);

        // Выбираем базу данных
        mysql_select_db($this->sDbName, $this->vLink);

        mysql_query("SET names UTF8");
    }

    // Возвращаем одно значение
    function getOne($query, $index = 0) {
        if (! $query)
            return false;
        $res = mysql_query($query);
        $arr_res = array();
        if ($res && mysql_num_rows($res))
            $arr_res = mysql_fetch_array($res);
        if (count($arr_res))
            return $arr_res[$index];
        else
            return false;
    }

    // Выполняем запрос SQL
    function res($query, $error_checking = true) {
        if(!$query)
            return false;
        $res = mysql_query($query, $this->vLink);
        if (!$res)
            $this->error('Database query error', false, $query);
        return $res;
    }

    // Возвращаем таблицу записей в виде пар
    function getPairs($query, $sFieldKey, $sFieldValue, $arr_type = MYSQL_ASSOC) {
        if (! $query)
            return array();

        $res = $this->res($query);
        $arr_res = array();
        if ($res) {
            while ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
                $arr_res[$row[$sFieldKey]] = $row[$sFieldValue];
            }
            mysql_free_result($res);
        }
        return $arr_res;
    }

    // Возвращаем таблицу записей
    function getAll($query, $arr_type = MYSQL_ASSOC) {
        if (! $query)
            return array();

        if ($arr_type != MYSQL_ASSOC && $arr_type != MYSQL_NUM && $arr_type != MYSQL_BOTH)
            $arr_type = MYSQL_ASSOC;

        $res = $this->res($query);
        $arr_res = array();
        if ($res) {
            while ($row = mysql_fetch_array($res, $arr_type))
                $arr_res[] = $row;
            mysql_free_result($res);
        }
        return $arr_res;
    }

    // Возвращаем одну строку
    function getRow($query, $arr_type = MYSQL_ASSOC) {
        if(!$query)
            return array();
        if($arr_type != MYSQL_ASSOC && $arr_type != MYSQL_NUM && $arr_type != MYSQL_BOTH)
            $arr_type = MYSQL_ASSOC;
        $res = $this->res ($query);
        $arr_res = array();
        if($res && mysql_num_rows($res)) {
            $arr_res = mysql_fetch_array($res, $arr_type);
            mysql_free_result($res);
        }
        return $arr_res;
    }

    // Выход
    function escape($s) {
        return mysql_real_escape_string($s);
    }

    // Получаем последний ID 
    function lastId() {
        return mysql_insert_id($this->vLink);
    }

    // Выводим ошибки
    function error($text, $isForceErrorChecking = false, $sSqlQuery = '') {
        echo $text; exit;
    }
}

$GLOBALS['MySQL'] = new CMySQL();

?>