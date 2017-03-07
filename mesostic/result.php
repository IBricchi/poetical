<!DOCTYPE html>
<html>
<head>
	<title>Mesostic</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css.css">
	<link href="https://fonts.googleapis.com/css?family=Crafty+Girls|Oldenburg" rel="stylesheet">
</head>
<body>
	<?php 
		$loc=$_POST["loc"];
		$input=strtolower($_POST["key"]);
		$key=str_split($input);
		$text=file("text.txt", FILE_IGNORE_NEW_LINES);
		$lineres=False;

		for ($i=$loc; $i < count($text); $i++) {
			if (count($lineres)==count($key)) {
				$floc=$i;
				$i=count($text);
			}else{
				for ($k=0; $k < count($key); $k++) {
					if (strpos( strtolower($text[$i+$k]), $key[$k] ) !== false) {
						$lineres[$k]=$text[$i+$k];
					}else{
						$lineres=False;
						$k=count($key);
					}
				}
			}
		}

		for ($l=0; $l < count($key); $l++) {
			$res=str_split($lineres[$l]);
			for ($m=0; $m < count($res); $m++) { 
				if (strtolower($res[$m])==$key[$l]) {
					if ($res[$m+1]==" ") {
						$res[$m]="<strong>".str_replace(' ', '-', strtoupper($key[$l]))."</strong></p><p id='r'><span id='s'>_</span>";
						$m=count($res);
					}else{
						$res[$m]="<strong>".str_replace(' ', '-', strtoupper($key[$l]))."</strong></p><p id='r'>";
						$m=count($res);
					}
				}
			}
			array_unshift($res, "<p id='l'>");
			array_push($res, "</p>");
			$res=implode("", $res);
			$final[$l]=$res;
		}
		for ($g=0; $g < count($key); $g++) { 
			echo "<div id='main'>";
			echo $final[$g];
			echo "<br>";
			echo "</div>";
		}
	?>
	<form action="result.php" method="POST">
		<input type="hidden" name="loc" value="<?php echo $floc; ?>">
		<input type="hidden" name="key" value="<?php echo $_POST["key"]; ?>">
		<input type="submit" value="next">
	</form>
</body>
</html>