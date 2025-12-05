<?php

namespace Wolf\Forms\Form;

use Wolf\Core\DependencyInjection\ContainerAwareInterface;
use Wolf\Core\DependencyInjection\ContainerAwareTrait;

class FormManager implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private $forms = [];

    public function register($name, $type)
    {
        $this->forms[$name] = $type;
    }

    public function unregister($name)
    {
        unset($this->forms[$name]);
    }

    public function isRegistered($formName)
    {
        return isset($this->forms[$formName]);
    }

    public function resolve($formName)
    {
        if (!$this->isRegistered($formName)) {
            throw new \RuntimeException("Form " . $formName . " is not registered.");
        }
        
        if ($this->container->has($this->forms[$formName])) {
            $form = $this->container->get($this->forms[$formName]);
        } else if (class_exists($this->forms[$formName])) {
            $form = new $this->forms[$formName]();
        } else {
            throw new \RuntimeException("Form class " . $this->forms[$formName] . " does not exist.");
        }
        return $form;
    }
}
