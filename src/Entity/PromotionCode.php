<?php

namespace App\Entity;

use App\Repository\PromotionCodeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PromotionCodeRepository::class)]
class PromotionCode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Length(min: 4, max: 255)]
    #[Assert\NotBlank(message: 'Il faut définir un nom de produit')]
    #[Assert\NotNull(message: 'Il ne faut pas que le nom de produit soit vide')]
    #[ORM\Column(length: 255)]
    private ?string $productName = null;

    #[Assert\DivisibleBy(value: 5, message: 'Le pourcentage doit être un multiple de 5 (exemple: 5, 10, 15, 20).')]
    #[Assert\NotBlank(message: 'Il faut définir un pourcentage')]
    #[Assert\NotNull(message: 'Il ne faut pas que le pourcentage soit vide')]
    #[Assert\Positive(message: 'Il faut que le pourcentage soit positif et non négatif')]
    #[Assert\Range(min: 0, max: 100, notInRangeMessage: 'Vous devez choisir un pourcentage qui soit entre {{ min }}% et {{ max }}%.')]
    #[ORM\Column]
    private ?int $rate = null;

    #[Assert\Length(min: 10, max: 10, exactMessage: 'Le code doit faire exactement 10 caractères.')]
    #[Assert\NotBlank(message: 'Il faut définir un code de promotion')]
    #[Assert\NotNull(message: 'Il ne faut pas que le code de promotion soit vide')]
    #[Assert\Regex(pattern: '/^#/', message: 'Le code doit commencer par un "#".')]
    #[Assert\Regex(pattern: '/[A-Z].*[0-9].*/', message: 'Le code doit contenir des lettres en majuscule et des nombres.')]
    #[ORM\Column(length: 255)]
    private ?string $code = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): static
    {
        $this->productName = $productName;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): static
    {
        $this->rate = $rate;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }
}
