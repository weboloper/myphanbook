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
namespace Phanbook\Frontend\Forms;

use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;

class ReplyForm extends Form
{
    public function initialize($entity = null)
    {
        // In edit page the id is hidden
        if (!is_null($entity)) {
            $this->add(new Hidden('id'));
        }
        //content
        $content = new Textarea(
            'content',
            array(
            'placeholder' => t('Please be sure to answer the question. Provide details and share your research!'),
            'class'       => 'form-control',
            'required'    => true,
            'rows'  =>8

            )
        );
        $content->addValidator(
            new PresenceOf(
                array(
                'message' => t('content is required.')
                )
            )
        );
        $this->add($content);

        $this->add(new Hidden('idObject'));
        $this->add(new Hidden('object'));

        $csrf = new Hidden('csrf');
        $csrf->addValidator(
            new Identical(
                array(
                'value'   => $this->security->getSessionToken(),
                'message' => t('CSRF validation failed')
                )
            )
        );
        $this->add($csrf);

        //Submit
        $this->add(
            new Submit(
                'postAnswer',
                [
                'value' => t('Post Your Comment'),
                'class' => 'btn btn-sm btn-info'
                ]
            )
        );
    }
}
