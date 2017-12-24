<?php

namespace AppBundle\Form;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\EntityInterface;

abstract class AbstractForm
{
    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var EntityInterface
     */
    protected $entity;

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * Validation groups
     *
     * @var array
     */
    protected $groups = [];

    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param array $groups
     * @return self
     */
    public function setGroups(array $groups)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * @return self
     */
    public function validate()
    {
        $this->errors = $this->validator->validate($this->entity, null, $this->groups);

        return $this;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return !count($this->errors);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        $messages = [];
        foreach ($this->errors as $error) {
            $messages[$error->getPropertyPath()] = [
                'messages' => [$error->getMessage()]
            ];
        }

        return $messages;
    }

    /**
     * @param EntityInterface $entity
     * @param Request $request
     * @return self
     */
    abstract public function setData(EntityInterface $entity, Request $request);
}
