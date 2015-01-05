<?php

namespace itaw\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Incident
 *
 * @ORM\Table("incident")
 * @ORM\Entity
 */
class Incident
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="occurence", type="datetime")
     */
    private $occurence;

    /**
     * @ORM\ManyToOne(targetEntity="Endpoint", inversedBy="incidents")
     * @ORM\JoinColumn(name="endpoint_id", referencedColumnName="id")
     */
    private $endpoint;

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
     * Set title
     *
     * @param  string   $title
     * @return Incident
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param  string   $description
     * @return Incident
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set occurence
     *
     * @param  \DateTime $occurence
     * @return Incident
     */
    public function setOccurence($occurence)
    {
        $this->occurence = $occurence;

        return $this;
    }

    /**
     * Get occurence
     *
     * @return \DateTime
     */
    public function getOccurence()
    {
        return $this->occurence;
    }

    /**
     * Set endpoint
     *
     * @param  \itaw\DataBundle\Entity\Endpoint $endpoint
     * @return Incident
     */
    public function setEndpoint(\itaw\DataBundle\Entity\Endpoint $endpoint = null)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Get endpoint
     *
     * @return \itaw\DataBundle\Entity\Endpoint
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }
}
