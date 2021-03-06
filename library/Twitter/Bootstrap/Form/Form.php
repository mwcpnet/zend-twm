<?php
/**
 * Form definition
 *
 * @category Forms
 * @package Twitter_Bootstrap
 * @subpackage Form
 * @author Christian Soronellas <csoronellas@emagister.com>
 */

/**
 * An "horizontal" Twitter Bootstrap's UI form
 *
 * @category Forms
 * @package Twitter_Bootstrap
 * @subpackage Form
 * @author Christian Soronellas <csoronellas@emagister.com>
 */
class Twitter_Bootstrap_Form_Form extends Twitter_Bootstrap_Form
{
    public function __construct($options = null)
    {
        $this->_initializePrefixes();
        
        $this->setDisposition(self::DISPOSITION_FORM);

        $this->setElementDecorators(array(
            array('FieldSize'),
            array('ViewHelper'),
            array('Addon'),
            array('ElementErrors', array('tag' => 'span', 'class' => 'has-error')),
            array('Description', array('tag' => 'p', 'class' => 'help-block')),
            //array('HtmlTag', array('tag' => 'dd')),
            array('Label', array()),
            array('Wrapper')
        ));
        
        parent::__construct($options);
    }
}
