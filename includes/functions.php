<?php
	/*
	Name:           Ramandeep Rathor
	Name:           Musab Nazir
	Name:           Kevin Astilla
	Name:           Nathan Morris
	Description:    constant variables for Homes for Gnomes
	Date:
	*/


	function evaluate( $d1, $d2, $op)
	{
		switch($op) {
			case '+' : // addition
				$result = $d1 + $d2;
				break;
			case '-' : // subtraction
				$result = $d1 - $d2;
				break;
			case '*' : // multiplication
				$result = $d1 * $d2;
				break;
			default :  // Unidentified, return safe value
				$result = 0;
		}
		return $result;
	}


	/* Return a number in the range 0-9 inclusive
	 */
	function randdigit()
	{
		return mt_rand(0,9);
	} // end functionranddigit()

	function randop()
	{
		$ops = array('+', '-', '*');
		// pick a random index between zero and highest index in array.
		$randnum = mt_rand(0,sizeof($ops)-1);
		return $ops[$randnum];  // Use the index to pick the operator
	}

	function isGet()
	{
	    $returnValue = false;
	    if($_SERVER["REQUEST_METHOD"] == "GET") $returnValue = true;
	    return $returnValue;
	}

	function isPost()
	{
	    $returnValue = false;
	    if($_SERVER["REQUEST_METHOD"] == "POST") $returnValue = true;
	    return $returnValue;
	}

	function convertCelsiustoFahrenheit($celsius)
	{
	    return (9.0/5.0*$celsius + 32);
	}

	function displayCopyrightInfo()
	{
	    echo "&copy; HomesForGnomes ".date('Y')." ";
	}

	function sticky()
	{
	    echo $_SERVER['PHP_SELF'];
	}

	function LengthValidation($type, $input)
	{
	    $error = "";
	    //validation on the user id
	    if($type === "id")
	    {
	        if(strlen($input) < MINIMUM_ID_LENGTH) $error .= "User ID must be greater than ". MINIMUM_ID_LENGTH . " characters long<br/>";
	        else if(strlen($input) > MAXIMUM_ID_LENGTH) $error .= "User ID must be less than ". MAXIMUM_ID_LENGTH . " characters long<br/>";
	    }
	    //validate email
	    if($type === "email")
	    {
	        if(strlen($input) > MAXIMUM_EMAIL_LENGTH) $error .= "Email must be less than ". MAXIMUM_EMAIL_LENGTH . " characters long<br/>";
	    }
	    //validate password
	    if($type === "pass")
	    {
	        if(strlen($input) < MINIMUM_PASSWORD_LENGTH) $error .= "Password must be greater than ". MINIMUM_PASSWORD_LENGTH . " characters long<br/>";
	        else if(strlen($input) > MAXIMUM_PASSWORD_LENGTH) $error .= "Password must be less than ". MAXIMUM_PASSWORD_LENGTH . " characters long<br/>";
	    }
	    // validate first name
	    if($type === "fname")
	    {
	        if(strlen($input) > MAX_FIRST_NAME_LENGTH) $error .= "First name must be less than ". MAX_FIRST_NAME_LENGTH . " characters long<br/>";
	    }
	    // validate last name
	    if($type === "lname")
	    {
	        if(strlen($input) > MAX_LAST_NAME_LENGTH) $error .= "Last name must be less than ". MAX_LAST_NAME_LENGTH . " characters long<br/>";
	    }
	    if($type === "phone")
	    {
	    	if(strlen($input) > MINIMUM_PHONE_NUMBER_LENGTH) $error .= "phone number must be greater than ". MINIMUM_PHONE_NUMBER_LENGTH . " digits long<br/>";
	        else if(strlen($input) > MAXIMUM_PHONE_NUMBER_LENGTH) $error .= "phone number must be less than ". MAXIMUM_PHONE_NUMBER_LENGTH . " digits long<br/>";
	    }
	    return $error;
	}
	function isValidPhoneNumber($phoneNumber)
	{

		if(!isset($phoneNumber) || $phoneNumber == "")
		{
			$valid = false;
		}
		else if(!is_numeric($phoneNumber))
		{
			$valid = false;
		}
		else if(strlen($phoneNumber) < MINIMUM_PHONE_NUMBER_LENGTH)
		{
			$valid = false;
		}
		else if (!regexCheck($phoneNumber))
		{
			$valid = false;
		}
		else
		{
			$valid = true;
		}
		return $valid;

	}
	/*
	function displayPhoneNumber($phoneNumber)
	{

		if (isValidPhoneNumber($phoneNumber))
		{
		}

	}*/
	function CleanPhoneNumber($phoneNumber)
	{
		$cleanedNumber = preg_replace('/[^0-9]/','', $phoneNumber);
		return $cleanedNumber;
	}
	function regexCheck($phoneNumber)
	{
		$pattern = "/^[2-9]\d{2}\d{3}\d{4}/";

		return (bool)preg_match($pattern, $phoneNumber);
	}
	function isValidPostalCode($postalCode)
	{
		$cleanedPostalCode = str_replace(' ', '', $postalCode);
		return (bool)preg_match(CANADIAN_POSTAL_CODE, $cleanedPostalCode);
	}


	function dump($arg)
	{
	    echo "<pre>";
	    echo (is_array($arg))? print_r($arg): $arg;
	    echo "</pre>";
	}

    function decimal_to_binary_array($value)
    {
        //transform the value into binary value then reverse
        //after reversal, split into array and then its ready for a loop
        $binary = strrev(decbin($value));
        $binaryArray = str_split($binary);

        return $binaryArray;
    }
    
    function sum_check_box($array)
    {
        $num_checks = count($array); 
        $sum = 0;
        for ($i = 0; $i < $num_checks; $i++)
        {
          $sum += $array[$i]; 
        }
        return $sum;
    }


?>
<script type="text/javascript">
var expanded = false;

function showCheckboxes(section) {
  var checkboxes = section.parentNode.getElementsByClassName("dropdownContent")[0];
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>

