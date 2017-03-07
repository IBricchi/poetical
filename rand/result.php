<!DOCTYPE html>
<html>
<head>
	<title>Poetical</title>
	<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
	<h1>Poetical</h1>
	<p>
		<?php
			$inP=$_POST["poem"];
			$inP = trim(preg_replace('/\s\s+/', ' <br> ', $inP));
			$exP=explode(" ",$inP);

			$words = file("words.txt", FILE_IGNORE_NEW_LINES);
			$name = file("name.txt", FILE_IGNORE_NEW_LINES);
			$punc = file("punc.txt", FILE_IGNORE_NEW_LINES);

			$wordsN = count($words);
			$nameN = count($name);

			$lim = 5;
			
			for ($i=rand(1,4); $i < count($exP); $i=$i+rand(2,$lim)) {
				$lim = 5;
				if ($exP[$i]!='<br>'){
					if (in_array($exP[$i], $name) and $exP[$i]===ucfirst($exP[$i])) {
						$randomN=rand(0,$nameN-1);
						$exP[$i]=$name[$randomN];
					}else if ($exP[$i]===ucfirst($exP[$i])) {
						$randomN=rand(0,$wordsN-1);
						$exP[$i]=ucfirst($words[$randomN]);
					}else if(in_array(substr($exP[$i], -1),$punc)){
						$pun = array_search(substr($exP[$i], -1),$punc);
						$randomN=rand(0,$wordsN-1);
						$exP[$i]=$words[$randomN].$punc[$pun];
					}else{
						$randomN=rand(0,$wordsN-1);
						$exP[$i]=$words[$randomN];
					}
				}else{
					$lim = 1;
				}
			}

			$finalP = implode(" ",$exP);

			echo $finalP;
		?>
	</p>
	<form action="result.php" method="POST">
		<input type="hidden" name="poem" value="<?php $inP; ?>">
		<input type="submit" value="New Poem">
	</form>
	<form action="index.php">
		<input type="submit" value="New Input">
	</form>
</body>
</html>