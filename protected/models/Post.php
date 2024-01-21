<?php

Yii::import('application.models._base.BasePost');

class Post extends BasePost
{

    const STATUS_DRAFT = 1;
    const STATUS_PUBLISHED = 2;
    const STATUS_ARCHIVED = 3;
    private $_oldTags;
    public $search_field;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function relations()
    {
        return array(
            'comments' => array(self::HAS_MANY, 'Comment', 'post_id', 'condition' => 'status=' . Comment::STATUS_APPROVED),
            'author' => array(self::BELONGS_TO, 'Users', 'author_id'),
            'commentCount' => array(self::STAT, 'Comment', 'post_id', 'condition' => 'status=' . Comment::STATUS_APPROVED),
        );
    }

    /**
     * @return string the URL that shows the detail of the post
     */
    public function getUrl()
    {
        return Yii::app()->createUrl('/blog/view', array(
            'id' => $this->id,
            'title' => $this->title,
        ));
    }

    /**
     * @return string the URL that shows the detail of the post
     */
    public function getShareThisUrl()
    {
        return Yii::app()->createAbsoluteUrl('blog/view', array(
            'id' => $this->id,
            'title' => $this->title,
        ));
    }


    /**
     * @return array a list of links that point to the post list filtered by every tag of this post
     */
    public function getTagLinks()
    {
        $links = array();
        foreach (Tag::string2array($this->tags) as $tag)
            $links[] = CHtml::link(CHtml::encode($tag), array('blog/index', 'tag' => $tag));
        return $links;
    }

    /**
     * Normalizes the user-entered tags.
     */
    public function normalizeTags($attribute, $params)
    {
        $this->tags = Tag::array2string(array_unique(Tag::string2array($this->tags)));
    }

    /**
     * Adds a new comment to this post.
     * This method will set status and post_id of the comment accordingly.
     * @param Comment the comment to be added
     * @return boolean whether the comment is saved successfully
     */
    public function addComment($comment)
    {
        if (Yii::app()->params['commentNeedApproval'])
            $comment->status = Comment::STATUS_PENDING;
        else
            $comment->status = Comment::STATUS_PENDING;
        $comment->post_id = $this->id;
        return $comment->save(false);
    }

    /**
     * This is invoked when a record is populated with data from a find() call.
     */
    protected function afterFind()
    {
        parent::afterFind();
        $this->_oldTags = $this->tags;
    }

    /**
     * This is invoked after the record is saved.
     */
    protected function afterSave()
    {
        parent::afterSave();
        Tag::model()->updateFrequency($this->_oldTags, $this->tags);
    }

    /**
     * This is invoked after the record is deleted.
     */
    protected function afterDelete()
    {
        parent::afterDelete();
        Comment::model()->deleteAll('post_id=' . $this->id);
        Tag::model()->updateFrequency($this->tags, '');
    }

    /**
     * Retrieves the list of posts based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the needed posts.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('title', $this->title, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('tags', $this->tags, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('author_id', $this->author_id);

        $criteria->compare('status', $this->status);

        return new CActiveDataProvider('Post', array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'status, update_time DESC',
            ),
        ));
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->create_time = new CDbExpression('NOW()');
        } else {
            $this->update_time = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }


}