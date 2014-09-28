<?php
$site = "http://mmoy.piwigo.com/";
$maximages = 1;
$cat_id = 1;

if (is_numeric($_GET['maximages'])) {
	$maximages = intval($_GET['maximages']);
}

if (is_numeric($_GET['cat_id'])) {
	$cat_id = intval($_GET['cat_id']);
}

header('Content-Type: text/javascript');
$url = $site . "ws.php" .
	"?format=php" .
	"&method=pwg.categories.getImages" .
	"&cat_id=" . $cat_id . 
	"&recursive=true&per_page=" . $maximages . 
	"&page=1" . 
	"&order=random";
$response = file_get_contents($url);
$thumbc = unserialize($response);
 
if ($thumbc["stat"]=='ok') {
	foreach ($thumbc["result"]["images"] as $image)
	{
		// Would be a bit simpler with jquery, but let's not
		// force it for such a simple piece of code.
		?>
		var newImg = document.createElement("img");
		newImg.src = "<?= $image['derivatives']['thumb']['url'] ?>";
		newImg.alt = "";
		newImg.title = "Random Image\n(Click for full-size)";
		var newLink = document.createElement("a");
		newLink.href = "<?= $image['page_url'] ?>";
		newLink.id = "rndpic-a";
		newLink.appendChild(newImg);
		var target = document.getElementById("random_image");
		if (!target) {
			// Could not find #random_image. As a
			// fall-back, try to find the parent of the
			// <script> tag calling us.
			// http://stackoverflow.com/questions/6932679/get-dom-element-where-script-tag-is
			var target = document.documentElement;
			while (target.childNodes.length && target.lastChild.nodeType == 1) {
				target = target.lastChild;
			}
			target = target.parentNode;
		}
		target.appendChild(newLink);
		<?php
	}
} else {
	// Silent error.
	// echo "Error";
}

?>