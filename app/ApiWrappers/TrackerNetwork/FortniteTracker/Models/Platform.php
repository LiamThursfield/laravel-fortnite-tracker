<?php

namespace App\ApiWrappers\TrackerNetwork\FortniteTracker\Models;

class Platform {

    // Define the constants for the platform codes
    public static const PLATFORM_CODE_XBOX = 1;
    public static const PLATFORM_CODE_PLAYSTATION = 2;
    public static const PLATFORM_CODE_PC = 3;

    // Define the constants for the platform names
    public static const PLATFORM_NAME_XBOX = 'Xbox';
    public static const PLATFORM_NAME_PLAYSTATION = 'Playstation';
    public static const PLATFORM_NAME_PC = 'PC';

    private $platform_code;
    private $platform_name;

    public function __construct($platform_code) {
        $this->platform_code = (int) $platform_code;
        $this->convertCode();
    }

    /**
     * Convert the raw platform code from the API into a platform name
     */
    private function convertCode() {
        switch ($this->platform_code) {
            case self::PLATFORM_CODE_XBOX:
                $this->platform_name = self::PLATFORM_NAME_XBOX;
                break;
            case self::PLATFORM_CODE_PLAYSTATION:
                $this->platform_name = self::PLATFORM_NAME_PLAYSTATION;
                break;
            case self::PLATFORM_CODE_PC:
                $this->platform_name = self::PLATFORM_NAME_PC;
                break;
            default:
                $this->platform_name = "Unknown {$this->platform_code}";
        }
    }

    /**
     * @return int
     */
    public function getPlatformCode() {
        return $this->platform_code;
    }

    /**
     * @return string
     */
    public function getPlatformName() {
        return $this->platform_name;
    }


}
