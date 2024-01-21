<?php

class CoreCMenu extends CMenu
{
    public $htmlOptions = array('class' => 'sidebar-menu');

    public function init()
    {
        if (isset($this->htmlOptions['id'])) {
            $this->id = $this->htmlOptions['id'];
        } else {
            $this->htmlOptions['id'] = $this->id;
            $hasActiveChild = true;
            $route = Yii::app()->controller->id . '/' . Yii::app()->controller->action->id;
            // p($this->items);

            $this->items = $this->normalizeItems($this->items, $route, $hasActiveChild);
        }
    }

    protected function normalizeItems($items, $route, &$active)
    {
 
        foreach ($items as $i => $item) {
            //If user is not super user, check its permissions
            // Other case is super user, who has all permissions so do not check. 
            if (Yii::app()->user->role == 'admin_user') {                
                if(!isset($items[$i]['resource_id'])){
                    unset($items[$i]);
                    continue;                
                }else if(($items[$i]['resource_id'] != 0) && (!Yii::app()->controller->auth->canView($items[$i]['resource_id']))) {
                    //resource_id 0 , means dashboard, or logout menu, etc. 
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
                if ($this->activateParents && $hasActiveChild || $this->activateItems && $this->isItemActive($item, $route)) {
                    $active = $items[$i]['active'] = true;
                } else {
                    $items[$i]['active'] = false;
                }

            } elseif ($item['active'])
                $active = true;
        }

        return array_values($items);
    }

    protected function isItemActive($item, $route)
    {
        if (!empty($item['url'][0]) && !empty($route) && ($item['url'][0] == 'rekognitionsMaster/uploadCsv')) {
            if ($route == $item['url'][0]) {
                return true;
            }
        } else if (!empty($item['url'][0]) && !empty($route) && ($item['url'][0] == 'rekognitionsMaster/admin')) {
            if ($route == $item['url'][0]) {
                return true;
            }
        } else {
            if (!empty($item['url'][0])) {
                $menu_item = explode('/', $item['url'][0]);
                $menu_item = $menu_item[0];

                $item['url'][0] = $menu_item;
            }

            if (!empty($route)) {
                $route_controller = explode('/', $route);
                if (!empty($route_controller[0])) {
                    $route = $route_controller[0];
                }
            }

            if (isset($item['url']) && is_array($item['url']) && !strcasecmp(trim($item['url'][0], '/'), $route)) {
                unset($item['url']['#']);
                if (count($item['url']) > 1) {
                    foreach (array_splice($item['url'], 1) as $name => $value) {
                        if (!isset($_GET[$name]) || $_GET[$name] != $value)
                            return false;
                    }
                }
                return true;
            }
        }

        return false;
    }
}

?>