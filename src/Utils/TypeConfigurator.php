<?php

namespace App\Utils;

use Symfony\Component\Form\AbstractType;

class TypeConfigurator  extends AbstractType {

    public function getConfiguration($label, $placeholder){
        return [
            'label' => $label,
                'attr' => [
                    'placeholder' => $placeholder
                    ]
                ];
    }

}

