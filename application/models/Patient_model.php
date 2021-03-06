<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_Model{

  function GetStates()
  {
    $result = $this->db->query("Select * from lugar");
    if($result->num_rows() > 0)
    {
      return $result;
    }
    else
    {
      return null;
    }
  }

  function GetSangre()
  {
    $result = $this->db->query("Select * from sangre");
    if($result->num_rows() > 0)
    {
      return $result;
    }
    else
    {
      return null;
    }
  }

  function GetPatient()
  {
    $result = $this->db->query("SELECT * fROM paciente ORDER BY noSeguro DESC LIMIT 5 ");
    if($result->num_rows() > 0)
    {
      return $result;
    }
    else
    {
      return null;
    }
  }

  function GetPerson($id = null)
  {
    if($id != null)
    {
      $result = $this->db->query("SELECT p.noSeguro, p.carnet, p.nombre, p.apellidoP, p.apellidoM, p.CURP, p.direccion, p.sexo, p.fecha_nacimiento, l.descripcion, s.tipo
        FROM paciente as p, lugar as l, sangre as s WHERE p.noSeguro = ".$id." and l.idlugar = p.id_lugar and s.idSangre = p.idSangre");
      if($result->num_rows() > 0)
      {
        return $result->row();
      }
      else
      {
        return null;
      }
    }
  }

  function Searchlike($id = null)
  {
    if($id != null)
    {
      $result = $this->db->query("SELECT * FROM paciente WHERE noSeguro like '%".$id."%'");
      if($result->num_rows() > 0)
      {
        return $result;
      }
      else
      {
        return null;
      }
    }
  }

  function Insert($datos = null)
  {
    if($datos != null)
    {

      $SQL = "INSERT INTO paciente (carnet, nombre, apellidoP, apellidoM, CURP, sexo, fecha_nacimiento, id_lugar, direccion, idSangre) VALUES
      ('". $datos['carnet'] ."', '". $datos['nombre'] ."', '". $datos['ap'] ."', '". $datos['am'] ."',
        '". $datos['curp'] ."', '". $datos['sex'] ."', '". $datos['fecha'] ."', '". $datos['estado'] ."', '". $datos['direccion'].
        "', ". $datos['sangre'] .")";

      if($this->db->query($SQL))
      {
        return true;
      }
    }
    return false;
  }

  function Update($info = null)
  {
    if($info != null)
    {
      $SQL = "UPDATE paciente SET nombre = '".$info['nombre'] . "', apellidoP = '" .  $info['paterno'] . "'," .
      " apellidoM = '" . $info['materno'] . "', sexo = '" . $info['sexo'] . "', curp = '" . $info['curp'] . "', direccion = '" . $info['direccion'] . "'" .
      " WHERE noSeguro = ".$info['seguro'];

      if($this->db->query($SQL))
      {
        return true;
      }
    }
    return false;
  }

  function SetCarnet($info = null)
  {
    if($info != null)
    {
      $SQL = "UPDATE paciente SET carnet = '".$info['carnet']."' WHERE noSeguro = ".$info['seguro'];

      if($this->db->query($SQL))
      {
        return true;
      }
    }
    return false;
  }

  function Delete($seguro = null)
  {
    if($seguro != null)
    {
      $SQL = "DELETE FROM paciente WHERE noSeguro = $seguro";

      if($this->db->query($SQL))
      {
        return true;
      }
    }
    return false;
  }

}
