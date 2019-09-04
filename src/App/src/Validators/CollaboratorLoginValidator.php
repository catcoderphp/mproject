<?php


namespace App\Validators;


use Psr\Http\Message\ServerRequestInterface;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class CollaboratorLoginValidator
{
    public $email;
    public $passwd;
    public $messages;
    private $inputFilter;

    public function __construct()
    {
        $this->email = new Input("email");
        $this->email->getValidatorChain()
            ->attach(new EmailAddress())
            ->attach(new NotEmpty());

        $this->passwd = new Input("password");
        $this->passwd->getValidatorChain()
            ->attach(new NotEmpty())
            ->attach(new StringLength(["min" => 5]));
    }

    public function validate(ServerRequestInterface $request): bool
    {
        $this->inputFilter = new InputFilter();

        $this->inputFilter->add($this->email);
        $this->inputFilter->add($this->passwd);

        $this->inputFilter->setData($request->getParsedBody());

        if (!$this->inputFilter->isValid()) {

            return $this->errorMessages($this->inputFilter);
        }

        return true;
    }

    public function errorMessages(InputFilter $inputFilter): bool
    {
        $this->messages["error"] = true;
        foreach ($inputFilter->getInvalidInput() as $error) {
            $this->messages[$error->getName()][] = $error->getMessages();
        }

        return false;
    }
}