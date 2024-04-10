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
use PHPZlc\Validate\Validate;
use Psr\Container\ContainerInterface;

class SnapshotBusiness extends AbstractBusiness
{

    /**
     * 缓存信息，避免多次查询
     *
     * @var array
     */
    private static array $caches = [];

    /**
     * @var SnapshotRepository
     */
    public SnapshotRepository $snapshotRepository;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->snapshotRepository = $this->em->getRepository('App:Snapshot');
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

        if(array_key_exists($key, self::$caches)){
            unset(self::$caches[$key]);
        }

        return true;
    }

    public function getValue($key, $def = '', $isUse = false)
    {
        if(array_key_exists($key, self::$caches)){
            return self::$caches[$key];
        }

        $snapshot = $this->snapshotRepository->findAssoc(['configKey' => $key]);

        if(empty($snapshot) || Validate::isRealEmpty($snapshot->getConfigValue())){
            self::$caches[$key] = $def;
            return $def;
        }

        $content = $snapshot->getConfigValue();

        self::$caches[$key] = $content;

        return $content;
    }

    public function hasKey($key)
    {
        return !empty($this->snapshotRepository->findOneBy([
            'configKey' => $key
        ]));
    }
}