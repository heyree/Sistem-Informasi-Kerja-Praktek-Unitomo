<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Model extends CI_Model {
                        
public function login(){
                        
                                
}
public function getData($table)
{
    $this->db->from($table);
    return $this->db->get()->result();
    
}
public function updateData($table,$reference,$id,$object)
{
    $this->db->where($reference, $id);
    $this->db->update($table, $object);
}
public function findData($table,$reference,$id)
{
    $this->db->from($table);
    $this->db->where($reference, $id);
    return $this->db->get();
}
public function getDataBimbinganSiswa($nis)
{
    $this->db->from('tbl_bimbingan');
    $this->db->select('tbl_bimbingan.type,tbl_bimbingan.kdbimbingan,tbl_bimbingan.source, tbl_bimbingan.catatan,tbl_bimbingan.nip,tbl_bimbingan.nis,tbl_bimbingan.tanggal,tbl_bimbingan.judul,tbl_bimbingan.file,tbl_siswa.nama_lengkap as nama_siswa,tbl_siswa.foto as foto_siswa, tbl_pemb.nama_lengkap as nama_pembimbing');
    $this->db->where('tbl_bimbingan.nis', $nis);
    $this->db->join('tbl_siswa', 'tbl_bimbingan.nis = tbl_siswa.nis');
    $this->db->join('tbl_pemb', 'tbl_bimbingan.nip = tbl_pemb.nip');
    $this->db->order_by('tbl_bimbingan.kdbimbingan', 'desc');
    
    return $this->db->get()->result();
    
}
                        
                            
                        
}
                        
/* End of file Model.php */
    
                        