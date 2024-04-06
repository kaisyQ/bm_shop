<?php
declare(strict_types=1);

namespace App\Application\Constants;

final class Constants
{
    const DELIVERY_MESSAGE = "
        Hello valued customer, \n
        We're pleased to offer multiple delivery options to suit your needs: \n
        1. Curbside Delivery - $30*: Your item will be delivered curbside, meaning it will be unloaded at the curb closest to your address. This option requires you to have at least 2 people available to move the item inside. \n
        2. *In-Home Delivery - $60*: We will bring the item into your home and place it in the room of your choice, eliminating the need for you to lift and carry the item yourself. \n
        3. *Basement Delivery (For Large Sectionals) - $80*: If you've ordered a large sectional and want it placed in your basement, this specialized service ensures that your furniture will be safely and conveniently installed where you'd like it. \n
        Please let us know which option best fits your needs. Thank you for choosing our services! \n
        Best regards,\n
        [ BM Furniture Finds ]
    
    ";

    public static function getDeliveryMessage()
    {
        return self::DELIVERY_MESSAGE;
    }
}
