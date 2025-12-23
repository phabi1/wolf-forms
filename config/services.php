<?php

return [
    'wolf-forms.form.manager' => [
        'factory' => [
            \Wolf\Forms\Form\FormManagerFactory::class,
            'create',
        ]
    ],
    'wolf-forms.form.manager.loader' => \Wolf\Forms\Form\Loader::class,
    'wolf-forms.form.interceptor' => [
        'class' => \Wolf\Forms\Form\Interceptor::class,
        'arguments' => [
            '@wolf-forms.form.manager'
        ],
    ]
];
