<div class="main_banner">
    <div class="center_banner">
        <?php
        $result = Yii::app()->db->createCommand()
            ->select('set.*,fund.fundraiser_type')
            ->from('setup_fundraiser as set')
            ->join('fundraiser_type as fund', 'fund.id = set.ftype_id')
            ->where('set.fundraiser_title like :val1 OR set.fundraiser_description like :val2 ', array(':val1' => '%' . $keyword . '%', ':val2' => '%' . $keyword . '%'))
            ->queryAll();
        if (!empty($result)) {
            p($result);
        } else {
            echo "Result not found";
            die;
        }
        ?>
    </div>
</div>
