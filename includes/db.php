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
        return pg_connect("host=127.0.0.1 dbname=astillak_db user=astillak password=100396393" );
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
    function personalInformation($userId)
    {
        $conn = db_connect();
        $result = pg_prepare($conn, "my_query_p", 'SELECT * FROM persons WHERE user_id = $1');
        $result = pg_execute($conn, "my_query_p", array($userId));

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

    function build_dropdown($table, $selected)
    {
        $conn = db_connect();
        $sql = "SELECT value, property FROM ".$table; 
        $results = pg_query($conn, $sql);
        $dropdown = '<select name="'.$table.'">';

        For($rows = 0; $rows < pg_num_rows($results); $rows++)
        {
            $select ="";
            $value = pg_fetch_result($results,$rows, "value");
            $property = pg_fetch_result($results,$rows, "property");
            if($selected == $value)
                {$select =  'selected =\"selected\"';}
            $dropdown .='\n\t <option value ="'.$value.'" '.$select.' >'.$property.'</option>';
        }    
        $dropdown  .= '\n\t</select>';
        return $dropdown;
    }
    function build_simple_dropdown($table, $selected)
    {
        $conn = db_connect();
        $sql = "SELECT value FROM ".$table;
        $results = pg_query($conn, $sql);
        if (!$results) 
        {
            echo "An error occurred.\n";
            exit;
        }

        $dropdown = '<select name="'.$table.'">';
        
        For($rows = 0; $rows < pg_num_rows($results); $rows++)
        {
            $select = "";
            $value = pg_fetch_result($results,$rows, "value");
            if($selected == trim($value))
                {$select =  'selected ="selected"';}
            $dropdown .='\n\t <option value ="'.trim($value).'" '.$select.' >'.$value.'</option>';
        }    
        $dropdown  .= '\n\t</select>';
        return $dropdown;
    }
    function build_radio($table, $selected)
    {
        $conn = db_connect();
        $sql = "SELECT * FROM ".$table;
        
        $results = pg_query($conn, $sql);
        $radio = "";

        For($rows = 0; $rows<pg_num_rows($results); $rows++)
        {
            $select ="";
            $value = pg_fetch_result($results,$rows, "value");
            $property = pg_fetch_result($results,$rows, "property");

            if($selected == trim($value))
               {$select =  'checked="checked"';}
            $radio .= '<input type ="radio" name="'.$table.'" value="'.$value.'" '.$select.'/>'.$property.'<br/>';
        }
        return $radio;
    }
    function get_property($table, $value)
    {
        $conn = db_connect();
        $sql = "SELECT property FROM ".$table." WHERE value = '".$value."'";
        return pg_query($conn, $sql);
    }

?>
