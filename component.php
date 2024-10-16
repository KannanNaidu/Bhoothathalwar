<?php
/**
 * @package    Joomla.Site
 * @subpackage Template.bhoothathalwar
 *
 * @author     Kannan Naidu Venugopal <mail>
 * @copyright  (C) 2024 Kannan Naidu Venugopal
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @client     Not Yet
 * @link       http://your.url.com
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;


/** @var Joomla\CMS\Document\HtmlDocument $this */

$app   = Factory::getApplication();
$input = $app->getInput();
$wa    = $this->getWebAssetManager();

// Favicons
$this->addHeadLink($fpath . 'images/favicons/apple-touch-icon.png', 'apple-touch-icon', 'rel', ['sizes' => '180x180']);
$this->addHeadLink($fpath . 'images/favicons/favicon-48x48.png', 'icon', 'rel', ['sizes' => '48x48', 'type' => 'image/png']);
$this->addHeadLink($fpath . 'images/favicons/favicon.svg', 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink($fpath . 'images/favicons/site.webmanifest', 'manifest', 'rel', []);
$this->addHeadLink($fpath . 'images/favicons/favicon.ico', 'shortcut icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);


// Enable assets
$wa->useStyle('template.bhoothathalwar')
	->useScript('template.bhoothathalwar');
$this->getPreloadManager()->preload($wa->getAsset('style', 'template.bhoothathalwar')->getUri() . '?' . $this->getMediaVersion(), ['as' => 'style']);

// Logo file or site title param
if ($this->params->get('logoFile')) {
	$logo = HTMLHelper::_('image', Uri::root(false) . htmlspecialchars($this->params->get('logoFile'), ENT_QUOTES), $sitename, ['class' =>  $logoclass , 'loading' => 'eager', 'decoding' => 'async'], false, 0);
} elseif ($this->params->get('siteTitle')) {
	$logo = '<span title="' . $sitename . '">' . htmlspecialchars($this->params->get('siteTitle'), ENT_COMPAT, 'UTF-8') . '</span>';
} else {
	$logo = HTMLHelper::_('image', 'logo.svg', $sitename, ['class' => 'logo d-inline-block', 'loading' => 'eager', 'decoding' => 'async'], true, 0);
}

// For dev use only
//$wa->registerAndUseScript('tailwind.scripts','https://cdn.tailwindcss.com');
//$wa->registerAndUseStyle('tailwind.styles','https://unpkg.com/@tailwindcss/typography@0.4.x/dist/typography.min.css');

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');
$this->setGenerator(null);



?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
    <head>
        <jdoc:include type="metas" />
        <jdoc:include type="styles" />
        <jdoc:include type="scripts" />
    </head>
    <body class="contentpane component <?php echo $this->direction === 'rtl' ? 'rtl' : ''; ?>">
    <jdoc:include type="message" />
    <jdoc:include type="component" />
    </body>
</html>
