/**
 *
 * Find all ns-picturefill-img images and build out proper <picture> markup
 *
 */
(function() {
  // Find our images
  var imgs = document.querySelectorAll('.ns-picturefill-img');
  for (var i = 0; i < imgs.length; i++) {

    // Find out what size the image is
    var size = 'size-thumbnail';
    if (imgs[i].classList.contains('size-medium'))
      size = 'size-medium';
    if (imgs[i].classList.contains('size-large'))
      size = 'size-large';
    if (imgs[i].classList.contains('size-full'))
      size = 'size-full';

    // Create our picture element and assign it the proper alignment
    var picture = document.createElement('picture');
        picture.classList.add(imgs[i].getAttribute('data-align'));

    // Create array of image urls
    var img_urls = [imgs[i].getAttribute('data-img-full'), imgs[i].getAttribute('data-img-large'), imgs[i].getAttribute('data-img-medium'), imgs[i].getAttribute('data-img-thumbnail')];

    // Create our <source> tags for each of the image sizes (function is below)
    var new_picture = addSrcSets(img_urls, picture, size);

    // Create an array of our image classes
    var img_classes = imgs[i].classList.toString();
        img_classes = img_classes.split(' ');

    // Create our image tag for the <picture> markup
    var img = document.createElement('img');
        img.alt = imgs[i].getAttribute('data-alt');
        img.title = imgs[i].getAttribute('data-title');
        img.src = imgs[i].getAttribute('data-img-medium');

    // Remove our fake-wp-image class but add the others to our new image
    for (var x = 0; x < img_classes.length; x++) {
      if (img_classes[x] !== 'fake-wp-image')
        img.classList.add(img_classes[x]);
    }

    // Append our image to our new_picture var which contains our <source> tags
    new_picture.appendChild(img);

    // Insert all of our markup directly after our <noscript> tag
    imgs[i].parentNode.insertBefore(new_picture, imgs[i].nextSibling);
  }
})();

function addSrcSets(imgs, parent, size) {
  var html = '';
  var mediaSizes = ['1400', '700', '300'];
  var i = 0;
  var x = 0;
  if (size == 'size-large') i = 1;
  if (size == 'size-medium') i = 2;
  if (size == 'size-thumbnail') i = 3;

  for (i; i < imgs.length; i++) {
    media = '';
    if (i < 3) media = 'media="(min-width: '+mediaSizes[i]+'px)"';

    if (x === 0) html += '<!--[if IE 9]><video style="display: none;"><![endif]-->';
    html += '<source srcset="'+imgs[i]+'" '+media+'>';
    if (i+1 == imgs.length) html += '<!--[if IE 9]></video><![endif]-->';

    x++;
  }

  parent.innerHTML = html;

  return parent;
}
