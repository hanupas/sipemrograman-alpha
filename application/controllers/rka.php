<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Rka extends CI_Controller {

	function __contruct()
	{	
		parent::__construct();
	}
    
    function cetak_umum()
    	{
    		
            $data['page_title']= 'BAPPENAS';
            $this->template->set('title', 'BAPPENAS');          
            $this->template->load('template','anggaran/rka/cetak_umum',$data) ; 
            //$this->load->view('anggaran/rka/tambah_rka',$data) ;
       }
	function preview_umum($ct='2',$cnama='',$cnip='',$cjabatan=''){
            
            $kd_skpd = $this->session->userdata('kdskpd');
            $thn_ang = $this->session->userdata('pcThang');
            $nama1 = str_replace('123456789',' ',$cnama);
            $nama = str_replace('jj',',',$nama1);
            $jabatan1 = str_replace('kk',' ',$cjabatan);
            $jabatan = str_replace('qq',',',$jabatan1);
            $nip = str_replace('123456789',' ',$cnip);
            $sqldns="select * from t_dept   WHERE kddept='$kd_skpd'";
                 $sqlskpd=$this->db->query($sqldns);
                 foreach ($sqlskpd->result() as $rowdns)
                {
                   
                    $kd_dept = $rowdns->kddept;
                    $nm_dept  = $rowdns->nmdept;
                }
            
            $thn_ang_2= $thn_ang+1;
            $thn_ang_3= $thn_ang+2;
            $thn_ang_4= $thn_ang+3;
            $thn_ang_5= $thn_ang+4;
            $cRet='';
                     $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                <tr>
                                     <td align=\"center\"  style=\"font-size:20px\" colspan=\"3\"><strong>FORMULIR 1</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" colspan=\"3\"><strong>PENJELASAN UMUM</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" colspan=\"3\"><strong>RENCANA KERJA KEMENTRIAN/LEMBAGA (RENJA-KL)</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" colspan=\"3\"><strong>TAHUN ANGGARAN $thn_ang_2</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" colspan=\"3\">&nbsp;</td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" >&nbsp;</td>                         
                                </tr>
                                
                              </table>"; 
                   
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">";
                                        $cRet    .= " <tr><td style=\"font-size:14px\"  width=\"25%\" align=\"left\"><strong><b>1. Kementrian/Lembaga</b></strong></td>                                     
                                                            <td style=\"font-size:14px\" width=\"1%\">:</td>                                    
                                                            <td style=\"font-size:14px\" width=\"74%\">$nm_dept</td></tr>";
                                        
                                        $sql="select * from t_visi where kddept='$kd_skpd'";
                 
                                         $query = $this->db->query($sql);
                                                                          
                                        foreach ($query->result() as $row)
                                        {
                                            $kdvisi=$row->kdvisi;
                                            $nmvisi=$row->nmvisi;
                                            $cRet    .= " <tr><td style=\"font-size:14px\" width=\"25%\" align=\"left\"><strong><b>2. VISI</b></strong></td>                                     
                                                            <td style=\"font-size:14px\" width=\"1%\">:</td>                                    
                                                            <td style=\"font-size:14px\" width=\"74%\">$nmvisi</td></tr>";
                                        }
                                         $sql1="select * from t_misi where kddept='$kd_skpd' order by kdmisi";
                 
                                         $query1 = $this->db->query($sql1);
                                        $i=0;                                  
                                        foreach ($query1->result() as $row1)
                                        {
                                            $i=$i+1;
                                            $kdmisi=$row1->kdmisi;
                                            $nmmisi=$row1->nmmisi;
                                            if($i==1){
                                                $cRet    .= " <tr><td style=\"font-size:14px\" width=\"25%\" align=\"left\"><strong><b>3. MISI</b></strong></td>                                     
                                                            <td style=\"font-size:14px\" width=\"1%\">:</td>                                    
                                                            <td style=\"font-size:14px\" width=\"74%\">$i.$nmmisi</td></tr>";
                                            }else{
                                                $cRet    .= " <tr><td style=\"font-size:14px\" width=\"25%\" align=\"left\"></td>                                     
                                                            <td style=\"font-size:14px\" width=\"1%\"></td>                                    
                                                            <td style=\"font-size:14px\" width=\"74%\">$i.$nmmisi</td></tr>";
                                            }
                                            
                                        }
                                
                    $cRet .=       " </table>"; 
                   
                   
                    $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                <tr>
                                     <td align=\"left\" style=\"font-size:14px\" colspan=\"3\"><strong><b>4. Sasaran Strategis dan Indikator Kinerja Sasaran Strategis K/L</b></strong></td>                         
                                </tr>
                                
                              </table>";         
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>NO</b></td>
                                        <td width=\"40%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Sasaran Strategis</b></td>
                                        <td width=\"30%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Indikator Sasaran Strategis</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Target 2016</b></td>
                                        <td width=\"15%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Alokasi 2016(Juta)</b></td>
                                      </tr> 
                                      
                                     
                                 </thead>  ";
                                 
                                         $sql2="SELECT d.nomor AS nosasstra,d.nama ,SUM(a.rupiah) AS rupiah ,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
                                                SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn FROM d_sasarankl AS d 
                                                LEFT JOIN d_sasaran_prog AS c ON c.kddept=d.kddept AND c.nosasstra=d.nomor 
                                                LEFT JOIN d_item_output AS b ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND b.nosasprog=c.nosasprog
                                                LEFT JOIN d_kmpnen AS e ON e.kddept=b.kddept AND e.kdunit=b.kdunit AND e.kdprogram=b.kdprogram AND e.kdgiat=b.kdgiat AND e.kdoutput=b.kdoutput
                                                LEFT JOIN d_lok AS a ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput AND a.kdkmpnen=e.kdkmpnen
                                                WHERE d.kddept='$kd_skpd' and  a.kdkmpnen <>'' and a.kdprop <>'' GROUP BY c.nosasstra order by d.nomor ";
                                         //$sql2="select c.nosasstra,d.nama,SUM(a.rupiah) AS rupiah,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
//                                                SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn,SUM(a.jumlah) AS jumlah FROM d_lok a 
//                                                INNER JOIN d_item_output b ON a.kddept=b.kddept and a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput
//                                                INNER JOIN d_sasaran_prog c ON b.kddept=c.kddept and b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND b.nosasprog=c.nosasprog
//                                                left JOIN d_sasarankl d ON c.kddept=d.kddept AND c.nosasstra=d.nomor 
//                                                WHERE a.kddept='$kd_skpd' AND b.nosasprog<>'' AND c.nosasstra<>''   GROUP BY c.nosasstra,d.nama ";
                                         $query2= $this->db->query($sql2);
                                         $tsastrakl=0;
                                         foreach ($query2->result() as $row2)
                                                {
                                                    $kdsaskl= $row2->nosasstra; 
                                                    $nmsaskl= $row2->nama;
                                                    $jtrp=$row2->rupiah;
                                                    $jtpln=$row2->pln;
                                                    $jtpdn=$row2->pdn;
                                                    $jthibah=$row2->hibah;
                                                    $jtpend=$row2->pend;
                                                    $jtpnbp=$row2->pnbp;
                                                    $jtblu=$row2->blu;
                                                    $jtsbsn1=$row2->sbsn;
                                                    $jtjml=$jtrp+$jtpend+$jtpln+$jtpdn+$jthibah+$jtpnbp+$jtblu+$jtsbsn1;
                                                  $calokasi=$jtjml;
                                                  $tsastrakl=$tsastrakl+$calokasi;
                                                  $alokasi=number_format($calokasi,"1",",",".");
                                                  $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black; font-size:8px\" width=\"5%\" align=\"center\" >$kdsaskl</td>                                     
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"40%\"align=\"left\">$nmsaskl</td>
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"30%\">&nbsp;</td>
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"center\"></td>
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"15%\" align=\"right\">$alokasi</td></tr>";
                                                            
                                                            $sql21="SELECT * from d_indikatorkl where kddept='$kd_skpd' and nomor_sasarankl='$kdsaskl'";
                                                            $query21 = $this->db->query($sql21);
                                                            foreach ($query21->result() as $row21)
                                                            {
                                                                
                                                                $indikator_kl=$row21->nama;
                                                                 $ivol=$row21->vol1;
                                                                $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\">&nbsp;</td>                                     
                                                                                <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"40%\"align=\"left\">&nbsp;</td>
                                                                                <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"30%\">$indikator_kl</td>
                                                                                <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"center\">$ivol</td>
                                                                                <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"15%\" align=\"right\"></td></tr>";
                                                            }
                                                  
                                                }
                                          
                                        
                                            
                                            $cRet    .= " <tr><td bgcolor=\"#90EE90\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"85%\" colspan=\"4\" align=\"center\"><b>Jumlah</b></td>
                                                            <td bgcolor=\"#90EE90\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"15%\" align=\"right\"><b>".number_format($tsastrakl,"1",",",".")."</b></td></tr>";
                                       
                                
                                $cRet .=       " </table>";
                    $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                <tr>
                                     <td align=\"left\" style=\"font-size:14px\" colspan=\"3\"><strong><b>5. Program dan Pendanaan</b></strong></td>                         
                                </tr>
                                
                              </table>";  
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>Kode</b></td>
                                        <td width=\"36%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>Program</b></td>
                                        <td width=\"31%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" colspan=\"5\"><b>Indikasi Pendanaan Tahun 2016</b></td>
                                        <td width=\"18%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" colspan=\"3\"><b>Prakiraan Kebutuhan(Juta)</b></td>
                                        
                                      </tr> 
                                      <tr>  
                                        <td width=\"6%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>Rupiah</b></td>
                                        <td width=\"6%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>PHLN+PDN</b></td>
                                        <td width=\"6%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>PNBP+BLU</b></td>
                                        <td width=\"6%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>SBSN</b></td>
                                        <td width=\"7%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>Jumlah</b></td>
                                        <td width=\"6%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>2017</b></td>
                                        <td width=\"6%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>2018</b></td>
                                        <td width=\"6%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>2019</b></td>
                                      </tr> 
                                     
                                 </thead> ";
                                 //$sql3="SELECT a.kdprogram,b.nmprogram,b.status,SUM(a.rupiah) AS rupiah,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
//                                        SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn,SUM(a.jumlah) AS jumlah
//                                        FROM d_lok a INNER JOIN t_program b ON a.kddept=b.kddept AND a.kdprogram=b.kdprogram WHERE a.kddept='$kd_skpd' GROUP BY  a.kdprogram ";
                                 $sql3="SELECT d.kdprogram,d.nmprogram,d.status,SUM(a.rupiah) AS rupiah,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
                                        SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn
                                        FROM t_program d
                                        LEFT JOIN d_sasaran_prog c ON c.kddept=d.kddept AND c.kdunit=d.kdunit AND c.kdprogram=d.kdprogram
                                        LEFT JOIN d_item_output b ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND  b.nosasprog =c.nosasprog  
                                        LEFT JOIN d_kmpnen AS e ON e.kddept=b.kddept AND e.kdunit=b.kdunit AND e.kdprogram=b.kdprogram AND e.kdgiat=b.kdgiat AND e.kdoutput=b.kdoutput
                                        LEFT JOIN d_lok AS a ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput AND a.kdkmpnen=e.kdkmpnen 
                                        WHERE d.kddept='$kd_skpd' AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') AND a.kdkmpnen <>'' and a.kdprop <>''  GROUP BY d.`kdprogram`
                                        ";
                                //$sql3="SELECT a.kdprogram,d.nmprogram,d.status,SUM(a.rupiah) AS rupiah,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
//                                        SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn
//                                        FROM d_lok a INNER JOIN t_program d ON a.kddept=d.kddept AND a.kdprogram=d.kdprogram
//                                        INNER JOIN `d_item_output` b ON a.kddept=b.kddept AND a.kdprogram=a.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput =b.kdoutput
//                                         WHERE a.kddept='$kd_skpd' AND b.nosasprog<>'' GROUP BY  a.kdprogram ";
                                        $query3 = $this->db->query($sql3);
                                        $trupiah= 0 ;//number_format($rp+$pend,"1",",",".");
                                        $tphlnpdn= 0 ;//number_format($pln+$hibah+$pdn,"1",",",".");
                                        $tpnbpblu= 0 ;//number_format($pnbp+$blu,"1",",",".");
                                        $tsbsn= 0 ;//number_format($row3->sbsn,"1",",",".");
                                        $tjumlah16 =0; 
                                        $tjumlah17 =0;
                                        $tjumlah18 =0;
                                        $tjumlah19 =0;                                
                                        foreach ($query3->result() as $row3)
                                        {
                                            $kdprogram=$row3->kdprogram;
                                            $nmprogram=$row3->nmprogram;
                                            $sta=$row3->status;
                                            $rp=$row3->rupiah;
                                            $pln=$row3->pln;
                                            $pdn=$row3->pdn;
                                            $hibah=$row3->hibah;
                                            $pend=$row3->pend;
                                            $pnbp=$row3->pnbp;
                                            $blu=$row3->blu;
                                            $sbsn1=$row3->sbsn;
                                            $jmal=$rp+$pend+$pln+$hibah+$pdn+$pnbp+$blu+$sbsn1;
                                            $trupiah= $trupiah+$rp+$pend ;
                                            $tphlnpdn= $tphlnpdn+$pln+$hibah+$pdn;
                                            $tpnbpblu= $tpnbpblu+$pnbp+$blu;
                                            $tsbsn= $tsbsn + $sbsn1;
                                            $tjumlah16 =$tjumlah16 + $jmal; 
                                            $rupiah=number_format($rp+$pend,"1",",",".");
                                            $phlnpdn=number_format($pln+$hibah+$pdn,"1",",",".");
                                            $pnbpblu=number_format($pnbp+$blu,"1",",",".");
                                            $sbsn=number_format($row3->sbsn,"1",",",".");
                                            $jumlah=number_format($rp+$pend+$pln+$hibah+$pdn+$pnbp+$blu+$sbsn1,"1",",",".");
                                                $sql31="SELECT SUM(harga2) AS a2017,SUM(harga3) AS a2018,SUM(harga4) AS a2019 FROM d_item_output 
                                                            WHERE kddept='$kd_skpd' AND kdprogram='$kdprogram'";
                                     
                                                             $query31 = $this->db->query($sql31);
                                                                                              
                                                            foreach ($query31->result() as $row31)
                                                            {
                                                                
                                                                $al17=$row31->a2017;
                                                                $tjumlah17 =$tjumlah17 + $al17; 
                                                                $al18=$row31->a2018;
                                                                $tjumlah18 =$tjumlah18 + $al18;
                                                                $al19=$row31->a2019;
                                                                $tjumlah19 =$tjumlah19 + $al19;
                                                                $al2017=number_format($row31->a2017,"1",",",".");
                                                                $al2018=number_format($row31->a2018,"1",",",".");
                                                                $al2019=number_format($row31->a2019,"1",",",".");
                                            
                                                               
                                                                 $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\">$kdprogram</td>                                     
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"36%\" align=\"left\">$nmprogram</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$rupiah</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$phlnpdn</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$pnbpblu</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$sbsn</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"7%\" align=\"right\">$jumlah</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$al2017</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$al2018</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$al2019</td>
                                                                              </tr>"; 
                                                              
                                            }
                                            
                                        }
                                        $sqlt3="SELECT SUM(a.rupiah) AS rupiah,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
                                                SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn,SUM(a.jumlah) AS jumlah FROM d_lok a 
                                                INNER JOIN `d_item_output` b ON a.kddept=b.kddept AND a.kdprogram=a.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput =b.kdoutput 
                                                INNER JOIN `d_sasaran_prog` c ON b.kddept=c.kddept AND b.kdprogram=c.kdprogram AND  b.nosasprog =c.nosasprog
                                                WHERE a.kddept='$kd_skpd' AND b.nosasprog<>'' AND c.nosasstra<>'' ";
                 
                                         $queryt3 = $this->db->query($sqlt3);
                                                                          
                                       // foreach ($queryt3->result() as $rowt3)
//                                        {
//                                            $trp=$rowt3->rupiah;
//                                            $tpln=$rowt3->pln;
//                                            $tpdn=$rowt3->pdn;
//                                            $thibah=$row3->hibah;
//                                            $tpend=$row3->pend;
//                                            $tpnbp=$rowt3->pnbp;
//                                            $tblu=$rowt3->blu;
//                                            $tsbsn1=$rowt3->sbsn;
//                                            $tjml2=$trp+$tpend+$tpln+$tpdn+$thibah+$tpnbp+$tblu+$tsbsn1;
//                                            $trupiah=number_format($trp+$tpend,"1",",",".");
//                                            $tphlnpdn=number_format($tpln+$tpdn+$thibah,"1",",",".");
//                                            $tpnbpblu=number_format($tpnbp+$tblu,"1",",",".");
//                                            $tsbsn=number_format($rowt3->sbsn,"1",",",".");
//                                            $tjumlah=number_format($tjml2,"1",",",".");
                                            //$sqlt31="SELECT SUM(harga2) AS a2017,SUM(harga3) AS a2018,SUM(harga4) AS a2019 FROM d_item_output 
//                                                     WHERE kddept='$kd_skpd'";
//                             
//                                                     $queryt31 = $this->db->query($sqlt31);
//                                                                                      
//                                                    foreach ($queryt31->result() as $rowt31)
//                                                    {
//                                                       
//                                                        $tal2017=number_format($rowt31->a2017,"1",",",".");
//                                                        $tal2018=number_format($rowt31->a2018,"1",",",".");
//                                                        $tal2019=number_format($rowt31->a2019,"1",",",".");
                                                        $cRet    .= " <tr>                                     
                                                                          <td colspan=\"2\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"55%\" bgcolor=\"#90EE90\" align=\"center\"><b>Jumlah</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($trupiah,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tphlnpdn,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tpnbpblu,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tsbsn,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"7%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah16,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah17,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah18,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah19,"1",",",".")."</b></td>
                                                                      </tr>";
                                                    //}
                                        //}
                                
                                $cRet .=       " </table>";
                                $tg=date('Y-m-d'); 
                                $tgl= $this->rka_model->tanggal_format_indonesia($tg);
                                $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">&nbsp;</td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\"></td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">Jakarta,$tgl</td>                         
                                </tr>
                                 <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">a/n Menteri/ Kepala Lembaga</strong></td>                         
                                </tr>
                                 <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">$jabatan</td>                         
                                </tr>
                                 <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">&nbsp;</td>                         
                                </tr>
                                 <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">&nbsp;</td>                         
                                </tr>
                                 <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" ></td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">$nama</td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" ></td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">NIP: $nip</td>                         
                                </tr>
                               
                                
                              </table>";   
        $data['prev']= $cRet; 
        $judul='umum';   
        switch($ct) {       
        case 1;
        //header("Cache-Control: no-cache, no-store, must-revalidate");
            echo($cRet);
            //$this->load->view('anggaran/rka/bappenas', $data);
        break;
        case 2;
            $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        case 4;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        } 
        
                
    }
    function cetak_f2()
    	{
    		
            $data['page_title']= 'BAPPENAS';
            $this->template->set('title', 'BAPPENAS');          
            $this->template->load('template','anggaran/rka/cetak_f2',$data) ; 
            //$this->load->view('anggaran/rka/tambah_rka',$data) ;
       }
       
    function cetak_f2_unit()
    	{
    		
            $data['page_title']= 'BAPPENAS';
            $this->template->set('title', 'BAPPENAS');          
            $this->template->load('template','anggaran/rka/cetak_f2_unit',$data) ; 
            //$this->load->view('anggaran/rka/tambah_rka',$data) ;
       }
    function preview_f2($ct='2',$prog='01',$cnama='',$cnip='',$cjabatan=''){
            
            $kd_skpd = $this->session->userdata('kdskpd');
            $unit= $this->session->userdata('esselon1');
            $thn_ang = $this->session->userdata('pcThang');
            $nama1 = str_replace('123456789',' ',$cnama);
            $nama = str_replace('jj',',',$nama1);
            $jabatan1 = str_replace('kk',' ',$cjabatan);
            $jabatan = str_replace('qq',',',$jabatan1);
            $nip = str_replace('123456789',' ',$cnip);
            $sqldns="select * from t_dept   WHERE kddept='$kd_skpd'";
                 $sqlskpd=$this->db->query($sqldns);
                 foreach ($sqlskpd->result() as $rowdns)
                {
                   
                    $kd_dept = $rowdns->kddept;
                    $nm_dept  = $rowdns->nmdept;
                }
            
            $thn_ang_2= $thn_ang+1;
            $thn_ang_3= $thn_ang+2;
            $thn_ang_4= $thn_ang+3;
            $thn_ang_5= $thn_ang+4;
            $cRet='';
                     $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                <tr>
                                     <td align=\"center\"  style=\"font-size:20px\" colspan=\"3\"><strong>FORMULIR 2</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" colspan=\"3\"><strong>RENCANA KERJA KEMENTRIAN/LEMBAGA (RENJA-KL)</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" colspan=\"3\"><strong>TAHUN ANGGARAN $thn_ang_2</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" colspan=\"3\">&nbsp;</td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" >&nbsp;</td>                         
                                </tr>
                               
                              </table>"; 
                   
                    
                   
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">";
                                 $sqldns="select * from t_dept   WHERE kddept='$kd_skpd'";
                                         $sqlskpd=$this->db->query($sqldns);
                                         foreach ($sqlskpd->result() as $rowdns)
                                        {
                                           
                                            $kd_dept = $rowdns->kddept;
                                            $nm_dept  = $rowdns->nmdept;
                                            $cRet    .= " <tr><td style=font-size:14px width=\"25%\" align=\"left\"><strong><b>1. Kementrian/Lembaga</b></strong></td>                                     
                                                            <td style=font-size:14px width=\"1%\">:</td>                                    
                                                            <td style=font-size:14px width=\"74%\">$nm_dept</td></tr>";
                                        }
                                 
                                 
                                 $sql1="SELECT DISTINCT a.nosasstra,b.nama as nmsasstra FROM d_sasaran_prog a INNER JOIN d_sasarankl b ON a.kddept=b.kddept AND a.nosasstra=b.nomor
                                  WHERE a.kddept='$kd_skpd'  AND a.kdprogram='$prog' AND a.kdunit='$unit' AND nosasstra IN (SELECT nomor FROM d_sasarankl WHERE a.kddept='$kd_skpd')";
                 
                                         $query1 = $this->db->query($sql1);
                                        $i=0;                                  
                                        foreach ($query1->result() as $row1)
                                        {
                                            $i=$i+1;
                                            $nosasstra=$row1->nosasstra;
                                            $nmsasstra=$row1->nmsasstra;
                                            if($i==1){
                                                $cRet    .= " <tr><td style=font-size:14px width=\"25%\" align=\"left\"><strong><b>2. Sasaran Strategis</b></strong></td>                                     
                                                            <td style=font-size:14px width=\"1%\">:</td>                                    
                                                            <td style=font-size:14px width=\"74%\">$i.$nmsasstra</td></tr>";
                                            }else{
                                                $cRet    .= " <tr><td style=font-size:14px width=\"25%\" align=\"left\"></td>                                     
                                                            <td style=font-size:14px width=\"1%\"></td>                                    
                                                            <td style=font-size:14px width=\"74%\">$i.$nmsasstra</td></tr>";
                                            }
                                            
                                        }
                                        $sql="SELECT a.kddept,a.kdunit,b.nmunit,a.kdprogram,a.nmprogram FROM t_program a INNER JOIN t_unit b ON a.kddept=b.kddept AND 
                                              a.kdunit=b.kdunit WHERE a.kddept='$kd_skpd'AND a.kdprogram='$prog' and a.kdunit='$unit'";
                 
                                         $query = $this->db->query($sql);
                                        $j=0;                                  
                                        foreach ($query->result() as $row)
                                        {
                                            $j=$j+1;
                                            $kdunit=$row->kdunit;
                                            $nmunit=$row->nmunit;
                                            $kdprogram=$row->kdprogram;
                                            $nmprogram=$row->nmprogram;
                                            if($j==1){
                                            $cRet    .= " <tr><td style=font-size:14px width=\"25%\" align=\"left\"><strong><b>3. Program</b></strong></td>                                     
                                                            <td style=font-size:14px width=\"1%\">:</td>                                    
                                                            <td style=font-size:14px width=\"74%\">$nmprogram</td></tr>
                                                          <tr><td style=font-size:14px width=\"25%\" align=\"left\"><strong><b>4. Unit Organisasi</b></strong></td>                                     
                                                            <td style=font-size:14px width=\"1%\">:</td>                                    
                                                            <td style=font-size:14px width=\"74%\">$nmunit</td></tr>";
                                            }else{
                                            $cRet    .= " <tr><td style=font-size:14px width=\"25%\" align=\"left\"></td>                                     
                                                            <td style=font-size:14px width=\"1%\"></td>                                    
                                                            <td style=font-size:14px width=\"74%\"></td></tr>
                                                          <tr><td style=font-size:14px width=\"25%\" align=\"left\"></td>                                     
                                                            <td style=font-size:14px width=\"1%\">:</td>                                    
                                                            <td style=font-size:14px width=\"74%\">$nmunit</td></tr>";    
                                            }
                                        }                                        
                                
                                $cRet .=       " </table>"; 
                    
                    
                    $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                <tr>
                                     <td align=\"left\" style=\"font-size:14px\" colspan=\"3\"><strong><b>5. Sasaran Program(Outcome) dan Indikator Kinerja Program(IKP)</b></strong></td>                         
                                </tr>
                                
                              </table>";         
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>NO</b></td>
                                        <td width=\"40%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Sasaran Program</b></td>
                                        <td width=\"35%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Indikator Sasaran Program</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Target 2016</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Alokasi 2016(Juta)</b></td>
                                      </tr> 
                                      
                                     
                                 </thead>  ";
                                 //$sqlsaskl="select nosasprog,nmsasprog from d_sasaran_prog where kddept='$kd_skpd' AND kdprogram='$prog'";
//                                 $querysaskl= $this->db->query($sqlsaskl);
//                                 $tsasprog=0;
//                                 foreach ($querysaskl->result() as $rowsaskl)
//                                        {
//                                         $kdsasprog= $rowsaskl->nosasprog; 
//                                         $nmsasprog= $rowsaskl->nmsasprog;
                                         $sql2="SELECT c.nosasprog,c.nmsasprog,SUM(a.rupiah) AS rupiah,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
                                                SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn,SUM(a.jumlah) AS jumlah FROM d_sasaran_prog c
                                                LEFT JOIN d_item_output b ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND b.nosasprog=c.nosasprog
                                                LEFT JOIN d_kmpnen AS e ON e.kddept=b.kddept AND e.kdunit=b.kdunit AND e.kdprogram=b.kdprogram AND e.kdgiat=b.kdgiat AND e.kdoutput=b.kdoutput
                                                LEFT JOIN d_lok AS a ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput AND a.kdkmpnen=e.kdkmpnen
                                                WHERE c.kddept='$kd_skpd' AND c.kdprogram='$prog' AND c.kdunit='$unit' AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') AND a.kdkmpnen <>'' AND a.kdprop <>'' GROUP BY c.nosasprog
                                                 ";
                     
                                         $query2 = $this->db->query($sql2);
                                            $tsasprog=0;                                  
                                            foreach ($query2->result() as $row2)
                                            {
                                                $kdsasprog= $row2->nosasprog; 
                                                $nmsasprog= $row2->nmsasprog;
                                                $xtrp=$row2->rupiah;
                                                $xtpln=$row2->pln;
                                                $xtpdn=$row2->pdn;
                                                $xthibah=$row2->hibah;
                                                $xtpend=$row2->pend;
                                                $xtpnbp=$row2->pnbp;
                                                $xtblu=$row2->blu;
                                                $xtsbsn1=$row2->sbsn;
                                                $xtjml2=$xtrp+$xtpend+$xtpln+$xtpdn+$xthibah+$xtpnbp+$xtblu+$xtsbsn1;
                                                $calokasi=$xtjml2;
                                                $tsasprog=$tsasprog+$calokasi;
                                                $alokasi=number_format($xtjml2,"1",",",".");
                                               
                                                $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\">$kdsasprog</td>                                     
                                                                <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"40%\"align=\"left\">$nmsasprog</td>
                                                                <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"35%\">&nbsp;</td>
                                                                <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"center\"></td>
                                                                <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$alokasi</td></tr>";    
                                                
                                                
                                                $sql21="SELECT * from d_indikator_prog where kddept='$kd_skpd' and kdprogram='$prog' and nosasprog='$kdsasprog'";
                         
                                                 $query21 = $this->db->query($sql21);
                                                                                  
                                                foreach ($query21->result() as $row21)
                                                {
                                                    $indikator_prog=$row21->uraian;
                                                    $vol1=$row21->vol1;
                                                    $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\">&nbsp;</td>                                     
                                                                    <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"40%\"align=\"left\">&nbsp;</td>
                                                                    <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"35%\">$indikator_prog</td>
                                                                    <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"center\">$vol1</td>
                                                                    <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\"></td></tr>";
                                                }
                                            }
                                        //}
                                 
                                       
                                            
                                            $cRet    .= " <tr><td colspan=\"4\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"90%\" bgcolor=\"#90EE90\" align=\"center\" ><b>Jumlah</b></td>  
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tsasprog,"1",",",".")."</b></td></tr>";    
                                            
                                
                                $cRet .=       " </table>";
                    $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                <tr>
                                     <td align=\"left\" style=\"font-size:14px\" colspan=\"3\"><strong><b>6. Kegiatan dan Pendanaan</b></strong></td>                         
                                </tr>
                                
                              </table>";  
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>Kode</b></td>
                                        <td width=\"36%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>Kegiatan</b></td>
                                        <td width=\"32%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" colspan=\"5\"><b>Indikasi Pendanaan Tahun 2016</b></td>
                                        <td width=\"18%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" colspan=\"3\"><b>Prakiraan Kebutuhan(Juta)</b></td>
                                        
                                      </tr> 
                                      <tr>  
                                        <td width=\"6%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>Rupiah</b></td>
                                        <td width=\"6%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>PHLN+PDN</b></td>
                                        <td width=\"6%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>PNBP+BLU</b></td>
                                        <td width=\"6%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>SBSN</b></td>
                                        <td width=\"7%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>Jumlah</b></td>
                                        <td width=\"6%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>2017</b></td>
                                        <td width=\"6%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>2018</b></td>
                                        <td width=\"6%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>2019</b></td>
                                      </tr> 
                                     
                                 </thead> ";
                                 $sql3="SELECT f.kdgiat,f.nmgiat,SUM(z.rupiah) AS rupiah,SUM(z.pend) AS pend,SUM(z.pln) AS pln,SUM(z.hibah) AS hibah,SUM(z.pdn) AS pdn,
                                        SUM(z.pnbp) AS pnbp,SUM(z.blu) AS blu,SUM(z.sbsn) AS sbsn FROM t_giat f 
                                        LEFT JOIN (
                                        SELECT a.kddept,a.kdunit,a.kdprogram,a.kdgiat,a.kdoutput,b.nosasprog,c.nosasstra,a.rupiah AS rupiah,a.pnbp AS pnbp,a.blu AS blu,a.pln AS pln,a.pdn AS pdn,
                                        hibah AS hibah,pend AS pend,a.sbsn AS sbsn FROM d_lok a 
                                        INNER JOIN d_kmpnen e ON a.kddept=e.kddept AND a.kdunit=e.kdunit AND a.kdprogram=e.kdprogram AND a.kdgiat=e.kdgiat AND a.kdoutput=e.kdoutput AND a.kdkmpnen=e.kdkmpnen
                                        INNER JOIN d_item_output b ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput
                                        INNER JOIN d_sasaran_prog c ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND b.nosasprog=c.nosasprog
                                        WHERE a.kddept='$kd_skpd' AND a.kdprogram='$prog' and a.kdunit='$unit' AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') AND a.kdkmpnen <>'' and a.kdprop <>'')z ON f.kddept=z.kddept AND f.kdunit=z.kdunit AND f.kdprogram=z.kdprogram AND f.kdgiat=z.kdgiat
                                        WHERE f.kddept='$kd_skpd' AND f.kdprogram='$prog' and f.kdunit='$unit'
                                        GROUP BY  f.kddept,f.kdunit,f.kdprogram,f.kdgiat";
                                //$sql3="SELECT a.kdgiat,d.nmgiat,SUM(a.rupiah) AS rupiah,SUM(pend) AS pend,SUM(a.pln) AS pln,SUM(hibah) AS hibah,SUM(a.pdn) AS pdn,
//                                        SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.sbsn) AS sbsn,SUM(a.jumlah) AS jumlah
//                                        FROM d_lok a INNER JOIN t_giat d ON a.kddept=d.kddept AND a.kdunit=d.kdunit AND a.kdprogram=d.kdprogram AND a.kdgiat=d.kdgiat 
//                                        INNER JOIN `d_item_output` b ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput =b.kdoutput 
//                                        INNER JOIN `d_sasaran_prog` c ON b.kddept=c.kddept AND a.kdunit=b.kdunit AND b.kdprogram=c.kdprogram AND  b.nosasprog =c.nosasprog 
//                                        WHERE b.kddept='$kd_skpd' AND a.kdprogram='$prog' GROUP BY  a.kdgiat ";
                                        $query3 = $this->db->query($sql3);
                                        $tzrp=0;
                                        $tzphln=0;
                                        $tzpnbp=0;
                                        $tzsbsn=0;
                                        $tjumlah17 =0;
                                        $tjumlah18 =0;
                                        $tjumlah19 =0;                                  
                                        foreach ($query3->result() as $row3)
                                        {
                                            $kdgiat=$row3->kdgiat;
                                            $nmgiat=$row3->nmgiat;
                                            $yrp=$row3->rupiah;
                                            $ypln=$row3->pln;
                                            $ypdn=$row3->pdn;
                                            $yhibah=$row3->hibah;
                                            $ypend=$row3->pend;
                                            $ypnbp=$row3->pnbp;
                                            $yblu=$row3->blu;
                                            $ysbsn1=$row3->sbsn;
                                            $tzrp=$tzrp+$yrp+$ypend;
                                            $tzphln=$tzphln+$ypln+$yhibah+$ypdn;
                                            $tzpnbp=$tzpnbp+$ypnbp+$yblu;
                                            $tzsbsn=$tzsbsn+$ysbsn1;
                                            $yjml=$yrp+$ypln+$ypdn+$yhibah+$ypend+$ypnbp+$yblu+$ysbsn1;
                                            $rupiah=number_format($yrp+$ypend,"1",",",".");
                                            $phlnpdn=number_format($ypln+$yhibah+$ypdn,"1",",",".");
                                            $pnbpblu=number_format($ypnbp+$yblu,"1",",",".");
                                            $sbsn=number_format($row3->sbsn,"1",",",".");
                                            $jumlah=number_format($yjml,"1",",",".");
                                                    $sql31="SELECT SUM(harga2) AS a2017,SUM(harga3) AS a2018,SUM(harga4) AS a2019 FROM d_item_output 
                                                            WHERE kddept='$kd_skpd' AND kdprogram='$prog' and kdgiat='$kdgiat' ";
                                     
                                                             $query31 = $this->db->query($sql31);
                                                                                              
                                                            foreach ($query31->result() as $row31)
                                                            {
                                                                $al17=$row31->a2017;
                                                                $tjumlah17 =$tjumlah17 + $al17; 
                                                                $al18=$row31->a2018;
                                                                $tjumlah18 =$tjumlah18 + $al18;
                                                                $al19=$row31->a2019;
                                                                $tjumlah19 =$tjumlah19 + $al19;
                                                                $al2017=number_format($row31->a2017,"1",",",".");
                                                                $al2018=number_format($row31->a2018,"1",",",".");
                                                                $al2019=number_format($row31->a2019,"1",",",".");
                                                                $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"center\">$kdgiat</td>                                     
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"36%\" align=\"left\">$nmgiat</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$rupiah</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$phlnpdn</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$pnbpblu</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\">$sbsn</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"7%\" align=\"right\">$jumlah</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$al2017</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$al2018</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$al2019</td>
                                                                              </tr>";
                                                            }
                                        }
                                       // $sqlt3="select SUM(a.rupiah) AS rupiah,SUM(pend) AS pend,SUM(a.pln) AS pln,SUM(hibah) AS hibah,SUM(a.pdn) AS pdn,
//                                                SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.sbsn) AS sbsn,SUM(a.jumlah) AS jumlah
//                                                FROM d_lok a INNER JOIN `d_item_output` b ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=a.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput =b.kdoutput 
//                                                INNER JOIN `d_sasaran_prog` c ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND  b.nosasprog =c.nosasprog 
//                                                WHERE a.kddept='$kd_skpd' AND a.kdprogram='$prog'  ";
//                 
//                                         $queryt3 = $this->db->query($sqlt3);
//                                                                          
//                                        foreach ($queryt3->result() as $rowt3)
//                                        {
//                                           
//                                            $ztrp=$rowt3->rupiah;
//                                            $ztpln=$rowt3->pln;
//                                            $ztpdn=$rowt3->pdn;
//                                            $zthibah=$rowt3->hibah;
//                                            $ztpend=$rowt3->pend;
//                                            $ztpnbp=$rowt3->pnbp;
//                                            $ztblu=$rowt3->blu;
//                                            $ztsbsn1=$rowt3->sbsn;
//                                            $ztjml=$ztrp+$ztpln+$ztpdn+$zthibah+$ztpend+$ztpnbp+$ztblu+$ztsbsn1;
//                                            $trupiah=number_format($ztrp+$ztpend,"1",",",".");
//                                            $tphlnpdn=number_format($ztpln+$ztpdn+$zthibah,"1",",",".");
//                                            $tpnbpblu=number_format($ztpnbp+$ztblu,"1",",",".");
//                                            $tsbsn=number_format($rowt3->sbsn,"1",",",".");
//                                            $tjumlah=number_format($ztjml,"1",",",".");
                                            //$sqlt31="SELECT SUM(harga2) AS a2017,SUM(harga3) AS a2018,SUM(harga4) AS a2019 FROM d_item_output 
//                                                     WHERE kddept='$kd_skpd' AND kdprogram='$prog'   ";
//                             
//                                                     $queryt31 = $this->db->query($sqlt31);
//                                                                                      
//                                                    foreach ($queryt31->result() as $rowt31)
//                                                    {
//                                                       
//                                                        $tal2017=number_format($rowt31->a2017,"1",",",".");
//                                                        $tal2018=number_format($rowt31->a2018,"1",",",".");
//                                                        $tal2019=number_format($rowt31->a2019,"1",",",".");
                                                        $cRet    .= " <tr>                                     
                                                                          <td colspan=\"2\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"42%\" bgcolor=\"#90EE90\" align=\"center\"><b>Jumlah</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tzrp,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tzphln,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tzpnbp,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tzsbsn,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"7%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tzrp+$tzphln+$tzpnbp+$tzsbsn,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah17,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah18,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah19,"1",",",".")."</b></td>
                                                                      </tr>";
                                                    //}
                                        //}
                                $cRet .=       " </table>";
                                $tg=date('Y-m-d'); 
                                $tgl= $this->rka_model->tanggal_format_indonesia($tg);
                                $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">&nbsp;</td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\"></td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">Jakarta,$tgl</td>                         
                                </tr>
                                 <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">a/n Menteri/ Kepala Lembaga</strong></td>                         
                                </tr>
                                 <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">$jabatan</td>                         
                                </tr>
                                 <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">&nbsp;</td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">&nbsp;</td>                         
                                </tr>
                                 <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" ></td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">$nama</td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" ></td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">NIP:$nip</td>                         
                                </tr>
                               
                                
                              </table>";
                                
        $data['prev']= $cRet; 
        $judul='umum';   
        switch($ct) {       
        case 1;
            echo($cRet);
            //$this->template->load('template','master/kegiatan/cetak1',$data);
        break;
        case 2;
            $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        case 4;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        } 
        
                
    }
    
    function cetak_f3()
    	{
    		
            $data['page_title']= 'BAPPENAS';
            $this->template->set('title', 'BAPPENAS');          
            $this->template->load('template','anggaran/rka/cetak_f3',$data) ; 
            //$this->load->view('anggaran/rka/tambah_rka',$data) ;
       }
       
    function cetak_f3_unit()
    	{
    		
            $data['page_title']= 'BAPPENAS';
            $this->template->set('title', 'BAPPENAS');          
            $this->template->load('template','anggaran/rka/cetak_f3_unit',$data) ; 
            //$this->load->view('anggaran/rka/tambah_rka',$data) ;
       }
    function preview_f3($ct='2',$prog='01',$giat='2379',$cnama='',$cnip='',$cjabatan=''){
            
            $kd_skpd = $this->session->userdata('kdskpd');
            $thn_ang = $this->session->userdata('pcThang');
            $nama1 = str_replace('123456789',' ',$cnama);
            $nama = str_replace('jj',',',$nama1);
            $jabatan1 = str_replace('kk',' ',$cjabatan);
            $jabatan = str_replace('qq',',',$jabatan1);
            $nip = str_replace('123456789',' ',$cnip);
            $sqldns="select * from t_dept   WHERE kddept='$kd_skpd'";
                 $sqlskpd=$this->db->query($sqldns);
                 foreach ($sqlskpd->result() as $rowdns)
                {
                   
                    $kd_dept = $rowdns->kddept;
                    $nm_dept  = $rowdns->nmdept;
                }
            
            $thn_ang_2= $thn_ang+1;
            $thn_ang_3= $thn_ang+2;
            $thn_ang_4= $thn_ang+3;
            $thn_ang_5= $thn_ang+4;
            $cRet='';
                     $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                <tr>
                                     <td align=\"center\"  style=\"font-size:20px\" colspan=\"3\"><strong>FORMULIR 3</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" colspan=\"3\"><strong>RENCANA KERJA KEMENTRIAN/LEMBAGA (RENJA-KL)</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" colspan=\"3\"><strong>TAHUN ANGGARAN $thn_ang_2</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" colspan=\"3\">&nbsp;</td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" >&nbsp;</td>                         
                                </tr>
                                
                              </table>"; 
                   
                    
                   $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">";
                                        
                                        $cRet    .= " <tr><td style=font-size:14px width=\"25%\" align=\"left\"><strong><b>1. Kementrian/Lembaga</b></strong></td>                                     
                                                            <td style=font-size:14px width=\"1%\">:</td>                                    
                                                            <td style=font-size:14px width=\"74%\">$nm_dept</td></tr>";
                                        $sql="SELECT DISTINCT a.kdprogram,a.nmprogram FROM t_program a INNER JOIN t_unit b ON a.kddept=b.kddept AND 
                                              a.kdunit=b.kdunit WHERE a.kddept='$kd_skpd'AND a.kdprogram='$prog'";
                 
                                         $query = $this->db->query($sql);
                                                                          
                                        foreach ($query->result() as $row)
                                        {
                                            
                                            $kdprogram=$row->kdprogram;
                                            $nmprogram=$row->nmprogram;
                                            $cRet    .= " <tr><td style=font-size:14px width=\"25%\" align=\"left\"><strong><b>2. Program</b></strong></td>                                     
                                                            <td style=font-size:14px width=\"1%\">:</td>                                    
                                                            <td style=font-size:14px width=\"74%\">$nmprogram</td></tr>";
                                        }
                                        $sql1="SELECT DISTINCT a.nosasprog,b.nmsasprog FROM d_item_output a INNER JOIN d_sasaran_prog b
                                               ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.nosasprog=b.nosasprog 
                                               WHERE a.kddept='$kd_skpd'  AND a.kdprogram='$prog' and a.kdgiat='$giat' ";
                 
                                         $query1 = $this->db->query($sql1);
                                        $i=0;                                  
                                        foreach ($query1->result() as $row1)
                                        {
                                            $i=$i+1;
                                            $nosasprog=$row1->nosasprog;
                                            $nmsasprog=$row1->nmsasprog;
                                            if($i==1){
                                                $cRet    .= " <tr><td style=font-size:14px width=\"25%\" align=\"left\"><strong><b>3. Sasaran Program</b></strong></td>                                     
                                                            <td style=font-size:14px width=\"1%\">:</td>                                    
                                                            <td style=font-size:14px width=\"74%\">$i.$nmsasprog</td></tr>";
                                            }else{
                                                $cRet    .= " <tr><td style=font-size:14px width=\"25%\" align=\"left\"></td>                                     
                                                            <td style=font-size:14px width=\"1%\"></td>                                    
                                                            <td style=font-size:14px width=\"74%\">$i.$nmsasprog</td></tr>";
                                            }
                                            
                                        }
                                         $sql="SELECT a.kdgiat,a.nmgiat FROM t_giat a WHERE a.kddept='$kd_skpd'AND a.kdprogram='$prog' and a.kdgiat='$giat'";
                 
                                         $query = $this->db->query($sql);
                                                                          
                                        foreach ($query->result() as $row)
                                        {
                                            
                                            $kdgiat=$row->kdgiat;
                                            $nmgiat=$row->nmgiat;
                                            $cRet    .= " <tr><td style=font-size:14px width=\"25%\" align=\"left\"><strong><b>4. Kegiatan</b></strong></td>                                     
                                                            <td style=font-size:14px width=\"1%\">:</td>                                    
                                                            <td style=font-size:14px width=\"74%\">$nmgiat</td>
                                                          </tr>
                                                          ";
                                        }
                                         $sqlq="SELECT a.kddit,b.nmdit,a.kdgiat,a.nmgiat FROM t_giat a INNER JOIN t_dit b ON a.kddept=b.kddept AND 
                                              a.kdunit=b.kdunit and a.kddit=b.kddit WHERE a.kddept='$kd_skpd'AND a.kdprogram='$prog' and a.kdgiat='$giat'";
                 
                                         $queryq = $this->db->query($sqlq);
                                        $h=0;                                  
                                        foreach ($queryq->result() as $rowq)
                                        {
                                            $kdunit=$rowq->kddit;
                                            $nmunit=$rowq->nmdit;
                                             $h=$h+1;
                                             if($h==1){
                                                $cRet    .= "
                                                          <tr><td style=font-size:14px width=\"25%\" align=\"left\"><strong><b>5. Unit Organisasi</b></strong></td>                                     
                                                            <td style=font-size:14px width=\"1%\">:</td>                                    
                                                            <td style=font-size:14px width=\"74%\">$nmunit</td>
                                                          </tr>";
                                             }else{
                                                $cRet    .= "
                                                          <tr><td style=font-size:14px width=\"25%\" align=\"left\"><strong><b></b></strong></td>                                     
                                                            <td style=font-size:14px width=\"1%\"></td>                                    
                                                            <td style=font-size:14px width=\"74%\">$nmunit</td>
                                                          </tr>";
                                             }
                                        }
                    $cRet .=       " </table>"; 
                     
                    
                    
                    $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                <tr>
                                     <td align=\"left\" style=\"font-size:14px\" colspan=\"3\"><strong><b>6. Sasaran Kegiatan(Output) dan Pendanaannya</b></strong></td>                         
                                </tr>
                                
                              </table>";         
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>NO</b></td>
                                        <td width=\"25%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Sasaran Kegiatan(Output)</b></td>
                                        <td width=\"20%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Indikator Kinerja Kegiatan</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Target 2016</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Alokasi 2016(Juta)</b></td>
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Dimensi</b></td>
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Bidang</b></td>
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Nawacita</b></td>
                                        <td width=\"15%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\"><b>Dukungan PPP/ARG/KSST/MPI/PPBAN </b></td>
                                      </tr> 
                                      
                                     
                                 </thead>  ";
                                 $sqlsasgiat="SELECT kdoutput,nmoutput,vol1 as vol,kddimensi AS dimensi,kdpbidang AS bidang,kdnwcita AS nawacita,
                                            IF(dppp='1','DPP','') AS dpp,IF(darg='1','ARG','') AS arg,IF(dksst='1','KSST','') AS ksst,IF(dmpi='1','MPI','') AS mpi,
                                            IF(ppban='1','PPBAN','') AS ppban,STATUS AS sta FROM d_item_output 
                                            WHERE  kddept='$kd_skpd' AND kdprogram='$prog' and kdgiat='$giat' order by kdoutput";
                                 $querysasgiat= $this->db->query($sqlsasgiat);
                                 $tsasgiat=0;
                                 foreach ($querysasgiat->result() as $rowsasgiat)
                                        {
                                         $kdoutput=$rowsasgiat->kdoutput;
                                         $nmoutput=$rowsasgiat->nmoutput;
                                         $target=$rowsasgiat->vol;
                                         $dimensi=$rowsasgiat->dimensi;
                                         $bidang=$rowsasgiat->bidang;
                                         $nawacita=$rowsasgiat->nawacita;
                                         $dpp=$rowsasgiat->dpp;
                                         $arg=$rowsasgiat->arg;
                                         $ksst=$rowsasgiat->ksst;
                                         $mpi=$rowsasgiat->mpi;
                                         $ppban=$rowsasgiat->ppban;
                                         $sta=$rowsasgiat->sta;
                                         $sql2="SELECT SUM(a.rupiah) AS rupiah,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,SUM(hibah) AS hibah,
                                                SUM(pend) AS pend,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.sbsn) AS sbsn
                                                FROM d_lok a
                                                INNER JOIN d_kmpnen e ON a.kddept=e.kddept AND a.kdunit=e.kdunit AND a.kdprogram=e.kdprogram AND a.kdgiat=e.kdgiat AND a.kdoutput=e.kdoutput AND a.kdkmpnen=e.kdkmpnen  
                                                INNER JOIN d_item_output b ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput
                                                INNER JOIN d_sasaran_prog c ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND b.nosasprog=c.nosasprog
                                                WHERE a.kddept='$kd_skpd' AND a.kdprogram='$prog' AND a.kdgiat='$giat' AND a.kdoutput='$kdoutput' AND c.nosasstra  IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') AND a.kdkmpnen <>'' and a.kdprop <>'' ";
                     
                                         $query2 = $this->db->query($sql2);
                                                                              
                                            foreach ($query2->result() as $row2)
                                            {
                                                
                                                $trp=$row2->rupiah;
                                                $tsbsn1=$row2->sbsn;
                                                $tpln=$row2->pln;
                                                $tpdn=$row2->pdn;
                                                $thibah=$row2->hibah;
                                                $tpend=$row2->pend;
                                                $tpnbp=$row2->pnbp;
                                                $tblu=$row2->blu;
                                                $tjml=$trp+$tpend+$tpln+$tpdn+$thibah+$tpnbp+$tblu+$tsbsn1;
                                                //$calokasi=$row2->alokasi;
                                                $tsasgiat=$tsasgiat+$tjml;
                                                $alokasi=number_format($tjml,"1",",",".");
                                                $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\">$kdoutput</td>                                     
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"25%\"align=\"left\">$nmoutput</td>
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"20%\">&nbsp;</td>
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"center\">$target</td>
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$alokasi</td>
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\">$dimensi</td>
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\">$bidang</td>
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\">$nawacita</td>
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"15%\" align=\"center\">$dpp-$arg-$ksst-$mpi-$ppban</td></tr>";
                                                            $sql21="SELECT * from d_indikator_output where kddept='$kd_skpd' and kdprogram='$prog' and kdgiat='$giat' and kdoutput='$kdoutput' order by nomor";
                     
                                                                 $query21 = $this->db->query($sql21);
                                                                                                  
                                                                foreach ($query21->result() as $row21)
                                                                {
                                                                    $indikator_kk=$row21->nama;
                                                                    $vol1=$row21->vol1;
                                                                    $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\">&nbsp;</td>                                     
                                                                                    <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"25%\"align=\"left\">&nbsp;</td>
                                                                                    <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"20%\">$indikator_kk</td>
                                                                                    <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"center\">$vol1</td>
                                                                                    <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\"></td>
                                                                                    <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\"></td>
                                                                                    <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\"></td>
                                                                                    <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\"></td>
                                                                                    <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"15%\" align=\"right\"></td></tr>";
                                                                }
                                            }
                                        }
                                
                                       
                                           
                                            $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"60%\" colspan=\"4\" bgcolor=\"#90EE90\" align=\"center\"><b>Jumlah</b></td> 
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tsasgiat,"1",",",".")."</b></td>
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"></td>
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"></td>
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"></td>
                                                            <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"15%\" bgcolor=\"#90EE90\" align=\"right\"></td></tr>";    
                                          
                                        
                                
                                $cRet .=       " </table>";
                    $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                <tr>
                                     <td align=\"left\" style=\"font-size:14px\" colspan=\"3\"><strong><b>7. Rincian Kegiatan</b></strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"left\" style=\"font-size:14px\" colspan=\"3\"><strong><b>A.Perhitungan Pendanaan(Tahun 2016 dan Prakiraan Maju)</b></strong></td>                         
                                </tr>
                                
                              </table>";  
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"3\"><b>No</b></td>
                                        <td width=\"35%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" colspan=\"2\" rowspan=\"3\"><b>Sasaran Kegiatan(Output)/Komponen</b></td>
                                        <td width=\"30%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" colspan=\"3\"><b>Tahun 2016</b></td>
                                        <td width=\"30%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" colspan=\"6\"><b>Prakiraan Maju</b></td>
                                        
                                      </tr> 
                                      <tr>  
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>volume</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>Satuan Biaya</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>Jumlah Alokasi (Juta Rupiah)</b></b></td>
                                        <td width=\"15%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" colspan=\"3\"><b>Volume</b></td>
                                        <td width=\"15%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" colspan=\"3\"><b>Jumlah Alokasi (Juta Rupiah)</b></td>                                        
                                      </tr> 
                                      <tr>  
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>2017</b></td>
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>2018</b></td>
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>2019</b></td>
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>2017</b></td>
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>2018</b></td>
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>2019</b></td>                                       
                                      </tr> 
                                     
                                 </thead> ";
                                $sql3="SELECT kdoutput,nmoutput,vol1 AS vol1,vol2 AS vol2,vol3 AS vol3,vol4 AS vol4,harga2 AS alokasi2,harga3 AS alokasi3,harga4 AS alokasi4,status as st FROM d_item_output 
                                         WHERE  kddept='$kd_skpd' AND kdprogram='$prog' and kdgiat='$giat' order by kdoutput";
                 
                                         $query3 = $this->db->query($sql3);
                                        $talo1 =0;
                                        $talo2 =0;
                                        $talo3 =0;
                                        $talo4 =0;                                 
                                        foreach ($query3->result() as $row3)
                                        {
                                            $kdout=$row3->kdoutput;
                                            $nmoute=$row3->nmoutput;
                                            $tar1=$row3->vol1;
                                            $tar2=$row3->vol2;
                                            $tar3=$row3->vol3;
                                            $tar4=$row3->vol4;
                                            $st=$row3->st;
                                            $talo2 =$talo2+$row3->alokasi2;
                                            $alo2=number_format($row3->alokasi2,"1",",",".");
                                            $talo3 =$talo3+$row3->alokasi3;
                                            $alo3=number_format($row3->alokasi3,"1",",",".");
                                            $talo4 =$talo4+$row3->alokasi4;
                                            $alo4=number_format($row3->alokasi4,"1",",",".");
                                            $sql311="SELECT SUM(a.rupiah) AS rupiah,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,SUM(hibah) AS hibah,
                                                    SUM(pend) AS pend,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.sbsn) AS sbsn,SUM(a.jumlah) AS jumlah
                                                    FROM d_lok a
                                                    INNER JOIN d_kmpnen e ON a.kddept=e.kddept AND a.kdunit=e.kdunit AND a.kdprogram=e.kdprogram AND a.kdgiat=e.kdgiat AND a.kdoutput=e.kdoutput AND a.kdkmpnen=e.kdkmpnen  
                                                    INNER JOIN d_item_output b ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput
                                                    INNER JOIN d_sasaran_prog c ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND b.nosasprog=c.nosasprog
                                                    WHERE a.kddept='$kd_skpd' AND a.kdprogram='$prog' AND a.kdgiat='$giat' AND a.kdoutput='$kdout' AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') AND a.kdkmpnen <>'' and a.kdprop <>'' ";
                                 
                                                     $query311 = $this->db->query($sql311);
                                                                                          
                                                        foreach ($query311->result() as $row311)
                                                        {
                                                         $atrp=$row311->rupiah;
                                                         $atsbsn1=$row311->sbsn;
                                                         $atpln=$row311->pln;
                                                         $atpdn=$row311->pdn;
                                                         $athibah=$row311->hibah;
                                                         $atpend=$row311->pend;
                                                         $atpnbp=$row311->pnbp;
                                                         $atblu=$row311->blu;
                                                         $atjml=$atrp+$atpend+$atpln+$atpdn+$athibah+$atpnbp+$atblu+$atsbsn1;
                                                         $talo1 =$talo1+$atjml;
                                                         $alo1=number_format($atjml,"1",",",".");
                                                         $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\">$kdout</td>                                     
                                                              <td colspan=\"2\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"35%\" align=\"left\">$nmoute</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"center\">$tar1</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"center\"></td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$alo1</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\">$tar2</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\">$tar3</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\">$tar4</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\">$alo2</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\">$alo3</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\">$alo4</td>
                                                          </tr>"; 
                                                          
                                                          
                                                          $sql31="SELECT a.kdkmpnen,b.urkmpnen,SUM(a.volume) AS volume, SUM(a.rupiah) AS rupiah,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,SUM(hibah) AS hibah,
                                                                SUM(pend) AS pend,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.sbsn) AS sbsn FROM d_lok a
                                                                INNER JOIN d_kmpnen b ON  a.kddept=b.kddept AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat  AND a.kdoutput=b.kdoutput AND a.kdkmpnen=b.kdkmpnen
                                                                INNER JOIN d_item_output c ON a.kddept=c.kddept AND a.kdunit=c.kdunit AND a.kdprogram=c.kdprogram AND a.kdgiat=c.kdgiat AND a.kdoutput=c.kdoutput
                                                                INNER JOIN d_sasaran_prog d ON c.kddept=d.kddept AND c.kdunit=d.kdunit AND c.kdprogram=d.kdprogram AND c.nosasprog=d.nosasprog
                                                                WHERE  a.kddept='$kd_skpd' AND a.kdprogram='$prog' AND a.kdgiat='$giat' AND a.kdoutput='$kdout' AND d.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') AND a.kdkmpnen <>'' and a.kdprop <>'' GROUP BY a.kdkmpnen,b.urkmpnen ORDER BY a.kdkmpnen,b.urkmpnen";
                                                                                                         
                                                                 $query31 = $this->db->query($sql31);
                                                                                                  
                                                                foreach ($query31->result() as $row31)
                                                                {
                                                                    $kdkmpnen=$row31->kdkmpnen;
                                                                    $nmkmpnen=$row31->urkmpnen;
                                                                    $volume=$row31->volume;
                                                                    $btrp=$row31->rupiah;
                                                                     $btsbsn1=$row31->sbsn;
                                                                     $btpln=$row31->pln;
                                                                     $btpdn=$row31->pdn;
                                                                     $bthibah=$row31->hibah;
                                                                     $btpend=$row31->pend;
                                                                     $btpnbp=$row31->pnbp;
                                                                     $btblu=$row31->blu;
                                                                     $btjml=$btrp+$btpend+$btpln+$btpdn+$bthibah+$btpnbp+$btblu+$btsbsn1;
                                                                    $sat=$btjml;
                                                                    $satuan=number_format($sat/$volume,"1",",",".");
                                                                    $klokasi=number_format($btjml,"1",",",".");
                                                                    
                                                                    $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\"></td>                                     
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-right:none;font-size:8px\" width=\"2%\" align=\"left\"></td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-left:none;font-size:8px\" width=\"33%\" align=\"left\"><i>$nmkmpnen</i></td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"center\">$volume</td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$satuan</td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$klokasi</td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\"></td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\"></td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\"></td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\"></td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\"></td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\"></td>
                                                                                  </tr>";    
                                                                    
                                                                    
                                                                                  
                                                                }      
                                                        }
                                            
                                                          
                                            }
                                            
                                             $sqlt3="SELECT sum(vol1) AS tvol1,sum(vol2) AS tvol2,sum(vol3) AS tvol3,sum(vol4) AS tvol4 FROM d_item_output 
                                                     WHERE  kddept='$kd_skpd' AND kdprogram='$prog' and kdgiat='$giat' ";
                             
                                                     $queryt3 = $this->db->query($sqlt3);
                                                                                      
                                                    foreach ($queryt3->result() as $rowt3)
                                                    {
                                                        $ttar1=$rowt3->tvol1;
                                                        $ttar2=$rowt3->tvol2;
                                                        $ttar3=$rowt3->tvol3;
                                                        $ttar4=$rowt3->tvol4;
                                                        
                                                        
                                                        $cRet    .= " <tr>                                     
                                                                          <td colspan=\"5\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"60%\" bgcolor=\"#90EE90\" align=\"center\"><b>Jumlah</td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($talo1,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"center\"><b>$ttar2</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"center\"><b>$ttar3</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"center\"><b>$ttar4</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($talo2,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($talo3,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($talo4,"1",",",".")."</b></td>
                                                                      </tr>";    
                                                        }
                                
                                $cRet .=       " </table>"; 
                    $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                
                                <tr>
                                     <td align=\"left\" style=\"font-size:14px\" colspan=\"3\"><strong><b>B. Sumber Pendanaan</b></strong></td>                         
                                </tr>
                                
                              </table>";  
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>No</b></td>
                                        <td width=\"30%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" colspan=\"2\" rowspan=\"2\"><b>Sasaran Kegiatan(Output)/Komponen</b></td>
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>Jenis Komponen (BAK/BLK)</b></td>
                                        <td width=\"50%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" colspan=\"5\"><b>Indikasi Pendanaan Tahun 2016 (Juta Rupiah)</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>Lokasi</b></td>
                                        
                                      </tr> 
                                      <tr>  
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>Rupiah</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>PHLN + PDN</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>PNBP + BLU</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>SBSN</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>Jumlah </b></td>                                        
                                      </tr> 
                                      
                                     
                                 </thead> ";
                                   $sql4="SELECT a.kdoutput,b.nmoutput,SUM(rupiah) AS rupiah,SUM(pln) AS pln,SUM(pdn) AS pdn,SUM(hibah) AS hibah, 
                                            SUM(pend) AS pend,SUM(pnbp) AS pnbp,SUM(blu) AS blu,SUM(sbsn) AS sbsn,SUM(jumlah) AS jml,'' AS sta1 FROM d_lok a
                                            INNER JOIN d_kmpnen e ON a.kddept=e.kddept AND a.kdunit=e.kdunit AND a.kdprogram=e.kdprogram AND a.kdgiat=e.kdgiat AND a.kdoutput=e.kdoutput AND a.kdkmpnen=e.kdkmpnen 
                                            INNER JOIN  d_item_output b ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput
                                            INNER JOIN d_sasaran_prog c ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND b.nosasprog=c.nosasprog
                                            WHERE  a.kddept='$kd_skpd' AND a.kdprogram='$prog' AND a.kdgiat='$giat' AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') AND a.kdkmpnen <>'' and a.kdprop <>'' GROUP BY a.kdoutput,b.nmoutput
                                            ";
                 
                                         $query4 = $this->db->query($sql4);
                                                                          
                                        foreach ($query4->result() as $row4)
                                        {
                                            $kdout1=$row4->kdoutput;
                                            $nmout1=$row4->nmoutput;
                                            $sta1=$row4->sta1;
                                            
                                            $rp=number_format($row4->rupiah+$row4->pend,"1",",",".");
                                            $pln=number_format($row4->pln + $row4->pdn+$row4->hibah,"1",",",".");
                                            $pnpb=number_format($row4->pnbp + $row4->blu,"1",",",".");
                                            $sbsn=number_format($row4->sbsn,"1",",",".");
                                            $jml=number_format($row4->rupiah+$row4->pend+$row4->pln + $row4->pdn+$row4->hibah+$row4->pnbp + $row4->blu+$row4->sbsn,"1",",",".");
                                            
                                            $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\">$kdout1</td>                                     
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"30%\" colspan=\"2\" align=\"left\">$nmout1</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\"></td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$rp</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$pln</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$pnpb</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$sbsn</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$jml</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\"></td>
                                                          </tr>";    
                                           
                                            
                                                          $sql41="SELECT a.kdkmpnen,b.urkmpnen,b.kdbiaya,SUM(rupiah) AS rupiah, SUM(pend) AS pend,SUM(pln) AS pln,SUM(hibah) AS hibah,SUM(pdn) AS pdn,SUM(pnbp) AS pnbp,SUM(blu) AS blu,SUM(sbsn) AS sbsn,SUM(jumlah) AS jumlah  FROM d_lok a
                                                                INNER JOIN d_kmpnen b ON a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput AND a.kdkmpnen=b.kdkmpnen 
                                                                INNER JOIN d_item_output c ON a.kddept=c.kddept AND a.kdunit=c.kdunit AND a.kdprogram=c.kdprogram AND a.kdgiat=c.kdgiat AND a.kdoutput=c.kdoutput
                                                                INNER JOIN d_sasaran_prog d ON c.kddept=d.kddept AND c.kdunit=d.kdunit AND c.kdprogram=d.kdprogram AND c.nosasprog=d.nosasprog
                                                                WHERE  a.kddept='$kd_skpd' AND a.kdprogram='$prog' AND a.kdgiat='$giat' AND a.kdoutput='$kdout1' AND d.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') AND a.kdkmpnen <>'' and a.kdprop <>''
                                                                GROUP BY a.kdkmpnen,b.urkmpnen,b.kdbiaya ORDER BY kdkmpnen";
                                             
                                                                     $query41 = $this->db->query($sql41);
                                                                                                       
                                                                    foreach ($query41->result() as $row41)
                                                                    {
                                                                        $kdkmp1=$row41->kdkmpnen;
                                                                        $nmkmp1=$row41->urkmpnen;
                                                                        $jnsb=$row41->kdbiaya;
                                                                        $rp1=number_format($row41->rupiah+$row41->pend,"1",",",".");
                                                                        $pln1=number_format($row41->pln+ $row41->hibah+$row41->pdn,"1",",",".");
                                                                        $pnpb1=number_format($row41->pnbp + $row41->blu,"1",",",".");
                                                                        $sbsn1=number_format($row41->sbsn,"1",",",".");
                                                                        $jml1=number_format($row41->rupiah+$row41->pend+$row41->pln+ $row41->hibah+$row41->pdn+$row41->pnbp + $row41->blu+$row41->sbsn,"1",",",".");
                                                                        
                                                                        $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\"></td>                                     
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-right: none;font-size:8px\" width=\"2%\" align=\"left\"></td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-left: none;font-size:8px\" width=\"28%\" align=\"left\"><i>$nmkmp1</i></td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\">$jnsb</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$rp1</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$pln1</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$pnpb1</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$sbsn1</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$jml1</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\"></td>
                                                                                      </tr>";    
                                                                       
                                                                        
                                                                       // $sql411="SELECT a.kdprop,b.nmprop,SUM(rupiah) AS rupiah,SUM(paguphln) AS pln,SUM(pdn) AS pdn,SUM(pnbp) AS pnbp,SUM(blu) AS blu,SUM(sbsn) AS sbsn,SUM(jumlah) AS jml FROM d_lok a
//                                                                                  INNER JOIN t_prop b ON a.kdprop=b.kdprop  
//                                                                                  WHERE  a.kddept='$kd_skpd' AND a.kdprogram='$prog' and a.kdgiat='$giat' and a.kdoutput='$kdout1' and kdkmpnen='$kdkmp1'
//                                                                                  GROUP BY a.kdprop,b.nmprop ORDER BY a.kdprop";
                                                                                     $sql411="SELECT a.kdkab,b.nmkab,rupiah AS rupiah,pln AS pln,pdn AS pdn,hibah AS hibah,pend AS pend,pnbp AS pnbp,blu AS blu,sbsn AS sbsn,jumlah AS jml FROM d_lok a
                                                                                              INNER JOIN t_kab b ON a.kdprop=b.kdprop and a.kdkab=b.kdkab  
                                                                                              WHERE  a.kddept='$kd_skpd' AND a.kdprogram='$prog' and a.kdgiat='$giat' and a.kdoutput='$kdout1' and a.kdkmpnen='$kdkmp1' and a.kdprop <>''
                                                                                               ORDER BY a.kdkab";    
                                                                                     $query411 = $this->db->query($sql411);
                                                                                                                       
                                                                                    foreach ($query411->result() as $row411)
                                                                                    {
                                                                                        $nmprop=$row411->nmkab;
                                                                                        $rp11=number_format($row411->rupiah+$row411->pend,"1",",",".");
                                                                                        $pln11=number_format($row411->pln+ $row411->hibah+ $row411->pdn,"1",",",".");
                                                                                        $pnpb11=number_format($row411->pnbp + $row411->blu,"1",",",".");
                                                                                        $sbsn11=number_format($row411->sbsn,"1",",",".");
                                                                                        $jml11=number_format($row411->rupiah+$row411->pend+$row411->pln+ $row411->hibah+ $row411->pdn+$row411->pnbp + $row411->blu+$row411->sbsn,"1",",",".");
                                                                                       
                                                                                        $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\"></td>                                     
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-right: none;font-size:8px\" width=\"2%\" align=\"left\"></td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-left: none;font-size:8px\" width=\"28%\" align=\"left\"><i></i></td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"center\"></td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$rp11</td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$pln11</td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$pnpb11</td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$sbsn11</td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$jml11</td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"left\">$nmprop</td>
                                                                                                      </tr>";    
                                                                                       
                                                                                        
                                                                                                      
                                                                                    }
                                                                                      
                                                                    }
                                                          
                                        }
                                        $sqlt4="SELECT SUM(a.rupiah) AS trupiah,SUM(a.pln) AS tpln,SUM(a.pdn) AS tpdn,SUM(a.hibah) AS thibah, SUM(a.pend) AS tpend,SUM(a.pnbp) AS tpnbp,SUM(a.blu) AS tblu,SUM(a.sbsn) AS tsbsn FROM d_lok a
                                                INNER JOIN d_kmpnen e ON a.kddept=e.kddept AND a.kdunit=e.kdunit AND a.kdprogram=e.kdprogram AND a.kdgiat=e.kdgiat AND a.kdoutput=e.kdoutput AND a.kdkmpnen=e.kdkmpnen 
                                                INNER JOIN  d_item_output b ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput
                                                INNER JOIN d_sasaran_prog c ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND b.nosasprog=c.nosasprog
                                                WHERE  a.kddept='$kd_skpd' AND a.kdprogram='$prog' AND a.kdgiat='$giat' AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') AND a.kdkmpnen <>'' and a.kdprop <>''";
                         
                                                 $queryt4 = $this->db->query($sqlt4);
                                                                                  
                                                foreach ($queryt4->result() as $rowt4)
                                                {
                                                    
                                                    $trp=number_format($rowt4->trupiah+$rowt4->tpend,"1",",",".");
                                                    $tpln=number_format($rowt4->tpln+ $rowt4->thibah+ $rowt4->tpdn,"1",",",".");
                                                    $tpnpb=number_format($rowt4->tpnbp + $rowt4->tblu,"1",",",".");
                                                    $tsbsn=number_format($rowt4->tsbsn,"1",",",".");
                                                    $tjml=number_format($rowt4->trupiah+$rowt4->tpend+$rowt4->tpln+ $rowt4->thibah+ $rowt4->tpdn+$rowt4->tpnbp + $rowt4->tblu+$rowt4->tsbsn,"1",",",".");
                                                   
                                                    $cRet    .= " <tr>                                    
                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"40%\" colspan=\"4\" bgcolor=\"#90EE90\" align=\"center\"><b>Jumlah</b></td>
                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>$trp</b></td>
                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>$tpln</b></td>
                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>$tpnpb</b></td>
                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>$tsbsn</b></td>
                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>$tjml</b></td>
                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"></td>
                                                                  </tr>";    
                                                    }
                                
                                $cRet .=       " </table>";
                        $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                
                                <tr>
                                     <td align=\"left\" style=\"font-size:14px\" colspan=\"3\"><strong><b>C. Pendanaan PHLN atau PDN Tahun 2016</b></strong></td>                         
                                </tr>
                                
                              </table>"; 
                        $sqlt5="SELECT SUM(paguphln) AS tpaguphln,SUM(serap) AS tserap,SUM(pdn) AS tpdn,SUM(pln) AS tpln,SUM(hibah) AS thibah,SUM(pend) AS tpend  FROM d_lok                                                  
                                                              WHERE  kddept='$kd_skpd' AND kdprogram='$prog' and kdgiat='$giat' AND kdkmpnen <>''";
                                         
                             $queryt5= $this->db->query($sqlt5);
                                                              
                            foreach ($queryt5->result() as $rowt5)
                            {
                                $tpaguphln2=$rowt5->tpaguphln;
                                if($tpaguphln2==0){
                                 $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                
                                            <tr>
                                                 <td align=\"left\" style=\"font-size:14px\" colspan=\"3\"><strong><b>--- Tidak ada Rencana Penarikan PHLN dan PDN pada Pagu Indikatif 2016 ---</b></strong></td>                         
                                            </tr>
                                            
                                          </table>";    
                                }else{
                                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"2%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"3\"><b>No</b></td>
                                        <td width=\"15%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" colspan=\"2\" rowspan=\"3\"><b>Sasaran Kegiatan(Output)/Komponen</b></td>
                                        <td width=\"3%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"3\"><b>Sumber/Loan</b></td>
                                        <td width=\"80%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" colspan=\"8\"><b>Pinjaman/Hibah Luar Negri(PHLN) atau Pinjaman Dalam Negri(PDN) (Juta Rupiah)</b></td>
                                        
                                      </tr> 
                                      <tr>  
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>Jenis PHLN (P/H/KE)</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>Pagu(Sesuai MoA)</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>Penyerapan</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>Tanggal Mulai</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>Tanggal Tutup</b> </td>
                                        <td width=\"20%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" colspan=\"2\"><b>Rencana Penarikan</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" rowspan=\"2\"><b>Kebutuhan Dana Pendamping</b></td>                                        
                                      </tr>
                                      <tr>  
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>PLN/PDN</b></td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:9px\" ><b>HIBAH</b></td>
                                                                              
                                      </tr> 
                                      
                                     
                                 </thead> ";
                                $sql5="SELECT a.kdoutput,b.nmoutput,SUM(paguphln) AS paguphln,SUM(serap) AS serap FROM d_lok a
                                      INNER JOIN d_kmpnen e ON a.kddept=e.kddept AND a.kdunit=e.kdunit AND a.kdprogram=e.kdprogram AND a.kdgiat=e.kdgiat AND a.kdoutput=e.kdoutput AND a.kdkmpnen=e.kdkmpnen 
                                      INNER JOIN d_item_output b ON a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput WHERE  a.kddept='$kd_skpd' AND a.kdprogram='$prog' and a.kdgiat='$giat' AND a.kdkmpnen <>'' and a.kdprop <>''
                                      GROUP BY a.kdoutput,b.nmoutput";
                 
                                         $query5= $this->db->query($sql5);
                                                                          
                                        foreach ($query5->result() as $row5)
                                        {
                                            $kdout2=$row5->kdoutput;
                                            $nmout2=$row5->nmoutput;
                                            
                                            $paguphln=number_format($row5->paguphln,"1",",",".");
                                            $serap=number_format($row5->serap,"1",",",".");
                                            if ($paguphln!= 0){
                                                
                                            
                                            $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"2%\" align=\"center\">$kdout2</td>                                     
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"15%\" colspan=\"2\" align=\"left\">$nmout2</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"3%\" align=\"right\"></td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\"></td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$paguphln</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$serap</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\"></td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\"></td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\"></td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\"></td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\"></td>
                                                          </tr>";
                                            }
                                                          $sql51="SELECT a.kdkmpnen,b.urkmpnen,a.kdsumber,IF(a.jenisphln='01','P',IF(a.jenisphln='02','H','KE')) as jenisphln ,a.tglawal,a.tglakhir,paguphln AS paguphln,serap AS serap,pdn AS pdn,
                                                                  pln AS pln,hibah AS hibah,pend AS pend  FROM d_lok a INNER JOIN d_kmpnen b ON a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput AND a.kdkmpnen=b.kdkmpnen
                                                                  WHERE  a.kddept='$kd_skpd' AND a.kdprogram='$prog' AND a.kdgiat='$giat'  AND a.kdoutput='$kdout2'";
                                             
                                                                    $query51= $this->db->query($sql51);                               
                                                                    foreach ($query51->result() as $row51)
                                                                    {
                                                                        $kdkmp2=$row51->kdkmpnen;
                                                                        $nmkmp2=$row51->urkmpnen;
                                                                        $sumber=$row51->kdsumber;
                                                                        $jenisphln=$row51->jenisphln;
                                                                        $pagu=$row51->paguphln;
                                                                        $pagupln=$row51->pln + $row51->pdn;
                                                                        $tglawal=$this->rka_model->tanggal_ind($row51->tglawal);
                                                                        $tglakhir=$this->rka_model->tanggal_ind($row51->tglakhir);
                                                                        $paguphln2=number_format($row51->paguphln,"1",",",".");
                                                                        $serap2=number_format($row51->serap,"1",",",".");
                                                                        $pln2=number_format($row51->pln + $row51->pdn,"1",",",".");
                                                                        $hibah2=number_format($row51->hibah,"1",",",".");
                                                                        $pnd2=number_format($row51->pend,"1",",",".");
                                                                        if($pagu !=0 ||$pagupln !=0){
                                                                        $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"2%\"  align=\"center\"></td>                                     
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-right:none;font-size:8px\" width=\"2%\" align=\"left\"></td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-left:none;font-size:8px\" width=\"13%\" align=\"left\"><i>$nmkmp2</i></td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"3%\" align=\"center\">$sumber</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"center\">$jenisphln</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$paguphln2</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$serap2</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"center\">$tglawal</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"center\">$tglakhir</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$pln2</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$hibah2</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" align=\"right\">$pnd2</td>
                                                                                      </tr>";
                                                                          }            
                                                                    }
                                                         
                                        }
                                                    $sqlt5="SELECT SUM(paguphln) AS tpaguphln,SUM(serap) AS tserap,SUM(pdn) AS tpdn,SUM(pln) AS tpln,SUM(hibah) AS thibah,SUM(pend) AS tpend  FROM d_lok                                                  
                                                              WHERE  kddept='$kd_skpd' AND kdprogram='$prog' and kdgiat='$giat' AND kdkmpnen <>'' and kdprop <>''";
                                         
                                                                 $queryt5= $this->db->query($sqlt5);
                                                                                                  
                                                                foreach ($queryt5->result() as $rowt5)
                                                                {
                                                                    $tpaguphln2=number_format($rowt5->tpaguphln,"1",",",".");
                                                                    $tserap2=number_format($rowt5->tserap,"1",",",".");
                                                                    $tpln2=number_format($rowt5->tpln + $rowt5->tpdn,"1",",",".");
                                                                    $thibah2=number_format($rowt5->thibah,"1",",",".");
                                                                    $tpnd2=number_format($rowt5->tpend,"1",",",".");
                                                                    $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"30%\"  colspan=\"5\" bgcolor=\"#90EE90\" align=\"center\"><b>Jumlah</b></td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>$tpaguphln2</b></td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>$tserap2</b></td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"></td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"></td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>$tpln2</b></td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>$thibah2</b></td>
                                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>$tpnd2</b></td>
                                                                                  </tr>";
                                                                                     
                                                                                  
                                                                }
                                $cRet .=       " </table>";
                                }
                            } 
                        
                                $tg=date('Y-m-d'); 
                                $tgl= $this->rka_model->tanggal_format_indonesia($tg);
                                $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">&nbsp;</td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\"></td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">Jakarta,$tgl</td>                         
                                </tr>
                                 <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">a/n Menteri/ Kepala Lembaga</strong></td>                         
                                </tr>
                                 <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">$jabatan</td>                         
                                </tr>
                                 <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">&nbsp;</td>                         
                                </tr>
                                 <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" >&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">&nbsp;</td>                         
                                </tr>
                                 <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" ></td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">$nama</td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\" ></td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"30%\">&nbsp;</td> 
                                     <td align=\"center\"  style=\"font-size:14px\" width=\"35%\">NIP:$nip</td>                         
                                </tr>
                               
                                
                              </table>";
        $data['prev']= $cRet; 
        $judul='umum';   
        switch($ct) {       
        case 1;
            echo($cRet);
            //$this->template->load('template','master/kegiatan/cetak1',$data);
        break;
        case 2;
            $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        case 4;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        } 
        
                
    }    
    function preview_f31($ct='2',$prog='01',$giat='2379'){
            
            $kd_skpd = $this->session->userdata('kdskpd');
            $thn_ang = $this->session->userdata('pcThang');
            $sqldns="select * from t_dept   WHERE kddept='$kd_skpd'";
                 $sqlskpd=$this->db->query($sqldns);
                 foreach ($sqlskpd->result() as $rowdns)
                {
                   
                    $kd_dept = $rowdns->kddept;
                    $nm_dept  = $rowdns->nmdept;
                }
            
            $thn_ang_2= $thn_ang+1;
            $thn_ang_3= $thn_ang+2;
            $thn_ang_4= $thn_ang+3;
            $thn_ang_5= $thn_ang+4;
            $cRet='';
                     $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                <tr>
                                     <td align=\"center\"  style=\"font-size:30px\" colspan=\"3\"><strong>FORMULIR 3</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" colspan=\"3\"><strong>RENCANA KERJA KEMENTRIAN/LEMBAGA (RENJA-KL)</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" colspan=\"3\"><strong>TAHUN ANGGARAN $thn_ang_2</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" colspan=\"3\">&nbsp;</td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\" style=\"font-size:14px\" >&nbsp;</td>                         
                                </tr>
                                
                              </table>"; 
                   
                    
                   $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">";
                                        
                                        $cRet    .= " <tr><td style= width=\"20%\" align=\"left\"><strong><b>1. Kementrian/Lembaga</b></strong></td>                                     
                                                            <td style= width=\"1%\">:</td>                                    
                                                            <td style= width=\"79%\">$nm_dept</td></tr>";
                                        $sql="SELECT a.kddept,a.kdunit,b.nmunit,a.kdprogram,a.nmprogram FROM t_program a INNER JOIN t_unit b ON a.kddept=b.kddept AND 
                                              a.kdunit=b.kdunit WHERE a.kddept='$kd_skpd'AND a.kdprogram='$prog'";
                 
                                         $query = $this->db->query($sql);
                                                                          
                                        foreach ($query->result() as $row)
                                        {
                                            $kdunit=$row->kdunit;
                                            $nmunit=$row->nmunit;
                                            $kdprogram=$row->kdprogram;
                                            $nmprogram=$row->nmprogram;
                                            $cRet    .= " <tr><td style= width=\"20%\" align=\"left\"><strong><b>2. Program</b></strong></td>                                     
                                                            <td style= width=\"1%\">:</td>                                    
                                                            <td style= width=\"79%\">$nmprogram</td></tr>";
                                        }
                                        $sql1="SELECT nosasprog,nmsasprog FROM d_sasaran_prog WHERE kddept='$kd_skpd'  AND kdprogram='$prog' ";
                 
                                         $query1 = $this->db->query($sql1);
                                        $i=0;                                  
                                        foreach ($query1->result() as $row1)
                                        {
                                            $i=$i+1;
                                            $nosasprog=$row1->nosasprog;
                                            $nmsasprog=$row1->nmsasprog;
                                            if($i==1){
                                                $cRet    .= " <tr><td style= width=\"20%\" align=\"left\"><strong><b>3. Sasaran Program</b></strong></td>                                     
                                                            <td style= width=\"1%\">:</td>                                    
                                                            <td style= width=\"79%\">$i.$nmsasprog</td></tr>";
                                            }else{
                                                $cRet    .= " <tr><td style= width=\"20%\" align=\"left\"></td>                                     
                                                            <td style= width=\"1%\"></td>                                    
                                                            <td style= width=\"79%\">$i.$nmsasprog</td></tr>";
                                            }
                                            
                                        }
                                         $sql="SELECT a.kddit,b.nmdit,a.kdgiat,a.nmgiat FROM t_giat a INNER JOIN t_dit b ON a.kddept=b.kddept AND 
                                              a.kdunit=b.kdunit and a.kddit=b.kddit WHERE a.kddept='$kd_skpd'AND a.kdprogram='$prog' and a.kdgiat='$giat'";
                 
                                         $query = $this->db->query($sql);
                                                                          
                                        foreach ($query->result() as $row)
                                        {
                                            $kdunit=$row->kddit;
                                            $nmunit=$row->nmdit;
                                            $kdgiat=$row->kdgiat;
                                            $nmgiat=$row->nmgiat;
                                            $cRet    .= " <tr><td style= width=\"20%\" align=\"left\"><strong><b>4. Kegiatan</b></strong></td>                                     
                                                            <td style= width=\"1%\">:</td>                                    
                                                            <td style= width=\"79%\">$nmgiat</td>
                                                          </tr>
                                                          <tr><td style= width=\"20%\" align=\"left\"><strong><b>5. Unit Organisasi</b></strong></td>                                     
                                                            <td style= width=\"1%\">:</td>                                    
                                                            <td style= width=\"79%\">$nmunit</td>
                                                          </tr>";
                                        }
                    $cRet .=       " </table>"; 
                     
                    
                    
                   
                    $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                
                                <tr>
                                     <td align=\"left\" style=\"font-size:14px\" colspan=\"3\"><strong><b>B. Sumber Pendanaan</b></strong></td>                         
                                </tr>
                                
                              </table>";  
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:14px\" rowspan=\"2\">No</td>
                                        <td width=\"30%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:14px\" colspan=\"2\" rowspan=\"2\">Sasaran Kegiatan(Output)/Komponen</td>
                                        <td width=\"5%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:14px\" rowspan=\"2\">Jenis Komponen (BAK/BLK)</td>
                                        <td width=\"50%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:14px\" colspan=\"5\">Indikasi Pendanaan Tahun 2016 (Juta Rupiah)</td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:14px\" rowspan=\"2\">Lokasi</td>
                                        
                                      </tr> 
                                      <tr>  
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:14px\" >Rupiah</td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:14px\" >PLN + PDN</td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:14px\" >PNBP + BLU</td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:14px\" >SBSN</td>
                                        <td width=\"10%\" bgcolor=\"#90EE90\" align=\"center\" style=\"font-size:14px\" >Jumlah </td>                                        
                                      </tr> 
                                      
                                     
                                 </thead> ";
                               $sql4="SELECT a.kdoutput,b.nmoutput,SUM(rupiah) AS rupiah,SUM(paguphln) AS pln,SUM(pdn) AS pdn,SUM(pnbp) AS pnbp,SUM(blu) AS blu,SUM(sbsn) AS sbsn,SUM(jumlah) as jml,status as sta1 FROM d_lok a
                                      INNER JOIN d_item_output b ON a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput WHERE  a.kddept='$kd_skpd' AND a.kdprogram='$prog' and a.kdgiat='$giat' 
                                      GROUP BY a.kdoutput,b.nmoutput";
                 
                                         $query4 = $this->db->query($sql4);
                                                                          
                                        foreach ($query4->result() as $row4)
                                        {
                                            $kdout1=$row4->kdoutput;
                                            $nmout1=$row4->nmoutput;
                                            $sta1=$row4->sta1;
                                            
                                            $rp=number_format($row4->rupiah,"1",",",".");
                                            $pln=number_format($row4->pln + $row4->pdn,"1",",",".");
                                            $pnpb=number_format($row4->pnbp + $row4->blu,"1",",",".");
                                            $sbsn=number_format($row4->sbsn,"1",",",".");
                                            $jml=number_format($row4->jml,"1",",",".");
                                            
                                            $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"5%\" align=\"center\">$kdout1</td>                                     
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"30%\" colspan=\"2\" align=\"left\">$nmout1</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"5%\" align=\"right\"></td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\">$rp</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\">$pln</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\">$pnpb</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\">$sbsn</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\">$jml</td>
                                                              <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\"></td>
                                                          </tr>";    
                                           
                                            
                                                          $sql41="SELECT a.kdkmpnen,b.urkmpnen,b.kdbiaya,SUM(rupiah) AS rupiah,SUM(paguphln) AS pln,SUM(pdn) AS pdn,SUM(pnbp) AS pnbp,SUM(blu) AS blu,SUM(sbsn) AS sbsn,SUM(jumlah) as jml,status as sta2  FROM d_lok a
                                                                  INNER JOIN d_kmpnen b ON a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput AND a.kdkmpnen=b.kdkmpnen 
                                                                  WHERE  a.kddept='$kd_skpd' AND a.kdprogram='$prog' and a.kdgiat='$giat' and a.kdoutput='$kdout1' 
                                                                  GROUP BY a.kdkmpnen,b.urkmpnen,b.kdbiaya order by kdkmpnen";
                                             
                                                                     $query41 = $this->db->query($sql41);
                                                                                                       
                                                                    foreach ($query41->result() as $row41)
                                                                    {
                                                                        $kdkmp1=$row41->kdkmpnen;
                                                                        $nmkmp1=$row41->urkmpnen;
                                                                        $jnsb=$row41->kdbiaya;
                                                                        $sta2=$row41->sta2;
                                                                        $rp1=number_format($row41->rupiah,"1",",",".");
                                                                        $pln1=number_format($row41->pln + $row41->pdn,"1",",",".");
                                                                        $pnpb1=number_format($row41->pnbp + $row41->blu,"1",",",".");
                                                                        $sbsn1=number_format($row41->sbsn,"1",",",".");
                                                                        $jml1=number_format($row41->jml,"1",",",".");
                                                                        
                                                                        $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"5%\" align=\"center\"></td>                                     
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-right: none;\" width=\"2%\" align=\"left\"></td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-left: none;\" width=\"28%\" align=\"left\"><i>$nmkmp1</i></td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"5%\" align=\"center\">$jnsb</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\">$rp1</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\">$pln1</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\">$pnpb1</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\">$sbsn1</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\">$jml1</td>
                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\"></td>
                                                                                      </tr>";    
                                                                       
                                                                        
                                                                       // $sql411="SELECT a.kdprop,b.nmprop,SUM(rupiah) AS rupiah,SUM(paguphln) AS pln,SUM(pdn) AS pdn,SUM(pnbp) AS pnbp,SUM(blu) AS blu,SUM(sbsn) AS sbsn,SUM(jumlah) AS jml FROM d_lok a
//                                                                                  INNER JOIN t_prop b ON a.kdprop=b.kdprop  
//                                                                                  WHERE  a.kddept='$kd_skpd' AND a.kdprogram='$prog' and a.kdgiat='$giat' and a.kdoutput='$kdout1' and kdkmpnen='$kdkmp1'
//                                                                                  GROUP BY a.kdprop,b.nmprop ORDER BY a.kdprop";
                                                                                     $sql411="SELECT a.kdkab,b.nmkab,rupiah AS rupiah,paguphln AS pln,pdn AS pdn,pnbp AS pnbp,blu AS blu,sbsn AS sbsn,jumlah AS jml FROM d_lok a
                                                                                              INNER JOIN t_kab b ON a.kdprop=b.kdprop and a.kdkab=b.kdkab  
                                                                                              WHERE  a.kddept='$kd_skpd' AND a.kdprogram='$prog' and a.kdgiat='$giat' and a.kdoutput='$kdout1' and kdkmpnen='$kdkmp1'
                                                                                               ORDER BY a.kdkab";    
                                                                                     $query411 = $this->db->query($sql411);
                                                                                                                       
                                                                                    foreach ($query411->result() as $row411)
                                                                                    {
                                                                                        $nmprop=$row411->nmkab;
                                                                                        $rp11=number_format($row411->rupiah,"1",",",".");
                                                                                        $pln11=number_format($row411->pln + $row411->pdn,"1",",",".");
                                                                                        $pnpb11=number_format($row411->pnbp + $row411->blu,"1",",",".");
                                                                                        $sbsn11=number_format($row411->sbsn,"1",",",".");
                                                                                        $jml11=number_format($row411->jml,"1",",",".");
                                                                                       
                                                                                        $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"5%\" align=\"center\"></td>                                     
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-right: none;\" width=\"2%\" align=\"left\"></td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-left: none;\" width=\"28%\" align=\"left\"><i></i></td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"5%\" align=\"center\"></td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\">$rp11</td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\">$pln11</td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\">$pnpb11</td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\">$sbsn11</td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"right\">$jml11</td>
                                                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" align=\"left\">$nmprop</td>
                                                                                                      </tr>";    
                                                                                       
                                                                                        
                                                                                                      
                                                                                    }
                                                                                      
                                                                    }
                                                          
                                        }
                                        $sqlt4="SELECT SUM(rupiah) AS trupiah,SUM(paguphln) AS tphln,SUM(pdn) AS tpdn,SUM(pnbp) AS tpnbp,SUM(blu) AS tblu,SUM(sbsn) AS tsbsn,SUM(jumlah) as tjml FROM d_lok 
                                              WHERE  kddept='$kd_skpd' AND kdprogram='$prog' and kdgiat='$giat'";
                         
                                                 $queryt4 = $this->db->query($sqlt4);
                                                                                  
                                                foreach ($queryt4->result() as $rowt4)
                                                {
                                                    
                                                    $trp=number_format($rowt4->trupiah,"1",",",".");
                                                    $tpln=number_format($rowt4->tphln + $rowt4->tpdn,"1",",",".");
                                                    $tpnpb=number_format($rowt4->tpnbp + $rowt4->tblu,"1",",",".");
                                                    $tsbsn=number_format($rowt4->tsbsn,"1",",",".");
                                                    $tjml=number_format($rowt4->tjml,"1",",",".");
                                                   
                                                    $cRet    .= " <tr>                                    
                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"40%\" colspan=\"4\" bgcolor=\"#90EE90\" align=\"center\"><b>Jumlah</b></td>
                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>$trp</b></td>
                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>$tpln</b></td>
                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>$tpnpb</b></td>
                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>$tsbsn</b></td>
                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"><b>$tjml</b></td>
                                                                      <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;\" width=\"10%\" bgcolor=\"#90EE90\" align=\"right\"></td>
                                                                  </tr>";    
                                                    }
                                
                                $cRet .=       " </table>";
                       
        $data['prev']= $cRet; 
        $judul='umum';   
        switch($ct) {       
        case 1;
            echo($cRet);
            //$this->template->load('template','master/kegiatan/cetak1',$data);
        break;
        case 2;
            $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        case 4;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        } 
        
                
    }
    
    function cetak_dkp()
    	{
    		
            $data['page_title']= 'BAPPENAS';
            $this->template->set('title', 'BAPPENAS');          
            $this->template->load('template','anggaran/rka/cetak_dkp',$data) ; 
            //$this->load->view('anggaran/rka/tambah_rka',$data) ;
       }
    function preview_dkp($ct='1',$ctk='',$prog='',$giat=''){
            
            $kd_skpd = $this->session->userdata('kdskpd');
            $thn_ang = $this->session->userdata('pcThang');
            $sqldns="select * from t_dept   WHERE kddept='$kd_skpd'";
                 $sqlskpd=$this->db->query($sqldns);
                 foreach ($sqlskpd->result() as $rowdns)
                {
                   
                    $kd_dept = $rowdns->kddept;
                    $nm_dept  = $rowdns->nmdept;
                }
            
            $thn_ang_2= $thn_ang+1;
            $thn_ang_3= $thn_ang+2;
            $thn_ang_4= $thn_ang+3;
            $thn_ang_5= $thn_ang+4;
            $cRet='';
                     $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                <tr>
                                     <td align=\"center\"><strong>IV. DAFTAR KEGIATAN PRIORITAS(N/B/KL)</strong></td>                         
                                </tr>
                                <!--<tr>
                                     <td align=\"center\"><strong>$kd_dept:$nm_dept</strong></td>                         
                                </tr>-->
                                                  
                                
                                <tr>
                                     <td align=\"center\">&nbsp;</td>
                                </tr>
                              </table>";   
                    
                            
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Kode</td>
                                        <td width=\"25%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Program/Kegiatan/Sasaran Kegiatan</td>
                                        <td width=\"20%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Output/Indikator Kinerja Kegiatan(IKK)</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Prioritas (N/B/KL)</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\">Target/Volume 2016</td>
                                        <td width=\"15%\" bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"3\" >Prakiraan Target/Volume</td>
                                        <td width=\"15%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\">Alokasi</td>
                                      </tr> 
                                      
                                      <tr>  
                                        <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" >$thn_ang</td>
                                        <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" >$thn_ang_2</td>
                                        <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" >$thn_ang_3</td>
                                      </tr>   
                                 </thead> 
                                 <tfoot>
                                    <tr><td style=\"border-top: solid 1px black; border-left:none;border-right:none;\" colspan=\"16\"></td>
                                 </tfoot>";
        $cRet .=       " </table>";
        
        
        $data['prev']= $cRet;    
        switch($ct) {       
        case 1;
            echo($cRet);
            //$this->template->load('template','master/kegiatan/cetak1',$data);
        break;
        case 2;
            $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        case 4;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        } 
        
                
    }
    function rekap_esselon1()
    	{
    		
            $data['page_title']= 'BAPPENAS';
            $this->template->set('title', 'BAPPENAS');          
            $this->template->load('template','anggaran/rka/cetak_esselon1',$data) ; 
            //$this->load->view('anggaran/rka/tambah_rka',$data) ;
       }
    function preview_esselon1($ct='1',$ctk='',$prog='',$giat=''){
            
            $kd_skpd = $this->session->userdata('kdskpd');
            $thn_ang = $this->session->userdata('pcThang');
            $sqldns="select * from t_dept   WHERE kddept='$kd_skpd'";
                 $sqlskpd=$this->db->query($sqldns);
                 foreach ($sqlskpd->result() as $rowdns)
                {
                   
                    $kd_dept = $rowdns->kddept;
                    $nm_dept  = $rowdns->nmdept;
                }
            
            $thn_ang_2= $thn_ang+1;
            $thn_ang_3= $thn_ang+2;
            $thn_ang_4= $thn_ang+3;
            $thn_ang_5= $thn_ang+4;
            $cRet='';
                     $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                <tr>
                                     <td align=\"center\"><strong>RENCANA KERJA KEMENTERIAN/LEMBAGA (RENJA-K/L)</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"><strong>TAHUN ANGGARAN 2016</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"><strong>(REKAPITULASI UNIT ORGANISASI)</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\">&nbsp;</td>
                                </tr>
                              </table>";   
                    
                    $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                 <tr>
                                     <td align=\"left\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:14px;\"><strong><span style=\"color:blue\"><b>$kd_dept:$nm_dept</b></span></strong></td>                         
                                </tr>
                                <tr>
                                     <td >&nbsp;</td>                         
                                </tr>
                                
                              </table>";          
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Kode</td>
                                        <td width=\"14%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Unit Organisasi</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Alokasi 2015</td>
                                        <td width=\"50%\" bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"5\" >Usulan Pendanaan Tahun 2016(Juta Rupiah)</td>
                                        <td width=\"21%\" bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"3\">Perkiraan Kebutuhan(Juta Rupiah)</td>
                                      </tr> 
                                      
                                      <tr>  
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >Rupiah</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >PHLN+PDN</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >PNBP+BLU</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >SBSN</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >Jumlah</td>
                                        <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\" >2017</td>
                                        <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\" >2018</td>
                                        <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\" >2019</td>
                                      </tr>   
                                 </thead> 
                                 <tfoot>
                                    <tr><td style=\"border-top: solid 1px black; border-left:none;border-right:none;\" colspan=\"16\"></td>
                                 </tfoot>";
                                 
                                 $sql3="SELECT d.kdunit,d.nmunit,SUM(a.rupiah) AS rupiah,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
                                        SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn
                                        FROM t_unit d
                                        LEFT JOIN d_sasaran_prog c ON c.kddept=d.kddept AND c.kdunit=d.kdunit 
                                        LEFT JOIN d_item_output b ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND  b.nosasprog =c.nosasprog  
                                        LEFT JOIN d_lok a ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput  
                                        WHERE d.kddept='$kd_skpd' AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') and kdkmpnen<>''  GROUP BY d.kdunit
                                        ";

                                        $query3 = $this->db->query($sql3);
                                        $trupiah= 0 ;//number_format($rp+$pend,"1",",",".");
                                        $tphlnpdn= 0 ;//number_format($pln+$hibah+$pdn,"1",",",".");
                                        $tpnbpblu= 0 ;//number_format($pnbp+$blu,"1",",",".");
                                        $tsbsn= 0 ;//number_format($row3->sbsn,"1",",",".");
                                        $tjumlah16 =0; 
                                        $tjumlah17 =0;
                                        $tjumlah18 =0;
                                        $tjumlah19 =0;                                
                                        foreach ($query3->result() as $row3)
                                        {
                                            $kdunit=$row3->kdunit;
                                            $nmunit=$row3->nmunit;
                                            $rp=$row3->rupiah;
                                            $pln=$row3->pln;
                                            $pdn=$row3->pdn;
                                            $hibah=$row3->hibah;
                                            $pend=$row3->pend;
                                            $pnbp=$row3->pnbp;
                                            $blu=$row3->blu;
                                            $sbsn1=$row3->sbsn;
                                            $jmal=$rp+$pend+$pln+$hibah+$pdn+$pnbp+$blu+$sbsn1;
                                            $trupiah= $trupiah+$rp+$pend ;
                                            $tphlnpdn= $tphlnpdn+$pln+$hibah+$pdn;
                                            $tpnbpblu= $tpnbpblu+$pnbp+$blu;
                                            $tsbsn= $tsbsn + $sbsn1;
                                            $tjumlah16 =$tjumlah16 + $jmal; 
                                            $rupiah=number_format($rp+$pend,"1",",",".");
                                            $phlnpdn=number_format($pln+$hibah+$pdn,"1",",",".");
                                            $pnbpblu=number_format($pnbp+$blu,"1",",",".");
                                            $sbsn=number_format($row3->sbsn,"1",",",".");
                                            $jumlah=number_format($rp+$pend+$pln+$hibah+$pdn+$pnbp+$blu+$sbsn1,"1",",",".");
                                                $sql31="SELECT SUM(harga2) AS a2017,SUM(harga3) AS a2018,SUM(harga4) AS a2019 FROM d_item_output 
                                                            WHERE kddept='$kd_skpd' AND kdunit='$kdunit'";
                                     
                                                             $query31 = $this->db->query($sql31);
                                                                                              
                                                            foreach ($query31->result() as $row31)
                                                            {
                                                                
                                                                $al17=$row31->a2017;
                                                                $tjumlah17 =$tjumlah17 + $al17; 
                                                                $al18=$row31->a2018;
                                                                $tjumlah18 =$tjumlah18 + $al18;
                                                                $al19=$row31->a2019;
                                                                $tjumlah19 =$tjumlah19 + $al19;
                                                                $al2017=number_format($row31->a2017,"1",",",".");
                                                                $al2018=number_format($row31->a2018,"1",",",".");
                                                                $al2019=number_format($row31->a2019,"1",",",".");
                                            
                                                               
                                                                 $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"5%\" align=\"center\">$kdunit</td>                                     
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"36%\" align=\"left\">$nmunit</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\"></td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$rupiah</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$phlnpdn</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$pnbpblu</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$sbsn</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"7%\" align=\"right\">$jumlah</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$al2017</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$al2018</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$al2019</td>
                                                                              </tr>"; 
                                                              
                                            }
                                            
                                        }
                                        $cRet    .= " <tr>                                     
                                                                          <td colspan=\"3\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"55%\" bgcolor=\"#90EE90\" align=\"center\"><b>Jumlah</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($trupiah,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tphlnpdn,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tpnbpblu,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tsbsn,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"7%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah16,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah17,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah18,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah19,"1",",",".")."</b></td>
                                                                      </tr>";
        $cRet .=       " </table>";
        
        
        $data['prev']= $cRet;    
        switch($ct) {       
        case 1;
            echo($cRet);
            //$this->template->load('template','master/kegiatan/cetak1',$data);
        break;
        case 2;
            $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        case 4;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        } 
        
                
    }
    function rekap_kabkota()
    	{
    		
            $data['page_title']= 'BAPPENAS';
            $this->template->set('title', 'BAPPENAS');          
            $this->template->load('template','anggaran/rka/cetak_kabkota',$data) ; 
            //$this->load->view('anggaran/rka/tambah_rka',$data) ;
       }
     function preview_kabkota($ct='1',$ctk='',$prog='',$giat=''){
            
            $kd_skpd = $this->session->userdata('kdskpd');
            $thn_ang = $this->session->userdata('pcThang');
            $sqldns="select * from t_dept   WHERE kddept='$kd_skpd'";
                 $sqlskpd=$this->db->query($sqldns);
                 foreach ($sqlskpd->result() as $rowdns)
                {
                   
                    $kd_dept = $rowdns->kddept;
                    $nm_dept  = $rowdns->nmdept;
                }
            
            $thn_ang_2= $thn_ang+1;
            $thn_ang_3= $thn_ang+2;
            $thn_ang_4= $thn_ang+3;
            $thn_ang_5= $thn_ang+4;
            $cRet='';
                     $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                <tr>
                                     <td align=\"center\"><strong>RENCANA KERJA KEMENTERIAN/LEMBAGA (RENJA-K/L)</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"><strong>TAHUN ANGGARAN 2016</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"><strong>(REKAPITULASI KABUPATEN/KOTA PER PROVINSI)</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\">&nbsp;</td>
                                </tr>
                              </table>";   
                    
                    $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                 <tr>
                                     <td align=\"left\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:14px;\"><strong><span style=\"color:blue\"><b>$kd_dept:$nm_dept</b></span></strong></td>                         
                                </tr>
                                <tr>
                                     <td >&nbsp;</td>                         
                                </tr>
                                
                              </table>";          
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Kode</td>
                                        <td width=\"14%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Provinsi/Kabupaten/Kota</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Alokasi 2015</td>
                                        <td width=\"50%\" bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"5\" >Usulan Pendanaan Tahun 2016(Juta Rupiah)</td>
                                        <td width=\"21%\" bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"3\">Perkiraan Kebutuhan(Juta Rupiah)</td>
                                      </tr> 
                                      
                                      <tr>  
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >Rupiah</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >PHLN+PDN</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >PNBP+BLU</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >SBSN</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >Jumlah</td>
                                        <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\" >2017</td>
                                        <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\" >2018</td>
                                        <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\" >2019</td>
                                      </tr>   
                                 </thead> 
                                 ";
                                 $sql3="SELECT a.kdprop,a.kdkab,e.nmkab,SUM(a.rupiah) AS rupiah,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
                                        SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn
                                        FROM t_unit d
                                        LEFT JOIN d_sasaran_prog c ON c.kddept=d.kddept AND c.kdunit=d.kdunit 
                                        LEFT JOIN d_item_output b ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND  b.nosasprog =c.nosasprog  
                                        LEFT JOIN d_lok a ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput 
                                        LEFT JOIN t_kab e ON a.kdprop=e.kdprop AND a.kdkab=e.kdkab  
                                        WHERE d.kddept='$kd_skpd' AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') and a.kdkmpnen<>'' AND a.kdprop IS NOT NULL  GROUP BY a.kdprop,a.kdkab
                                        ";

                                        $query3 = $this->db->query($sql3);
                                        $trupiah= 0 ;//number_format($rp+$pend,"1",",",".");
                                        $tphlnpdn= 0 ;//number_format($pln+$hibah+$pdn,"1",",",".");
                                        $tpnbpblu= 0 ;//number_format($pnbp+$blu,"1",",",".");
                                        $tsbsn= 0 ;//number_format($row3->sbsn,"1",",",".");
                                        $tjumlah16 =0; 
                                                                   
                                        foreach ($query3->result() as $row3)
                                        {
                                            $kdprop=$row3->kdprop;
                                            $kdkab=$row3->kdkab;
                                            $nmkab=$row3->nmkab;
                                            $rp=$row3->rupiah;
                                            $pln=$row3->pln;
                                            $pdn=$row3->pdn;
                                            $hibah=$row3->hibah;
                                            $pend=$row3->pend;
                                            $pnbp=$row3->pnbp;
                                            $blu=$row3->blu;
                                            $sbsn1=$row3->sbsn;
                                            $jmal=$rp+$pend+$pln+$hibah+$pdn+$pnbp+$blu+$sbsn1;
                                            $trupiah= $trupiah+$rp+$pend ;
                                            $tphlnpdn= $tphlnpdn+$pln+$hibah+$pdn;
                                            $tpnbpblu= $tpnbpblu+$pnbp+$blu;
                                            $tsbsn= $tsbsn + $sbsn1;
                                            $tjumlah16 =$tjumlah16 + $jmal; 
                                            $rupiah=number_format($rp+$pend,"1",",",".");
                                            $phlnpdn=number_format($pln+$hibah+$pdn,"1",",",".");
                                            $pnbpblu=number_format($pnbp+$blu,"1",",",".");
                                            $sbsn=number_format($row3->sbsn,"1",",",".");
                                            $jumlah=number_format($rp+$pend+$pln+$hibah+$pdn+$pnbp+$blu+$sbsn1,"1",",",".");
                                             
                                                               
                                                 $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"5%\" align=\"center\">$kdprop.$kdkab</td>                                     
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"36%\" align=\"left\">$nmkab</td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\"></td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$rupiah</td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$phlnpdn</td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$pnbpblu</td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$sbsn</td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"7%\" align=\"right\">$jumlah</td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\"></td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\"></td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\"></td>
                                                              </tr>"; 
                                                              
                                         
                                            
                                        }
                                        $cRet    .= " <tr>                                     
                                                                          <td colspan=\"3\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"55%\" bgcolor=\"#90EE90\" align=\"center\"><b>Jumlah</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($trupiah,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tphlnpdn,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tpnbpblu,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tsbsn,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"7%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah16,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"></td>
                                                                      </tr>";
        $cRet .=       " </table>";
        
        
        $data['prev']= $cRet;    
        switch($ct) {       
        case 1;
            echo($cRet);
            //$this->template->load('template','master/kegiatan/cetak1',$data);
        break;
        case 2;
            $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        case 4;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        } 
        
                
    }
    function rekap_kegiatan()
    	{
    		
            $data['page_title']= 'BAPPENAS';
            $this->template->set('title', 'BAPPENAS');          
            $this->template->load('template','anggaran/rka/cetak_kegiatan',$data) ; 
            //$this->load->view('anggaran/rka/tambah_rka',$data) ;
       }
    function preview_kegiatan($ct='1',$ctk='',$prog='',$giat=''){
            
            $kd_skpd = $this->session->userdata('kdskpd');
            $thn_ang = $this->session->userdata('pcThang');
            $sqldns="select * from t_dept   WHERE kddept='$kd_skpd'";
                 $sqlskpd=$this->db->query($sqldns);
                 foreach ($sqlskpd->result() as $rowdns)
                {
                   
                    $kd_dept = $rowdns->kddept;
                    $nm_dept  = $rowdns->nmdept;
                }
            
            $thn_ang_2= $thn_ang+1;
            $thn_ang_3= $thn_ang+2;
            $thn_ang_4= $thn_ang+3;
            $thn_ang_5= $thn_ang+4;
            $cRet='';
                     $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                <tr>
                                     <td align=\"center\"><strong>RENCANA KERJA KEMENTERIAN/LEMBAGA (RENJA-K/L)</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"><strong>TAHUN ANGGARAN 2016</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"><strong>(RINCIAN KEGIATAN PER PROGRAM)</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\">&nbsp;</td>
                                </tr>
                              </table>";   
                    
                    $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                 <tr>
                                     <td align=\"left\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:14px;\"><strong><span style=\"color:blue\"><b>$kd_dept:$nm_dept</b></span></strong></td>                         
                                </tr>
                                <tr>
                                     <td >&nbsp;</td>                         
                                </tr>
                                
                              </table>";          
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Kode</td>
                                        <td width=\"14%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Program/Kegiatan</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Alokasi 2015</td>
                                        <td width=\"50%\" bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"5\" >Usulan Pendanaan Tahun 2016(Juta Rupiah)</td>
                                        <td width=\"21%\" bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"3\">Perkiraan Kebutuhan(Juta Rupiah)</td>
                                      </tr> 
                                      
                                      <tr>  
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >Rupiah</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >PHLN+PDN</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >PNBP+BLU</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >SBSN</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >Jumlah</td>
                                        <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\" >2017</td>
                                        <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\" >2018</td>
                                        <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\" >2019</td>
                                      </tr>   
                                 </thead>";
                                 $sql3="SELECT d.kdprogram,d.nmprogram,d.status,SUM(a.rupiah) AS rupiah,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
                                        SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn
                                        FROM t_program d
                                        LEFT JOIN d_sasaran_prog c ON c.kddept=d.kddept AND c.kdunit=d.kdunit AND c.kdprogram=d.kdprogram
                                        LEFT JOIN d_item_output b ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND  b.nosasprog =c.nosasprog  
                                        LEFT JOIN d_lok a ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput 
                                        WHERE d.kddept='$kd_skpd' AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') and a.kdkmpnen<>''  GROUP BY d.`kdprogram`
                                        ";

                                        $query3 = $this->db->query($sql3);
                                        $trupiah= 0 ;
                                        $tphlnpdn= 0 ;
                                        $tpnbpblu= 0 ;
                                        $tsbsn= 0 ;
                                        $tjumlah16 =0; 
                                        $tjumlah17 =0;
                                        $tjumlah18 =0;
                                        $tjumlah19 =0;                                
                                        foreach ($query3->result() as $row3)
                                        {
                                            $kdprogram=$row3->kdprogram;
                                            $nmprogram=$row3->nmprogram;
                                            $rp=$row3->rupiah;
                                            $pln=$row3->pln;
                                            $pdn=$row3->pdn;
                                            $hibah=$row3->hibah;
                                            $pend=$row3->pend;
                                            $pnbp=$row3->pnbp;
                                            $blu=$row3->blu;
                                            $sbsn1=$row3->sbsn;
                                            $jmal=$rp+$pend+$pln+$hibah+$pdn+$pnbp+$blu+$sbsn1;
                                            $trupiah= $trupiah+$rp+$pend ;
                                            $tphlnpdn= $tphlnpdn+$pln+$hibah+$pdn;
                                            $tpnbpblu= $tpnbpblu+$pnbp+$blu;
                                            $tsbsn= $tsbsn + $sbsn1;
                                            $tjumlah16 =$tjumlah16 + $jmal; 
                                            $rupiah=number_format($rp+$pend,"1",",",".");
                                            $phlnpdn=number_format($pln+$hibah+$pdn,"1",",",".");
                                            $pnbpblu=number_format($pnbp+$blu,"1",",",".");
                                            $sbsn=number_format($row3->sbsn,"1",",",".");
                                            $jumlah=number_format($rp+$pend+$pln+$hibah+$pdn+$pnbp+$blu+$sbsn1,"1",",",".");
                                                $sql31="SELECT SUM(harga2) AS a2017,SUM(harga3) AS a2018,SUM(harga4) AS a2019 FROM d_item_output 
                                                            WHERE kddept='$kd_skpd' AND kdprogram='$kdprogram'";
                                     
                                                             $query31 = $this->db->query($sql31);
                                                                                              
                                                            foreach ($query31->result() as $row31)
                                                            {
                                                                
                                                                $al17=$row31->a2017;
                                                                $tjumlah17 =$tjumlah17 + $al17; 
                                                                $al18=$row31->a2018;
                                                                $tjumlah18 =$tjumlah18 + $al18;
                                                                $al19=$row31->a2019;
                                                                $tjumlah19 =$tjumlah19 + $al19;
                                                                $al2017=number_format($row31->a2017,"1",",",".");
                                                                $al2018=number_format($row31->a2018,"1",",",".");
                                                                $al2019=number_format($row31->a2019,"1",",",".");
                                            
                                                               
                                                                 $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px;color:red\" width=\"5%\" align=\"left\">$kdprogram</td>                                     
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px;color:red\" width=\"36%\" align=\"left\">$nmprogram</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\"></td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$rupiah</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$phlnpdn</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$pnbpblu</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$sbsn</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"7%\" align=\"right\">$jumlah</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$al2017</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$al2018</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$al2019</td>
                                                                              </tr>"; 
                                                                 $sql3k="SELECT f.kdgiat,f.nmgiat,SUM(z.rupiah) AS rupiah,SUM(z.pend) AS pend,SUM(z.pln) AS pln,SUM(z.hibah) AS hibah,SUM(z.pdn) AS pdn,
                                                                        SUM(z.pnbp) AS pnbp,SUM(z.blu) AS blu,SUM(z.sbsn) AS sbsn FROM t_giat f 
                                                                        LEFT JOIN (
                                                                        SELECT a.kddept,a.kdunit,a.kdprogram,a.kdgiat,a.kdoutput,b.nosasprog,c.nosasstra,a.rupiah AS rupiah,a.pnbp AS pnbp,a.blu AS blu,a.pln AS pln,a.pdn AS pdn,
                                                                        hibah AS hibah,pend AS pend,a.sbsn AS sbsn FROM d_lok a 
                                                                        INNER JOIN d_item_output b ON a.kddept=b.kddept  AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput
                                                                        INNER JOIN d_sasaran_prog c ON b.kddept=c.kddept  AND b.kdprogram=c.kdprogram AND b.nosasprog=c.nosasprog
                                                                        WHERE a.kddept='$kd_skpd' AND a.kdprogram='$kdprogram'  AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') and a.kdkmpnen<>'')z ON f.kddept=z.kddept  AND f.kdprogram=z.kdprogram AND f.kdgiat=z.kdgiat
                                                                        WHERE f.kddept='$kd_skpd' AND f.kdprogram='$kdprogram'  GROUP BY f.kdgiat";
                                                               
                                                                        $query3k = $this->db->query($sql3k);
                                                                                                     
                                                                        foreach ($query3k->result() as $row3k)
                                                                        {
                                                                            $kdgiat=$row3k->kdgiat;
                                                                            $nmgiat=$row3k->nmgiat;
                                                                            $yrp=$row3k->rupiah;
                                                                            $ypln=$row3k->pln;
                                                                            $ypdn=$row3k->pdn;
                                                                            $yhibah=$row3k->hibah;
                                                                            $ypend=$row3k->pend;
                                                                            $ypnbp=$row3k->pnbp;
                                                                            $yblu=$row3k->blu;
                                                                            $ysbsn1=$row3k->sbsn;
                                                                            $yjml=$yrp+$ypln+$ypdn+$yhibah+$ypend+$ypnbp+$yblu+$ysbsn1;
                                                                            $rupiahk=number_format($yrp+$ypend,"1",",",".");
                                                                            $phlnpdnk=number_format($ypln+$yhibah+$ypdn,"1",",",".");
                                                                            $pnbpbluk=number_format($ypnbp+$yblu,"1",",",".");
                                                                            $sbsnk=number_format($row3k->sbsn,"1",",",".");
                                                                            $jumlahk=number_format($yjml,"1",",",".");
                                                                                    $sql31k="SELECT SUM(harga2) AS a2017,SUM(harga3) AS a2018,SUM(harga4) AS a2019 FROM d_item_output 
                                                                                            WHERE kddept='$kd_skpd' AND kdprogram='$kdprogram' and kdgiat='$kdgiat' ";
                                                                     
                                                                                             $query31k = $this->db->query($sql31k);
                                                                                                                              
                                                                                            foreach ($query31k->result() as $row31k)
                                                                                            {
                                                                                                
                                                                                                $kal2017=number_format($row31k->a2017,"1",",",".");
                                                                                                $kal2018=number_format($row31k->a2018,"1",",",".");
                                                                                                $kal2019=number_format($row31k->a2019,"1",",",".");
                                                                                                $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"left\">$kdprogram.$kdgiat</td>                                     
                                                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"36%\" align=\"left\">$nmgiat</td>
                                                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\"></td>
                                                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$rupiahk</td>
                                                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$phlnpdnk</td>
                                                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$pnbpbluk</td>
                                                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" align=\"right\">$sbsnk</td>
                                                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"7%\" align=\"right\">$jumlahk</td>
                                                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$kal2017</td>
                                                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$kal2018</td>
                                                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" align=\"right\">$kal2019</td>
                                                                                                              </tr>";
                                                                                            }
                                                                        }
                                                              
                                            }
                                            
                                        }
                                                                    $cRet    .= " <tr>                                     
                                                                          <td colspan=\"3\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"55%\" bgcolor=\"#90EE90\" align=\"center\"><b>Jumlah</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($trupiah,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tphlnpdn,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tpnbpblu,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tsbsn,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"7%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah16,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah17,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah18,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah19,"1",",",".")."</b></td>
                                                                      </tr>";
        $cRet .=       " </table>";
        
        
        $data['prev']= $cRet;    
        switch($ct) {       
        case 1;
            echo($cRet);
            //$this->template->load('template','master/kegiatan/cetak1',$data);
        break;
        case 2;
            $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        case 4;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        } 
        
                
    }
    function rekap_program()
    	{
    		
            $data['page_title']= 'BAPPENAS';
            $this->template->set('title', 'BAPPENAS');          
            $this->template->load('template','anggaran/rka/cetak_program',$data) ; 
            //$this->load->view('anggaran/rka/tambah_rka',$data) ;
       }
    function preview_program($ct='1',$ctk='',$prog='',$giat=''){
            
            $kd_skpd = $this->session->userdata('kdskpd');
            $thn_ang = $this->session->userdata('pcThang');
            $sqldns="select * from t_dept   WHERE kddept='$kd_skpd'";
                 $sqlskpd=$this->db->query($sqldns);
                 foreach ($sqlskpd->result() as $rowdns)
                {
                   
                    $kd_dept = $rowdns->kddept;
                    $nm_dept  = $rowdns->nmdept;
                }
            
            $thn_ang_2= $thn_ang+1;
            $thn_ang_3= $thn_ang+2;
            $thn_ang_4= $thn_ang+3;
            $thn_ang_5= $thn_ang+4;
            $cRet='';
                     $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                <tr>
                                     <td align=\"center\"><strong>RENCANA KERJA KEMENTERIAN/LEMBAGA (RENJA-K/L)</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"><strong>TAHUN ANGGARAN 2016</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"><strong>(REKAPITULASI PROGRAM)</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\">&nbsp;</td>
                                </tr>
                              </table>";   
                    
                    $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                 <tr>
                                     <td align=\"left\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:14px;\"><strong><span style=\"color:blue\"><b>$kd_dept:$nm_dept</b></span></strong></td>                         
                                </tr>
                                <tr>
                                     <td >&nbsp;</td>                         
                                </tr>
                                
                              </table>";          
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Kode</td>
                                        <td width=\"14%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Program</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Alokasi 2015</td>
                                        <td width=\"50%\" bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"5\" >Usulan Pendanaan Tahun 2016(Juta Rupiah)</td>
                                        <td width=\"21%\" bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"3\">Perkiraan Kebutuhan(Juta Rupiah)</td>
                                      </tr> 
                                      
                                      <tr>  
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >Rupiah</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >PHLN+PDN</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >PNBP+BLU</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >SBSN</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >Jumlah</td>
                                        <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\" >2017</td>
                                        <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\" >2018</td>
                                        <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\" >2019</td>
                                      </tr>   
                                 </thead>";
                                 $sql3="SELECT d.kdprogram,d.nmprogram,d.status,SUM(a.rupiah) AS rupiah,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
                                        SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn
                                        FROM t_program d
                                        LEFT JOIN d_sasaran_prog c ON c.kddept=d.kddept AND c.kdunit=d.kdunit AND c.kdprogram=d.kdprogram
                                        LEFT JOIN d_item_output b ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND  b.nosasprog =c.nosasprog  
                                        LEFT JOIN d_lok a ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput 
                                        WHERE d.kddept='$kd_skpd' AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') and a.kdkmpnen<>'' GROUP BY d.`kdprogram`
                                        ";

                                        $query3 = $this->db->query($sql3);
                                        $trupiah= 0 ;
                                        $tphlnpdn= 0 ;
                                        $tpnbpblu= 0 ;
                                        $tsbsn= 0 ;
                                        $tjumlah16 =0; 
                                        $tjumlah17 =0;
                                        $tjumlah18 =0;
                                        $tjumlah19 =0;                                
                                        foreach ($query3->result() as $row3)
                                        {
                                            $kdprogram=$row3->kdprogram;
                                            $nmprogram=$row3->nmprogram;
                                            $rp=$row3->rupiah;
                                            $pln=$row3->pln;
                                            $pdn=$row3->pdn;
                                            $hibah=$row3->hibah;
                                            $pend=$row3->pend;
                                            $pnbp=$row3->pnbp;
                                            $blu=$row3->blu;
                                            $sbsn1=$row3->sbsn;
                                            $jmal=$rp+$pend+$pln+$hibah+$pdn+$pnbp+$blu+$sbsn1;
                                            $trupiah= $trupiah+$rp+$pend ;
                                            $tphlnpdn= $tphlnpdn+$pln+$hibah+$pdn;
                                            $tpnbpblu= $tpnbpblu+$pnbp+$blu;
                                            $tsbsn= $tsbsn + $sbsn1;
                                            $tjumlah16 =$tjumlah16 + $jmal; 
                                            $rupiah=number_format($rp+$pend,"1",",",".");
                                            $phlnpdn=number_format($pln+$hibah+$pdn,"1",",",".");
                                            $pnbpblu=number_format($pnbp+$blu,"1",",",".");
                                            $sbsn=number_format($row3->sbsn,"1",",",".");
                                            $jumlah=number_format($rp+$pend+$pln+$hibah+$pdn+$pnbp+$blu+$sbsn1,"1",",",".");
                                                $sql31="SELECT SUM(harga2) AS a2017,SUM(harga3) AS a2018,SUM(harga4) AS a2019 FROM d_item_output 
                                                            WHERE kddept='$kd_skpd' AND kdprogram='$kdprogram'";
                                     
                                                             $query31 = $this->db->query($sql31);
                                                                                              
                                                            foreach ($query31->result() as $row31)
                                                            {
                                                                
                                                                $al17=$row31->a2017;
                                                                $tjumlah17 =$tjumlah17 + $al17; 
                                                                $al18=$row31->a2018;
                                                                $tjumlah18 =$tjumlah18 + $al18;
                                                                $al19=$row31->a2019;
                                                                $tjumlah19 =$tjumlah19 + $al19;
                                                                $al2017=number_format($row31->a2017,"1",",",".");
                                                                $al2018=number_format($row31->a2018,"1",",",".");
                                                                $al2019=number_format($row31->a2019,"1",",",".");
                                            
                                                               
                                                                 $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px;\" width=\"5%\" align=\"left\">$kdprogram</td>                                     
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px;\" width=\"36%\" align=\"left\">$nmprogram</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\"></td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$rupiah</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$phlnpdn</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$pnbpblu</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$sbsn</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"7%\" align=\"right\">$jumlah</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$al2017</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$al2018</td>
                                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$al2019</td>
                                                                              </tr>"; 
                                                                 
                                            }
                                            
                                        }
                                                                    $cRet    .= " <tr>                                     
                                                                          <td colspan=\"3\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"55%\" bgcolor=\"#90EE90\" align=\"center\"><b>Jumlah</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($trupiah,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tphlnpdn,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tpnbpblu,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tsbsn,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"7%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah16,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah17,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah18,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah19,"1",",",".")."</b></td>
                                                                      </tr>";
        $cRet .=       " </table>";
        
        
        $data['prev']= $cRet;    
        switch($ct) {       
        case 1;
            echo($cRet);
            //$this->template->load('template','master/kegiatan/cetak1',$data);
        break;
        case 2;
            $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        case 4;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        } 
        
                
    }
    function rekap_provinsi()
    	{
    		
            $data['page_title']= 'BAPPENAS';
            $this->template->set('title', 'BAPPENAS');          
            $this->template->load('template','anggaran/rka/cetak_provinsi',$data) ; 
            //$this->load->view('anggaran/rka/tambah_rka',$data) ;
       }
    function preview_provinsi($ct='1',$ctk='',$prog='',$giat=''){
            
            $kd_skpd = $this->session->userdata('kdskpd');
            $thn_ang = $this->session->userdata('pcThang');
            $sqldns="select * from t_dept   WHERE kddept='$kd_skpd'";
                 $sqlskpd=$this->db->query($sqldns);
                 foreach ($sqlskpd->result() as $rowdns)
                {
                   
                    $kd_dept = $rowdns->kddept;
                    $nm_dept  = $rowdns->nmdept;
                }
            
            $thn_ang_2= $thn_ang+1;
            $thn_ang_3= $thn_ang+2;
            $thn_ang_4= $thn_ang+3;
            $thn_ang_5= $thn_ang+4;
            $cRet='';
                     $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                <tr>
                                     <td align=\"center\"><strong>RENCANA KERJA KEMENTERIAN/LEMBAGA (RENJA-K/L)</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"><strong>TAHUN ANGGARAN 2016</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"><strong>(REKAPITULASI PROVINSI)</strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\">&nbsp;</td>
                                </tr>
                              </table>";   
                    
                    $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                 <tr>
                                     <td align=\"left\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:14px;\"><strong><span style=\"color:blue\"><b>$kd_dept:$nm_dept</b></span></strong></td>                         
                                </tr>
                                <tr>
                                     <td >&nbsp;</td>                         
                                </tr>
                                
                              </table>";          
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Kode</td>
                                        <td width=\"14%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Provinsi</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Alokasi 2015</td>
                                        <td width=\"50%\" bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"5\" >Usulan Pendanaan Tahun 2016(Juta Rupiah)</td>
                                        <td width=\"21%\" bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"3\">Perkiraan Kebutuhan(Juta Rupiah)</td>
                                      </tr> 
                                      
                                      <tr>  
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >Rupiah</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >PHLN+PDN</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >PNBP+BLU</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >SBSN</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >Jumlah</td>
                                        <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\" >2017</td>
                                        <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\" >2018</td>
                                        <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\" >2019</td>
                                      </tr>   
                                 </thead>";
                                 $sql3="SELECT a.kdprop,e.nmprop,SUM(a.rupiah) AS rupiah,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
                                        SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn
                                        FROM t_unit d
                                        LEFT JOIN d_sasaran_prog c ON c.kddept=d.kddept AND c.kdunit=d.kdunit 
                                        LEFT JOIN d_item_output b ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND  b.nosasprog =c.nosasprog  
                                        LEFT JOIN d_lok a ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput 
                                        LEFT JOIN t_prop e ON a.kdprop=e.kdprop 
                                        WHERE d.kddept='$kd_skpd' AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') and a.kdkmpnen<>'' AND a.kdprop IS NOT NULL  GROUP BY a.kdprop
                                        ";

                                        $query3 = $this->db->query($sql3);
                                        $trupiah= 0 ;//number_format($rp+$pend,"1",",",".");
                                        $tphlnpdn= 0 ;//number_format($pln+$hibah+$pdn,"1",",",".");
                                        $tpnbpblu= 0 ;//number_format($pnbp+$blu,"1",",",".");
                                        $tsbsn= 0 ;//number_format($row3->sbsn,"1",",",".");
                                        $tjumlah16 =0; 
                                                                   
                                        foreach ($query3->result() as $row3)
                                        {
                                            $kdprop=$row3->kdprop;
                                            $nmkab=$row3->nmprop;
                                            $rp=$row3->rupiah;
                                            $pln=$row3->pln;
                                            $pdn=$row3->pdn;
                                            $hibah=$row3->hibah;
                                            $pend=$row3->pend;
                                            $pnbp=$row3->pnbp;
                                            $blu=$row3->blu;
                                            $sbsn1=$row3->sbsn;
                                            $jmal=$rp+$pend+$pln+$hibah+$pdn+$pnbp+$blu+$sbsn1;
                                            $trupiah= $trupiah+$rp+$pend ;
                                            $tphlnpdn= $tphlnpdn+$pln+$hibah+$pdn;
                                            $tpnbpblu= $tpnbpblu+$pnbp+$blu;
                                            $tsbsn= $tsbsn + $sbsn1;
                                            $tjumlah16 =$tjumlah16 + $jmal; 
                                            $rupiah=number_format($rp+$pend,"1",",",".");
                                            $phlnpdn=number_format($pln+$hibah+$pdn,"1",",",".");
                                            $pnbpblu=number_format($pnbp+$blu,"1",",",".");
                                            $sbsn=number_format($row3->sbsn,"1",",",".");
                                            $jumlah=number_format($rp+$pend+$pln+$hibah+$pdn+$pnbp+$blu+$sbsn1,"1",",",".");
                                             
                                                               
                                                 $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"5%\" align=\"center\">$kdprop</td>                                     
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"36%\" align=\"left\">$nmkab</td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\"></td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$rupiah</td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$phlnpdn</td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$pnbpblu</td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\">$sbsn</td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"7%\" align=\"right\">$jumlah</td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\"></td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\"></td>
                                                                  <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:9px\" width=\"6%\" align=\"right\"></td>
                                                              </tr>"; 
                                                              
                                         
                                            
                                        }
                                        $cRet    .= " <tr>                                     
                                                                          <td colspan=\"3\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"55%\" bgcolor=\"#90EE90\" align=\"center\"><b>Jumlah</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($trupiah,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tphlnpdn,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tpnbpblu,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"5%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tsbsn,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"7%\" bgcolor=\"#90EE90\" align=\"right\"><b>".number_format($tjumlah16,"1",",",".")."</b></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"></td>
                                                                          <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:8px\" width=\"6%\" bgcolor=\"#90EE90\" align=\"right\"></td>
                                                                      </tr>";
        $cRet .=       " </table>";
        
        
        $data['prev']= $cRet;    
        switch($ct) {       
        case 1;
            echo($cRet);
            //$this->template->load('template','master/kegiatan/cetak1',$data);
        break;
        case 2;
            $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        case 4;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        } 
        
                
    }
    function cetak_ref()
    	{
    		
            $data['page_title']= 'BAPPENAS';
            $this->template->set('title', 'BAPPENAS');          
            $this->template->load('template','anggaran/rka/cetak_ref',$data) ; 
            //$this->load->view('anggaran/rka/tambah_rka',$data) ;
       }
    function preview_referensi($ct='1',$ctk='',$prog='',$giat=''){
            
            $kd_skpd = $this->session->userdata('kdskpd');
            $thn_ang = $this->session->userdata('pcThang');
            $sqldns="select * from t_dept   WHERE kddept='$kd_skpd'";
                 $sqlskpd=$this->db->query($sqldns);
                 foreach ($sqlskpd->result() as $rowdns)
                {
                   
                    $kd_dept = $rowdns->kddept;
                    $nm_dept  = $rowdns->nmdept;
                }
            
            $thn_ang_2= $thn_ang+1;
            $thn_ang_3= $thn_ang+2;
            $thn_ang_4= $thn_ang+3;
            $thn_ang_5= $thn_ang+4;
            $cRet='';
                     $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                <tr>
                                     <td align=\"center\"><strong>DAFTAR PROGRAM DAN KEGIATAN 2016</strong></td>                         
                                </tr>        
                                
                                <tr>
                                     <td align=\"center\">&nbsp;</td>
                                </tr>
                              </table>";   
                     $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                
                                 <tr>
                                     <td align=\"left\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;font-size:14px;\"><strong><span style=\"color:blue\"><b>$kd_dept:$nm_dept</b></span></strong></td>                         
                                </tr>
                                <tr>
                                     <td >&nbsp;</td>                         
                                </tr>
                                
                              </table>"; 
                            
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                    
             		                  <tr>  
                                        <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Kode</td>
                                        <td width=\"25%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Program/Kegiatan</td>
                                        <td width=\"20%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Sasaran Program(Outcome)/Sasaran Kegiatan</td>
                                        <td width=\"20%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" >Indikator Kinerja Program(IKP)/ Indikator kinerja Kegiatan(IKK) </td>                                        
                                        <td width=\"20%\" bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"4\" >Target</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\">Penanggung Jawab</td>
                                      </tr> 
                                      
                                      <tr>  
                                        <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" >2016</td>
                                        <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" >2017</td>
                                        <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" >2018</td>
                                        <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\" >2019</td>
                                      </tr>   
                                 </thead> 
                                 <tfoot>
                                    <tr><td style=\"border-top: solid 1px black; border-left:none;border-right:none;\" colspan=\"16\"></td>
                                 </tfoot>";
        $cRet .=       " </table>";
        
        
        $data['prev']= $cRet;    
        switch($ct) {       
        case 1;
            echo($cRet);
            //$this->template->load('template','master/kegiatan/cetak1',$data);
        break;
        case 2;
            $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        case 4;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        } 
        
                
    }
    
    function preview_1($ct='1',$ctk='',$prog='',$giat=''){
            $judul='lampiran';
            $kd_skpd = $this->session->userdata('kdskpd');
            $thn_ang = $this->session->userdata('pcThang');
            $sqldns="select * from t_dept   WHERE kddept='$kd_skpd'";
                 $sqlskpd=$this->db->query($sqldns);
                 foreach ($sqlskpd->result() as $rowdns)
                {
                   
                    $kd_dept = $rowdns->kddept;
                    $nm_dept  = $rowdns->nmdept;
                }
            
            $thn_ang_2= $thn_ang+1;
            $thn_ang_3= $thn_ang+2;
            $thn_ang_4= $thn_ang+3;
            $thn_ang_5= $thn_ang+4;
            $cRet='';
                     $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                                <tr>
                                     <td align=\"center\"><strong>Lampiran </strong></td>                         
                                </tr>
                                <tr>
                                     <td align=\"center\"><strong>$kd_dept:$nm_dept</strong></td>                         
                                </tr>
                                                  
                                
                                <tr>
                                     <td align=\"center\">&nbsp;</td>
                                </tr>
                              </table>";   
                    
                            
                    $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                                 <thead>                       
                                        
             		                  <tr>  
                                        <td width=\"15%\" bgcolor=\"#CCCCCC\" align=\"center\" >Program/Kegiatan</td>
                                        <td width=\"35%\" bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"2\"  >Sasaran Program/Sasaran Kegiatan(Output)/Indikator</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >Lokasi</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >Volume Output</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\">Satuan</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >Alokasi(Dalam Juta Rupiah)</td>
                                        <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\" >Unit Organisasi Pelaksana</td>
                                      </tr> 
                                      
                                      
                                 </thead>";
                                if($ctk=='1'){
                                   $sqlkl="SELECT d.kddept,f.nmdept,SUM(a.rupiah) AS rupiah ,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
                                                SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn FROM d_sasarankl AS d 
                                                LEFT JOIN t_dept AS f ON d.kddept=f.kddept
                                                LEFT JOIN d_sasaran_prog AS c ON c.kddept=d.kddept AND c.nosasstra=d.nomor 
                                                LEFT JOIN d_item_output AS b ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND b.nosasprog=c.nosasprog
                                                LEFT JOIN d_kmpnen AS e ON e.kddept=b.kddept AND e.kdunit=b.kdunit AND e.kdprogram=b.kdprogram AND e.kdgiat=b.kdgiat AND e.kdoutput=b.kdoutput
                                                LEFT JOIN d_lok AS a ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput AND a.kdkmpnen=e.kdkmpnen
                                                WHERE d.kddept='$kd_skpd' AND  a.kdkmpnen <>'' AND a.kdprop <>'' GROUP BY d.kddept ORDER BY d.nomor"; 
                                }else if($ctk=='2'){ 
                                $sqlkl="SELECT a.kddept,b.nmdept,sum(a15) as total,sum(a16) as total1,sum(a17) as total2,sum(a18) as total3,sum(a19) as total4  FROM d_item_output a INNER JOIN t_dept b ON a.kddept=b.kddept 
                                        WHERE a.kddept='$kd_skpd' and a.kdprogram='$prog' GROUP BY a.kddept,b.nmdept";
                                }else{ 
                                $sqlkl="SELECT a.kddept,b.nmdept,sum(a15) as total,sum(a16) as total1,sum(a17) as total2,sum(a18) as total3,sum(a19) as total4  FROM d_item_output a INNER JOIN t_dept b ON a.kddept=b.kddept 
                                        WHERE a.kddept='$kd_skpd' and a.kdprogram='$prog' and a.kdgiat='$giat' GROUP BY a.kddept,b.nmdept";
                                }
                                 $sqld=$this->db->query($sqlkl);
                                 $dtsastrakl=0;
                                 foreach ($sqld->result() as $rowd)
                                    {
                                       
                                        $kddept=$rowd->kddept;
                                        $nama1=$rowd->nmdept;
                                       
                                                    $djtrp=$rowd->rupiah;
                                                    $djtpln=$rowd->pln;
                                                    $djtpdn=$rowd->pdn;
                                                    $djthibah=$rowd->hibah;
                                                    $djtpend=$rowd->pend;
                                                    $djtpnbp=$rowd->pnbp;
                                                    $djtblu=$rowd->blu;
                                                    $djtsbsn1=$rowd->sbsn;
                                                    $djtjml=$djtrp+$djtpend+$djtpln+$djtpdn+$djthibah+$djtpnbp+$djtblu+$djtsbsn1;
                                                  $dcalokasi=$djtjml;
                                                  $dtsastrakl=$dtsastrakl+$dcalokasi;
                                                  $ddalokasi=number_format($dcalokasi,"1",",",".");                  
                                         $cRet    .= " <tr>                                    
                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;color:red\" colspan=\"3\" width=\"50%\"><strong>$kddept-$nama1</strong></td>
                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$ddalokasi</td>
                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                         </tr>
                                                         ";
                                                         
                                                         $sqlkl="SELECT d.nomor AS nosasstra,d.nama ,SUM(a.rupiah) AS rupiah ,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
                                                SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn FROM d_sasarankl AS d 
                                                LEFT JOIN d_sasaran_prog AS c ON c.kddept=d.kddept AND c.nosasstra=d.nomor 
                                                LEFT JOIN d_item_output AS b ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND b.nosasprog=c.nosasprog
                                                LEFT JOIN d_kmpnen AS e ON e.kddept=b.kddept AND e.kdunit=b.kdunit AND e.kdprogram=b.kdprogram AND e.kdgiat=b.kdgiat AND e.kdoutput=b.kdoutput
                                                LEFT JOIN d_lok AS a ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput AND a.kdkmpnen=e.kdkmpnen
                                                WHERE d.kddept='$kd_skpd' and  a.kdkmpnen <>'' and a.kdprop <>'' GROUP BY c.nosasstra order by d.nomor";
                                                         $sqlpkl=$this->db->query($sqlkl);
                                                         $a=0;
                                                         $tsastrakl=0;
                                                         foreach ($sqlpkl->result() as $row2)
                                                            {
                                                                $a=$a+1;
                                                                $kdsaskl= $row2->nosasstra; 
                                                                $nmsaskl= $row2->nama;
                                                                $jtrp=$row2->rupiah;
                                                                $jtpln=$row2->pln;
                                                                $jtpdn=$row2->pdn;
                                                                $jthibah=$row2->hibah;
                                                                $jtpend=$row2->pend;
                                                                $jtpnbp=$row2->pnbp;
                                                                $jtblu=$row2->blu;
                                                                $jtsbsn1=$row2->sbsn;
                                                                $jtjml=$jtrp+$jtpend+$jtpln+$jtpdn+$jthibah+$jtpnbp+$jtblu+$jtsbsn1;
                                                              $calokasi=$jtjml;
                                                              $tsastrakl=$tsastrakl+$calokasi;
                                                              $alokasi=number_format($calokasi,"1",",",".");
                                                                                
                                                                 $cRet    .= " <tr>                                    
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"15%\"></td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" colspan=\"2\" width=\"35%\"><b>$kdsaskl.&nbsp;$nmsaskl</b></td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$alokasi</td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                 </tr>
                                                                                 ";
                                                                                 $sqlikl="SELECT * from d_indikatorkl where kddept='$kd_skpd' and nomor_sasarankl='$kdsaskl'";
                                                                                 $sqlpikl=$this->db->query($sqlikl);
                                                                                 foreach ($sqlpikl->result() as $rowikl)
                                                                                    {
                                                                                       
                                                                                        $indikator_kl=$rowikl->nama;
                                                                                         $ivol=$rowikl->vol1;
                                                                                                        
                                                                                         $cRet    .= " <tr>                                    
                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"15%\"></td>
                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;border-right-style:hidden;\" width=\"2%\"></td>
                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"33%\"><i>-$indikator_kl</i></td>
                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$ivol </td>
                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"></td>
                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                         </tr>
                                                                                                         ";
                                                                                    }
                                                            }
                                                         if($ctk=='1'){
                                                         $sql="SELECT d.kdprogram,d.nmprogram,d.kdunit,f.nmunit,d.status,SUM(a.rupiah) AS rupiah,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
                                                                SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn
                                                                FROM t_program d
                                                                LEFT JOIN t_unit f ON d.kddept=f.kddept AND d.kdunit=f.kdunit
                                                                LEFT JOIN d_sasaran_prog c ON c.kddept=d.kddept AND c.kdunit=d.kdunit AND c.kdprogram=d.kdprogram
                                                                LEFT JOIN d_item_output b ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND  b.nosasprog =c.nosasprog  
                                                                LEFT JOIN d_kmpnen AS e ON e.kddept=b.kddept AND e.kdunit=b.kdunit AND e.kdprogram=b.kdprogram AND e.kdgiat=b.kdgiat AND e.kdoutput=b.kdoutput
                                                                LEFT JOIN d_lok AS a ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput AND a.kdkmpnen=e.kdkmpnen 
                                                                WHERE d.kddept='$kd_skpd' AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') AND a.kdkmpnen <>'' and a.kdprop <>''  GROUP BY d.`kdprogram`
                                                                 ";
                                                         }else if($ctk=='2'){
                                                          $sql="SELECT a.kdprogram,b.nmprogram,b.pelaksana,sum(a15) as total,sum(a16) as total1,sum(a17) as total2,sum(a18) as total3,sum(a19) as total4  FROM d_item_output a INNER JOIN t_program b ON a.kddept=b.kddept AND a.kdprogram=b.kdprogram
                                                                WHERE a.kddept='$kd_skpd' and a.kdprogram='$prog' GROUP BY a.kdprogram,b.nmprogram,b.pelaksana ";  
                                                         }else{
                                                          $sql="SELECT a.kdprogram,b.nmprogram,b.pelaksana,sum(a15) as total,sum(a16) as total1,sum(a17) as total2,sum(a18) as total3,sum(a19) as total4  FROM d_item_output a INNER JOIN t_program b ON a.kddept=b.kddept AND a.kdprogram=b.kdprogram
                                                                WHERE a.kddept='$kd_skpd' and a.kdprogram='$prog' and a.kdgiat='$giat' GROUP BY a.kdprogram,b.nmprogram,b.pelaksana ";  
                                                         }
                                                         $sqlp=$this->db->query($sql);
                                                         $trupiah= 0 ;//number_format($rp+$pend,"1",",",".");
                                                        $tphlnpdn= 0 ;//number_format($pln+$hibah+$pdn,"1",",",".");
                                                        $tpnbpblu= 0 ;//number_format($pnbp+$blu,"1",",",".");
                                                        $tsbsn= 0 ;//number_format($row3->sbsn,"1",",",".");
                                                        $tjumlah16 =0; 
                                                         foreach ($sqlp->result() as $row3)
                                                            {
                                                               
                                                                $kdprogram=$row3->kdprogram;
                                                                $nmprogram=$row3->nmprogram;
                                                                $kdunit=$row3->kdunit;
                                                                $nmunit=$row3->nmunit;
                                                                $sta=$row3->status;
                                                                $rp=$row3->rupiah;
                                                                $pln=$row3->pln;
                                                                $pdn=$row3->pdn;
                                                                $hibah=$row3->hibah;
                                                                $pend=$row3->pend;
                                                                $pnbp=$row3->pnbp;
                                                                $blu=$row3->blu;
                                                                $sbsn1=$row3->sbsn;
                                                                $jmal=$rp+$pend+$pln+$hibah+$pdn+$pnbp+$blu+$sbsn1;
                                                                $trupiah= $trupiah+$rp+$pend ;
                                                                $tphlnpdn= $tphlnpdn+$pln+$hibah+$pdn;
                                                                $tpnbpblu= $tpnbpblu+$pnbp+$blu;
                                                                $tsbsn= $tsbsn + $sbsn1;
                                                                $tjumlah16 =$tjumlah16 + $jmal; 
                                                                $rupiah=number_format($rp+$pend,"1",",",".");
                                                                $phlnpdn=number_format($pln+$hibah+$pdn,"1",",",".");
                                                                $pnbpblu=number_format($pnbp+$blu,"1",",",".");
                                                                $sbsn=number_format($row3->sbsn,"1",",",".");
                                                                $jumlah=number_format($rp+$pend+$pln+$hibah+$pdn+$pnbp+$blu+$sbsn1,"1",",",".");                
                                                                 $cRet    .= " <tr>                                    
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none; color:blue\" colspan=\"3\" width=\"50%\"><strong>$kdprogram-$nmprogram</strong></td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$jumlah</td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\">$kdunit.$nmunit</td>
                                                                                 </tr>
                                                                                 ";
                                                                                 
                                                                                 $sqlprog="SELECT c.nosasprog,c.nmsasprog,SUM(a.rupiah) AS rupiah,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,
                                                                                            SUM(hibah) AS hibah,SUM(pend) AS pend,SUM(a.sbsn) AS sbsn,SUM(a.jumlah) AS jumlah FROM d_sasaran_prog c
                                                                                            LEFT JOIN d_item_output b ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND b.nosasprog=c.nosasprog
                                                                                            LEFT JOIN d_kmpnen AS e ON e.kddept=b.kddept AND e.kdunit=b.kdunit AND e.kdprogram=b.kdprogram AND e.kdgiat=b.kdgiat AND e.kdoutput=b.kdoutput
                                                                                            LEFT JOIN d_lok AS a ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput AND a.kdkmpnen=e.kdkmpnen
                                                                                            WHERE c.kddept='$kd_skpd' AND c.kdprogram='$kdprogram' AND c.kdunit='$kdunit' AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') AND a.kdkmpnen <>'' AND a.kdprop <>'' GROUP BY c.nosasprog
                                                                                             ";
                                                                                 $sqlpprog=$this->db->query($sqlprog);
                                                                                 $b=0;
                                                                                 $tsasprog=0;
                                                                                 foreach ($sqlpprog->result() as $rowprog)
                                                                                    {
                                                                                        $b=$b+1;
                                                                                        $kdsasprog= $rowprog->nosasprog; 
                                                                                        $nmsasprog= $rowprog->nmsasprog;
                                                                                        $xtrp=$rowprog->rupiah;
                                                                                        $xtpln=$rowprog->pln;
                                                                                        $xtpdn=$rowprog->pdn;
                                                                                        $xthibah=$rowprog->hibah;
                                                                                        $xtpend=$rowprog->pend;
                                                                                        $xtpnbp=$rowprog->pnbp;
                                                                                        $xtblu=$rowprog->blu;
                                                                                        $xtsbsn1=$rowprog->sbsn;
                                                                                        $xtjml2=$xtrp+$xtpend+$xtpln+$xtpdn+$xthibah+$xtpnbp+$xtblu+$xtsbsn1;
                                                                                        $calokasi=$xtjml2;
                                                                                        $tsasprog=$tsasprog+$calokasi;
                                                                                        $spalokasi=number_format($xtjml2,"1",",",".");                
                                                                                         $cRet    .= " <tr>                                    
                                                                                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"15%\"></td>
                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" colspan=\"2\" width=\"35%\"><b>$kdsasprog.&nbsp;$nmsasprog</b></td>
                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$spalokasi</td>
                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                         </tr>
                                                                                                         ";
                                                                                                         $sqliprg="SELECT * from d_indikator_prog where kddept='$kd_skpd' and kdprogram='$kdprogram' and nosasprog='$kdsasprog'";
                                                                                                         $sqlpprg=$this->db->query($sqliprg);
                                                                                                         foreach ($sqlpprg->result() as $rowiprg)
                                                                                                            {
                                                                                                               
                                                                                                                $indikator_prog=$rowiprg->uraian;
                                                                                                                $ipvol1=$rowiprg->vol1;
                                                                                                                                
                                                                                                                 $cRet    .= " <tr>                                    
                                                                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"15%\"></td>
                                                                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;border-right-style:hidden;\" width=\"2%\"></td>
                                                                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"33%\"><i>-$indikator_prog</i></td>
                                                                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$ipvol1 </td>
                                                                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"></td>
                                                                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                                                 </tr>
                                                                                                                                 ";
                                                                                                            }
                                                                                    }
                                                                         if($ctk=='3'){
                                                                         $sql1="SELECT f.kdgiat,f.nmgiat,f.kddit,g.nmdit,SUM(z.rupiah) AS rupiah,SUM(z.pend) AS pend,SUM(z.pln) AS pln,SUM(z.hibah) AS hibah,SUM(z.pdn) AS pdn,
                                                                                SUM(z.pnbp) AS pnbp,SUM(z.blu) AS blu,SUM(z.sbsn) AS sbsn FROM t_giat f
                                                                                LEFT JOIN t_dit g ON f.kddept=g.kddept AND f.kdunit=g.kdunit AND f.kddit=g.kddit 
                                                                                LEFT JOIN (
                                                                                SELECT a.kddept,a.kdunit,a.kdprogram,a.kdgiat,a.kdoutput,b.nosasprog,c.nosasstra,a.rupiah AS rupiah,a.pnbp AS pnbp,a.blu AS blu,a.pln AS pln,a.pdn AS pdn,
                                                                                hibah AS hibah,pend AS pend,a.sbsn AS sbsn FROM d_lok a 
                                                                                INNER JOIN d_kmpnen e ON a.kddept=e.kddept AND a.kdunit=e.kdunit AND a.kdprogram=e.kdprogram AND a.kdgiat=e.kdgiat AND a.kdoutput=e.kdoutput AND a.kdkmpnen=e.kdkmpnen
                                                                                INNER JOIN d_item_output b ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput
                                                                                INNER JOIN d_sasaran_prog c ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND b.nosasprog=c.nosasprog
                                                                                WHERE a.kddept='$kd_skpd' AND a.kdprogram='$kdprogram' and a.kdunit='$kdunit' AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') AND a.kdkmpnen <>'' and a.kdprop <>'')z ON f.kddept=z.kddept AND f.kdunit=z.kdunit AND f.kdprogram=z.kdprogram AND f.kdgiat=z.kdgiat
                                                                                WHERE f.kddept='$kd_skpd' AND f.kdprogram='$kdprogram' and f.kdunit='$kdunit'
                                                                                GROUP BY  f.kddept,f.kdunit,f.kdprogram,f.kdgiat"; 
                                                                         }else {             
                                                                         $sql1="SELECT f.kdgiat,f.nmgiat,f.kddit,g.nmdit,SUM(z.rupiah) AS rupiah,SUM(z.pend) AS pend,SUM(z.pln) AS pln,SUM(z.hibah) AS hibah,SUM(z.pdn) AS pdn,
                                                                                SUM(z.pnbp) AS pnbp,SUM(z.blu) AS blu,SUM(z.sbsn) AS sbsn FROM t_giat f
                                                                                LEFT JOIN t_dit g ON f.kddept=g.kddept AND f.kdunit=g.kdunit AND f.kddit=g.kddit 
                                                                                LEFT JOIN (
                                                                                SELECT a.kddept,a.kdunit,a.kdprogram,a.kdgiat,a.kdoutput,b.nosasprog,c.nosasstra,a.rupiah AS rupiah,a.pnbp AS pnbp,a.blu AS blu,a.pln AS pln,a.pdn AS pdn,
                                                                                hibah AS hibah,pend AS pend,a.sbsn AS sbsn FROM d_lok a 
                                                                                INNER JOIN d_kmpnen e ON a.kddept=e.kddept AND a.kdunit=e.kdunit AND a.kdprogram=e.kdprogram AND a.kdgiat=e.kdgiat AND a.kdoutput=e.kdoutput AND a.kdkmpnen=e.kdkmpnen
                                                                                INNER JOIN d_item_output b ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput
                                                                                INNER JOIN d_sasaran_prog c ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND b.nosasprog=c.nosasprog
                                                                                WHERE a.kddept='$kd_skpd' AND a.kdprogram='$kdprogram' and a.kdunit='$kdunit' AND c.nosasstra IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') AND a.kdkmpnen <>'' and a.kdprop <>'')z ON f.kddept=z.kddept AND f.kdunit=z.kdunit AND f.kdprogram=z.kdprogram AND f.kdgiat=z.kdgiat
                                                                                WHERE f.kddept='$kd_skpd' AND f.kdprogram='$kdprogram' and f.kdunit='$kdunit'
                                                                                GROUP BY  f.kddept,f.kdunit,f.kdprogram,f.kdgiat";
                                                                          }    
                                                                         $sqlp1=$this->db->query($sql1);
                                                                         $tzrp=0;
                                                                        $tzphln=0;
                                                                        $tzpnbp=0;
                                                                        $tzsbsn=0;
                                                                         foreach ($sqlp1->result() as $rowp1)
                                                                            {
                                                                               
                                                                                $kdgiat=$rowp1->kdgiat;
                                                                                $nmgiat=$rowp1->nmgiat;
                                                                                $kddit=$rowp1->kddit;
                                                                                $nmdit=$rowp1->nmdit;
                                                                                $yrp=$rowp1->rupiah;
                                                                                $ypln=$rowp1->pln;
                                                                                $ypdn=$rowp1->pdn;
                                                                                $yhibah=$rowp1->hibah;
                                                                                $ypend=$rowp1->pend;
                                                                                $ypnbp=$rowp1->pnbp;
                                                                                $yblu=$rowp1->blu;
                                                                                $ysbsn1=$rowp1->sbsn;
                                                                                $tzrp=$tzrp+$yrp+$ypend;
                                                                                $tzphln=$tzphln+$ypln+$yhibah+$ypdn;
                                                                                $tzpnbp=$tzpnbp+$ypnbp+$yblu;
                                                                                $tzsbsn=$tzsbsn+$ysbsn1;
                                                                                $yjml=$yrp+$ypln+$ypdn+$yhibah+$ypend+$ypnbp+$yblu+$ysbsn1;
                                                                                $rupiah=number_format($yrp+$ypend,"1",",",".");
                                                                                $phlnpdn=number_format($ypln+$yhibah+$ypdn,"1",",",".");
                                                                                $pnbpblu=number_format($ypnbp+$yblu,"1",",",".");
                                                                                $sbsn=number_format($row3->sbsn,"1",",",".");
                                                                                $kjumlah=number_format($yjml,"1",",","."); 
                                                                                                       
                                                                                $cRet    .= " <tr>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none; color:green\" colspan=\"3\" width=\"50%\"><strong>$kdgiat-$nmgiat</strong></td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$kjumlah</td>
                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\">$kddit.$nmdit</td>
                                                                                 
                                                                                 </tr>
                                                                                 ";
                                                                                                 
                                                                                 $sqlsasgiat="SELECT kdoutput,nmoutput,vol1 as vol,kddimensi AS dimensi,kdpbidang AS bidang,kdnwcita AS nawacita,
                                                                                            IF(dppp='1','DPP','') AS dpp,IF(darg='1','ARG','') AS arg,IF(dksst='1','KSST','') AS ksst,IF(dmpi='1','MPI','') AS mpi,
                                                                                            IF(ppban='1','PPBAN','') AS ppban,STATUS AS sta FROM d_item_output 
                                                                                            WHERE  kddept='$kd_skpd' AND kdprogram='$kdprogram' and kdgiat='$kdgiat' order by kdoutput";
                                                                                 $querysasgiat= $this->db->query($sqlsasgiat);
                                                                                 $tsasgiat=0;
                                                                                 foreach ($querysasgiat->result() as $rowsasgiat)
                                                                                        {
                                                                                         $kdoutput=$rowsasgiat->kdoutput;
                                                                                         $nmoutput=$rowsasgiat->nmoutput;
                                                                                         $target=$rowsasgiat->vol;
                                                                                         $dimensi=$rowsasgiat->dimensi;
                                                                                         $bidang=$rowsasgiat->bidang;
                                                                                         $nawacita=$rowsasgiat->nawacita;
                                                                                         $dpp=$rowsasgiat->dpp;
                                                                                         $arg=$rowsasgiat->arg;
                                                                                         $ksst=$rowsasgiat->ksst;
                                                                                         $mpi=$rowsasgiat->mpi;
                                                                                         $ppban=$rowsasgiat->ppban;
                                                                                         $sta=$rowsasgiat->sta;
                                                                                         $sql2="SELECT SUM(a.rupiah) AS rupiah,SUM(a.pln) AS pln,SUM(a.pdn) AS pdn,SUM(hibah) AS hibah,
                                                                                                SUM(pend) AS pend,SUM(a.pnbp) AS pnbp,SUM(a.blu) AS blu,SUM(a.sbsn) AS sbsn
                                                                                                FROM d_lok a
                                                                                                INNER JOIN d_kmpnen e ON a.kddept=e.kddept AND a.kdunit=e.kdunit AND a.kdprogram=e.kdprogram AND a.kdgiat=e.kdgiat AND a.kdoutput=e.kdoutput AND a.kdkmpnen=e.kdkmpnen  
                                                                                                INNER JOIN d_item_output b ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput
                                                                                                INNER JOIN d_sasaran_prog c ON b.kddept=c.kddept AND b.kdunit=c.kdunit AND b.kdprogram=c.kdprogram AND b.nosasprog=c.nosasprog
                                                                                                WHERE a.kddept='$kd_skpd' AND a.kdprogram='$kdprogram' AND a.kdgiat='$kdgiat' AND a.kdoutput='$kdoutput' AND c.nosasstra  IN (SELECT nomor FROM `d_sasarankl` WHERE kddept='$kd_skpd') AND a.kdkmpnen <>'' and a.kdprop <>'' ";
                                                                     
                                                                                             $query2 = $this->db->query($sql2);
                                                                                                                                  
                                                                                                foreach ($query2->result() as $row2)
                                                                                                {
                                                                                                    
                                                                                                    $trp=$row2->rupiah;
                                                                                                    $tsbsn1=$row2->sbsn;
                                                                                                    $tpln=$row2->pln;
                                                                                                    $tpdn=$row2->pdn;
                                                                                                    $thibah=$row2->hibah;
                                                                                                    $tpend=$row2->pend;
                                                                                                    $tpnbp=$row2->pnbp;
                                                                                                    $tblu=$row2->blu;
                                                                                                    $tjml=$trp+$tpend+$tpln+$tpdn+$thibah+$tpnbp+$tblu+$tsbsn1;
                                                                                                    //$calokasi=$row2->alokasi;
                                                                                                    $tsasgiat=$tsasgiat+$tjml;
                                                                                                    $alokasi=number_format($tjml,"1",",",".");
                                                                                                     $cRet    .= " <tr>                                    
                                                                                                                <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"15%\"></td>
                                                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" colspan=\"2\" width=\"35%\"><b>$kdoutput.&nbsp;$nmoutput</b></td>
                                                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$alokasi</td>
                                                                                                                 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                                 </tr>
                                                                                                                 ";
                                                                                                                 
                                                                                                                 $sqliout="SELECT * from d_indikator_output where kddept='$kd_skpd' and kdprogram='$kdprogram' and kdgiat='$kdgiat' and kdoutput='$kdoutput' order by nomor";
                                                                                                                 $sqlpout=$this->db->query($sqliout);
                                                                                                                 foreach ($sqlpout->result() as $rowiout)
                                                                                                                    {
                                                                                                                       
                                                                                                                        $indikator_kk=$rowiout->nama;
                                                                                                                        $ovol1=$rowiout->vol1;              
                                                                                                                         $cRet    .= " <tr>                                    
                                                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"15%\"></td>
                                                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;border-right-style:hidden;\" width=\"2%\"></td>
                                                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"33%\"><i>-$indikator_kk</i></td>
                                                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$ovol1 </td>
                                                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"></td>
                                                                                                                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\"></td>
                                                                                                                                         </tr>
                                                                                                                                         ";
                                                                                                                    }
                                                                                                   }
                                                                                    }
                                                                        }
                                                            
                                                                    
                                                               }
                                         }
                                $cRet .=       " </table>";
        
        
        $data['prev']= $cRet;    
        switch($ct) {       
        case 1;
            echo($cRet);
            //$this->template->load('template','master/kegiatan/cetak1',$data);
        break;
        case 2;
            $this->_mpdf('',$cRet,10,10,10,'1');
        break;
        case 3;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        case 4;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
            $this->load->view('anggaran/rka/bappenas', $data);
        break;
        } 
        
                
    }
    
    function _mpdf($judul='',$isi='',$lMargin=10,$rMargin=10,$font=12,$orientasi='1') {
        
        ini_set("memory_limit","-1");
        $this->load->library('mpdf');
        
        /*
        $this->mpdf->progbar_altHTML = '<html><body>
	                                    <div style="margin-top: 5em; text-align: center; font-family: Verdana; font-size: 12px;"><img style="vertical-align: middle" src="'.base_url().'images/loading.gif" /> Creating PDF file. Please wait...</div>';        
        $this->mpdf->StartProgressBarOutput();
        */
        
        $this->mpdf->defaultheaderfontsize = 6;	/* in pts */
        $this->mpdf->defaultheaderfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */

        $this->mpdf->defaultfooterfontsize = 6;	/* in pts */
        $this->mpdf->defaultfooterfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 1; 
        
        //$this->mpdf->SetHeader('SIMAKDA||');
        $jam = date("H:i:s");
        //$this->mpdf->SetFooter('Printed on @ {DATE j-m-Y H:i:s} |Simakda| Page {PAGENO} of {nb}');
        $this->mpdf->SetFooter('Printed on @ {DATE j-m-Y H:i:s} |Halaman {PAGENO} / {nb}| ');
        
        $this->mpdf->AddPage($orientasi);
        
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);
         
        $this->mpdf->Output();
    }  
    
}


