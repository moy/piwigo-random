<?php // -*- mode:php c-basic-offset: 2 -*-
// +-----------------------------------------------------------------------+
// | Piwigo RANDOM - Insert images from a Piwigo Galery in a website       |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2014, 2015 Matthieu Moy                                  |
// +-----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify  |
// | it under the terms of the GNU General Public License as published by  |
// | the Free Software Foundation; either version 2 of the License, or     |
// | (at your option) any later version.                                   |
// |                                                                       |
// | This program is distributed in the hope that it will be useful, but   |
// | WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU      |
// | General Public License for more details.                              |
// |                                                                       |
// | You should have received a copy of the GNU General Public License     |
// | along with this program; if not, write to the Free Software           |
// | Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, |
// | USA.                                                                  |
// +-----------------------------------------------------------------------+

// Your piwigo gallery here:
include 'prb-settings.php';

$error = '';

if (is_numeric($_GET['maximages']))
{
  $maximages = intval($_GET['maximages']);
}

if (is_numeric($_GET['cat_id']))
{
  $cat_id = intval($_GET['cat_id']);
}

if (isset($_GET['element_name']))
{
  $element_name = $_GET['element_name'];
}

if (isset($_GET['target']))
{
  $target = $_GET['target'];
}

if (isset($_GET['size']))
{
  $size = $_GET['size'];
}

if (isset($_GET['mode'])) {
  $mode = $_GET['mode'];
}

if (isset($_GET['tag_name']))
{
  $tag_name = $_GET['tag_name'];
}

function check_param($param, $values) {
  global $error;
  global $$param;
  if (!in_array($$param, $values, true)) {
    if ($error != '') {
      $error .= ', ';
    }
    $error .= 'Invalid value \'' . $$param . '\' for parameter \'' . $param
      . '\' (possible values are: ' . implode(', ', $values) . ')';
  }
}

check_param('size', array('square', 'thumb', '2small', 'xsmall', 'small', 'medium', 'large', 'xlarge', 'xxlarge'));
check_param('mode', array('html', 'javascript'));

header('Content-Type: text/javascript');
if ($error != '') {
  echo 'document.getElementById('. json_encode($element_name) . ').innerHTML = ' . json_encode(
    '<strong>piwigo-random error:</strong> ' . htmlspecialchars($error) . '.') . ';';
  echo 'console.log('. json_encode('piwigo-random error:' . $error) . ');';
  exit(1);
}

$url = $site . "ws.php" .
  "?format=php";
if ($tag_name)
{
  $url .= "&method=pwg.tags.getImages" .
    "&tag_name=" . $tag_name;
}
else
{
  $url .= "&method=pwg.categories.getImages" .
    ($cat_id ? "&cat_id=" . $cat_id : "") .
    "&recursive=true";
}
$url .=
  "&per_page=" . $maximages .
  "&page=1" .
  "&order=random";

$response = file_get_contents($url);
$thumbc = unserialize($response);

if ($thumbc["stat"] === 'ok')
{
  foreach ($thumbc["result"]["images"] as $image)
  {
    $image_url = (string)$image['derivatives'][$size]['url'];
    # pwg.tags.getImages for example does not deliver categories.
    $cats = (isset($image['categories']) ? $image['categories'] : null);
    $cats_count = (isset($cats) ? count($cats) : 0);
    if ($cats_count > 0) {
      # Piwigo's WS returns two URLs for the image. $image['page_url'] is the URL
      # of the image, without any category consideration, and $image['categories']
      # is the list of categories, each of which contains the URL of the image
      # viewed as part of this category (e.g. next/previous buttons navigate
      # within this category). In practice, the list of categories seems to be a
      # singleton whenever we set $cat_id, but let's have fun and pick it randomly
      # anyway.
      $page_url = (string)$cats[random_int(0, $cats_count - 1)]['page_url'];
    } else {
      $page_url = (string)$image['page_url'];
    }
    $comment = (string)$image['comment'];
    if ($comment === '') {
      $comment = "Random image";
    }
    $comment .= "\n(click for full-size)";
    if ($mode === 'javascript') {
      // Would be a bit simpler with jquery, but let's not
      // force it for such a simple piece of code.
      ?>
      var newImg = document.createElement("img");
      newImg.src = <?php echo json_encode($image_url); ?>;
      newImg.alt = "";
      newImg.title = <?php echo json_encode($comment) ?>;
      var newLink = document.createElement("a");
      newLink.href = <?php echo json_encode($page_url); ?>;
      newLink.id = "rndpic-a";
      newLink.appendChild(newImg);
      newLink.target = <?php echo json_encode($target); ?>;
      var target = document.getElementById(<?php echo json_encode($element_name); ?>);
      if (!target)
      {
        // Could not find #random_image. As a
        // fall-back, try to find the parent of the
        // <script> tag calling us.
        // http://stackoverflow.com/questions/6932679/get-dom-element-where-script-tag-is
        var target = document.documentElement;
        while (target.childNodes.length && target.lastChild.nodeType == 1)
        {
          target = target.lastChild;
        }
        target = target.parentNode;
      }
      target.appendChild(newLink);
      <?php
    } else if ($mode === 'html') {
      echo '<a id="rndpic-a" href="' . htmlspecialchars($page_url) .
	'" target="' . htmlspecialchars($target) . '"><img src="'
        . htmlspecialchars($image_url) . '" alt="" title="' . htmlspecialchars($comment) . '" />'
        . '</a>';
    }
  }
}
else
{
  // Silent error.
  // echo "Error";
}
