<?php

Yii::import('application.models._base.BaseComment');

class Comment extends BaseComment
{
    const STATUS_PENDING=1;
    const STATUS_APPROVED=2;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    /**
     * Approves a comment.
     */
    public function approve()
    {
        $this->status=Comment::STATUS_APPROVED;
        $this->update();
    }

    /**
     * @param Post the post that this comment belongs to. If null, the method
     * will query for the post.
     * @return string the permalink URL for this comment
     */
    public function getUrl($post=null)
    {
        if($post===null)
            $post=$this->post;
        return $post->url.'#c'.$this->id;
    }

    /**
     * @return string the hyperlink display for the current comment's author
     */
    public function getAuthorLink()
    {
        if(!empty($this->url))
            return CHtml::link(CHtml::encode($this->author),$this->url);
        else
            return CHtml::encode($this->author);
    }

    /**
     * @return integer the number of comments that are pending approval
     */
    public function getPendingCommentCount()
    {
        return $this->count('status='.self::STATUS_PENDING);
    }

    /**
     * @param integer the maximum number of comments that should be returned
     * @return array the most recently added comments
     */
    public function findRecentComments($limit=10)
    {
        return $this->with('post')->findAll(array(
            'condition'=>'t.status='.self::STATUS_APPROVED,
            'order'=>'t.created_date DESC',
            'limit'=>$limit,
        ));
    }
}