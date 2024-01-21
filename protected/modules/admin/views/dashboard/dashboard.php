<style>
.mini-stat-info {
    font-size: 15px;
}
</style>
<section class="wrapper">
    <div class="row">
        <div class="col-md-3">
            <div class="mini-stat clearfix">
                <span class="mini-stat-icon green"><i class="fa fa-users"></i></span>
                <div class="mini-stat-info">
                    <span><?php  echo $visitors_count; ?></span>
                    Total Visitors
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mini-stat clearfix">
                <span class="mini-stat-icon green"><i class="fa fa-users"></i></span>
                <div class="mini-stat-info">
                    <span><?php  echo $supporter_count; ?></span>
                    Total No Of Supporters
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mini-stat clearfix">
                <span class="mini-stat-icon green"><i class="fa fa-users"></i></span>
                <div class="mini-stat-info">
                    <span><?php  echo $users_count; ?></span>
                    Total Registered Users
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="mini-stat clearfix">
                <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
                <div class="mini-stat-info">
                    <span><?php  echo $fundraiser_count; ?></span>
                    Total Created Fundraisers
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mini-stat clearfix">
                <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
                <div class="mini-stat-info">

                    <span><?php  echo $active_fundraiser_count; ?></span>
                    Total Active Fundraisers
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mini-stat clearfix">
                <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
                <div class="mini-stat-info">

                    <span><?php  echo $new_fundraiser_count; ?></span>
                    Total New Fundraisers
                </div>
            </div>
        </div>        
    </div>

    <div class="row">
        <div class="col-md-12">
            <h2>Stats By Fundraiser Category</h2>

            <?php $this->widget('CoreCGridView', array(
                    'id' => 'fundraiser-type-grid',
                    'dataProvider' => $model->search(),
                    'columns' => array(
                        'fundraiser_type'=>array(
                            'name' => 'fundraiser_type',
                            'header' => 'Fundraiser Category',
                            'value' => '$data->fundraiser_type',
                            'footer' => '<b>Over All</b>',
                        ),
                        array(
                            'header' => 'Total Created Fundraisers',
                            'value' => '$data->getFundraisersCount()',
                            'footer' => "<b>".$fundraiser_count."<b>",
                        ),
                        array(
                            'header' => 'Total Active Fundraisers',
                            'value' => '$data->getActiveFundraisersCount()',
                            'footer' => "<b>".$active_fundraiser_count."<b>",
                        ),                        
                    ),
                )); ?>
        </div>
    </div>
</section>
