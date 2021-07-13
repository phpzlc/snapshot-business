<?php

namespace App\Repository;

use App\Entity\Snapshot;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use PHPZlc\PHPZlc\Doctrine\ORM\Repository\AbstractServiceEntityRepository;
use PHPZlc\PHPZlc\Doctrine\ORM\Rule\Rule;
use PHPZlc\PHPZlc\Doctrine\ORM\Rule\Rules;
use PHPZlc\Validate\Validate;

/**
 * @method Snapshot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Snapshot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Snapshot|null    findAssoc($rules = null, ResultSetMappingBuilder $resultSetMappingBuilder = null, $aliasChain = '')
 * @method Snapshot|null   findLastAssoc($rules = null, ResultSetMappingBuilder $resultSetMappingBuilder = null, $aliasChain = '')
 * @method Snapshot|null    findAssocById($id, $rules = null, ResultSetMappingBuilder $resultSetMappingBuilder = null, $aliasChain = '')
 * @method Snapshot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Snapshot[]    findAll($rules = null, ResultSetMappingBuilder $resultSetMappingBuilder = null, $aliasChain = '')
 * @method Snapshot[]    findLimitAll($rows, $page = 1, $rules = null, ResultSetMappingBuilder $resultSetMappingBuilder = null, $aliasChain = '')
 */
class SnapshotRepository extends AbstractServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Snapshot::class);
    }

    public function registerRules()
    {
        // TODO: Implement registerRules() method.
    }

    public function ruleRewrite(Rule $currentRule, Rules $rules, ResultSetMappingBuilder $resultSetMappingBuilder)
    {
        // TODO: Implement ruleRewrite() method.
    }
}
