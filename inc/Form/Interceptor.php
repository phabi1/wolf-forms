<?php

namespace Wolf\Forms\Form;

use Wolf\Core\DependencyInjection\ContainerAwareInterface;
use Wolf\Core\DependencyInjection\ContainerAwareTrait;

class Interceptor implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private $formManager;

    public function getFormManager()
    {
        if (!$this->formManager) {
            $this->formManager = $this->container->get('wolf-forms.form_manager');
        }
        return $this->formManager;
    }

    public function intercept()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wolf_forms_form_id'])) {
            $formId = $_POST['wolf_forms_form_id'];
            $form = $this->getFormManager()->resolve($formId);
            if ($form) {
                
                $data = $_POST;
                unset($data['wolf_forms_form_id']);

                $result = $form->validateForm($data);
                if ($result->valid === true) {
                    return $form->submitForm($data);
                }
            }
        }
    }
}
