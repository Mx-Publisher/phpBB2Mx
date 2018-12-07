<?
//JN (GPL)
$file = $file ? $file : "sig_mx.png";
$file_header = 'Content-type: image/png';
$src = str_replace('php', 'png', $file);

srand ((float) microtime() * 10000000);
$quote = rand(1, 6);

switch($quote)
{
	case "1":
		$rand_quote = "MXP-CMS Team, mxp.sf.net";
	break;

	case "2":
		$rand_quote = "in between milestones edition ;)";
	break;

	case "3":
		$rand_quote = "MX-Publisher, Fully Modular Portal & CMS for phpBB";
	break;

	case "4":
		$rand_quote = "Portal & CMS Site Creation Tool";
	break;

	case "5":
		$rand_quote = "pafileDB, FAP, MX-Publisher, Translator";
	break;

	case "6":
		$rand_quote = "...Calendar, Links & News...modules";
	break;
}

$pic_title = $rand_quote;
$pic_title_reg = preg_replace("/[^A-Za-z0-9]/", "_", $pic_title);

$current_release = "3.0.0";

$im = @ImageCreateFromPNG($src);
$pic_size = @GetImageSize($src);

$pic_width = $pic_size[0];
$pic_height = $pic_size[1];

$dimension_font = 1;
$dimension_filesize = FileSize($src);
$dimension_string = intval($pic_width) . 'x' . intval($pic_height) . '(' . intval($dimension_filesize / 1024) . 'KB)';

// integer representation of the color black (rgb: 0,0,0)
$blue = ImageColorAllocate($im, 6, 108, 159);
$background = ImageColorAllocate($im, 0, 0, 0);
// removing the black from the placeholder
ImageColorTransparent($im, $background);
// turning on alpha channel information saving (to ensure the full range
// of transparency is preserved)
ImageSaveAlpha($im, true);

$dimension_height = imagefontheight($dimension_font);
$dimension_width = imagefontwidth($dimension_font) * strlen($current_release);
$dimension_x = ($thumbnail_width - $dimension_width) / 2;
$dimension_y = $thumbnail_height + ((16 - $dimension_height) / 2);
//ImageString($im, 2, $dimension_x, $dimension_y, $current_release, $blue);
@ImageString($im, 2, 125, 2, $current_release, $blue);
@ImageString($im, 2, 20, 17, $rand_quote, $blue);

@Header($file_header);
Header("Expires: Mon, 1, 1999 05:00:00 GMT");
Header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
Header("Cache-Control: no-store, no-cache, must-revalidate");
Header("Cache-Control: post-check=0, pre-check=0", false);
Header("Pragma: no-cache");
@ImagePNG($im);
exit;
?>