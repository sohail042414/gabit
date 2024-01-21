<?php

class CoreGxActiveForm extends CActiveForm
{
    public $attributesClass = 'form-control';

    public function checkBoxList($model, $attribute, $data, $htmlOptions = array())
    {
        return GxHtml::activeCheckBoxList($model, $attribute, $data, $htmlOptions);
    }

    public function textField($model, $attribute, $htmlOptions = array())
    {
        if (!empty($htmlOptions['class'])) {
            // append class in existing class
            $htmlOptions['class'] = $htmlOptions['class'] . ' ' . $this->attributesClass;
        } else {
            // add new class
            $htmlOptions['class'] = $this->attributesClass;
        }

        return CHtml::activeTextField($model, $attribute, $htmlOptions);
    }

    public function dropDownList($model, $attribute, $data, $htmlOptions = array())
    {
        if (!empty($htmlOptions['class'])) {
            // append class in existing class
            $htmlOptions['class'] = $htmlOptions['class'] . ' ' . $this->attributesClass;
        } else {
            // add new class
            $htmlOptions['class'] = $this->attributesClass;
        }

        return CHtml::activeDropDownList($model, $attribute, $data, $htmlOptions);
    }

    public function textArea($model, $attribute, $htmlOptions = array())
    {

        if (!empty($htmlOptions['class'])) {
            // append class in existing class
            $htmlOptions['class'] = $htmlOptions['class'] . ' ' . $this->attributesClass;
        } else {
            // add new class
            $htmlOptions['class'] = $this->attributesClass;
        }


        return CHtml::activeTextArea($model, $attribute, $htmlOptions);
    }

    public function passwordField($model, $attribute, $htmlOptions = array())
    {
        if (!empty($htmlOptions['class'])) {
            // append class in existing class
            $htmlOptions['class'] = $htmlOptions['class'] . ' ' . $this->attributesClass;
        } else {
            // add new class
            $htmlOptions['class'] = $this->attributesClass;
        }

        return CHtml::activePasswordField($model, $attribute, $htmlOptions);
    }

    public function fileField($model, $attribute, $htmlOptions = array())
    {
        return CHtml::activeFileField($model, $attribute, $htmlOptions);
    }

}

?>