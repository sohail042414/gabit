<div class="col-sm-12">
    <section class="panel">
        <header class="panel-heading">
            Manage Users
            <ol class="breadcrumb">
                <li>
                    <a href="/MobiTrustWeb/admin/dashboard/index">Dashboard</a>
                </li>
                <li>
                    <a href="/MobiTrustWeb/admin/users/admin">Users</a>
                </li>
                <li>New Entry</li>
            </ol>    
            <?php //echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)) ?>
            <?php
               /* $this->breadcrumbs = array(
                    $model->label(2) => array('admin'),
                    Yii::t('app', 'Manage'),
                );*/

                /*$this->widget('CoreCBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    'htmlOptions' => array('class' => 'breadcrumb')
                ));*/ 
            ?> 
        </header>
        <div class="panel-body">
            <div class="box-header">
                <ul id="yw0" class="module_menu">
                    <li>
                        <a class="btn btn-primary module_menu" href="/MobiTrustWeb/admin/users/create">Create Users</a>
                    </li>
                </ul>
                <?php
                /*$this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array('create')),
                    ),
                ));*/
                ?>
                <a class="btn btn-primary module_menu1" href="<?php echo $this->createUrl("users/admin"); ?>">Manage Users</a>
                <a class="btn btn-primary module_menu1" href="<?php echo $this->createUrl("users/export"); ?>">Export All Registration Data</a>
                <a class="btn btn-primary module_menu1" href="<?php echo $this->createUrl("users/exportlogin"); ?>">Export All Login Users Data</a>
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-inline">
                <?php 
                /*echo "Curr: ".date('Y-m-d H:i:s')."<br>";
                echo "Past: ".date('Y-m-d H:i:s', strtotime('-1 day'))."<br>";*/
                ?>
                <table class="display table table-bordered table-striped dataTable" style="margin-top: 20px;">
                <thead>
                <tr>
                    <th id="donations-grid">Username</th>
                    <th id="donations-grid">Email</th>
                    <th id="donations-grid">Age</th>
                    <th id="donations-grid">Sex</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    foreach($model as $records){
                        /*echo "KK<pre>";
                        print_r($records);
                        echo "</pre>";*/
                        echo "<tr class='odd'>";
                        echo "<td>".$records['username']."</td>";
                        echo "<td>".$records['email']."</td>";
                        echo "<td>".$records['age']."</td>";
                        echo "<td>".$records['sex']."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>    
            </table>
            </div>
        </div>
    </section>
</div>
