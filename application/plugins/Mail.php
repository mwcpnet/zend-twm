<?php

/**
 * Description of Application_Plugin_Mail
 *
 * @author Sören
 */
class Application_Plugin_Mail extends Zend_Mail {

    protected $language;
    protected $template;
    protected $view;
    protected $layout;
    protected $transport;
    protected $subject;

    function __construct($template) {
        parent::__construct('UTF-8');
        $this->view = new Zend_View();
        $this->view->setScriptPath(APPLICATION_PATH . "/views/mail/");
        $this->view->addHelperPath(APPLICATION_PATH . "/views/helpers/");
        $this->setTemplate($template);

        $this->setFrom("no-reply@polytan-infoarena.de", "Polytan InfoArena");
        $this->setDefaultReplyTo("admin@polytan-infoarena.de", "Polytan InfoArena");
        $this->transport = new Zend_Mail_Transport_Smtp('localhost', array(
            'auth' => 'login',
            'username' => 'no-reply@polytan-infoarena.de',
            'password' => 'M$cky337'
        ));
    }

    public function getLanguage() {
        return $this->language;
    }

    public function setLanguage($language) {
        $this->language = $language;
        $this->assign("language", $language);
    }

    public function getTemplate() {
        return $this->template;
    }

    public function setTemplate($template) {
        $this->template = $template;
    }

    public function assign($spec, $value = NULL) {
        if ($spec == "content") {
            throw new Exception("content is illegal");
        }
        $this->view->assign($spec, $value);
    }

    public function send($transport = null) {
        $translate = Zend_Registry::get("Zend_Translate");
        $locale = $translate->getLocale();

        if ($translate->isAvailable($this->getLanguage())) {
            $translate->setLocale($this->getLanguage());
        } else {
            $translate->setLocale("en");
        }
        //Subject
        parent::setSubject($this->view->translate($this->getSubject()));
        //Html Body
        $this->view->content = $this->view->render($this->getTemplate() . "_html.phtml");
        parent::setBodyHtml($this->view->render("html.phtml"));
        //Text Body
        $this->view->content = $this->view->render($this->getTemplate() . "_text.phtml");
        parent::setBodyText($this->view->render("text.phtml"));

        if (is_null($transport)) {
            $transport = $this->transport;
        }
        $translate->setLocale($locale);
        return parent::send($transport);
    }

    /**
     * Is set automatically
     */
    public function setBodyHtml() {
        
    }

    /**
     * Is set automatically
     */
    public function setBodyText() {
        
    }

    public function __set($name, $value) {
        $this->assign($name, $value);
    }

    /**
     * $email can a Instance of Application_Model_User
     * @param mixed $email
     * @param string $name
     * @return Application_Plugin_Mail
     */
    public function addTo($email, $name = '') {
        if ($email instanceof Application_Model_User) {
            parent::addTo($email->getEmail(), $email->getFirstname() . " " . $email->getLastname());
            $this->setLanguage($email->getLanguage());
            $this->assign("user", $email);
            return $this;
        } else {
            parent::addTo($email, $name);
            return $this;
        }
    }

    public function getSubject() {
        return $this->subject;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

}

?>
