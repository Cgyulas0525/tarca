<?php
namespace App\Classes;
use App\Models\Szamla;
use DB;

class SzamlaSparklineClass{

    public static function sparklineData($partner, $tol, $ig)
    {
        $negyedevek = SzamlaClass::szamlaPartnerNegyedevOsszesen($partner->id, $tol, $ig);

        $array = [];
        $dataSparkline = "";

        if ($negyedevek->count() < 4) {
            $mitol = $tol;
            for ( $i = 0; $i < 4; $i++) {
                $month = date("n", strtotime($mitol));
                $quarter = ceil($month / 3);
                $year = date('Y',strtotime($mitol));
                $quarter = $year.ceil($month / 3);

                if ( $negyedevek->where('idoszak', $quarter)->count() == 0 ) {
                    array_push($array, ['partner' => $negyedevek[0]->partner,'idoszak' => $quarter, 'osszeg' => 0]);
                } else {
                for ( $j = 0; $j < $negyedevek->count(); $j++) {
                    if ( $negyedevek[$j]->idoszak == $quarter ) {
                        $negyedev = $negyedevek[$j];
                        array_push($array, ['partner' => $negyedev->partner,'idoszak' => $negyedev->idoszak, 'osszeg' => $negyedev->osszeg]);
                    }
                }
                };

                $mitol = date('Y-m-d', strtotime("+3 month", strtotime(date($mitol)))) . "\n";
            }
            for ( $i = 0; $i < 4; $i++ ) {
                $dataSparkline = $dataSparkline . strval($array[$i]["osszeg"] . ", ");
            }
        } else {
            foreach ($negyedevek as $negyedev) {
                $dataSparkline = $dataSparkline . strval($negyedev->osszeg) . ", ";
            }
        }

        return $dataSparkline;
    }
}
