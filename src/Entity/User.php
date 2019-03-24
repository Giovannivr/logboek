<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Logboek", mappedBy="userid")
     */
    private $logboekusers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Logboek", mappedBy="chauffeurId")
     */
    private $logboekchauffeur;

    public function __construct()
    {
        parent::__construct();
        $this->logboekusers = new ArrayCollection();
        $this->logboekchauffeur = new ArrayCollection();
        // your own logic
    }

    /**
     * @return Collection|Logboek[]
     */
    public function getLogboekusers(): Collection
    {
        return $this->logboekusers;
    }

    public function addLogboekuser(Logboek $logboekuser): self
    {
        if (!$this->logboekusers->contains($logboekuser)) {
            $this->logboekusers[] = $logboekuser;
            $logboekuser->setUserid($this);
        }

        return $this;
    }

    public function removeLogboekuser(Logboek $logboekuser): self
    {
        if ($this->logboekusers->contains($logboekuser)) {
            $this->logboekusers->removeElement($logboekuser);
            // set the owning side to null (unless already changed)
            if ($logboekuser->getUserid() === $this) {
                $logboekuser->setUserid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Logboek[]
     */
    public function getLogboekchauffeur(): Collection
    {
        return $this->logboekchauffeur;
    }

    public function addLogboekchauffeur(Logboek $logboekchauffeur): self
    {
        if (!$this->logboekchauffeur->contains($logboekchauffeur)) {
            $this->logboekchauffeur[] = $logboekchauffeur;
            $logboekchauffeur->setChauffeurId($this);
        }

        return $this;
    }

    public function removeLogboekchauffeur(Logboek $logboekchauffeur): self
    {
        if ($this->logboekchauffeur->contains($logboekchauffeur)) {
            $this->logboekchauffeur->removeElement($logboekchauffeur);
            // set the owning side to null (unless already changed)
            if ($logboekchauffeur->getChauffeurId() === $this) {
                $logboekchauffeur->setChauffeurId(null);
            }
        }

        return $this;
    }
}
