<?php

if( PHP_SAPI != 'cli' ) exit(1);

$files = array();
foreach( scandir('downloads') as $file ) {
	$ext = substr($file, -4);
	if( $ext != '.zip' && $ext != '.deb' ) continue;
	$files[] = $file;
}
rsort($files);

function formatMustacheDownload($file) {
	$ext = substr($file, -4);
	$file = substr($file, 0, -4);
	if( $ext === '.deb' ) {
		list($php, $extension, $versionArch) = explode('-', $file);
		$parts = explode('_', $versionArch);
		$mustacheVersion = array_shift($parts);
		$arch = join('_', $parts);
		return 'Mustache (.deb) ' . $mustacheVersion . ' (' . join(', ', array(
                        $arch
                )) . ')';
	} else {
		list($extension, $mustacheVersion, $phpVersion, $arch, $compiler, $threadSafety) = explode('-', $file);
		$phpVersionClean = $phpVersion[3] . '.' . $phpVersion[4];
		return 'Mustache ' . $mustacheVersion . ' (' . join(', ', array(
			'PHP ' . $phpVersionClean,
			strtoupper($compiler),
			$arch,
			$threadSafety == 'ts' ? 'Thread safety' : 'No thread safety'
		)) . ')';
	}
}

ob_start();
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>php-mustache</title>
    <link href="bootstrap.min.css" rel="stylesheet" charset="utf-8">
    <link href="styles.css" rel="stylesheet" charset="utf-8">
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-7764958-4', 'jbboehr.github.io');
      ga('send', 'pageview');
    </script>
  </head>
  <body>
    
    <div class="container">
	<h3>Mustache Builds</h3>
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
