<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  function photo_u($u=NULL,$f=NULL){
    global $Config;
    if ($f !='') {
      if ($u == 'mhs') {
        return $Config->_site_url.'uploads/mhs-photo/'.$f;
      }
      elseif ($u == 'ptk') {
        return $Config->_site_url.'uploads/ptk-photo/'.$f;
      }
    }
    else{
      return $Config->_site_url.'uploads/default-photo/user-image.png';
    }
  }

  function number_conv($num,$format=NULL){
    if ($format != NULL) {
      if ($format == ',') {
        $dec = '.';
        $sep = ',';
      }
      else{
        $dec = ',';
        $sep = '.';
      }
      $number = number_format($num,0,$dec,$sep);
    }
    else{
      $number = number_format($num,0,',','.');
    }
    return $number;
  }

  function list_fields($tables,$other_field=NULL){
    $_this =& get_instance();
    $list_fields = array();
    foreach ($tables as $key) {
      $list_fields = array_merge($_this->db->list_fields($key),$list_fields);
    }

    if ($other_field != NULL) {
      $list_fields = array_merge($list_fields,$other_field);
    }
    return $list_fields;
  }

  function date_convert($tgl){
    if ($tgl != NULL) {
      $var = explode('-',$tgl);
      $day = $var[2];
      $month = $var[1];
      $year = $var[0];
      $array_month = array(
        '00' => '00',
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
        );
      return $day.' '.$array_month[$month].' '.$year;
    }
    else{
      return $tgl;
    }
  }

  function color_pd_static($no){
    $array_color = array(
      '0' => '#3c8dbc',
      '1' => '#00c0ef',
      '2' => '#00a65a',
      '3' => '#f39c12',
      '4' => '#f56954',
      '5' => '#ff7701',
      '6' => '#001F3F',
      '7' => '#39CCCC',
      '8' => '#605ca8',
      '9' => '#ff851b',
      '10' => '#D81B60',
      '11' => '#111111',
      '12' => '#357ca5',
      '13' => '#00a7d0',
      '14' => '#008d4c',
      '15' => '#db8b0b',
      '16' => '#d33724',
      '17' => '#555299',
      );
    if (array_key_exists($no, $array_color)) {
      return $array_color[$no];
    }
    else{
      return '#f39c12';
    }
  }

  function pdk_conv($nl){
    if ($nl >= 85) {
      $pd = 'A';
    }
    elseif ($nl >= 75 && $nl <= 84) {
      $pd = 'B+';
    }
    elseif ($nl >= 65 && $nl <= 74) {
      $pd = 'B';
    }
    elseif ($nl >= 55 && $nl <= 64) {
      $pd = 'C+';
    }
    elseif ($nl >= 45 && $nl <= 54) {
      $pd = 'C';
    }
    elseif ($nl <= 44) {
      $pd = 'E';
    }
    return $pd;
  }

  function nilai_conv($nl,$s){
    if ($nl != '') {
      if ($nl >= 85) {
        $pd = 'A';
      }
      elseif ($nl >= 75 && $nl <= 84) {
        $pd = 'B+';
      }
      elseif ($nl >= 65 && $nl <= 74) {
        $pd = 'B';
      }
      elseif ($nl >= 55 && $nl <= 64) {
        $pd = 'C+';
      }
      elseif ($nl >= 45 && $nl <= 54) {
        $pd = 'C';
      }
      elseif ($nl <= 44 && $nl >= 0) {
        $pd = 'E';
      }

      if ($pd == 'A') {
        $am = 4.00;
      }
      elseif ($pd == 'B+') {
        $am = 3.50;
      }
      elseif ($pd == 'B') {
        $am = 3.00;
      }
      elseif ($pd == 'C+') {
        $am = 2.50;
      }
      elseif ($pd == 'C') {
        $am = 2.00;
      }
      elseif ($pd == 'E') {
        $am = 1.50;
      }
      $mutu = $s*$am;
    }
    else{
      $pd = '';
      $am = '';
      $mutu = '';
    }
    return $pd.'/'.$am.'/'.$mutu;
  }

  function thn_ajaran_conv($thn){
    if ($thn != NULL && $thn != '') {
      $vars = explode('/',$thn);
      if ($vars[1] == '1') {
        $thn = $vars[0].'/Ganjil';
      }
      elseif ($vars[1] == '2') {
        $thn = $vars[0].'/Genap';
      }
      return $thn;
    }
    else{
      return '-';
    }
  }

  function select_conv_value($val,$data,$field){
    if ($data == 'ptk') {
      if ($field == 'status_ptk') {
        $data_array = array(
          '1' => 'Dosen Tetap', 
          '2' => 'Dosen Tidak Tetap', 
          '3' => 'Lainnya', 
          );
      }
      elseif ($field == 'status_aktif_ptk') {
        $data_array = array(
          '1' => 'Aktif', 
          '2' => 'Tidak Aktif', 
          '3' => 'Tugas Belajar', 
          '4' => 'Ijin Belajar', 
          '5' => 'Lainnya', 
          );
      }
      elseif ($field == 'jenjang') {
        $data_array = array(
          '1' => 'S1', 
          '2' => 'S2', 
          '3' => 'S3',
          '4' => 'Lainnya', 
          );
      }
      elseif ($field == 'agama_ptk') {
        $data_array = array(
          '1' => 'Islam', 
          '2' => 'Kristen', 
          '3' => 'Katholik',
          '4' => 'Budha', 
          '5' => 'Hindu', 
          '6' => 'Konghucu', 
          '7' => 'Lainnya', 
          );
      }
    }
    $data_array['0'] = '';
    if (array_key_exists($val, $data_array)) {
      return $data_array[$val];
    }
    else{
      return '';
    }
  }

  function output_filtering($str){
    $new_str = array();
    foreach ($str as $in => $row) {
      foreach ($row as $field => $value) {
        $new_value[$field] = htmlentities($value, ENT_QUOTES, 'UTF-8');
      }
      $new_str[] = $new_value;
    }
    return $new_str;
  }

  function input_filtering($str){
    $new_str = array();
    foreach ($str as $in => $row) {
      $new_str += array(
        $in => htmlentities($row, ENT_QUOTES, 'UTF-8')
        );
    }
    return $new_str;
  }

  function rand_val($num=20){
    $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $len = strlen($string)-1;
    $pass = '';
    for ($i=1; $i <= $num ; $i++) { 
      $start = rand(0,$len);
      $pass .= $string{$start};
    }
    return $pass;
  }

?>