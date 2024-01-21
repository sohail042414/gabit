<div class="col-sm-12">
    <section class="content-header">
        <h1>
            Error <?php echo $error['code']; ?>
        </h1>
        <?php
        $this->breadcrumbs = array(
            Yii::t('app', 'Error ' . $error['code']),
        );


        $this->widget('CoreCBreadcrumbs', array(
            'links' => $this->breadcrumbs,
            'htmlOptions' => array('class' => 'breadcrumb')
        ));

        ?>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-body">
                            <div class="error-content">
                                <p>
                                    <?php echo $error['message']; ?>
                                    Meanwhile, you may <a
                                        href='<?php echo $this->createUrl('dashboard/index'); ?>'>return
                                        to
                                        dashboard</a>
                                </p>
                            </div>
                        </div>
                    </header>
                </section>
            </div>
        </div>
    </section>
</div>
