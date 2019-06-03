<?php

namespace App\Utils;

use Symfony\Component\Form\AbstractType;

class TypeConfigurator  extends AbstractType {

    /**
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     */
    public function getConfiguration($label, $placeholder, $require = true, $options =[]){
        return array_merge([
            'label' => $label,
            'required' => $require,
                'attr' => [
                    'placeholder' => $placeholder
                    ]
                ], 
                $options);
    }

}