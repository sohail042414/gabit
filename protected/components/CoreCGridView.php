<?php

class CoreCGridView extends CGridView
{

    public $itemsCssClass = 'demo';
    public $summaryText = '';
    public $pagerCssClass = 'dataTables_paginate paging_bootstrap pagination';
    public $cssFile = false;
    public $pager = array('htmlOptions' => array('class' => ''), 'header' => '');
    public $rowCssClass = array('odd', 'even');
    public $showTableOnEmpty = true;
    

    public function renderItems()
    {
        if ($this->dataProvider->getItemCount() > 0 || $this->showTableOnEmpty) {
            echo "<div class='loader_space'></div>\n<table style=\"margin-top:10px;\" class=\"{$this->itemsCssClass}\">\n";
            $this->renderTableHeader();
            ob_start();
            $this->renderTableBody();
            $body = ob_get_clean();
            $this->renderTableFooter();
            echo $body; // TFOOT must appear before TBODY according to the standard.
            echo "</table>";
        } else
            $this->renderEmptyText();
    }
}

?>