<?php

class CoreCBreadcrumbs extends CWidget
{
    /**
     * @var string the tag name for the breadcrumbs container tag. Defaults to 'div'.
     */
    public $tagName = 'ol';
    /**
     * @var array the HTML attributes for the breadcrumbs container tag.
     */
    public $htmlOptions = array('class' => 'breadcrumbs');
    /**
     * @var boolean whether to HTML encode the link labels. Defaults to true.
     */
    public $encodeLabel = false;
    /**
     * @var string the first hyperlink in the breadcrumbs (called home link).
     * If this property is not set, it defaults to a link pointing to {@link CWebApplication::homeUrl} with label 'Home'.
     * If this property is false, the home link will not be rendered.
     */
    public $homeLink;
    /**
     * @var array list of hyperlinks to appear in the breadcrumbs. If this property is empty,
     * the widget will not render anything. Each key-value pair in the array
     * will be used to generate a hyperlink by calling CHtml::link(key, value). For this reason, the key
     * refers to the label of the link while the value can be a string or an array (used to
     * create a URL). For more details, please refer to {@link CHtml::link}.
     * If an element's key is an integer, it means the element will be rendered as a label only (meaning the current page).
     *
     * The following example will generate breadcrumbs as "Home > Sample post > Edit", where "Home" points to the homepage,
     * "Sample post" points to the "index.php?r=post/view&id=12" page, and "Edit" is a label. Note that the "Home" link
     * is specified via {@link homeLink} separately.
     *
     * <pre>
     * array(
     *     'Sample post'=>array('post/view', 'id'=>12),
     *     'Edit',
     * )
     * </pre>
     */
    public $links = array();
    /**
     * @var string String, specifies how each active item is rendered. Defaults to
     * "<a href="{url}">{label}</a>", where "{label}" will be replaced by the corresponding item
     * label while "{url}" will be replaced by the URL of the item.
     * @since 1.1.11
     */
    public $activeLinkTemplate = '<li><a href="{url}">{label}</a></li>';
    /**
     * @var string String, specifies how each inactive item is rendered. Defaults to
     * "<span>{label}</span>", where "{label}" will be replaced by the corresponding item label.
     * Note that inactive template does not have "{url}" parameter.
     * @since 1.1.11
     */
    public $inactiveLinkTemplate = '<li>{label}</li>';
    /**
     * @var string the separator between links in the breadcrumbs. Defaults to ' &raquo; '.
     */
    public $separator = ' ';

    /**
     * Renders the content of the portlet.
     */
    public function run()
    {
        $this->homeLink = '<li><a href="' . Yii::app()->createUrl('admin/dashboard/index') . '">Dashboard</a></li>';

        if (empty($this->links))
            return;

        $definedLinks = $this->links;

        echo CHtml::openTag($this->tagName, $this->htmlOptions)
            . "\n";
        $links = array();
        if ($this->homeLink === null)
            $definedLinks = array_merge(array(Yii::t('zii', 'Home') => Yii::app()->homeUrl), $definedLinks);
        elseif ($this->homeLink !== false)
            $links[] = $this->homeLink;
        foreach ($definedLinks as $label => $url) {
            if (is_string($label) || is_array($url))
                $links[] = strtr($this->activeLinkTemplate, array(
                    '{url}' => CHtml::normalizeUrl($url),
                    '{label}' => $this->encodeLabel ? CHtml::encode($label) : $label,
                ));
            else
                $links[] = str_replace('{label}', $this->encodeLabel ? CHtml::encode($url) : $url, $this->inactiveLinkTemplate);
        }
        echo implode($this->separator, $links);
        echo CHtml::closeTag($this->tagName);
    }
}

?>