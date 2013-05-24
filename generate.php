<?php

if( PHP_SAPI != 'cli' ) exit(1);

$files = array();
foreach( scandir('downloads') as $file ) {
	if( substr($file, -4) != '.zip' ) continue;
	$files[] = $file;
}

function formatMustacheDownload($file) {
	$file = substr($file, 0, -4);
	list($extension, $mustacheVersion, $phpVersion, $arch, $compiler, $threadSafety) = explode('-', $file);
	$phpVersionClean = $phpVersion[3] . '.' . $phpVersion[4];
	return 'Mustache ' . $mustacheVersion . ' (' . join(', ', array(
		'PHP ' . $phpVersionClean,
		strtoupper($compiler),
		$arch,
		$threadSafety == 'ts' ? 'Thread safety' : 'No thread safety'
	)) . ')';
}

ob_start();
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>php-mustache</title>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
  </head>
  <body>
    
    <div class="container">
	<h3>Mustache Windows Builds</h3>
      <div class="well">
        <ul class="nav nav-list">
			<?php foreach( $files as $file ):
				$name = formatMustacheDownload($file);
			?>
			  <li>
				<a href="downloads/<?php echo $file ?>">
				  <?php echo $name ?>
				</a>
			  </li>
			<?php endforeach ?>
        </ul>
      </div>
      
    </div>
  </body>
</html>
<?php
echo ob_get_clean();