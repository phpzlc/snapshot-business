<?php
/**
 * 快照表
 *
 * Created by Trick
 * user: Trick
 * Date: 2021/7/13
 * Time: 8:57 下午
 */

namespace App\Business\SnapshotBusiness;

use App\Entity\Snapshot;
use App\Repository\SnapshotRepository;
use PHPZlc\PHPZlc\Bundle\Business\AbstractBusiness;
use Psr\Container\ContainerInterface;

class SnapshotBusiness extends AbstractBusiness
{
    /**
     * @var SnapshotRepository
     */
    public $snapshotRepository;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->snapshotRepository = $this->getDoctrine()->getRepository('App:Snapshot');
    }

    public function setValue($key, $value)
    {
        $snapshot = $this->snapshotRepository->findOneBy(['configKey' => $key]);

        if(empty($snapshot)){
            $snapshot = new Snapshot();
            $snapshot->setConfigKey($key);
            $snapshot->setConfigValue($value);

            $this->em->persist($snapshot);
        }else{
            $snapshot->setConfigValue($value);
        }

        $this->em->flush();
    }

    public function getValue($key, $def = '')
    {
        $snapshot = $this->snapshotRepository->findOneBy(['configKey' => $key]);

        if(empty($snapshot) || empty($snapshot->getConfigValue())){
            return $def;
        }

        return $snapshot->getConfigValue();
    }

    public function hasKey($key)
    {
        return !empty($this->snapshotRepository->findOneBy([
            'configKey' => $key
        ]));
    }
}
