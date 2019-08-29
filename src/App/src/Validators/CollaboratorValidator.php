<?php


namespace App\Validators;


use Psr\Http\Message\ServerRequestInterface;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class CollaboratorValidator
{
    public $messages;
    private $name;
    private $lastname;
    private $email;
    private $password;
    private $phone;
    /**
     * @var InputFilter
     */
    private $inputFilter;

    public function __construct()
    {
        $this->name = new Input("name");
        $this->name->getValidatorChain()
            ->attach(new NotEmpty());

        $this->lastname = new Input("lastname");
        $this->lastname->getValidatorChain()
            ->attach(new NotEmpty());

        $this->email = new Input("email");
        $this->email->getValidatorChain()
            ->attach(new NotEmpty())
            ->attach(new EmailAddress());

        $this->password = new Input("password");
        $this->password->getValidatorChain()
            ->attach(new NotEmpty())
            ->attach(new StringLength(["min" => 5, "max" => 15]));

        $this->phone = new Input("phone");
        $this->phone->getValidatorChain()
            ->attach(new StringLength(["min" => 10, "max" => 10]));

    }

    public function validate(ServerRequestInterface $request): bool
    {
        $this->inputFilter = new InputFilter();

        $this->inputFilter->add($this->name);
        $this->inputFilter->add($this->lastname);
        $this->inputFilter->add($this->email);
        $this->inputFilter->add($this->password);
        $this->inputFilter->add($this->phone);

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