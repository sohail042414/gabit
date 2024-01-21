<div class="col-sm-12">
    <section class="panel">
        <header class="panel-heading">
            Manage Donations
            <ol class="breadcrumb">
                <li>
                    <a href="/MobiTrustWeb/admin/dashboard/index">Dashboard</a>
                </li>
                <li>
                    <a href="/MobiTrustWeb/admin/donations/admin">Donations</a>
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
<!--                        <a class="btn btn-primary module_menu" href="/MobiTrustWeb/admin/donations/create">Create Donations</a>-->
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
                <a class="btn btn-primary module_menu1" href="<?php echo $this->createUrl("donations/admin"); ?>">Manage Donations</a>
                <a class="btn btn-primary module_menu1" href="<?php echo $this->createUrl("donations/export"); ?>">Export</a>
                <?php /*<a class="btn btn-primary module_menu1" href="<php echo $this->createUrl("donations/admin"); ?>">Go Back</a>*/ ?>
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
                    <th id="donations-grid">ID</th>
                    <th id="donations-grid">SetupFundraiser</th>
                    <th id="donations-grid">Donation Amount</th>
                    <th id="donations-grid">Name</th>
                    <th id="donations-grid">Email</th>
                    <th id="donations-grid">Phone Number</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    foreach($model as $records){
                        /*echo "KK<pre>";
                        print_r($records);
                        echo "</pre>";*/
                        echo "<tr class='odd'>";
                        echo "<td>".$records['id']."</td>";
                        echo "<td>".$records['fundraiser_title']."</td>";
                        echo "<td>".$records['donation_amount']."</td>";
                        echo "<td>".$records['donor_name']."</td>";
                        echo "<td>".$records['donor_email']."</td>";
                        echo "<td>".$records['donor_phone_no']."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>    
            </table>
            </div>
            <?php 
                $total_donations = Yii::app()->db->createCommand()
                        ->select('SUM(donation_amount) as donation_amount')
                        ->from('donations')
                        ->where("status='Y'")
                        ->queryAll();
                $count_donations = Yii::app()->db->createCommand()
                        ->select('COUNT(id) as id')
                        ->from('donations')
                        ->where("status='Y'")
                        ->queryAll();
                $avg_donations = $total_donations[0][donation_amount] / $count_donations[0][id];
            ?>
            Total of all donations: <?php echo $total_donations[0][donation_amount]."<br>";  ?>
            Average donations: <?php echo round($avg_donations, 2);  ?>
        </div>
    </section>
</div>