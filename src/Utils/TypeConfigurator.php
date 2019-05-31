<?php

namespace App\Utils;

use Symfony\Component\Form\AbstractType;

class TypeConfigurator  extends AbstractType {

    public function getConfiguration($label, $placeholder, $require = true){
        return [
            'label' => $label,
            'required' => $require,
                'attr' => [
                    'placeholder' => $placeholder
                    ]
                ];
    }

}

