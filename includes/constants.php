<?php
    /*
    Name:         	Ramandeep Rathor
    Name:           Musab Nazir
    Name:			Kevin Astilla
    Name:			Nathan Morris
    Description:  	constant variables for Homes for Gnomes
    Date:         	01 October 2018
    */

    define("ADMIN","s");
    define("AGENT","a");
    define("CLIENT","c");
    define("PENDING","p");
    define("DISABLED","d");

    define("DB_HOST","127.0.0.1");
    define("DB_NAME","group24_db");
    define("DB_PORT","5432");
    define("DB_PASSWORD","buffetboys48");
    define("DB_USER","group24_admin");
    define("COOKIE_LIFESPAN",time() + 60*60*24*7);

    //All constants for the ppassword and username
    define("MINIMUM_ID_LENGTH", 5);
    define("MAXIMUM_ID_LENGTH", 20);
    define("MINIMUM_PASSWORD_LENGTH", 6);
    define("MAXIMUM_PASSWORD_LENGTH", 15);
    define("MAX_FIRST_NAME_LENGTH", 20);
    define("MAX_LAST_NAME_LENGTH", 30);
    define("MAXIMUM_EMAIL_LENGTH", 255);

    define("HASH_STYLE", md5);


?>
