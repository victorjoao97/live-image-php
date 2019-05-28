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


// Upload using Submit Button
function vpb_upload_and_watermark_file() 
{
	$("#vasPLUS_Programming_Blog_Form").vPB({
		url: 'vasPLUSfileUploads.php',
		beforeSubmit: function() 
		{
			$("#vpb_main").hide();
			$("#vpb_fake").show();
			$("#vasPhoto_uploads_Status").show();
			$("#vasPhoto_uploads_Status").html('');
			$("#vasPhoto_uploads_Status").html('<div style="font-family: Verdana, Geneva, sans-serif; font-size:12px; color:black;" align="center">Upload <img src="images/loadings.gif" align="absmiddle" alt="Upload...." title="Upload...."/></div><br clear="all">');
		},
		success: function(response) 
		{
			$("#vpb_fake").hide();
			$("#vpb_main").show();
			$("#vasPhoto_uploads_Status").hide().fadeIn('slow').html(response);
			$('#vasPhoto_uploads').val('');
		}
	}).submit();  
}


/*
//Automatic Upload without submit button - Un-comment this code to use this function instead of the above function
$(document).ready(function() 
{
	$('#vasPhoto_uploads').live('change', function() 
	{
		$("#vasPLUS_Programming_Blog_Form").vPB({
			url: 'vasPLUSfileUploads.php',
			beforeSubmit: function() 
			{
				$("#vasPhoto_uploads_Status").show();
				$("#vasPhoto_uploads_Status").html('');
				$("#vasPhoto_uploads_Status").html('<div style="font-family: Verdana, Geneva, sans-serif; font-size:12px; color:black;" align="center">Upload <img src="images/loadings.gif" align="absmiddle" alt="Upload...." title="Upload...."/></div><br clear="all">');
			},
			success: function(response) 
			{
				$("#vasPhoto_uploads_Status").hide().fadeIn('slow').html(response);
			}
		}).submit();
	});          
}); 
*/