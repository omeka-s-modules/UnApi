<?php
namespace UnApi\Form;

use Laminas\Form\Element\Checkbox;
use Laminas\Form\Form;

class ConfigForm extends Form
{
    public function init()
    {
        $this->add([
            'name' => 'unapi_public_server',
            'type' => Checkbox::class,
            'options' => [
                'label' => 'Open the unAPI server to public', // @translate
            ],
        ]);
    }
}
