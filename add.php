<?php
	if (isset($_POST['submit'])) {


$target_dir = "gambar/";
$target_file = $target_dir . basename($_FILES["gambar"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

// Check if file already exists
if (file_exists($target_file)) {
    $error_message = "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $error_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $error_message = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
    	require_once("db.php");
		$sql = $conn->prepare("INSERT INTO barang (nama,size,bahan,harga,keterangan,gambar) VALUES (?, ?, ?, ?, ?, ?, ?)");  
		$nama=$_POST['nama'];
		$size = $_POST['size'];
		$bahan= $_POST['bahan'];
		$harga= $_POST['harga'];
		$keterangan= $_POST['keterangan'];
		$gambar= basename( $_FILES["gambar"]["name"]);
		$sql->bind_param("sssssss", $nama, $size, $bahan, $harga, $keterangan, $gambar); 
		if($sql->execute()) {
			$success_message = "Added Successfully";
		} else {
			$error_message = "Problem in Adding New Record";
		}
		$sql->close();   
		$conn->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
		
	} 


?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
	
<style>
.tbl-qa{border-spacing:0px;border-radius:4px;border:#6ab5b9 1px solid;}
</style>
  <title>Add New Employee</title> 	
</head>
<body>
<?php if(!empty($success_message)) { ?>
<div class="success message"><?php echo $success_message; ?></div>
<?php } if(!empty($error_message)) { ?>
<div class="error message"><?php echo $error_message; ?></div>
<?php } ?>
<form name="frmUser" method="post" action="" enctype="multipart/form-data">
<div class="button_link"><a href="index.php"> Kembali </a></div>
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tbl-qa">
	<thead>
		<tr>
			<th colspan="2" class="table-header">Tambahkan Barang</th>
		</tr>
	</thead>
	<tbody>
		<tr class="table-row">
			<td><label>Nama Barang</label></td>
			<td><input type="text" name="nama" class="txtField"></td>
		</tr>
		<tr class="table-row">
			<td><label>Ukuran</label></td>
			<td><input type="text" name="size" class="txtField"></td>
		</tr>
		<tr class="table-row">
			<td><label>Bahan</label></td>
			<td><input type="text" name="bahan" class="txtField"></td>
		</tr>
		<tr class="table-row">
			<td><label>Harga</label></td>
			<td><input type="number" name="harga" class="txtField" minlength="1"></td>
		</tr>
		<tr class="table-row">
			<td><label>Keterangan</label></td>
			<td><textarea name="keterangan"></textarea></td>
		</tr>
		<tr class="table-row">
			<td><input type="file" name="gambar" class="demo-form-submit" id="gambar"></td>
			<td><input type="submit" name="submit" value="Submit" class="demo-form-submit"></td>
		</tr>
	</tbody>
</table>
</form>
</body>
</html>