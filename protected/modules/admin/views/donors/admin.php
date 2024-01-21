<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            
            Manage Donors (<?php echo $users_count; ?>)

            <?php
            $this->breadcrumbs = array(
                $model->label(2) => array('admin'),
                Yii::t('app', 'Manage'),
            );

            $this->widget('CoreCBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'htmlOptions' => array('class' => 'breadcrumb')
            ));
            ?>
        </header>
        <div class="panel-body">
            <div class="box-header">
                <?php
                $this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        // array(
                        //     'label' => Yii::t('app', 'Create') . ' ' . $model->label(), 
                        //     'url' => array('create'),
                        //     'visible' => $this->auth->canAdd($this->resource_id),
                        // ),
                    ),
                ));
                ?>
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-inline">
                <?php
                $this->widget('CoreCGridView', array(
                    'id' => 'users-grid',
                    'dataProvider' => $data_provider,
                    'filter' => $model,
                    'columns' => array(
                        'id' => array(
                            'name' => 'id',
                            'header' => 'Id',
                            'footer' => '<b>Total</b>',
                        ),
                        'username' => array(
                            'name' => 'username',
                            'header' => 'Full Name',
                            'footer' => "<b>".$data_provider->getTotalItemCount()."</b>",
                        ),
                        'email',
                        'phone',
                        'age',
                        array(
                            'name' => 'sex',
                            'type' => 'raw',
                            'value' => '$data->sex == "M" ? "Male" : "Female" ',
                            'filter' => array('M' => 'Male', 'F' => 'Female'),
                        ),
                        array(
                            'header' => 'New',
                            'name' => 'status_new',
                            'type' => 'raw',
                            'value' => '$data->status_new == "Y" ? "<span style=\"color:red;\">Yes</span>" : "No"',
                            'filter' => '',
                        ),
                        array(
                            'class' => 'CoreCButtonColumn',
                            'header' => 'Functions',
                            'template' => '{view}{update}{delete}',
                            'buttons' => array(
                                'view' => array(
                                    'visible' => ($this->auth->canView($this->resource_id)) ? '1' : '0;'
                                ),
                                'update' => array(
                                    'visible' => ($this->auth->canUpdate($this->resource_id)) ? '1' : '0;'
                                ),
                                'delete' => array(
                                    'visible' => ($this->auth->canDelete($this->resource_id)) ? '1' : '0;'
                                ),
                            ),
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </section>
</div>
