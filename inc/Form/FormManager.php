<?php

namespace Wolf\Forms\Form;

use Wolf\Core\DependencyInjection\ContainerAwareInterface;
use Wolf\Core\DependencyInjection\ContainerAwareTrait;

class FormManager implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private $forms = [];
    private $instances = [];

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

    public function get($formName)
    {
        if (array_key_exists($formName, $this->instances) === true) {
            return $this->instances[$formName];
        }

        $instance = $this->resolve($formName);

        $state = new FormState();
        $state->setValues($_POST);
        $instance->setState($state);

  

        $this->instances[$formName] = $instance;

        return $instance;
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
