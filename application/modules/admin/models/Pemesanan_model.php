<?php

class Pemesanan_model extends MY_Model {
  protected $_table = 'pemesanans';

  public function get_pinfo($key)
  {return $this->db->get_where('vpemesanan', array('id' => $key))->row();}

  public function create_pkode()
  {
    $kar = "PS"; $kd = "";
    $q = $this->db->select('MAX(RIGHT(kode_pesanan,3)) as idmax')->get('pemesanans');
      if($q->num_rows()>0){
        foreach($q->result() as $k){
          $tmp = ((int)$k->idmax)+1; //string kode diset ke integer dan ditambahkan 1 dari kode terakhir
          $kd = sprintf("%03s", $tmp); // kode ambil 3 karakter terakhir
        }
      }else{ //jika data kosong diset ke kode awal
        $kd = "001";
      }
    //gabungkan string dengan kode yang telah dibuat tadi
    $kd_psn = $kar; $kd_psn .= $kd;
    return $kd_psn;
  }
}
