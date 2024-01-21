<?php

/**
 * This is the model class for table "news_updates".
 *
 * The followings are the available columns in table 'news_updates':
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $content
 * @property string $video_link
 * @property integer $status
 */
class NewsUpdates extends CActiveRecord
{

	public $image_file;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news_updates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, image, content, video_link', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('title, image, video_link,image_file', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, image, content, video_link, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'image' => 'Image',
			'content' => 'Content',
			'video_link' => 'Video Link',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('video_link',$this->video_link,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


    public function uploadImage() {

        try {

            $supporter_image = CUploadedFile::getInstance($this, 'image_file');

            if (!is_object($supporter_image)) {
                $this->addError('image_file', 'No File selected!');
                return FALSE;
            } 

			$file_extension = $supporter_image->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = SUPPORTER_IMAGE_ORIGINAL . $image_name;
			$supporter_image->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(SUPPORTER_IMAGE_THUMBNAIL . SUPPORTER_IMAGE_THUMB_NAME . $image_name);			                 
			$this->image = $image_name;

        } catch (Exception $ex) {

        }
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NewsUpdates the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
