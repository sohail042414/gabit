<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            
            Manage Administrators (<?php echo $users_count; ?>)

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
                        array(
                            'label' => 'Manage Resources', 
                            'url' => array('resources/admin'),
                            //hard coded resource_id for Resources controller
                            'visible' => $this->auth->canUpdate(27)
                        ),
                        array(
                            'label' => 'Manage Admin Groupss', 
                            'url' => array('groups/admin'),
                            //hard coded resource_id for Groups controller
                            'visible' => $this->auth->canUpdate(24)
                        ),
			            array(
                            'label' => 'Create Account', 
                            'url' => array('administrators/create'),
                            'visible' => $this->auth->canUpdate($this->resource_id)
                        ),
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
                            'header' => 'User Name',
                            'footer' => "<b>".$data_provider->getTotalItemCount()."</b>",
                        ),
                        array(
                            'header' => 'Admin Group',
                            'type' => 'raw',
                            'value' => 'isset($data->group) ? $data->group->name  : null',
                        ),
                        'email',
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
                        /*
                          'password',
                          'created_date',
                          'updated_date',
                          array(
                          'name' => 'status',
                          'type' => 'raw',
                          'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                          'value' => 'UtilityHtml::getStatusImage($data->status,"grid")',
                          ), */
                        array(
                            'header' => 'Actions',
                            'class' => 'CoreCButtonColumn',
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </section>
</div>
