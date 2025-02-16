<?php
/**
 * TbBreadcrumbs class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

/**
 * Bootstrap breadcrumb widget.
 * @see http://twitter.github.com/bootstrap/components.html#breadcrumbs
 * @package bootstrap.widgets
 */
class TbBreadcrumb extends CWidget
{
    /**
     * @var string the divider between links in the breadcrumbs.
     */
    public $divider = '/';
    /**
     * @var boolean whether to HTML encode the link labels.
     */
    public $encodeLabel = true;
    /**
     * @var string the label for the first link in the breadcrumb.
     */
    public $homeLabel;
    /**
     * @var array the url for the first link in the breadcrumb
     */
    public $homeUrl;
    /**
     * @var array the HTML attributes for the breadcrumbs.
     */
    public $htmlOptions = [];
    /**
     * @var array list of links to appear in the breadcrumbs.
     */
    public $links = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        $this->htmlOptions['divider'] = $this->divider;
    }

    /**
     * Runs the widget.
     */
    public function run()
    {
        // todo: consider adding control property for displaying breadcrumbs even when empty.
        if (!empty($this->links)) {
            $links = [];
            if ($this->homeLabel !== false) {
                $label = $this->homeLabel ?? TbHtml::icon('home');
                $links[$label] = $this->homeUrl ?? Yii::app()->homeUrl;
            }
            foreach ($this->links as $label => $url) {
                if (is_string($label) || is_array($url)) {
                    if ($this->encodeLabel) {
                        $label = CHtml::encode($label);
                    }
                    $links[$label] = $url;
                } else {
                    $links[] = $this->encodeLabel ? CHtml::encode($url) : $url;
                }
            }
            echo TbHtml::breadcrumbs($links, $this->htmlOptions);
        }
    }
}
