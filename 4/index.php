<?php

$rows = file('./result.txt');
$result = array();

foreach ($rows as $row)
{
	$pattern = '#^(\d+),(.+)$#';
	$matches = array();

	preg_match($pattern, $row, $matches);

	$rollno = sprintf('%02d', $matches[1]);
	$fields = unserialize($matches[2]);

	$result[$rollno] = $fields;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<title>LNCTS - IT - 4th Semester Result</title>
	<link rel="stylesheet" type="text/css" href="./style.css" />
	<script type="text/javascript" src="./jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="./jquery.tablesorter.min.js"></script>
	<script type="text/javascript">
		$(function() {
			$(".sortable").tablesorter({
				sortList: [[0,0]],
				headers: { 1: {sorter: false}},
				textExtraction: function (node) {
					var txt = node.innerHTML;
					if (txt.indexOf('*') == -1) return txt;
					if (txt.indexOf('A') == -1) return txt.slice(0, -1);
					return '0';
				}
			});
		});
	</script>
</head>
<body>

<div id="main-container">

<ul id="menu">
	<li><a href="http://www.geekpoint.net/" title="GeekPoint Home">Home</a></li>
	<li class="current"><a href="/lncts/" title="Results List">Results</a></li>
	<li><a href="#top-5" title="Hall of Fame">Top 5</a></li>
	<li><a href="#trivia" title="Useless Statistics">Trivia</a></li>
	<li><a href="mailto:shadab@geekpoint.net" title="Contact Me">Contact</a></li>
</ul>

<h1 id="web-title"><a href="/lncts/"><span class="emphasize">4<sup>th</sup> semester</span> result</a></h1>
<h2 id="web-subtitle">Information Technology &ndash; LNCTS &ndash; 2011</h2>

<div id="maincol">

	<div class="article" id="mark-list">
		<h2 class="article-title">Subject &amp; Sessional Marks</h2>
		<div class="article-meta">Click on individal table headers to sort the list ascending or descending, accordingly.</div>

		<table class="marks-list sortable" width="100%">
		<thead>
			<tr>
				<th class="roll" width="55px">#</th>
				<th class="name">Full Name</th>
				<th width="55px">401</th>
				<th width="55px">402</th>
				<th width="55px">403</th>
				<th width="55px">404</th>
				<th width="55px">405</th>
				<th width="85px">Midsem</th>
				<th width="85px">Practical</th>
				<th width="85px">Sessional</th>
				<th width="85px">Total</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($result as $rollno => $data): ?>
			<tr>
				<td class="roll"><?php echo $rollno ?></td>
				<td class="name"><?php echo ucwords(strtolower($data['lblNameNew'])) ?></td>
				<td><?php echo $data['dtlstResult_ctl00_T_obtLabel'] ?></td>
				<td><?php echo $data['dtlstResult_ctl01_T_obtLabel'] ?></td>
				<td><?php echo $data['dtlstResult_ctl02_T_obtLabel'] ?></td>
				<td><?php echo $data['dtlstResult_ctl03_T_obtLabel'] ?></td>
				<td><?php echo $data['dtlstResult_ctl04_T_obtLabel'] ?></td>
				<td><?php echo $data['Label2New'] ?></td>
				<td><?php echo $data['Label1New'] ?></td>
				<td><?php echo $data['Label3New'] ?></td>
				<td><?php echo $data['lblGTotalNew'] ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		</table>
	</div>

	<div class="article" id="top-5">
		<h2 class="article-title">Top 5 Scores</h2>
		<div class="article-meta">Top five scores based on the grand total marks.</div>

		<ol>
			<li><strong>Niyati Nawani</strong> (<em>Grand Total: 779, Theory: 304, Sessional: 475</em>)</li>
			<li><strong>Ankita Tiwari</strong> (<em>Grand Total: 759, Theory: 302, Sessional: 457</em>)</li>
			<li><strong>Shruti Shukla</strong> (<em>Grand Total: 757, Theory: 302, Sessional: 455</em>)</li>
			<li><strong>Nivya Agrawal</strong> (<em>Grand Total: 756, Theory: 308, Sessional: 448</em>)</li>
			<li><strong>Smriti Srivastava</strong> (<em>Grand Total: 743, Theory: 324, Sessional: 419</em>)</li>
		</ol>
	</div>

	<div class="article" id="trivia">
		<h2 class="article-title">The Trivia Section</h2>
		<div class="article-meta">Useless statistics derived from the mark list above.</div>

		<p>
			Based on the grand total, only 6 students scored 70% or more.
			28 students cleared the examination in one go, with the other 25
			failing in one or more than one subject. And 2 of them failed
			in all five subjects.
		</p>
	</div>

</div>
</div>

<div id="footer">
	<div>
	<h2 class="compact">Credits</h2>
	<ul class="compact">
		<li><a href="#">Shadab Ansari</a> <span class="date">(28/08/11)</span></li>
	</ul>
	</div>
	<div>
	<h2 class="compact">Data Source</h2>
	<ul class="compact">
		<li><a href="http://www.rgpv.ac.in/Exam/Result.aspx">RGPV - Result Declared</a></li>
		<li><em>The data was taken verbatim from the individal, publicly-available, result pages.
			Any error in the above published result is not my damned responsibility.</em></li>
	</ul>
	</div>
	<div>
	<h2 class="compact">Interesting Stuff</h2>
	<ul class="compact">
		<li><a href="https://news.ycombinator.com/">Hacker News</a></li>
		<li><a href="http://xkcd.com/">xkcd</a></li>
		<li><a href="http://www.dilbert.com/">Dilbert</a></li>
		<li><a href="http://programmers.stackexchange.com/">Programmers - StackExchange</a></li>
		<li><a href="http://stackoverflow.com/">StackOverflow</a></li>
	</ul>
	</div>
</div>

</body>
</html>