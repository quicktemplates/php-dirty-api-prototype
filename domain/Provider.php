<?php

namespace Domain;

use JsonSerializable;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;

/**
 * @Entity(repositoryClass="Repository\Providers")
 * @Table(name="providers")
 */
class Provider implements JsonSerializable
{
	/**
	 * @Id
	 * @GeneratedValue(strategy="AUTO")
	 * @Column(type="integer")
	 */
	private $id;
	/**
	 * @Column(type="json")
	 */
	private $contact;
	/**
	 * @Column(type="json")
	 */
	private $service;

	public function __construct(
		array $contact = null,
		array $service = null,
		int $id = null
	) {
		$this->contact = $contact;
		$this->service = $service;
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}


	public function getContact()
	{
		return $this->contact;
	}

	public function setContact($newContact)
	{
		$this->contact = $newContact;
	}


	public function getService()
	{
		return $this->service;
	}

	public function setService($newService)
	{
		$this->service = $newService;
	}

    
	public function jsonSerialize()
	{
		return [
			'id' => $this->getId(),
			'contact' => $this->getContact(),
			'service' => $this->getService()
		];
	}
}
