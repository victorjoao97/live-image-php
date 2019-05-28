<?php
include '../config/config.php';
/***********************************************************************************************************
* Upload and Watermark Image Files without Refreshing Page using Ajax and Jquery
* Written by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: info@vasplus.info

**********************************Copyright Information*****************************************************
* This script has been released with the aim that it will be useful.
* Please, do not remove this copyright information from the top of this page 
* If you want the copyright info to be removed from the script then you have to buy this script.
* This script must not be used for commercial purpose without the consent of Vasplus Programming Blog.
* This script must not be sold.
* All Copy Rights Reserved by Vasplus Programming Blog
*************************************************************************************************************/


//This function generates a random name for the uploaded image files
function vpb_generate_random_name() 
{
	$stringa = rand(0,99999);
	return $stringa;
}

//This function performs image watermark or the function that stamps the uploaded image files
//It holds three attributes or has three fields which are shown below:
// 1. $vpb_old_file_name: This is the name of the image file that a user wants to upload
// 2. $vpb_new_file_name: This is the new name that you want the uploaded image file to bear or have
// 3. $vpb_watermark_file_name: This is the image file that has the watermark or stamp that you want to put or place on the uploaded image file
function vpb_image_water_mark($vpb_old_file_name, $vpb_new_file_name, $vpb_watermark_file_name)
{
	if(file_exists($vpb_watermark_file_name))
	{
		//Width and Height that you want your uploaded image files to be
		//$nova = getimagesize($vpb_old_file_name);

		// $vpb_file_width = getimagesize($vpb_old_file_name)[0];
		// $vpb_file_height = getimagesize($vpb_old_file_name)[1];
		$vpb_file_width = 1366;
		$vpb_file_height = 768;
		
		$vpb_image_src = true;
		$vpb_water_mark_file_with_this = true;
		
		$vpb_upload_file_extension = strtolower(pathinfo($vpb_old_file_name, PATHINFO_EXTENSION)); // Get file extension for uploaded image file
		$vpb_water_mark_file_extension = strtolower(pathinfo($vpb_watermark_file_name, PATHINFO_EXTENSION)); // Get file extension for water image file
		
		list($vpb_old_file_width,$vpb_old_file_height) = getimagesize($vpb_old_file_name); // Gets file size

		$vpb_file_tmp = imagecreatetruecolor($vpb_file_width, $vpb_file_height); // Creates true file color
		
		/* Create images based on their file types */
		if($vpb_upload_file_extension == "gif") //If the attached file extension is a gif, carry out the below action
		{
			$vpb_image_src = imagecreatefromgif($vpb_old_file_name); //This will create a gif image file
		}
		elseif($vpb_upload_file_extension == "jpg" || $vpb_upload_file_extension == "jpeg") //If file is a jpg or jpeg, carry out the below action
		{
			$vpb_image_src = imagecreatefromjpeg($vpb_old_file_name); //This will create a jpg or jpeg image file
		}
		else if($vpb_upload_file_extension=="png") //If the attached file extension is a png, carry out the below action
		{
			$vpb_image_src = imagecreatefrompng($vpb_old_file_name); //This will create a png image file
		}
		else
		{
			$vpb_image_src = false;
		}
		
		
		if($vpb_image_src == false)
		{
			//If the file attached is unknow, return false
			print 'O tipo de arquivo anexado não é permitido. Este sistema só aceita jpeg, jpg, gif ou png';
			return false;
		}
		else
		{
			imagecopyresampled($vpb_file_tmp, $vpb_image_src, 0, 0, 0, 0, $vpb_file_width, $vpb_file_height, $vpb_old_file_width, $vpb_old_file_height);
			
			/* watermark images based on their file types */
			if($vpb_water_mark_file_extension == "gif")
			{
				$vpb_water_mark_file_with_this = imagecreatefromgif($vpb_watermark_file_name);
			}
			elseif($vpb_water_mark_file_extension == "jpg" || $vpb_water_mark_file_extension == "jpeg")
			{
				$vpb_water_mark_file_with_this = imagecreatefromjpeg($vpb_watermark_file_name);
			}
			else if($vpb_water_mark_file_extension=="png")
			{
				$vpb_water_mark_file_with_this = imagecreatefrompng($vpb_watermark_file_name);
			}
			else
			{
				$vpb_water_mark_file_with_this = false;
			}
			
			if($vpb_water_mark_file_with_this == false)
			{
				print 'A marca d\'água tipo arquivo de imagem não é permitido. Este sistema só aceita jpeg, jpg, gif ou png';
				return false;
			}
			else
			{
				list($vpb_water_mark_file_width, $vpb_water_mark_file_height) = getimagesize($vpb_watermark_file_name);
				// $vpb_water_mark_file_width /= 2;
				// $vpb_water_mark_file_height /= 2;
				$vpb_water_mark_file_position_x = $vpb_file_width - $vpb_water_mark_file_width-25; 
				$vpb_water_mark_file_position_y = $vpb_file_height - $vpb_water_mark_file_height-2;
				imagecopy($vpb_file_tmp, $vpb_water_mark_file_with_this, $vpb_water_mark_file_position_x, $vpb_water_mark_file_position_y, 0, 0, $vpb_water_mark_file_width, $vpb_water_mark_file_height);
				imagejpeg($vpb_file_tmp, $vpb_new_file_name, 100);
				imagedestroy($vpb_file_tmp);
				@unlink($vpb_old_file_name);
				return true;
			}
		}
	}
	else
	{
		print 'O arquivo de imagem de marca d\'água <b>'.$vpb_watermark_file_name.'</b> não existe. Por favor, certifique-se este arquivo está disponível e tente novamente.';
		return false;
	}
}

//This is the directory where uploaded files are saved
$upload_location = path("assets/images/events/" . $_POST['event'] . "/");


if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") // Validate the request brought from the JS file
{
	if(is_array($_FILES["vasPhoto_uploads"]["tmp_name"])){
		foreach ($_FILES["vasPhoto_uploads"]["tmp_name"] as $key => $value) {
			$name = $_FILES['vasPhoto_uploads']['name'][$key]; // Name of the image file to be uploaded
			$size = $_FILES['vasPhoto_uploads']['size'][$key]; // Size of the image file to be uploaded
			
			$allowedExtensions = array("jpg","jpeg","gif","png");  //Allowed file types
			
			$vpb_file_extension = strtolower(pathinfo($name, PATHINFO_EXTENSION)); // Get image file extensions
			
			
			if (!empty($name))
			{
				if (!in_array($vpb_file_extension, $allowedExtensions)) 
				{
					echo '<div class="alert alert-danger" align="left">Desculpe, você tentou carregar um formato de arquivo inválido. <br> arquivos de imagem png jpg, jpeg, gif e só são permitidos. Obrigado.</div>';
				}
				else 
				{
				  if($size<(5120*5120)) //This line of code states that to upload a file, that file must be 1MB in size
				  {
					  $actual_image_name = vpb_generate_random_name().'.jpg'; // Generate a random name for every new file uploaded;
					  
					  $new_image_name = $upload_location.$actual_image_name;

					  if(move_uploaded_file($_FILES['vasPhoto_uploads']['tmp_name'][$key], $upload_location.$_FILES['vasPhoto_uploads']['name'][$key])) 
					  {
						  //Run your SQL Query here to insert the new image file named $actual_image_name if you deem it necessary

					  	if(vpb_image_water_mark($upload_location.$_FILES['vasPhoto_uploads']['name'][$key], $new_image_name, path("assets/images/icons/mstile-150x150.png")))
					  	{
					  		var_dump($_FILES['vasPhoto_uploads']['tmp_name'][$key]);
					  	var_dump($name);
					  		echo '<div align="center"><span class="alert alert-success"><img src="' . url("assets/images/events/" . $_POST['event'] . "/" . $actual_image_name) .'" width="90%" class="img-thumbnail"></span></div>';
					  	}
					  	else
					  	{
					  		echo "<div class='alert alert-danger' align='left'>Desculpe, sua imagem não pode ser marca d'água no momento. <br> Por favor tente novamente ou entre em contato com este site de administração para denunciar a mensagem de erro persistir, se este problema. Obrigado.</div> />";
					  	}
					  }
					  else 
					  {
					  	var_dump($_FILES['vasPhoto_uploads']['tmp_name']);
					  	var_dump($name);
					  	echo "<div class='alert alert-danger' align='left'>Desculpe, sua imagem não pôde ser carregado no momento. <br> Por favor tente novamente ou entre em contato com este site de administração para denunciar a mensagem de erro persistir, se este problema. Obrigado.</div>";
					  }
					}
					else 
					{
						echo "<div class='alert alert-danger' align='left'>O arquivo: <b>".$name."</b> excedeu 5MB que é o tamanho máximo permitido de arquivos para este sistema. <br> Faça upload de um arquivo em 1 MB de tamanho para prosseguir. Obrigado.</div>";
					}
				}
			}
			else 
			{
				echo "<div class='alert alert-danger' align='left'>Por favor, procure um arquivo que você deseja carregar para continuar. Obrigado.</div>";
			}
		}
	}
}
?>