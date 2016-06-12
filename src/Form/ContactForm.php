<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Network\Email\Email;

class ContactForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('name', 'string')
            ->addField('email', ['type' => 'string'])
            ->addField('body', ['type' => 'text']);
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator->notEmpty('name', 'Campo obrigatório');
        $validator->add('name', 'length', ['rule' => ['minLength', 6], 'message' => 'Mínimo de seis caracteres']);

        $validator->notEmpty('email', 'Campo obrigatório');
        $validator->add('email', 'format', ['rule' => 'email', 'message' => 'E-mail inválido']);

        $validator->notEmpty('body', 'Campo obrigatório');

        return $validator;
    }

    protected function _execute(array $data)
    {
        // Send an email.
        $email = new Email('default');
        $email->emailFormat('html');

        $email->template('default')->viewVars(array(
            'name' => $data['name'],
            'email' => $data['email'],
            'body' => $data['body']
        ));

        $email->subject('Formulário de Contato');

        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }
}