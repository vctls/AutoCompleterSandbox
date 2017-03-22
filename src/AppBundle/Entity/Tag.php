<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\AutocompleterBundle\Form\Transformer\TransformableInterface as Transformable;

/**
 * Class Tag
 * @package AppBundle\Entity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TagRepository")
 */
class Tag implements Transformable
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @return int
     */
    public function getId() :int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString() :string
    {
        return $this->name;
    }
}