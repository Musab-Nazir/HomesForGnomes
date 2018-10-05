<?php
    /*
    Name:           Ramandeep Rathor
    Name:           Musab Nazir
    Name:           Kevin Astilla
    Name:           Nathan Morris
    Description:    databse functions for Homes for Gnomes
    Date:
    */
include "constants.php";

    function db_connect()
    {
<<<<<<< HEAD
        //return pg_connect("host=127.0.0.1 dbname=group24_db user=group24_admin password=buffetboys48" );
        return pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASSWORD."" );
=======
        return pg_connect("host=127.0.0.1 dbname=group24_db user=group24_admin password=buffetboys48" );
>>>>>>> 2984bbce3c1f252110b016965d90945587fd9ce3
    }

    function updateLastAccess($conn)
    {
        $sql = "UPDATE users SET last_access = '". date("Y-m-d", time()) . "' WHERE user_id = '".$login."'";
        return pg_query($conn, $sql);
    }

    function login($login, $password)
    {
        // $conn = db_connect();
        // //make the query
        // $sql = "SELECT user_type, email_address, enrol_date, last_access
        // FROM users WHERE user_id = '".$login."' AND password= '".md5($password)."'";
        // $result = pg_query($conn, $sql);
        // return $result;
        // //return true is match found ,else return false
        // // if(pg_num_rows($result) > 0)
        // // {
        // //     return True;
        // // }
        // // else
        // // {
        // //     return False;
        // // }
        $conn = db_connect();
        $result = pg_prepare($conn, "my_query", 'SELECT * FROM users WHERE user_id = $1 AND password= $2');
        $result = pg_execute($conn, "my_query", array($login,hash("md5",$password)));

        return $result;
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
