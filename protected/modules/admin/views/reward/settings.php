<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
			Reward Settings
            <?php
			$this->breadcrumbs=array(
				'Manage Rewards'=>array('index'),
				'Settings',
			);

            $this->widget('CoreCBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'htmlOptions' => array('class' => 'breadcrumb')
            ));

            ?>
        </header>
        <div class="panel-body">
            <?php echo UtilityHtml::get_flash_message(); ?>        
            <div class="box-header">
                <?php
                $this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        array('label' => 'Manage Rewards ', 'url' => array('admin')),
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="loader_space"></div>
            <?php
            $this->renderPartial('_settings_form', array(
                'model' => $model,
                'reward_date' => $reward_date,
                'reward_prize' => $reward_prize,
                'buttons' => 'create'));
            ?>
        </div>
    </section>
</div>

