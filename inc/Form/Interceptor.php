<?php

namespace Wolf\Forms\Form;

class Interceptor
{

    private $formManager;

    public function __construct(FormManager $formManager)
    {
        $this->formManager = $formManager;
    }

    public function intercept()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wolf_forms_form_id'])) {
            $formId = $_POST['wolf_forms_form_id'];
            $form = $this->formManager->get($formId);

            if ($form) {
                $state = $form->getState();
                $form->validateForm();
                if ($state->isValid() === true) {
                    $state->setSubmitted(true);
                    $form->submitForm();
                }
            }
        }
    }
}
