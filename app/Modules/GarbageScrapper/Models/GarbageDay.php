<?php


namespace App\Modules\GarbageScrapper\Models;


class GarbageDay
{
    private $iconMapping = [
        'Gft & etensresten' => 'sw-gft-groente-fruit-tuinafval.svg',
        'Plastic, blik & drinkpakken' => 'sw-pmd-plastic-metaal-drankverpakking.svg',
        'Papier en karton' => 'sw-papier-en-karton.svg',
    ];

    /**
     * @var string
    */
    private $date;

    /**
     * @var string
     */
    private $title;

    /**
     * @param string $date
     * @return GarbageDay
     */
    public function setDate(string $date): GarbageDay
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $title
     * @return GarbageDay
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    public function getIcon() :? string
    {
        if(isset($this->iconMapping[$this->getTitle()])) {
            return getenv('INZAMEL_KALENDER_ICON_BASE_URL') . $this->iconMapping[$this->getTitle()];
        }

        return null;
    }
}
