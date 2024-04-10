<?php

namespace App\Entity;

use App\Repository\SnapshotRepository;
use Doctrine\ORM\Mapping as ORM;
use PHPZlc\PHPZlc\Doctrine\SortIdGenerator;

#[ORM\Entity(repositoryClass: SnapshotRepository::class)]
#[ORM\Table(name: "snapshot", options:["comment" => "快照表"])]
class Snapshot
{
    #[ORM\Id]
    #[ORM\Column(name: "id", type: "string")]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: SortIdGenerator::class)]
    private ?string $id = null;

    #[ORM\Column(name: "config_key", type: "string", length: 255, unique: true, options: ["comment" => "键"])]
    private ?string $configKey = null;

    #[ORM\Column(name: "config_value", type: "text", nullable:true, options: ["comment" => "值"])]
    private ?string $configValue = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getConfigKey(): ?string
    {
        return $this->configKey;
    }

    public function setConfigKey(string $configKey): self
    {
        $this->configKey = $configKey;

        return $this;
    }

    public function getConfigValue(): ?string
    {
        return $this->configValue;
    }

    public function setConfigValue(?string $configValue): self
    {
        $this->configValue = $configValue;

        return $this;
    }
}
