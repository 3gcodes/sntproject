<?php
include("Article.php");
include("Parser.php");
libxml_use_internal_errors(true);

if (!empty($_GET["address"])) {
	$address = $_GET["address"];
	$parser = new Parser($address);
	$article = $parser->fetch_article();
	header('Content-Type: application/json');
	echo json_encode($article);
} else {
	echo json_encode(array('message' => 'no data'));
}

?>