<style type="text/css">
.comment{margin-bottom:20px; padding:10px; border:#CCC 1px solid;}
.summary{ position:relative; top:-45px;}
.pending{color:red;}
.author strong{ color:green;}
.content{margin-top:10px;}
</style>


<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            <?php echo Yii::t('app', 'Comments') ?>

            <?php
            $this->breadcrumbs = array(
                'Blog' => array('index'),
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
                        array('label' => 'Manage Posts', 'url' => array('post/admin')),
                        array('label' => 'Create Post', 'url' => array('post/create')),
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="loader_space"></div>
            <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_view',
            )); ?>

</div>
</section>
</div>