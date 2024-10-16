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


// Detecting Active Variables
$option   = $input->getCmd('option', '');
$view     = $input->getCmd('view', '');
$layout   = $input->getCmd('layout', '');
$task     = $input->getCmd('task', '');
$itemid   = $input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu     = $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';
$logoclass = $this->params->get('logoStyle') !== null ? $this->params->get('logoStyle') : '';

// Favicons path
$fpath = Uri::root(true) . '/media/templates/site/bhoothathalwar/';


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

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($pageclass ? ' ' . $pageclass : '')
	. ($this->direction == 'rtl' ? ' rtl' : '');
?>">

<a href="#main" class="sr-only focus:not-sr-only"><?php echo Text::_('TPL_BHOOTHATHALWAR_SKIP_LINK_LABEL'); ?></a>

<?php if ($this->params->get('brand', 1)) : ?>
            <a class="brand-logo" href="<?php echo $this->baseurl; ?>/">
				<?php echo $logo; ?>
            </a>
			<?php if ($this->params->get('siteDescription')) : ?>
                <div class="site-description"><?php echo htmlspecialchars($this->params->get('siteDescription')); ?></div>
			<?php endif; ?>
<?php endif; ?>

<?php if ($this->countModules('menu', true)) : ?>
    <jdoc:include type="modules" name="menu" style="none" />
<?php endif; ?>


<?php if ($menu->getActive() == $menu->getDefault()) :?>

<?php else: ?>

<?php endif; ?>



    <jdoc:include type="message" />
    <main id="main">
        <jdoc:include type="component" />
    </main>

<?php if ($this->params->get('backTop') == 1) : ?>
    <a href="#" id="back-top" class="back-to-top-link" aria-label="<?php echo Text::_('TPL_BHOOTHATHALWAR_BACKTOTOP'); ?>">
        <span class="icon-arrow-up icon-fw" aria-hidden="true"></span>
    </a>
<?php endif; ?>




<footer>
    <p class="">&copy; <?php echo (date('Y')=='2023') ? '2023' : '2023 - '.date('Y'); ?> <?php echo $sitename; ?>. All rights reserved.</p>
</footer>

<jdoc:include type="modules" name="debug" style="none" />

</body>
</html>
