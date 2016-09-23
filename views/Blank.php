<?= \Pecee\UI\Site::GetInstance()->getDocType(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?= $this->printHeader(); ?>
	</head>
	<body>
		<?= $this->getContentHtml(); ?>
	</body>
</html>