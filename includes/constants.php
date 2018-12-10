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
    define("DB_USER","rathorr");
    define("COOKIE_LIFESPAN",time() + 60*60*24*7);

    //All constants for the ppassword and username
    define("MINIMUM_ID_LENGTH", 5);
    define("MAXIMUM_ID_LENGTH", 20);
    define("MINIMUM_PASSWORD_LENGTH", 6);
    define("MAXIMUM_PASSWORD_LENGTH", 15);
    define("MAX_FIRST_NAME_LENGTH", 20);
    define("MAX_LAST_NAME_LENGTH", 30);
    define("MAXIMUM_EMAIL_LENGTH", 255);
    define("MINIMUM_PHONE_NUMBER_LENGTH", 10);
    define("MAXIMUM_PHONE_NUMBER_LENGTH", 15);
    define("MINIMUM_PHONE_RANGE", 200);
    define("MAXIMUM_PHONE_RANGE", 999);
    define("MAXIMUM_IMAGE_SIZE",3000000);

    //constants for listing status

    define("OPEN","o");
    define("CLOSED","c");
    define("SOLD","s");
    define("HIDDEN","h");
    //regex for the canadian postal code
    //reference :https://gist.github.com/james2doyle/c310e6ceeb3bad437621
    define("CANADIAN_POSTAL_CODE","/^([a-zA-Z]\d[a-zA-Z])\ {0,1}(\d[a-zA-Z]\d)$/");

    define("PRICE_FILTER", "/^(?:0|[1-9]\d*)(?:\.\d{2})?$/");
    define("PREVIEW_LINE_LIMIT",3);

$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
);


?>
