<?php
class Address
{
    private $fullAddress;

    function __construct($street, $city, $state)
    {
        $this->fullAddress = "$street, $city, $state";
    }

    function getFullAddress()
    {
        return $this->fullAddress;
    }

    function setFullAddress($new_street, $new_city, $new_state)
    {
        $this->fullAddress = "$new_street.$new_city.$new_state";
    }
}
 ?>
