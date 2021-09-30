<?php

namespace App\Http\Utility;

use App\Models\pembayaran;
use Exception;

class PembayaranUtility
{
    private $model;

    public function __construct(pembayaran $pembayaran)
    {
        $this->model = $pembayaran;
    }

    /**
     * method create new invoice
     */
    public function createInvoice(): string
    {
        // initial model
        $pembayaran = $this->model;
        // get last id from tabel pembayaran
        $last = $pembayaran->latest()->first();
        // split string invoice terbarus ambil angka
        $pecah = $last === null ? 0 : explode("/", $last['invoice']);
        // tentukan nominal terbaru
        $parseid = $last === null ? 0 : (int) $pecah[0];
        return "{$this->makeZero($parseid)}/INV/{$this->getMounth()}/" . date('Y');
    }
    /**
     * method make format invoice
     */
    private function makeZero($id): int | string
    {
        if ($id < 9) :
            return '00' . ($id += 1);
        elseif ($id < 99) :
            return '0' . ($id += 1);
        else :
            return $id += 1;
        endif;
    }

    // method generate mounth romawi
    private function getMounth(): string
    {
        try {
            $im = (int) date('m');
            $mounth = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
            return $mounth[$im - 1];
        } catch (Exception $e) {
            throw $e->getMessage();
        }
    }
}
