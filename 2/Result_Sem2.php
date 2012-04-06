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
	'lblSemesterNew',    // 2
	'lblRevalStatusNew', // Regular

	'dtlstResult_ctl00_T_obtLabel', // BE201
	'dtlstResult_ctl01_T_obtLabel', // BE202
	'dtlstResult_ctl02_T_obtLabel', // BE203
	'dtlstResult_ctl03_T_obtLabel', // BE204
	'dtlstResult_ctl04_T_obtLabel', // BE205

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
__EVENTTARGET=&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE=%2FwEPDwUJNDM3ODMwODcxD2QWAgIDD2QWDAICDxAPFgIeC18hRGF0YUJvdW5kZ2QQFQgCQkUKQi5QaGFybWFjeQNNQ0EETS5FLgpNLlBoYXJtYWN5B00uVGVjaC4HQkUtUFREQwZCLkFyY2gVCAExATIBNQE2ATcBOAIxMAIxMRQrAwhnZ2dnZ2dnZxYBZmQCAw8QDxYEHg1EYXRhVGV4dEZpZWxkBQhzZW1lc3Rlch8AZ2QQFQgBMQEyATMBNAE1ATYBNwE4FQgBMQEyATMBNAE1ATYBNwE4FCsDCGdnZ2dnZ2dnZGQCBg8PFgIeB1Zpc2libGVoZBYEAhEPPCsADQBkAicPDxYEHgRUZXh0BQ9QcmludCBNYXJrc2hlZXQfAmgWAh4HT25DbGljawUeQ2xpY2toZXJldG9wcmludCgncG5sRGV0YWlscycpZAIHDw8WAh8CZ2QWIgIDDw8WAh8DBQJCRWRkAgUPDxYCHwMFPEFDSEFMQSBOQU5ESU5JICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGRkAgcPDxYCHwMFDDAxNTdJVDA5MTAwMWRkAgkPDxYCHwMFAklUZGQCCw8PFgIfAwUCQkVkZAINDw8WAh8DBQEyZGQCDw8PFgIfAwUHUmVndWxhcmRkAhEPPCsACQEADxYEHghEYXRhS2V5cxYAHgtfIUl0ZW1Db3VudAIFZBYKZg9kFgQCAw8PFgIfAwUFQkUyMDFkZAIHDw8WAh8DBQI3MWRkAgEPZBYIAgEPDxYCHwJoZGQCAw8PFgIfAwUFQkUyMDJkZAIFDw8WAh8CaGRkAgcPDxYCHwMFAjU2ZGQCAg9kFggCAQ8PFgIfAmhkZAIDDw8WAh8DBQVCRTIwM2RkAgUPDxYCHwJoZGQCBw8PFgIfAwUCNTBkZAIDD2QWCAIBDw8WAh8CaGRkAgMPDxYCHwMFBUJFMjA0ZGQCBQ8PFgIfAmhkZAIHDw8WAh8DBQI1MWRkAgQPZBYIAgEPDxYCHwJoZGQCAw8PFgIfAwUFQkUyMDVkZAIFDw8WAh8CaGRkAgcPDxYCHwMFAjY5ZGQCEw8PFgIfAwUDMjk3ZGQCFQ8PFgIfAwUCNjdkZAIXDw8WAh8DBQMyNTVkZAIZDw8WAh8DBQMxMzNkZAIbDw8WAh8DBQM3NTJkZAIdDw8WAh8DBQRQQVNTZGQCHw8PFgIfAwUKMDgvMTEvMjAxMGRkAiEPDxYCHwMFCjEyLzExLzIwMTBkZAIjDw8WBB8DBQ9QcmludCBNYXJrc2hlZXQfAmcWAh8EBSFDbGlja2hlcmV0b3ByaW50KCdwbmxEZXRhaWxzTmV3JylkAggPD2QPEBYDZgIBAgIWAxYCHg5QYXJhbWV0ZXJWYWx1ZQUBMRYCHwcFATIWAh8HBQwwMTU3SVQwOTEwMDEWA2ZmZmRkAgkPD2QPEBYCZgIBFgIWAh8HBQEyFgIfBwUMMDE1N0lUMDkxMDAxFgJmZmRkGAEFCUdyaWRWaWV3MQ9nZCCDL9lS%2FVK6HHslbXSRDggJJfPQ&txtrollno={$rollno}&drpProgram=1&drpSemester=2&btnviewresult=View+Result
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
		echo 'Enrollment No not Found: ' . $i . PHP_EOL;
		continue;
	}

	$data = array();
	foreach ($dataFields as $id)
	{
		$data[$id] = $doc->getElementById($id)->nodeValue;
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