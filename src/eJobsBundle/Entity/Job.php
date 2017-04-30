<?php

namespace eJobsBundle\Entity;

use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Job
 *
 * @ORM\Table(name="job")
 * @ORM\Entity(repositoryClass="eJobsBundle\Repository\JobRepository")
 */
class Job
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titlu_job", type="string", length=255)
     */
    private $titluJob;

    /**
     * @var string
     *
     * @ORM\Column(name="descriere", type="text")
     */
    private $descriere;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_publicarii", type="datetime")
     */
    private $dataPublicarii;

    /**
     * @var bool
     *
     * @ORM\Column(name="este_activ", type="boolean")
     */
    private $esteActiv;

    /**
     * @ORM\ManyToOne(targetEntity="Oras", inversedBy="jobs")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param Oras $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="jobs")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titluJob
     *
     * @param string $titluJob
     *
     * @return Job
     */
    public function setTitluJob($titluJob)
    {
        $this->titluJob = $titluJob;

        return $this;
    }

    /**
     * Get titluJob
     *
     * @return string
     */
    public function getTitluJob()
    {
        return $this->titluJob;
    }

    /**
     * Set descriere
     *
     * @param string $descriere
     *
     * @return Job
     */
    public function setDescriere($descriere)
    {
        $this->descriere = $descriere;

        return $this;
    }

    /**
     * Get descriere
     *
     * @return string
     */
    public function getDescriere()
    {
        return $this->descriere;
    }

    /**
     * Set dataPublicarii
     *
     * @param \DateTime $dataPublicarii
     *
     * @return Job
     */
    public function setDataPublicarii($dataPublicarii)
    {
        $this->dataPublicarii = $dataPublicarii;

        return $this;
    }

    /**
     * Get dataPublicarii
     *
     * @return \DateTime
     */
    public function getDataPublicarii()
    {
        return $this->dataPublicarii;
    }

    /**
     * Set esteActiv
     *
     * @param boolean $esteActiv
     *
     * @return Job
     */
    public function setEsteActiv($esteActiv)
    {
        $this->esteActiv = $esteActiv;

        return $this;
    }

    /**
     * Get esteActiv
     *
     * @return bool
     */
    public function getEsteActiv()
    {
        return $this->esteActiv;
    }
}

