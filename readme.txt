=== WP Responsive Media ===
Contributors: randyjensen
Donate link: http://www.randyjensen.com/
Tags: responsive, images, rwd, media
Requires at least: 3.9
Tested up to: 3.9.1
Stable tag: 1.0.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A seamless responsive images solution for WordPress that doesn’t break the visual editor.

== Description ==

Most responsive image solutions use shortcodes to insert responsive images. This isn’t inherently a bad idea, but it does ruin the experience for your content editors who lose the ability to see images in the visual editor. WP Responsive Media maintains the visual editor support as well as all other WordPress media functionality. It’s built on top of the Picturefill polyfill for the picture element and uses the default WordPress image sizes.

== Installation ==

Installing "WP Responsive Media" can be done either by searching for "WP Responsive Media" via the "Plugins > Add New" screen in your WordPress dashboard, or by using the following steps:

1. Download the plugin via WordPress.org
1. Upload the ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard
1. Activate the plugin through the 'Plugins' menu in WordPress

== Description ==

A seamless responsive images solution for WordPress that doesn’t break the visual editor.

== Frequently Asked Questions ==

= Does this make all of my images responsive for older posts? =
No. This only works on images added after you’ve activated the plugin.

= Does everything blow up after I uninstall it? =
No. There will be a little extra code in your markup that is used by this plugin, mainly some extra data attributes, but everything will continue to function normally.

= Does this handle all media? =
No. It only handles images. Someone had already taken WP Responsive Images so this was the next best.

= How does it work? =
After you’ve activated the plugin, just go to your Post or Page and insert an image. You won’t notice anything different in the WordPress admin, it’ll just show up as an image like every other one. On the front end of the site, you’ll now see that the images that you’ve added are now fully responsive. You can read about it in more depth [here](http://randyjensenonline.com/thoughts/crafting-seamless-responsive-images-solution-wordpress/)

== Screenshots ==

== Changelog ==

= 1.0 =
* 2014-08-21
* Initial release

= 1.0.3 =
* 2014-08-21
* Added check for old images so we don’t parse those

== Upgrade Notice ==

= 1.0 =
* 2014-08-21
* Initial release