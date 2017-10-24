<?php

class Rekening_model extends MY_Model {
  protected $_table = 'VD_Transaksi';

    public function bunga_saldo_minimum_harain($nrek,$month)
  {
    $qr = $this->db->query("
      SELECT DISTINCT
(SELECT DATEDIFF( MAX( `Tanggal_Transaksi` ) , MIN( `Tanggal_Transaksi` ) ) as jml_hari  FROM `VD_Transaksi` WHERE `Rekening_Transaksi` = '.$nrek.' AND date_format(`Tanggal_Transaksi`,'%Y-%m') = '.$month.') as jml_hari ,
(SELECT min(Nominal) FROM `VD_Transaksi` WHERE `Rekening_Transaksi` = '.$nrek.' AND date_format(`Tanggal_Transaksi`,'%Y-%m') = '.$month.') as t_saldo_terendah,
((((SELECT min(Nominal) FROM `VD_Transaksi` WHERE `Rekening_Transaksi` = '.$nrek.' AND date_format(`Tanggal_Transaksi`,'%Y-%m') = '.$month.'))*(12/100)*((SELECT DATEDIFF( MAX( `Tanggal_Transaksi` ) , MIN( `Tanggal_Transaksi` ) ) as jml_hari FROM `VD_Transaksi` WHERE `Rekening_Transaksi` = '.$nrek.' AND date_format(`Tanggal_Transaksi`,'%Y-%m') = '.$month.')))/365) as bunga_saldo_terendah_harian
FROM `VD_Transaksi` WHERE `Rekening_Transaksi` = '.$nrek.' AND date_format(`Tanggal_Transaksi`,'%Y-%m') = '.$month.'");
    $row = $qr->row();
    if (isset($row))
    {
    echo $row->jml_hari;
    }
    return $row;
  }

  public function tes($nrek,$month)
  {
  $fqr = $this->db->query("SELECT DATEDIFF( MAX( `Tanggal_Transaksi` ) , MIN( `Tanggal_Transaksi` ) ) as jml_hari  FROM `VD_Transaksi` WHERE `Rekening_Transaksi` = '.$nrek.' AND Bulan = '.$month.'");
    $row = array($fqr->result());
    return $row;
  }
}
