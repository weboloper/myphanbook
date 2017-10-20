<?php
/**
 * Phanbook : Delightfully simple forum software
 *
 * Licensed under The BSD License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link    http://phanbook.com Phanbook Project
 * @since   1.0.0
 * @license https://github.com/phanbook/phanbook/blob/master/LICENSE.txt
 */
namespace Phanbook\Oauth\Forms;

use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\StringLength;

class SignupForm extends Form
{
    public function initialize()
    {
        // First name
        $firstName = new Text(
            'firstname',
            [
                'placeholder' => 'Firstname',
                'required' => 'true',
                'autofocus' => 'true',
                'class' => 'text-box'
            ]
        );
        $firstName->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'Firstname is required.'
                    ]
                )
            ]
        );
        $this->add($firstName);

        // Last name
        $lastName = new Text(
            'lastname',
            [
                'placeholder' => 'Lastname',
                'autofocus' => 'true'
            ]
        );

        $this->add($lastName);

        // User name
        $username = new Text(
            'username',
            [
                'placeholder' => t('Username'),
                'required' => 'true',
                'autofocus' => 'true',
                'class' => 'text-box'
            ]
        );
        $username->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => t('Username is required.')
                    ]
                )
            ]
        );
        $this->add($username);

        // Email
        $email = new Text(
            'email',
            [
                'placeholder' => 'Email',
                'required' => 'true',
                'class' => 'text-box'
            ]
        );
        $email->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'The e-mail is required'
                    ]
                ),
                new Email(
                    [
                        'message' => 'The e-mail is not valid'
                    ]
                )
            ]
        );
        $this->add($email);

        //New password
        $passwd = new Password(
            'passwd',
            array(
            'placeholder'  => t('New password'),
            'class'        => 'form-control',
            'autocomplete' => 'off'
            )
        );

        $passwd->addValidators(
            array(
                new PresenceOf(
                    array(
                    'message' => t('Password is required')
                    )
                ),
                new StringLength(
                    array(
                    'min'            => 5,
                    'messageMinimum' => t('Password is too short. Minimum 5 characters')
                    )
                ),
                new Confirmation(
                    array(
                    'message' => t("Password doesn't match confirmation"),
                    'with'    => 'passwd_confirm'
                    )
                )
            )
        );

        $this->add($passwd);

        //Confirm New Password
        $passwdConfirm = new Password(
            'passwd_confirm',
            array(
            'placeholder'  => t('Confirm new password'),
            'class'        => 'form-control',
            'autocomplete' => 'off'
            )
        );

        $passwdConfirm->addValidator(
            new PresenceOf(
                array(
                'message' => t('The confirmation password is required')
                )
            )
        );

        $this->add($passwdConfirm);






        // Remember me
        $terms = new Check(
            'terms',
            [
                'value' => 'yes',
                'checked' => 'checked'
            ]
        );
        $this->add($terms);

        // Submit
        $this->add(
            new Submit(
                'submit',
                [
                    'value' => 'Register'
                ]
            )
        );
    }
}
