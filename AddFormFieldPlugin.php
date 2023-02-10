<?php

namespace APP\plugins\generic\addFormField;

use PKP\components\forms\FieldOptions;
use PKP\plugins\GenericPlugin;
use PKP\plugins\Hook;

class AddFormFieldPlugin extends GenericPlugin
{

    public function register($category, $path, $mainContextId = NULL)
    {


        $success = parent::register($category, $path);

        if ($success && $this->getEnabled()) {

            Hook::add('Form::config::before', [$this, 'addAdditionalFormFields']);

        }
        return $success;
    }

    function addAdditionalFormFields($hookName, $form): bool

    {

        if (!$form instanceof \PKP\components\forms\publication\ContributorForm) return Hook::CONTINUE;

        $form->addField(new FieldOptions('extraFieldAuthor', [
            'label' => __('plugins.generic.addFormField.field1.title'),
            'options' => [
                [
                    'value' => true,
                    'label' => __('plugins.generic.addFormField.field1.option1')
                ]
            ]
        ]));
        return Hook::CONTINUE;
    }


    public function getDisplayName()
    {
        return __('plugins.generic.addFormField.displayName');
    }


    public function getDescription()
    {
        return __('plugins.generic.addFormField.description');
    }
}
