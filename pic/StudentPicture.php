<html>
<head>
	<title>LNCTS Results</title>
	<style type="text/css">body { font: 12px Verdana; line-height: 1.5; }</style>
</head>
<body>
<?php
ob_flush(); flush();

$start = 1001;
$stop = 1055;

for ($i = $start; $i <= $stop; $i++):

$c = curl_init('http://rgpv.ac.in/StudentPicture.ashx?imgid=%270157IT09'.$i.'%27');

curl_setopt($c, CURLOPT_HEADER, 0);
curl_setopt($c, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($c, CURLOPT_REFERER, 'http://rgpv.ac.in/Admin/StudentProfile.aspx');
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

$img = curl_exec($c);
file_put_contents('data/0157IT09'.$i.'.jpg', $img);

curl_close($c);

echo <<<HTML
Fetch: $i <br />
<img src="data/0157IT09{$i}.jpg" style="max-height: 100px; max-width: 100px;" /><br /><br />
HTML;

ob_flush(); flush();
endfor;
?>
</body>
</html>