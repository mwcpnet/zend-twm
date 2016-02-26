<?php

class Twitter_Bootstrap_Form_Decorator_Label extends Zend_Form_Decorator_Label {

    public function render($content) {
        if ($this->getElement() instanceof Zend_Form_Element_Checkbox) {
            $this->_placement = self::IMPLICIT_APPEND;
            $class = $this->getOption('class');
            //$this->setOption('class', $class ? $class . ' option option-primary' : 'option option-primary');
        }
        return parent::render($content);
    }

}
