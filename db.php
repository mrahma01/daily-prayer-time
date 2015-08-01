<?php
function db_connect()
{
    $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
    if (!$link) {
        die('Not connected : ' . mysql_error());
    }

    $db_selected = mysql_select_db(DB_NAME, $link);
    if (!$db_selected) {
        die ('Can\'t use database: ' . mysql_error());
    }
}

function db_query($sql)
{
    return mysql_query($sql);
}

function db_affected_rows($result)
{
    return mysql_affected_rows($result);
}

function db_num_rows($result)
{
    return mysql_num_rows($result);
}

function db_fetch_array($result)
{
    return mysql_fetch_array($result);
}

function db_query_return_as_array($sql)
{
    $result = db_query($sql);
    if(db_num_rows($result)>0){
            $resArray = array();
            while($row = db_fetch_array($result)) {
                    $resArray[] = $row;
            }
            return $resArray;
    }
    return false;
}
