<div class="inner-container">
        <div class="inner-page">
            <?php
            foreach ($comments as $comment): ?>
                <div class="comment" id="c<?php echo $comment->id; ?>">

<!--                    echo CHtml::link("#{$comment->id}", $comment->getUrl($post), array( -->
                    <?php echo CHtml::link("", $comment->getUrl($post), array(
                        'class' => 'cid',
                        'title' => 'Permalink to this comment',
                    )); ?>

                    <div class="author">
                        <?php echo $comment->authorLink; ?> says:
                    </div>

                    <div class="time">
                        <?php echo date('F j, Y \a\t h:i a', strtotime($comment->created_date));?>
                    </div>

                    <div class="content">
                        <p><?php echo nl2br(CHtml::encode($comment->content)); ?></p>
                    </div>

                </div><!-- comment -->
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>