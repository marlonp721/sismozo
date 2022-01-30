<?php
namespace App\Extensions;

use Carbon\Carbon;

class Util
{

    public static function getIpRange($from, $to, $fromApn, $onlyCount = false) {


        $notAvailableIps = collect($fromApn)
        ->filter(function (LineApn $object) {
            return (isset($object->ip) && !is_null($object->ip));
        })->map(function (LineApn $object) {
            return $object->ip;
        })->toArray();
        $elements = [];
        $count = 0;

        if (filter_var($from, FILTER_VALIDATE_IP) && filter_var($to, FILTER_VALIDATE_IP)) {

            $startSplit = explode(".", $from);
            $endSplit = explode(".", $to);

            $i0 = (int) $startSplit[0];
            $i1 = (int) $startSplit[1];
            $i2 = (int) $startSplit[2];
            $i3 = (int) $startSplit[3];

            $e0 = (int) $endSplit[0];
            $e1 = (int) $endSplit[1];
            $e2 = (int) $endSplit[2];
            $e3 = (int) $endSplit[3];

            while ($i0 < $e0 || $i1 < $e1 || $i2 < $e2 || $i3 <= $e3) {

                if ($i3 >= 255) {
                    $i2++;
                    $i3 = 1;
                }
                if ($i2 > 255) {
                    $i1++;
                    $i2 = 0;
                }
                if ($i1 > 255) {
                    $i0++;
                    $i1 = 0;
                }

                $elements[] = $i0 . '.' . $i1 . '.' . $i2 . '.' . $i3;
                $count++;
                $i3++;
            }

            $availables = array_diff($elements, $notAvailableIps);
            return [
                'from' => $from,
                'to' => $to,
                'total' => $count,
                'data' => $elements,
                'availableTotal' => count($availables),
                'availableIp' => (count($availables)>0)?head($availables):'',
                'notAvailableIps' => $notAvailableIps

            ];
        }
    }

    public static function parseDate($fromClientSide) {

    try {
        $strDate = explode(' ', $fromClientSide);
        $date = $strDate[0];
        $time = $strDate[1];
        list($day, $month, $year) = explode('/', $date);
        $fecha = join('-', [$year, $month, $day]) . ' ' . $time;
        $date= date($fecha);
        $newDate = strtotime ($date) ;
        return $newDate;
    }catch(Exception $e) {
        return null;
    }

  }
  public static function parseDates($fromClientSide) {

    try {
      $strDate = explode(' ', $fromClientSide);
      $date = $strDate[0];
      $time = $strDate[1];
      list($day, $month, $year) = explode('/', $date);
      $fecha = join('-', [$year, $month, $day]) . ' ' . $time;
      $date= date($fecha);
      return $date;
    }catch(Exception $e) {
      return null;
    }

  }

  public static function parseDateExport($fromClientSide) {

    try {
      $strDate = explode(' ', $fromClientSide);
      $date = $strDate[0];
      $time = $strDate[1];
      list($day, $month, $year) = explode('-', $date);
      $fecha = join('/', [$year, $month, $day]) . ' ' . $time;
      $date= date($fecha);
      return $date;
    }catch(Exception $e) {
      return null;
    }

  }
}
