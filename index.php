<?php
$con=mysqli_connect("localhost","root","","dictionary");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"
	SELECT `en_word`, `pos_tag`, `en_lemma`, `bn_pronunciation`, `bn_word`, `explanation`, `example`
	FROM  `dict_table` 
	WHERE  `bn_word` !=  ''
	"
	);

$singleline_gape = '&nbsp;&nbsp;&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;<br>';
$dubleline_gape = $singleline_gape.'<br>&nbsp;&nbsp;&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;<br>';
$abc = null;

while($row = mysqli_fetch_array($result)) {
		$pos_tag = null;
		$en_lemma = null;
		$bn_pronunciation = null;
		$explanation = null;
		$example = null;

	if(strpos($abc, $row['en_word']) == false) {
			
		if($row['pos_tag'] != '') {
			$pos_tag = '&nbsp;&nbsp;&nbsp;&nbsp;\[[p]'.$row['pos_tag'].'[/p]\]<br>';
		}
		if($row['en_lemma'] != '') {
			$en_lemma = $row['en_lemma'];
		}
		if($row['bn_pronunciation'] != '') {
			$bn_pronunciation = '&nbsp;&nbsp;&nbsp;&nbsp;[b]উচ্চারণ: '.$row['bn_pronunciation'].'[/b]<br>';
		}
		if($row['explanation'] != '') {
			$explanation = '&nbsp;&nbsp;&nbsp;&nbsp;[b]'.$row['explanation'].'[/b]<br>';
		}
		if($row['example'] != '') {
			$example = '&nbsp;&nbsp;&nbsp;&nbsp;[m4]'.$row['example'].'[/m4]<br>';
		}
		$bn_word = '&nbsp;&nbsp;&nbsp;&nbsp;[b]'.$row['bn_word'].'[/b]<br>';
	
  		echo trim($row['en_word']).'<br>'.$pos_tag.$bn_pronunciation.$singleline_gape.$bn_word.$explanation.$example;
  		
  		$abc .= ' '.$row['en_word'].' ';
  	} else {
  		if($row['pos_tag'] != '') {
			$pos_tag = '&nbsp;&nbsp;&nbsp;&nbsp;\[[p]'.$row['pos_tag'].'[/p]\]<br>';
		}
		if($row['en_lemma'] != '') {
			$en_lemma = $row['en_lemma'];
		}
		if($row['bn_pronunciation'] != '') {
			$bn_pronunciation = '&nbsp;&nbsp;&nbsp;&nbsp;[b]উচ্চারণ: '.$row['bn_pronunciation'].'[/b]<br>';
		}
		if($row['explanation'] != '') {
			$explanation = '&nbsp;&nbsp;&nbsp;&nbsp;[b]'.$row['explanation'].'[/b]<br>';
		}
		if($row['example'] != '') {
			$example = '&nbsp;&nbsp;&nbsp;&nbsp;[m4]'.$row['example'].'[/m4]<br>';
		}
		$bn_word = '&nbsp;&nbsp;&nbsp;&nbsp;[b]'.$row['bn_word'].'[/b]<br>';
	
  		echo $singleline_gape.$pos_tag.$bn_pronunciation.$singleline_gape.$bn_word.$explanation.$example;
  	}
}
mysqli_close($con);
?> 
