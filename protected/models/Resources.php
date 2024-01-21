<?php

/**
 * This is the model class for table "resources".
 *
 * The followings are the available columns in table 'resources':
 * @property integer $id
 * @property integer $resource_id
 * @property string $name
 */
class Resources extends CActiveRecord
{
	public $group = null;
	public $group_id = null;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'resources';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('resource_id, name', 'required'),
			array('resource_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, resource_id, name', 'safe', 'on'=>'search'),
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
			'resource_id' => 'Resource ID',
			'name' => 'Name',
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
		$criteria->compare('resource_id',$this->resource_id);
		$criteria->compare('name',$this->name,true);

	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Resources the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Performs operations after loading any row from database. 
     */
    protected function afterFind() {

		// if($this->group_id !=null){

		// 	echo "herere"; exit;

		// 	$this->group = Groups::model()->findByPk($this->group_id);
		// }

        parent::afterFind();
    }

	public function groupCanView($group_id){

		echo "Herere"; 
		echo ">>>>".$group_id; exit;

		$permission = Permissions::model()->find('group_id = :group_id AND resource_id= :resource_id',array('group_id'=> $this->group->id,'resource_id' => $this->resource_id));

		if(is_object($permission)){
			return $permission->can_view;
		}

		return 0;
	}
}
