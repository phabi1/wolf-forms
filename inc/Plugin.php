<?php

namespace Wolf\Forms;

class Plugin
{
    public function bootstrap()
    {
        add_action('init', [$this, 'initFormManager']);
    }

    public function initFormManager()
    {
        $container = \Wolf\Core\DependencyInjection\Container::getInstance();
        $loader = $container->get('wolf-forms.form.manager.loader');
        $loader->load();
    }
}
