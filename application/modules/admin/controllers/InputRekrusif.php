<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InputRekrusif extends Admin_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->library('form_builder','');
  }

  public function index(){
    //$this->load->view('welcome_message');
  }

  public function input_absen()
  {
        // jumlah data yang akan di insert
        $jumlah_data = 47;
        $idk = 23;
        for ($kk=1; $kk <= 2; $kk++) {
          for ($i=0;$i<=$jumlah_data;$i++){
            $data = array(
              "nip"  =>  "".$idk,
              "keterangan"  =>  "Hadir",
              //"waktu_masuk"  =>  "".date("2017-04-10 08:00:00"),
              "waktu_masuk"  =>  "".date("2017-05-".$kk." 08:00:00"),
              //"waktu_keluar"  =>  "".date("2017-04-10 16:00:00"),
              "waktu_keluar"  =>  "".date("2017-05-".$kk." 16:00:00"),
              "denda"  =>  null
            );
            $this->db->insert('data_absensi',$data);
            $idk = $idk+1;
          }
          $idk = 23;
        }
        echo $i.' Data Berhasil Di Insert '.$kk.' kali';
  }

  public function input_karyawan()
  {
      // jumlah data yang akan di insert
      $jumlah_data = 47;
      $firstname_array = array("ADI", "ADITYA", "ADVENTIO", "AGNES", "AGUNG", "ANDREAS", "ANTHONY", "ARTAGA", "AVIANTINO", "BAGUS", "BAYU", "CHANDRA", "CUT MUDA", "DANIEL", "DERI", "DEVIN", "DIMAS", "DITA", "DWI", "ERWIN", "FAHRULI", "GALIH", "IBNU", "IMAM", "IRFAN", "LUTFI", "M ADITYA", "MOCH IRPAN", "MOHAMMAD RIZKY", "MUHAMMAD IQBAL", "MUHAMMAD NOORIANDA", "NADYAWATI", "NATANAEL", "NIKEN", "OMEGA", "PANJI", "REZA", "SARI", "SHINTA", "SIGIT", "SOLAHUDIN", "SUCI", "TEUKU", "WILSON", "YOGY", "YUSLIANA", "ZULFA", "ZULFIKAR");
      $lastname_array = array(" AULIA D", " FAJAR DEWANTO", " CHRISTIANO APITU", " SEKAR MAHARDHIKA", " SANTA NUGRAHA", " PERKASA GINTING S", " MARTONO", " BUNAIYA", " CLEO SANTANA", " GUNTUR", " SYAITS DHIN ANWAR", " FEBRIAWAN", " MALIM", " PANDAPOTAN SIMORAN", " AGUSTIN", " PASYA", " PRAMUDITA", " LOGIARTI", " NUR RAHMAWATI", " RIO FADILAH", " ", " NURMANSYAH", " SYAEBANI", " SETYA UTAMA", " SETYADI YAHYA", " FEBRIANTO", " RAHMAN", " KANANI", " MAULANA RI", " NAUFAL", " KURNIA", " JASMIEN P", " ", " PRATIWI", " SHINTAULY", " EKO YUNIARSO", " DESTRIANSYAH", " WIJAYA", " JANATI M", " HADI PURNOMO", " ", " FAJARWATI RAMADHAN", " FATAHILLAH MOEDA", " ALEKSANDER G", " MAULANA FERRY", " ISKANTIKA", " NUR", " R L");
      $nip_array = array("10113183", "10113233", "10113276", "10113329", "10113358", "10113935", "11113176", "11113400", "11113519", "11113612", "11113679", "11113867", "11113966", "12113020", "12113193", "12113269", "12113504", "12113607", "12113684", "12113976", "13113098", "13113622", "14113181", "14113317", "14113483", "15113079", "15113109", "15113523", "15113641", "15113997", "16113049", "16113303", "16113348", "16113433", "16113789", "16113817", "17113494", "18113280", "18113452", "18113474", "18113600", "18113656", "18113855", "19113306", "19113479", "19113625", "19113678", "19113684");

      for ($i=0;$i<=$jumlah_data;$i++){
          $data = array(
              "nip"  =>  "".$nip_array[$i],
              "first_name"  =>  "".$firstname_array[$i],
              "last_name"  =>  "".$lastname_array[$i],
              "alamat"  =>  "DI Rumah",
              "jenis_kelamin"  =>  "Laki-Laki",
              "tempat_lahir"  =>  "BUMI",
              "tgl_lahir"  =>  date("Y-m-d",now()),
              "agama"  =>  "ISLAM",
              "status"  =>  "Lajang",
              "email"  =>  "karyawan_".$nip_array[$i]."@gmail.com",
              "phone"  =>  "0888".$nip_array[$i],
              "id_departemen"  =>  1,
              "id_jabatan"  =>  1,
              "status_pegawai"  =>  "Tetap",
              "masa_kerja"  =>  "",
              "no_rekening"  =>  "",
              "foto"  =>  "",
              "npwp"  =>  "",
              "active"  =>  1
              );
          $this->db->insert('karyawan',$data);


          $username = "".$nip_array[$i];
          $email = "karyawan_".$nip_array[$i]."@gmail.com";
          $password = "".$nip_array[$i];
          $additional_data = array(
          'first_name'  => $firstname_array[$i],
          'last_name'   => $lastname_array[$i],
          'company'   => "".$nip_array[$i]
          );
          $groups = '1';

          $this->ion_auth_model->tables = array(
          'users'       => 'users',
          'groups'      => 'groups',
          'users_groups'    => 'users_groups',
          'login_attempts'  => 'login_attempts',
          );
          $user = $this->ion_auth->register($username, $password, $email, $additional_data, $groups);
      }
      echo $i.' Data Berhasil Di Insert';
  }
  public function input_guk()
  {
        for ($i=3;$i<=50;$i++){
          $data = array(
              "user_id"  =>  "".$i,
              "group_id"  =>  "1"
              );
          $this->db->insert('users_groups',$data);
        }
      }


}
