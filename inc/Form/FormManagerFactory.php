<?php

namespace Wolf\Forms\Form;

use Wolf\Core\DependencyInjection\Container;

class FormManagerFactory
{
    public static function create(Container $container)
    {
        $loader = $container->get('wolf-forms.form.manager.loader');
        $forms = $loader->load();

        $formManager = new FormManager();
        $formManager->setContainer($container);
        
        foreach ($forms as $name => $type) {
            $formManager->register($name, $type);
        }
        return $formManager;
    }
}
