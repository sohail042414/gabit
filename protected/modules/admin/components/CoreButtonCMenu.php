<?php

class CoreButtonCMenu extends CMenu
{
    protected function renderMenu($items)
    {
        if (!empty($this->htmlOptions['class'])) {
            $this->htmlOptions['class'] = $this->htmlOptions['class'] . ' ' . 'module_menu';
        } else {
            $this->htmlOptions['class'] = 'module_menu';
        }

        if (count($items)) {
            echo CHtml::openTag('ul', $this->htmlOptions) . "\n";
            $this->renderMenuRecursive($items);
            echo CHtml::closeTag('ul');
        }
    }

    protected function renderMenuRecursive($items)
    {
        $count = 0;
        $n = count($items);
        foreach ($items as $item) {
            $count++;
            $options = isset($item['itemOptions']) ? $item['itemOptions'] : array();
            $class = array();
            if ($item['active'] && $this->activeCssClass != '')
                $class[] = $this->activeCssClass;
            if ($count === 1 && $this->firstItemCssClass !== null)
                $class[] = $this->firstItemCssClass;
            if ($count === $n && $this->lastItemCssClass !== null)
                $class[] = $this->lastItemCssClass;
            if ($this->itemCssClass !== null)
                $class[] = $this->itemCssClass;
            if ($class !== array()) {
                if (empty($options['class']))
                    $options['class'] = implode(' ', $class);
                else
                    $options['class'] .= ' ' . implode(' ', $class);
            }

            echo CHtml::openTag('li', $options);

            $menu = $this->renderMenuItem($item);
            if (isset($this->itemTemplate) || isset($item['template'])) {
                $template = isset($item['template']) ? $item['template'] : $this->itemTemplate;
                echo strtr($template, array('{menu}' => $menu));
            } else
                echo $menu;

            if (isset($item['items']) && count($item['items'])) {
                echo "\n" . CHtml::openTag('ul', isset($item['submenuOptions']) ? $item['submenuOptions'] : $this->submenuHtmlOptions) . "\n";
                $this->renderMenuRecursive($item['items']);
                echo CHtml::closeTag('ul') . "\n";
            }

            echo CHtml::closeTag('li') . "\n";
        }
    }

    protected function renderMenuItem($item)
    {

        if (!empty($item['linkOptions']['class'])) {
            $item['linkOptions']['class'] = $item['linkOptions']['class'] . ' ' . 'btn btn-primary module_menu';
        } else {
            $item['linkOptions']['class'] = 'btn btn-primary module_menu';
        }

        if (isset($item['url'])) {
            $label = $this->linkLabelWrapper === null ? $item['label'] : CHtml::tag($this->linkLabelWrapper, $this->linkLabelWrapperHtmlOptions, $item['label']);
            return CHtml::link($label, $item['url'], isset($item['linkOptions']) ? $item['linkOptions'] : array());
        } else
            return CHtml::tag('span', isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
    }

    protected function normalizeItems($items, $route, &$active)
    {
        foreach ($items as $i => $item) {

            // Other case is super user, who has all permissions so do not check. 
            if (Yii::app()->user->role == 'admin_user'){ 
                if(!isset($items[$i]['visible']) || ((boolean)$items[$i]['visible'] == false)) { 
                    unset($items[$i]);
                    continue;
                }
            }   

            if (!isset($item['label']))
                $item['label'] = '';
            $encodeLabel = isset($item['encodeLabel']) ? $item['encodeLabel'] : $this->encodeLabel;
            if ($encodeLabel)
                $items[$i]['label'] = CHtml::encode($item['label']);
            $hasActiveChild = false;
            if (isset($item['items'])) {
                $items[$i]['items'] = $this->normalizeItems($item['items'], $route, $hasActiveChild);
                if (empty($items[$i]['items']) && $this->hideEmptyItems) {
                    unset($items[$i]['items']);
                    if (!isset($item['url'])) {
                        unset($items[$i]);
                        continue;
                    }
                }
            }
            if (!isset($item['active'])) {
                if ($this->activateParents && $hasActiveChild || $this->activateItems && $this->isItemActive($item, $route))
                    $active = $items[$i]['active'] = true;
                else
                    $items[$i]['active'] = false;
            } elseif ($item['active'])
                $active = true;
        }
        return array_values($items);
    }

}

?>