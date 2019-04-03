<?php

namespace Repository;

use Doctrine\ORM\EntityRepository;
use CrEOF\Spatial\PHP\Types\Geography\Point;

class Providers extends EntityRepository
{
    public function search($service = null, $name = null, $limit = 20, $offset = 0)
    {
        $qb = $this->createQueryBuilder('p');
		$params = [];

        if ($service) {
			$qb = $qb->where('service like :service');
			$params['service'] = "%$service%";
		}
		if ($name) {
			$qb = $qb->where('name like :name');
			$params['name'] = "%$name%";
		}

		return $qb->getQuery()->execute($params);
    }
}
