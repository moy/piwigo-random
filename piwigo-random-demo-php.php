<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Random images demo</title>
  </head>
  <body>
    <p>Piwigo RANDOM demo, without JavaScript. See <a
    href="https://github.com/moy/piwigo-random">https://github.com/moy/piwigo-random</a>
    for details.</p>

    <h1>Using file_get_content</h1>
    <p><span>This
    <?php echo file_get_contents("http://www-verimag.imag.fr/~moy/piwigo-random/piwigo-random-js.php?mode=html&cat_id=13"); ?>
    </span> is a random image</p>
    
    <div id="validator">
      <a href="http://validator.w3.org/check?uri=referer">
	<img src="http://www.w3.org/html/logo/downloads/HTML5_Logo_64.png"
	     alt="Valid HTML" height="64" width="64" />
      </a>
    </div>
  </body>
</html>

