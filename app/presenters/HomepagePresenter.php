<?php

namespace App\Presenters;

use Jednoadem\Communications\StreamReader;
use Nette,
    App\Model;
use Nette\Application\UI\Form;


class HomepagePresenter extends BasePresenter
{

    public function renderDefault()
    {
        $this->template->anyVariable = 'any value';
    }

    /**
     * @todo SMAZAT
     */
    public function createComponentXmlForm()
    {
        $form = new Form();
        $form->addTextArea("xml");
        $form->addSubmit("ok", "OK");
        $form->onSuccess[] = $this->XMLFORMSUBMITTED;
        return $form;
    }

    /**
     * @param Form $form
     * @todo SMAZAT
     */
    public function XMLFORMSUBMITTED(Form $form)
    {
        $values = $form->getValues();
        libxml_use_internal_errors(true);
        $doc = new \DOMDocument("1.0", "UTF-8");
        $doc->loadHTML($values->xml);
        $reader = new StreamReader($doc);
        $this->template->reader = $reader;
    }

}
