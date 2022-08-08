Piwigo RANDOM
=============

Piwigo-random is a simple solution to incorporate random images from a
[Piwigo](http://piwigo.org/) galery in any website.

It uses Piwigo's [remote API](http://piwigo.org/demo/tools/ws.htm), so
it does not need anything installed on the Piwigo server. It consists
in 2 parts:

* A small PHP script, `piwigo-random-backend.php` that should be placed on
  any webserver able to execute PHP. It can be any server: either your
  Piwigo server, the same server as the one on which you want to
  integrate the image, or any other.

* An HTML snippet, to be inserted in any webpage where you wish to
  include images.

Technically, the HTML snippet loads `piwigo-random-backend.php` as
JavaScript code, which generates the images element.

How to use it
=============

* Download `piwigo-random-backend.php` and put it on a webserver able to
  execute PHP. Create a file named prb-settings.php (you may use [prb-settings.php.example](prb-settings.php.example) as a template). Edit the file and change `$site` to your piwigo URL.

* On the site where you want to incorporate images, add the following code
  snippet (change the `src=` field to point to your own `piwigo-random-backend.php`):

```html
<span id="random_image">
  <script type="text/javascript"
	  src="//matthieu-moy.fr/piwigo-random-backend.php"
	  async>
  </script>
</span>
```

* Optionally: send me an email, I'd like to know if anyone uses my code :-).

The script will look for an HTML element with `id="random_image"`, and
add the images to this element. Note the `async` attribute to allow
asynchronous loading of the script: if your piwigo gallery is slow or
even down, it won't slow down your website.

Customization
-------------

One can change slightly the behavior of piwigo-random by adding GET
parameters to the piwigo-random-backend.php URL (e.g.
`src="//example.com/piwigo-random-backend.php?variable1=value&amp;variable2=value`):

* `maximages` (integer, default=1) is the number of images to display.

* `cat_id` (integer, default=null) is the number of the category
  (=album) in Piwigo. It is the number that appears in the URL when
  you visit an album in your Piwigo gallery. By default, take any image.

* `size` (string, must be one of `square`, `thumb`, `2small`,
  `xsmall`, `small`, `medium`, `large`, `xlarge`, `xxlarge`) is the
  size of the image.

* `element_name` (string, default="random_image") is the name of the
  HTML element generated. Use it to add CSS customization for example.

* `mode` (string, default="javascript") is the way piwigo-random
  should work. See below.

* `target` (string, default="_blank") defines how the link should
  behave (see how the
  [target HTML](http://www.w3schools.com/tags/att_a_target.asp)
  attribute works for details). By default, open in a new tab. Set to
  "_self" to open in the same tab as the source page.

To see all these settings in action, see the [demo](#demo) below.

Alternate methods
=================

The previous method has several advantages:

* It allows asynchronous load, i.e. it won't slow down your site even
  if the piwigo gallery experiences troubles.

* It works regardless of the technology your website uses, even in
  plain static HTML.

still, it won't work if the client disabled JavaScript.

Server-side generation (mode=html)
----------------------------------

An alternate method is to include the HTML elements for the random image
server-side, typically in PHP code. This can be done by passing `mode=html` to
`piwigo-random-backend.php`. For example, in PHP (replace with your URL of
course):

```php
<p>This
  <?php $base_url = "http://matthieu-moy.fr/piwigo-random/piwigo-random-backend.php";
	     echo file_get_contents($base_url . "?mode=html&cat_id=13"); ?>
is a random image</p>

```

Using a redirection (mode=redirect)
-----------------------------------

Piwigo-random can also be asked to issue a redirection to the image itself. This way, you can use a piwigo-random URL wherever you can use a static image URL (in the `src="..."` field of an `<img>` tag, in CSS code, ...). The user has complete freedom on the HTML or [CSS](https://www.scaler.com/topics/css/) code that uses this URL. The main drawback of this mode is that one only gets the URL of the image, and there's no simple way to have the image clickable to the gallery's page for example.

More information
================

<a id="demo"></a>See the demo for examples of more advanced uses:

* [HTML source of the demo](piwigo-random-demo.html)
* [Browsable demo](http://matthieu-moy.fr/piwigo-random/piwigo-random-demo.html)
* [Demo using the HTML mode (server-side in PHP)](http://matthieu-moy.fr/piwigo-random/piwigo-random-demo-php.php)

Don't hesitate to read the source code of `piwigo-random-backend.php`, it's
actually a very small piece of code!

Alternatives
============

* [PiwigoPress](https://wordpress.org/plugins/piwigopress/): Same
  idea, with more features but limited to wordpress.


