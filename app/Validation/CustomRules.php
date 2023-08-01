<?
// App/Validations/CustomRules.php

namespace App\Validations;

use App\Models\ReservationModel;

class CustomRules
{
    public function checkReservationDate(string $str, string $fields, array $data)
    {
        $reservationModel = new ReservationModel();
        $selectedDate = date_create($str);

        // Check if there is any reservation on the same date or within two days of the selected date
        $existingReservations = $reservationModel->getReservationsByDateRange($selectedDate, 2);

        if (!empty($existingReservations)) {
            return false;
        }

        return true;
    }
}
