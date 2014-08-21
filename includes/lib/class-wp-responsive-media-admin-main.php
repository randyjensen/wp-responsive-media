<?php

/**
* Change the image output from the WYSIWYG
*/
add_filter( 'image_send_to_editor', 'add_custom_image_class', 10, 7 );
function add_custom_image_class($html, $id, $alt, $title, $align, $url, $size) {
	$imgAtts = wp_get_attachment_image_src($id, $size);

	$html = '<img class="fake-wp-image align'.$align.' size-'.$size.' wp-image-'.$id.'"
						width="'.$imgAtts[1].'"
						height="'.$imgAtts[2].'"
						title="'.get_the_title($id).'"
						src="'.wp_get_attachment_image_src($id, $size)[0].'"
						alt="'.get_post_meta($id, '_wp_attachment_image_alt', true).'"
						data-img-full="'.wp_get_attachment_image_src($id, 'full')[0].'"
						data-img-large="'.wp_get_attachment_image_src($id, 'large')[0].'"
						data-img-medium="'.wp_get_attachment_image_src($id, 'medium')[0].'"
						data-img-thumbnail="'.wp_get_attachment_image_src($id, 'thumbnail')[0].'"
						data-size="'.$size.'"
						data-id="'.$id.'" />';

	return $html;
}

/**
 * Remove dummy image that we inject just for WYSIWYG purposes from
 * being displayed and inject picture source
*/
add_filter( 'the_content', 'remove_wysiwyg_dummy_image' );
function remove_wysiwyg_dummy_image($content) {
	// Turn off errors
	libxml_use_internal_errors(true);
	// Start parsing the dom
	$dom = new DOMDocument;
	$dom->loadHTML($content);
	$images = $dom->getElementsByTagName('img');
	foreach ($images as $image) {
		// If it's a regular WP image, skip it
		if (strpos($image->getAttribute('class'), 'fake-wp-image') === false) continue;

		$src = $image->getAttribute('src');
		$alt = $image->getAttribute('alt');
		$title = $image->getAttribute('title');
		$class = $image->getAttribute('class');
		$full = $image->getAttribute('data-img-full');
		$large = $image->getAttribute('data-img-large');
		$medium = $image->getAttribute('data-img-medium');
		$thumbnail = $image->getAttribute('data-img-thumbnail');
		$size = $image->getAttribute('data-size');
		$id = $image->getAttribute('data-id');
		$align = 'alignnone';
		if (strpos($class, 'alignright') !== false) $align = 'alignright';
		if (strpos($class, 'alignleft') !== false) $align = 'alignleft';
		if (strpos($class, 'aligncenter') !== false) $align = 'aligncenter';

		$html = '';

		$html .= '<noscript data-img-full="'.wp_get_attachment_image_src($id, 'full')[0].'" data-img-large="'.wp_get_attachment_image_src($id, 'large')[0].'" data-img-medium="'.wp_get_attachment_image_src($id, 'medium')[0].'" data-img-thumbnail="'.$thumbnail.'" data-align="'.$align.'" data-size="size-'.$size.'" data-id="wp-image-'.$id.'" data-alt="'.$alt.'" data-title="'.$title.'" class="ns-picturefill-img '.$class.'">';
		$html .= '<img class="'.$class.' '.$size.' '.$id.'" src="'.$medium.'" alt="'.$alt.'" title="'.$title.'" />';
		$html .= '</noscript>';

		$picturefill = $dom->createDocumentFragment();
		$picturefill->appendXML($html);
		$image->parentNode->replaceChild( $picturefill, $image );
	}
	// Remove the doctype that is added
	$content = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());

	return $content;
}
