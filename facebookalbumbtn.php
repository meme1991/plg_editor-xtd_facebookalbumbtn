<?php
/**
 * @version    1.0.0
 * @package    SPEDI Facebook Album Button
 * @author     SPEDI srl - http://www.spedi.it
 * @copyright  Copyright (c) Spedi srl.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die;

/**
 * Editor Article Gallery Btn
 *
 * @since  1.5
 */
class PlgButtonFacebookAlbumBtn extends JPlugin
{
	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;

	/**
	 * Article Gallery button
	 *
	 * @param string  $name  The name of the button to add
	 *
	 * @return array A two element array of (textToInsert)
	 */
	public function onDisplay($name)
	{
		$doc  = JFactory::getDocument();

		$link = '../plugins/editors-xtd/facebookalbumbtn/display.php?ih_name='.$name;

		JHTML::_('behavior.modal');
		$button          = new JObject;
		$button->modal   = true;
		$button->class   = 'btn';
		$button->text    = JText::_('Facebook Album');
		$button->name    = 'grid-view';
		$button->options = "{handler: 'iframe', size: {x: 800, y: 500}}";
		$button->link    = $link;

		return $button;
	}
}
