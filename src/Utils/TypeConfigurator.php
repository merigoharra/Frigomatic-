<?php

// Méthode a utiliser dans les Froms pour faciliter l'ajout de label, placeholder, required et tout autre option grace à la méthode getConfiguration. Celle-ci étend AbstractType pour être utilisé directement en extends dans les formulaires. 

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