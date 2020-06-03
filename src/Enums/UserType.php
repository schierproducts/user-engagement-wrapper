<?php

namespace Schierproducts\UserEngagementApi\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static EngineerArchitect()
 * @method static static Contractor()
 * @method static static Distributor()
 * @method static static AhjInspector()
 * @method static static FacilityOwner()
 * @method static static ManufacturerRep()
 * @method static static Other()
 * @method static static SchierEmployee()
 */
final class UserType extends Enum
{
    const EngineerArchitect = 'engineerArchitect';
    const Contractor = 'contractor';
    const Distributor = 'distributor';
    const AhjInspector = 'ahjInspector';
    const FacilityOwner = 'facilityOwner';
    const ManufacturerRep = 'manufacturerRep';
    const Other = 'other';
    const SchierEmployee = 'schierEmployee';

    public static function getDescription($value): string
    {
        if ($value === self::EngineerArchitect) {
            return 'Engineer / Architect';
        } elseif ($value === self::AhjInspector) {
            return 'AHJ / Inspector';
        } elseif ($value === self::FacilityOwner) {
            return 'Facility Owner';
        } elseif ($value === self::ManufacturerRep) {
            return 'Manufacturer Rep';
        } elseif ($value === self::SchierEmployee) {
            return 'Schier Employee';
        }

        return parent::getDescription($value);
    }
}
