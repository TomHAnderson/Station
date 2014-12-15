<?php

namespace Db\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\ArraySerializableInterface;

/**
 * ProfileAnswer
 */
class ProfileAnswer implements ArraySerializableInterface
{
    public function __toString()
    {
        return $this->getAnswer();
    }

    public function exchangeArray(array $data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'question_id':
                case 'questionId':
                    $this->setQuestionId($value);
                    break;
                case 'question':
                    $this->setQuestion($value);
                    break;
                case 'answer':
                    $this->setAnswer($value);
                    break;
                default:
                    break;
            }
        }

        return $this;
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->getId(),
            'questionId' => $this->getQuestionId(),
            'question' => $this->getQuestion(),
            'answer' => $this->getAnswer(),
        ];
    }


    /**
     * @var string
     */
    private $question;

    /**
     * @var string
     */
    private $answer;

    /**
     * @var integer
     */
    private $questionId;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Db\Entity\Profile
     */
    private $profile;


    /**
     * Set question
     *
     * @param string $question
     * @return ProfileAnswer
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return ProfileAnswer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set questionId
     *
     * @param integer $questionId
     * @return ProfileAnswer
     */
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;

        return $this;
    }

    /**
     * Get questionId
     *
     * @return integer
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set profile
     *
     * @param \Db\Entity\Profile $profile
     * @return ProfileAnswer
     */
    public function setProfile(\Db\Entity\Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \Db\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
