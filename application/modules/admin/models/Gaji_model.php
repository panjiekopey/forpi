<?php

class Gaji_model extends MY_Model {
  protected $_table = 'config';

  public function get_ginfo($key)
  {return $this->db->get_where('uLembur_dTerlambat', array('nip' => $key))->row();}

  public function get_dginfo($key)
  {return $this->db->get_where('infoDendaAlfa', array('nip' => $key))->row();}
}
