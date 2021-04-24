<?php


namespace App\Modules\GarbageScrapper;


use App\Modules\GarbageScrapper\Models\GarbageDay;
use Goutte\Client;

class Scrapper
{

    /**
     * @var Client
     */
    private $client;
    /**
     * @var GarbageDay
     */
    private $garbageDay;

    /** @var string */
    private $postcode, $houseNumber;

    public function __construct(Client $client, GarbageDay $garbageDay)
    {

        $this->client = $client;
        $this->garbageDay = $garbageDay;
    }

    /**
     * @return array |  GarbageDay[]
     */
    public function scrapComingUp() : array
    {
        $crawler = $this->client->request('GET', $this->_getUrl());

        $dates = $crawler->filter('#ophaaldata > li')->each(function ($node) {
            $item = array_filter(preg_split("/\r\n|\n|\r/", $node->text()), function($item) {
                return strlen(trim($item)) > 0;
            });

            reset($item);

            if(count($item) > 0) {
                $item = array_values($item);

                $garbageDay = clone $this->garbageDay;
                $garbageDay->setDate(trim($item[0]));
                $garbageDay->setTitle(trim($item[1]));

                return $garbageDay;

            }

            return null;
        });

        return $dates;
    }

    private function _getUrl() : string
    {
        if(empty(getenv('INZAMEL_KALENDER_URL')) || empty($this->getPostcode()) || empty($this->getHouseNumber())) {
            die("Make sure the following data is provided: Inzamel kalender url (ENV), postcode, house number");
        }

        return getenv('INZAMEL_KALENDER_URL') . $this->getPostcode() . ':' . $this->getHouseNumber();
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param mixed $postcode
     * @return Scrapper
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * @param mixed $houseNumber
     * @return Scrapper
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;
        return $this;
    }



}
