<?php

/*
Name:           Ramandeep Rathor
Name:           Musab Nazir
Name:                 Kevin Astilla
Name:                 Nathan Morris
Description:    Create Listing File For Homes For Gnomes
Date

// have aform here
//allow multiple uploads in the file
//hav a form that verifies the page
*/

require "header.php";
if($_SESSION['userType'] != "a")
{
    $_SESSION['RedirectError'] = "You were not logged in as an Agent<br/>";
    header("Location:login.php");
}

$login = $_SESSION["userID"];
$imagePath = "images/upload/temp";
$error = "";
$tempName = "";
if(isPost()){

	$uploadedFiles = count($_FILES["listing_image"]["name"]);
	$imageNames = array_fill(0, $uploadedFiles, null);

	if(isset($_POST['upload']))
	{
		$imageCount = 1;
		For($rows = 0; $rows < $uploadedFiles; $rows++){

		if($_FILES["listing_image"]["error"][$rows] != 0)
		{
		    $error .= $phpFileUploadErrors[$_FILES["listing_image"]["error"][$rows]];

		}
		else if($_FILES["listing_image"]["size"][$rows] > MAXIMUM_IMAGE_SIZE) //size in bytes
		{
		    $error .= "<br/>File selected is too big ". $_FILES["listing_image"]["name"][$rows];
		}
		else if($_FILES["listing_image"]["type"][$rows] != "image/jpeg" && $_FILES["listing_image"]["type"][$rows] != "image/jpg" )
		{
		    $error .= "<br/>image type is not supported ". $_FILES["listing_image"]["name"][$rows];
		}
		else
		{
			//display the uploaded files name for confirmation
			//
			if(!is_dir($imagePath))
			{mkdir($imagePath, 0775,true);}
		
			$imageNames[$rows] = $_FILES["listing_image"]["name"][$rows];
			$imageCount = $rows + 1;
			$tempName = $_FILES["listing_image"]["tmp_name"][$rows];
			$imagePathAndFile = $imagePath.$imageNames[$rows];
	        move_uploaded_file($tempName, $imagePathAndFile);
	        $ext = ".".pathinfo($imageNames[$rows], PATHINFO_EXTENSION);
	        $newName = $imagePath.$login.strval($imageCount).$ext;
	        rename($imagePathAndFile, $newName);

		}
	}
		if($error == ""){
			$_SESSION['imageCount'] = $imageCount;
		}

	}
}

?>

<div class="container">

  <div class="row" style="margin-top:75px">
<?php echo $error; ?>
<form action="<?php sticky();?>" method="post" enctype="multipart/form-data">

<label for="form_file">upload images:</label>
<br/>
<input name="listing_image[]" type="file" multiple />

<br/>
<input type="submit" name="upload" value="upload" />

</form>
</div>
</div>
<?php
  include 'footer.php'
?>
