<?php
	session_start();
	error_reporting(1);
	if(isset($_SESSION['tempfbuser']))
	{
		$con=mysqli_connect("localhost","root","","facebook");
		
		$user=$_SESSION['tempfbuser'];
		$que1=mysqli_query($con,"SELECT * FROM users WHERE Email='$user' ");
		$rec=mysqli_fetch_array($que1);
		$userid=$rec[0];
		$gender=$rec[4];
		if($gender=="Female")
		{
			$que2=mysqli_query($con,"SELECT * FROM user_profile_pic WHERE user_id=$userid");
			$count1=mysqli_num_rows($que2);
			if($count1==0)
			{
		
?>
<?php

	if(isset($_POST['file']) && ($_POST['file']=='Upload'))
	{
		$path = "../../../fb_users/Female/".$user."/Profile/";
		$path2 = "../../../fb_users/Female/".$user."/Post/";
		$path3 = "../../../fb_users/Female/".$user."/Cover/";
		mkdir($path, 0, true);
		mkdir($path2, 0, true);
		mkdir($path3, 0, true);
		
		$img_name=$_FILES['file']['name'];
    	$img_tmp_name=$_FILES['file']['tmp_name'];
    	$prod_img_path=$img_name;
    	move_uploaded_file($img_tmp_name,"../../../fb_users/Female/".$user."/Profile/".$prod_img_path);
		
		mysqli_query($con,"INSERT INTO user_profile_pic(user_id,image) VALUES('$userid','$img_name')");
		header("location:../fb_step2/Secret_Question1.php");
	} 
?>
<html>
<head>
	<title> Step1 </title>
	<link href="step1_css/step1.css" rel="stylesheet" type="text/css">
    <link href="../../fb_font/font.css" rel="stylesheet" type="text/css">
    <LINK REL="SHORTCUT ICON" HREF="../../fb_title_icon/Faceback.ico" />
	<script src="step1_js/Image_check.js" language="javascript">
	</script>
</head>
<body>
<?php
	include("step1_background/background.php");
?>
<div style="position:absolute; left:35%; top:50%;">
<img src="step1_images/Female.jpg" style=" height:60; width:60;"/> 
</div>

<div style="position:absolute; left:39%; top:50%;"> 
	<table>
		<tr>
			<td></td> <td>&nbsp;  </td> <td style="text-transform:capitalize"> <h4><?php echo $rec[1]; ?></h4></td>
		</tr>
	</table> 
</div>


<form method="post" enctype="multipart/form-data" name="uimg" onSubmit="return Img_check();">
	<div style="position:absolute; left:40%; top:65%;">	
		<input type="file" name="file" id="img"/>  
	</div>
    
	<div style="position:absolute; left:57.5%; top:64%; " id="upload">	
		<input type="submit" value="Upload" name="file" id="upload_button"/>	
	</div>
</form>
	<?php
		include("step1_erorr/step1_erorr.php");
	?>
</body>
</html>
<?php
			}
			else
			{
				header("location:../fb_step2/Secret_Question1.php");
			}
		
		}
		else
		{
			header("location:../fb_step1/Step1_Male.php");
		}
	}
	else
	{
		header("location:../../../index.php");
	}
?>