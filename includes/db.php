<?php
    /*
    Name:           Ramandeep Rathor
    Name:           Musab Nazir
    Name:           Kevin Astilla
    Name:           Nathan Morris
    Description:    databse functions for Homes for Gnomes
    Date:
    */

    function db_connect()
    {
        return pg_connect("host=127.0.0.1 dbname=nazirm_db user=nazirm password=Iamaboy1" );
    }

    function updateLastAccess($conn)
    {
        $sql = "UPDATE users SET last_access = '". date("Y-m-d", time()) . "' WHERE user_id = '".$login."'";
        return pg_query($conn, $sql);
    }

    function login($login, $password)
    {
        $conn = db_connect();
        //make the query
        $sql = "SELECT user_type, email_address, enrol_date, last_access
        FROM users WHERE user_id = '".$login."' AND password= '".md5($password)."'";
        $result = pg_query($conn, $sql);
        return $result;
        //return true is match found ,else return false
        // if(pg_num_rows($result) > 0)
        // {
        //     return True;
        // }
        // else
        // {
        //     return False;
        // }
    }

    function userExists($login)
    {
        $conn = db_connect();
        //make the query
        $sql = "SELECT user_type, email_address, enrol_date, last_access
        FROM users WHERE user_id = '".$login."'";
        $result = pg_query($conn, $sql);
        //if nothing was found
        if(pg_num_rows($result) > 0)
        {
            return True;
        }
        else
        {
            return False;
        }
    }

?>
