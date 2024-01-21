<div class="col-sm-12">
    <section class="panel">
        <header class="panel-heading">
            Manage SetupFundraisers
            <ol class="breadcrumb">
                <li>
                    <a href="/MobiTrustWeb/admin/dashboard/index">Dashboard</a>
                </li>
                <li>
                    <a href="/MobiTrustWeb/admin/SetupFundraiser/admin">SetupFundraisers</a>
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
                <?php
                /*$this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array('create')),
                    ),
                ));*/
                ?>
                <a class="btn btn-primary module_menu1" href="<?php echo $this->createUrl("SetupFundraiser/newentry"); ?>">New Entry</a>
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
                    <th id="donations-grid">FundraiserType</th>
                    <th id="donations-grid">Title Your Fundraiser</th>
                    <th id="donations-grid">Fundraiser Image</th>
                    <th id="donations-grid">Description of Fundraiser</th>
                    <th id="donations-grid">Search Status</th>
                    <th id="donations-grid">Feature Flag</th>
                    <th id="donations-grid">Users</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    foreach($model as $records){
                        /*echo "KK<pre>";
                        print_r($records);
                        echo "</pre>";*/
                        echo "<tr class='odd'>";
                        echo "<td>".$records['fundraiser_type']."</td>";
                        echo "<td>".$records['fundraiser_title']."</td>";
                        
                        if($records['fundraiser_image'] == ""){
                            echo "<td>".$records['fundraiser_image']."</td>";
                        } else {
                            echo "<td><img src='/MobiTrustWeb/uploads/fundraiser_picture/thumbnails/215x215_".$records['fundraiser_image']."' title='".$records['fundraiser_image']."' class='display_facebook_img' /></td>";
                        }
                        
                        echo "<td>".$records['fundraiser_description']."</td>";
                        
                        if($records['search_status'] == "Y"){
                            echo "<td align='center'><img src='/MobiTrustWeb/images/admin/active.ico' title='".$records['status']."' class='status_iconsgrid1' /></td>";
                        } else {
                            echo "<td align='center'><img src='/MobiTrustWeb/images/admin/inactive.ico' title='".$records['status']."' class='status_iconsgrid1' /></td>";
                        }
                        
                        if($records['feature_flag'] == "Y"){
                            echo "<td align='center'><img src='/MobiTrustWeb/images/admin/active.ico' title='".$records['status']."' class='status_iconsgrid1' /></td>";
                        } else {
                            echo "<td>".$records['feature_flag']."</td>";
                        }
                        
                        
                        echo "<td>".$records['username']."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>    
            </table>
            </div>
        </div>
    </section>
</div>