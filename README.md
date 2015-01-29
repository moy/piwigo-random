Piwigo RANDOM
=============

Piwigo-random is a simple solution to incorporate random images from a
[Piwigo](http://piwigo.org/) galery in any website.

It uses Piwigo's [remote API](http://piwigo.org/demo/tools/ws.htm), so
it does not need anything installed on the Piwigo server. It consists
in 2 parts:

* A small PHP script, `piwigo-random-js.php` that should be placed on
  any webserver able to execute PHP. It can be any server: either your
  Piwigo server, the same server as the one on which you want to
  integrate the image, or any other.

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

The script will look for an HTML element with `id="random_image"`, and
add the images to this element. Note the `async` attribute to allow
asynchronous loading of the script: if your piwigo gallery is slow or
even down, it won't slow down your website.

More information
================

See the demo for examples of more advanced uses:

* [HTML source](piwigo-random-demo.html)
* [Browsable demo](http://www-verimag.imag.fr/~moy/piwigo-random/piwigo-random-demo.html)

Don't hesitate to read the source code of `piwigo-random-js.php`, it's
actually a very small piece of code!

Alternatives
============

* [PiwigoPress](https://wordpress.org/plugins/piwigopress/): Same
  idea, with more features but limited to wordpress.


