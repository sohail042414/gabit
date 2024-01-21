<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            <?php echo Yii::t('app', 'Payment Summary '); ?>
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
                            'label' => Yii::t('app', 'Manage Donations') , 
                            'url' => array('admin'),
                            'visible' => $this->auth->canView($this->resource_id),
                        ),
                    ),
                ));
                ?>
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-inline">


            <table class="display table table-bordered table-striped dataTable" style="margin-top:20px;">
                <thead>
                    <tr>
                        <th colspan="4">Payment Summary</th>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <th>Total</th>
                        <th>Payout</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Fundraisers Inflow/reward (89%-5)</td>
                    <td>
                        <?php $reward_inflow = Donations::model()->getRewardInflow(); ?>
                        <?php echo number_format($reward_inflow,2); ?>
                    </td>
                    <td>
                        <?php $reward_payout = FundtransferByuser::model()->getRewardPayoutTotal(); ?>
                        <?php echo number_format($reward_payout,2); ?>                        
                    </td>
                    <td>
                        <?php $reward_balance = $reward_inflow-$reward_payout; ?>
                        <?php echo number_format($reward_balance,2); ?>
                    </td>
                </tr>
                <tr>
                    <td>Fundraisers Inflow (92%-5)</td>
                    <td>
                        <?php $normal_inflow = Donations::model()->getNormalInflow(); ?>
                        <?php echo number_format($normal_inflow,2); ?>
                    </td>
                    <td>
                        <?php $normal_payout = FundtransferByuser::model()->getNormalPayoutTotal(); ?>
                        <?php echo number_format($normal_payout,2); ?>                        
                    </td>
                    <td>
                        <?php $normal_balance = $normal_inflow-$normal_payout; ?>
                        <?php echo number_format($normal_balance,2); ?>
                    </td>
                </tr>
                <tr>
                    <td>Platform Inflow/reward (11%+5)</td>
                    <td>
                        <?php $platform_reward_inflow = Donations::model()->getPlatformRewardInflow();  ?>
                        <?php echo number_format($platform_reward_inflow,2); ?>
                    </td>
                    <?php $reward_inflow3 = Donations::model()->getRewardInflow3Perccent(); ?>
                    <td>Reward Inflow (3%) | <?php echo number_format($reward_inflow3,2); ?></td>
                    <td>0.00</td>
                </tr>
                
                <tr>
                    <td>Platform Inflow (8%+5)</td>
                    <td colspan="3">
                        <?php $platform_normal_inflow = Donations::model()->getPlatformNormalInflow();  ?>
                        <?php echo number_format($platform_normal_inflow,2); ?>
                    </td>
                </tr>
                <tr>
                    <td>Total Inflow (100%)</td>
                    <td colspan="3">
                        <?php $total_inflow = Donations::model()->getTotalInflow();  ?>
                        <?php echo number_format($total_inflow,2); ?>
                    </td>
                </tr>
                </tbody>
            </table>  


            </div>        
        </div>
    </section>
</div>