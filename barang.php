<?php 
require_once("db.php");
$sql = $conn->prepare("SELECT * FROM barang WHERE id=?");
	$sql->bind_param("i",$_GET["id"]);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {		
		$row = $result->fetch_assoc();
	}
	$conn->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<style>
.tbl-qa{border-spacing:0px;border-radius:4px;border:#6ab5b9 1px solid;}
</style>
<meta property="fb:app_id" content="1722304247789264" />
<meta property="og:url"                content="http://sambal.ga/barang.php?id=<?php echo $row["id"]?>" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="<?php echo $row["nama"]?>" />
<meta property="og:description"        content="<?php echo $row["keterangan"]?>" />
<meta property="og:image"              content="<?php echo $row["gambar"]?>" />
  <meta charset="UTF-8">
  <title>Kardi Online Shop</title>
</head>

<body>
  </body>
</html>
