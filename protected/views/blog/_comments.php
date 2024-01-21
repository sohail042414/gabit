<div class="inner-container">
    <div class="inner-page" style="width:70%;">
        <?php foreach ($comments as $comment): ?>
            <div class="comment" id="c<?php echo $comment->id; ?>">

                <?php echo CHtml::link("", $comment->getUrl($post), array(
                    'class' => 'cid',
                    'title' => 'Permalink to this comment',
                )); ?>

                <div class="author">
                    <?php echo $comment->authorLink; ?> says:
                </div>

                <div class="time">
                    <?php echo date('F j, Y \a\t h:i a', strtotime($comment->created_date));?>
                    <?php //echo date('d-m-Y h:i:s', strtotime($comment->created_date));?>
                </div>

                <div class="content">
                    <p><?php echo nl2br(CHtml::encode($comment->content)); ?></p>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>