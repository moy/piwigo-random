Piwigo RANDOM
=============

Piwigo-random is a simple solution to incorporate random images from a
[Piwigo](http://piwigo.org/) galery in any website.

It uses Piwigo's [remote API](http://piwigo.org/demo/tools/ws.htm), so
it does not need anything installed on the Piwigo server. It consists
in 2 parts:

* A small PHP script, `piwigo-random-js.php` that should be placed on
  any webserver able to execute PHP.

* An HTML snippet, to be inserted in any webpage where you wish to
  include images.

Technically, the HTML snippet loads `piwigo-random-js.php` as
JavaScript code, which generates the images element.

How to use it
=============

Download `piwigo-random-js.php` and put it on a webserver able to
execute PHP. Edit the file and change `$site` to your piwigo URL.

On the site where you want to incorporate images, add the following code snippet (change the `src=` field to point to your own `piwigo-random-js.php`).

```html
<span id="random_image">
  <script type="text/javascript"
	  src="//www-verimag.imag.fr/~moy/piwigo-random-js.php"
	  async>
  </script>
</span>
```

More information
================

See the demo for examples of more advanced uses:

* [HTML source](piwigo-random-demo.html)
* [Browsable demo](http://www-verimag.imag.fr/~moy/piwigo-random/piwigo-random-demo.html)

Alternatives
============

* [PiwigoPress](https://wordpress.org/plugins/piwigopress/): Same
  idea, with more features but limited to wordpress.


