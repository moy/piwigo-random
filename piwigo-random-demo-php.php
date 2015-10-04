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
    <p>This
      <?php $base_url = "http://www-verimag.imag.fr/~moy/piwigo-random/piwigo-random-backend.php";
	     echo file_get_contents($base_url . "?mode=html&cat_id=13"); ?>
    is a random image</p>

    <h1>Using file_get_content and setting the target</h1>
    <p>This
      <?php $base_url = "http://www-verimag.imag.fr/~moy/piwigo-random/piwigo-random-backend.php";
	     echo file_get_contents($base_url . "?mode=html&target=_self"); ?>
    is a random image</p>

    <div id="validator">
      <a href="http://validator.w3.org/check?uri=referer">
	<img src="http://www.w3.org/html/logo/downloads/HTML5_Logo_64.png"
	     alt="Valid HTML" height="64" width="64" />
      </a>
    </div>
  </body>
</html>

