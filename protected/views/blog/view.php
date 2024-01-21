<style type="text/css">
    h3 {
        float: left;
        width: 100%;
        text-align: left;
        margin-bottom: 20px;
    }

    .row {
        width: 100%;
        float: left;
        margin-bottom: 10px;
    }

    #comment-form .row label {
        width: 120px !important;
        float: left;
        line-height: 30px;
        font-weight: normal;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        text-align: left;
    }

    #comment-form .row label span.required {
        width: auto;
        color: red;
        float: none !important;
    }

    #comment-form .row input {
        width: 270px;
        height: 30px;
        float: left;
        line-height: 30px;
        font-weight: normal;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        text-align: left;
        border: #CCC 1px solid;
    }

    #comment-form .row textarea {
        width: 270px;
        height: 70px;
        float: left;
        line-height: 30px;
        font-weight: normal;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        text-align: left;
        border: #CCC 1px solid;
    }

    #comment-form .buttons input {
        background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #959595 0%, #000000 0%, #4e4e4e 8%, #4e4e4e 16%, #0d0d0d 50%, #4e4e4e 83%, #4e4e4e 91%, #1b1b1b 100%) repeat scroll 0 0 !important;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #959595), color-stop(0%, #000000), color-stop(8%, #4e4e4e), color-stop(16%, #4e4e4e), color-stop(50%, #0d0d0d), color-stop(83%, #4e4e4e), color-stop(91%, #4e4e4e), color-stop(100%, #1b1b1b)) !important;
        /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #959595 0%, #000000 0%, #4e4e4e 8%, #4e4e4e 16%, #0d0d0d 50%, #4e4e4e 83%, #4e4e4e 91%, #1b1b1b 100%) !important;
        /* Chrome10+,Safari5.1+ */
        border: medium none;
        color: #fff;
        cursor: pointer;
        font-size: 13px;
        font-weight: normal;
        height: 37px;
        line-height: 35px;
        margin-left: 120px;
        padding: 0 20px;
        text-align: center;
        width: auto;
        border-radius: 5px !important;
    }

    #comment-form .buttons input:hover {
        background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0 !important;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ee1023), color-stop(100%, #9c0405)) !important;
        /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #ee1023 0%, #9c0405 100%) !important;
        /* Chrome10+,Safari5.1+ */
    }

    #comment-form .errorMessage {
        color: red;
        float: left;
        font-size: 12px;
        line-height: 22px;
        margin-left: 120px;
        text-align: left;
        width: 100%;
    }

    .form {
        margin-bottom: 40px;
        float: left;
    }

    .flash-success {
        width: 100%;
        float: left;
        text-align: left;
        color: green;
        margin-bottom: 30px;
        line-height: 22px;
    }

    @media only screen and (max-width: 479px) {
        #comment-form .buttons input {
            margin-left: 0px;
        }

        #comment-form .errorMessage {
            margin-left: 0px;
        }
    }
</style>
<style type="text/css">
        .f-team{border-top:none; padding-left:0px !important;}
        #sidebar h4.teg4-h4 {
            margin-bottom: 10px;
        }
    </style>

<?php $this->renderPartial('/layouts/cms_banner'); ?>
<!----Hererere--->
<div class="inner-container">
    <div class="inner-left">
        <div class="inner-page">
            <?php
            $this->breadcrumbs = array(
                $model->title,
            );
            $this->pageTitle = $model->title;
            ?>

            <?php $this->renderPartial('_view', array(
                'data' => $model,
            )); ?>


            <div id="comments">
                <?php if ($model->commentCount >= 1) : ?>
                    <h3>
                        <?php echo $model->commentCount > 1 ? $model->commentCount . ' comments' : 'One comment'; ?>
                    </h3>
                    <?php
                    $this->renderPartial('_comments', array(
                        'post' => $model,
                        'comments' => $model->comments,
                    )); ?>
                <?php endif; ?>

                <h3>Leave a Comment</h3>

                <?php if (Yii::app()->user->hasFlash('commentSubmitted')) : ?>
                    <div class="flash-success">
                        <?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
                    </div>
                <?php else : ?>
                    <?php $this->renderPartial('_comment_form', array(
                        'model' => $comment,
                    )); ?>
                <?php endif; ?>
            </div><!-- comments -->
        </div>
    </div>

    <?php $this->renderPartial('/layouts/cms_sidebar'); ?>

</div>
<!----End Hererere--->