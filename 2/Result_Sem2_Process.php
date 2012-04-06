<?php

header('content-type: text/plain');

$mysqli = new mysqli('localhost', 'test', 'qwerty', 'lncts_it');

if ($mysqli->connect_error)
{
	die($mysqli->connect_errno . ' : ' . $mysqli->connect_error);
}

$mapping = array(
	'dtlstResult_ctl00_T_obtLabel' => 'BE201',
	'dtlstResult_ctl01_T_obtLabel' => 'BE202',
	'dtlstResult_ctl02_T_obtLabel' => 'BE203',
	'dtlstResult_ctl03_T_obtLabel' => 'BE204',
	'dtlstResult_ctl04_T_obtLabel' => 'BE205',
	'Label14New'                   => 'ThTotal',
	'Label2New'                    => 'ThMidtotal',
	'Label1New'                    => 'PrTotal',
	'Label3New'                    => 'SetTotal',
	'lblGTotalNew'                 => 'GndTotal',
	'lblResultNew'                 => 'Result',
);

$results = file('./result.txt');

foreach ($results as $result)
{
	$pattern = '#^(\d+),(.+)$#';
	$matches = array();

	preg_match($pattern, $result, $matches);

	$rollno = sprintf('0157IT0910%02d', $matches[1]);
	$fields = unserialize($matches[2]);

	$sql = sprintf("
		INSERT INTO marksheet (roll_number, semester, status)
		VALUES ('%s', '%s', '%s')
	", $rollno, '2', 'RG');

	$result = $mysqli->query($sql);

	if ($result)
	{
		$marksheet = $mysqli->insert_id;
		echo "Marksheet {$marksheet} for {$rollno} created.\n";

		foreach ($fields as $key => $field)
		{
			if (array_key_exists($key, $mapping))
			{
				if ($field === 'A*')
				{
					$sql = sprintf("
						INSERT INTO marks (marksheet_id, attribute_name)
						VALUES ('%s', '%s')
					", $marksheet, $mapping[$key]);
				}
				else
				{
					$field = ($key !== 'lblResultNew') ? (int) $field : $field;

					$sql = sprintf("
						INSERT INTO marks (marksheet_id, attribute_name, attribute_value)
						VALUES ('%s', '%s', '%s')
					", $marksheet, $mapping[$key], $field);
				}

				$mysqli->query($sql);
			}
		}
	}
}

$mysqli->close();
