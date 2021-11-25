<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HammingDistance extends Controller
{
    public function compute(Request $oRequest)
    {
        $aData = $oRequest->validate([
            'x' => 'required|numeric',
            'y' => 'required|numeric'
        ]);

        $aInput = $this->formatBinary($aData['x'], $aData['y']);

        $aBinX = str_split($aInput['x']);
        $aBinY = str_split($aInput['y']);
        $iHammingDistance = 0;

        foreach ($aBinX as $iKey => $sBit) {
            if ($aBinX[$iKey] != $aBinY[$iKey]) {
                $iHammingDistance++;
            }
        }

        return $iHammingDistance;
    }

    private function formatBinary($iBinX, $iBinY)
    {
        $sBinX = decbin($iBinX);
        $sBinY = decbin($iBinY);

        $iLength = strlen($sBinX);

        if (strlen($sBinY) > strlen($sBinX)) {
            $iLength = strlen($sBinY);
        }

        $sBinX = substr(str_repeat(0, $iLength) . $sBinX, - $iLength);
        $sBinY = substr(str_repeat(0, $iLength) . $sBinY, - $iLength);

        return [
            'x' => $sBinX,
            'y' => $sBinY
        ];

    }
}
