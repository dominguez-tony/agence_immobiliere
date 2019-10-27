<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


class PropertySearch{

/**
 * @var int|null
 * @Assert\Range(min=1000, max=800000)
 */

 private $maxPrince;

/**
 * @var int|null
 * @Assert\Range(min=10, max=400)
 */

private $minSurface;

/**
 * @return int|null
 */
    /**
     * @var ArrayCollection
     */
    private $opt;
    public function __construct()
    {
        $this->opt = new ArrayCollection();
    }


    public function getMaxPrince(): ?int
{
return $this->maxPrince;

}
/**
 * @param int|null $maxPrince
 * @return PropertySearch
 */

public function setMaxPrince(int $maxPrince)
{
 $this->maxPrince = $maxPrince;
 return $this;

}

/**
 * @return int|null
 */

public function getMinSurface(): ?int
{
return $this->minSurface;


}
/**
 * @param int|null $minSurface
 * @return PropertySearch
 */

public function setMinSurface(int $minSurface)
{
 $this->minSurface = $minSurface;
 return $this;

}

    /**
     * @return ArrayCollection
     */
    public function getOpt(): ArrayCollection
    {
        return $this->opt;
    }

    /**
     * @param ArrayCollection $opt
     */
    public function setOpt(ArrayCollection $opt): void
    {
        $this->opt = $opt;
    }
}
