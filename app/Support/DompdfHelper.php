<?php

namespace App\Support;

use Dompdf\Dompdf;
use Dompdf\Options;

class DompdfHelper
{
    /**
     * Create a configured Dompdf instance with the Manrope font registered.
     */
    public static function create(): Dompdf
    {
        $fontDir = rtrim(str_replace('\\', '/', realpath(storage_path('fonts'))), '/') . '/';

        $options = new Options();
        $options->set('fontDir', $fontDir);
        $options->set('fontCache', $fontDir);
        $options->set('chroot', [base_path(), $fontDir]);
        $options->set('isFontSubsettingEnabled', true);
        $options->set('isRemoteEnabled', false);

        $dompdf = new Dompdf($options);
        $fontMetrics = $dompdf->getFontMetrics();

        $fontMetrics->registerFont(
            ['family' => 'Manrope', 'style' => 'normal', 'weight' => 'normal'],
            'file://' . $fontDir . 'Manrope-Regular.woff2'
        );
        $fontMetrics->registerFont(
            ['family' => 'Manrope', 'style' => 'normal', 'weight' => 'medium'],
            'file://' . $fontDir . 'Manrope-Medium.woff2'
        );
        $fontMetrics->registerFont(
            ['family' => 'Manrope', 'style' => 'normal', 'weight' => 'semibold'],
            'file://' . $fontDir . 'Manrope-SemiBold.woff2'
        );
        $fontMetrics->registerFont(
            ['family' => 'Manrope', 'style' => 'normal', 'weight' => 'bold'],
            'file://' . $fontDir . 'Manrope-Bold.woff2'
        );

        return $dompdf;
    }
}
