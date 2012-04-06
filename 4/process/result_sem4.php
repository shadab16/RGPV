<html>
<head>
	<title>LNCTS Result - 2nd Semester</title>
	<style type="text/css">body { font: 12px Verdana; line-height: 1.5; }</style>
</head>
<body>
<pre>
<?php

ob_flush(); flush();
$errorState = libxml_use_internal_errors(true);

$f = fopen('./result.txt', 'wb+');

$dataFields = array(

	'lblNameNew',
	'lblRollNoNew',

	'lblBranchNew',      // IT
	'lblProgramNew',     // BE
	'lblSemesterNew',    // 4
	'lblRevalStatusNew', // Regular

	'dtlstResult_ctl00_T_obtLabel', // BE401
	'dtlstResult_ctl01_T_obtLabel', // BE402
	'dtlstResult_ctl02_T_obtLabel', // BE403
	'dtlstResult_ctl03_T_obtLabel', // BE404
	'dtlstResult_ctl04_T_obtLabel', // BE405

	'Label14New',   // ThTotal
	'Label2New',    // ThMidtotal
	'Label1New',    // PrTotal
	'Label3New',    // SetTotal
	'lblGTotalNew', // GndTotal

	'lblResultNew'  // Result Des
);

$start = 1;
$limit = 55;

for ($i = $start; $i <= $limit; ++$i):

	$c = curl_init('http://rgpv.ac.in/Exam/Result.aspx');

	$rollno = sprintf('0157IT0910%02d', $i);
	$postFields = <<<QUERY
__EVENTTARGET=&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE=%2FwEPDwUKMTc0MzA5ODc5NQ9kFgICAw9kFg4CAg8QDxYCHgtfIURhdGFCb3VuZGdkEBUIAkJFCkIuUGhhcm1hY3kDTUNBBE0uRS4KTS5QaGFybWFjeQdNLlRlY2guB0JFLVBUREMGQi5BcmNoFQgBMQEyATUBNgE3ATgCMTACMTEUKwMIZ2dnZ2dnZ2cWAWZkAgMPEA8WBB4NRGF0YVRleHRGaWVsZAUIc2VtZXN0ZXIfAGdkEBUIATEBMgEzATQBNQE2ATcBOBUIATEBMgEzATQBNQE2ATcBOBQrAwhnZ2dnZ2dnZ2RkAgYPDxYCHgdWaXNpYmxlaGQWBAIRDzwrAA0AZAInDw8WAh8CaBYCHgdPbkNsaWNrBR5DbGlja2hlcmV0b3ByaW50KCdwbmxEZXRhaWxzJylkAgcPZBYEAhEPPCsACQBkAiMPDxYCHwJoFgIfAwUhQ2xpY2toZXJldG9wcmludCgncG5sRGV0YWlsc05ldycpZAIID2QWBgIRDzwrAA0AZAITDw9kDxAWA2YCAQICFgMWAh4OUGFyYW1ldGVyVmFsdWUFATEWAh8EBQExFgIfBGUWA2ZmZmRkAh0PDxYCHwJoFgIfAwUlQ2xpY2toZXJldG9wcmludCgncG5sRGV0YWlsc0dyYWRpbmcnKWQCCQ8PZA8QFgNmAgECAhYDFgIfBAUBMRYCHwQFATEWAh8EZRYDZmZmZGQCCg8PZA8QFgJmAgEWAhYCHwQFATEWAh8EZRYCZmZkZBgCBQlndkdyYWRpbmcPZ2QFCUdyaWRWaWV3MQ9nZIBZRFNxyHEIELGUKdVvLm%2BbCpyj&txtrollno={$rollno}&drpProgram=1&drpSemester=4&btnviewresult=View+Result
QUERY;

	curl_setopt($c, CURLOPT_HEADER, 0);
	curl_setopt($c, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($c, CURLOPT_REFERER, 'http://rgpv.ac.in/Exam/Result.aspx');
	curl_setopt($c, CURLOPT_POST, 1);
	curl_setopt($c, CURLOPT_POSTFIELDS, $postFields);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

	$html = curl_exec($c);
	curl_close($c);

	$doc = new DOMDocument();

	$doc->validateOnParse = true;
	$doc->loadHTML($html);

	if (strpos($html, 'Enrollment No not Found') !== false)
	{
		echo 'Enrollment Number not Found: ' . $i . PHP_EOL;
		continue;
	}

	$data = array();
	foreach ($dataFields as $id)
	{
		$data[$id] = trim($doc->getElementById($id)->nodeValue);
	}

	fwrite($f, $i . ',' . serialize($data) . PHP_EOL);
	echo 'Processed: ' . $i . PHP_EOL;

	ob_flush(); flush();

endfor;

libxml_use_internal_errors($errorState);

?>
</pre>
</body>
</html>