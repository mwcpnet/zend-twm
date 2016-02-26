<?php

/**
 * Form decorator definition
 *
 * @category Forms
 * @package Twitter_Bootstrap_Form
 * @subpackage Decorator
 * @author Christian Soronellas <csoronellas@emagister.com>
 */

/**
 * Defines a decorator to wrap all the Bootstrap form elements
 *
 * @category Forms
 * @package Twitter_Bootstrap_Form
 * @subpackage Decorator
 * @author Christian Soronellas <csoronellas@emagister.com>
 */
class Twitter_Bootstrap_Form_Decorator_Wrapper extends Zend_Form_Decorator_Abstract {

    /**
     * Renders a form element decorating it with the Twitter's Bootstrap markup
     *
     * @param $content
     *
     * @return string
     */
    public function render($content) {
        $hasErrors = $this->getElement()->hasErrors();

        if ($this->getElement() instanceof Zend_Form_Element_Checkbox) {
            return '<div class="form-group"><div class="checkbox' . (($hasErrors) ? ' has-error' : '') . '">' . $content . '</div></div>';
        } elseif ($this->getElement() instanceof Zend_Form_Element_File) {
            return '<div class="form-group"><div class="field prepend-icon file' . (($hasErrors) ? ' has-error' : '') . '">' . $content . '</div></div>';
        } else {
            return '<div class="form-group' . (($hasErrors) ? ' has-error' : '') . '">' . "\n" . $content . "\n" . '</div>';
        }
    }

}
