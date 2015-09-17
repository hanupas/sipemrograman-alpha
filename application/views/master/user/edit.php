 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>    

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css"> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
    <style>
        table{
            border-spacing: 0;
        }
        td{
            padding: 0px;
        }
        input{
            padding: 2px;
            border: 1px solid #ccc;
        }
        input:hover{
            border: 1px solid #000;
        }
        input:focus{
            border: 1px solid #f00;
        }

    </style>
    <script type="text/javascript"> 
    
    $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 220,
            width: 400,
            modal: true,
            autoOpen:false
        });
        get_skpd();
  });          

    function get_skpd()
        {
        	$.ajax({
        		url:'<?php echo base_url(); ?>index.php/rka/config_skpd',
        		type: "POST",
        		dataType:"json",                         
        		success:function(data){
        								$("#sskpd").attr("value",data.kd_skpd);
        								$("#nmskpd").attr("value",data.nm_skpd.toUpperCase());
        								kdskpd = data.kd_skpd;
                                        sta    = data.statu;
                                        validate_prog();
                                        validate_jns();
                                        //alert(kdskpd);
        							  }                                     
        	});
        }
    function validate_jns(){
	  	    $(function(){
            $('#jns').combogrid({  
            panelWidth : 700,  
            idField    : 'kd',  
            textField  : 'kd',  
            mode       : 'remote',
            url        : '<?php echo base_url(); ?>index.php/master/jns_user',  
            columns    : [[  
                {field:'kd',title:'Kode',width:50},  
                {field:'jns',title:'Jenis',width:680}    
            ]],
            onSelect:function(rowIndex,rowData){
                user = rowData.kd;
                $("#nmjns").attr("value",rowData.jns.toUpperCase());
            }
            }); 
            });
		}    
        
    function validate_prog(){
	  	    $(function(){
            $('#kdprog').combogrid({  
            panelWidth : 700,  
            idField    : 'kdprogram',  
            textField  : 'kdprogram',  
            mode       : 'remote',
            url        : '<?php echo base_url(); ?>index.php/rka/pprog/'+kdskpd,  
            columns    : [[  
                {field:'kdprogram',title:'Kode',width:50},  
                {field:'nmprogram',title:'Nama Prog',width:680}    
            ]],
            onSelect:function(rowIndex,rowData){
                program = rowData.kdprogram;
                $("#nmprog").attr("value",rowData.nmprogram.toUpperCase());
            }
            }); 
            });
		}
    
     function simpan(){
        var cid_us = document.getElementById('id_user').value;
        var cuser = document.getElementById('user_name').value;
        var cpass = document.getElementById('password').value;
        var cnama = document.getElementById('nama').value;
        var cskpd = document.getElementById('sskpd').value;
        var cprog = $("#kdprog").combogrid("getValue");  
        var cjns = $("#jns").combogrid("getValue");
        
        if (cid_us==''){
            alert('Id User Tidak Boleh Kosong');
            exit();
        } 
        if (cuser==''){
            alert('User Name Tidak Boleh Kosong');
            exit();
        }
        if (cpass==''){
            alert('Password Tidak Boleh Kosong');
            exit();
        }
        if (cnama==''){
            alert('Nama Tidak Boleh Kosong');
            exit();
        }
        
        if (cskpd==''){
            alert('Kode SKPD Tidak Boleh Kosong');
            exit();
        }
            
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>/index.php/master/update_user',
                    data:({cidus:cid_us,cus:cuser,cpa:cpass,cnm:cnama,csikd:cskpd,cprg:cprog,cjs:cjns}),
                    dataType:"json",
                    success:function(data){
                        status = data;
                        if (status=='0'){
                            alert('Gagal Update..!!');
                            exit();
                        }else if(status=='1'){
                            alert('Data Tidak Ada..!!');
                            exit();
                        }else{
                            alert('Data Updated..!!');
                            //kosong();      
                            exit();
                        }
                    }
                });
            });    
     };
     
     
     $(function(){   
     var idq =  document.getElementById('id_user').value;
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/master/load_otorisasi/'+idq,
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'idx',
    		title:'ID',
    		width:15,
            align:"center"},
            {field:'title',
    		title:'Menu',
    		width:35},
            {field:'status',
    		title:'Status',
			align:'center',
    		width:15,
			editor:{type:'combobox',
					options:{ valueField:'status',
							  textField:'status',
							  panelwidth:910,	
							  panelheigth:10,	
							  url :'<?php echo base_url(); ?>/index.php/master/yatidak',
							  required:false									  
							}
					}			
			},
        ]],
        onAfterEdit:function(rowIndex, rowData, changes){
            idx=rowData.idx;
		    tt = rowData.title;
            st = rowData.status;
            simpanx(idx,tt,st);
           	$('#dg').datagrid('reload');  
            },
        onSelect:function(rowIndex,rowData){
          kd = rowData.idx;
          tt = rowData.title;
          st = rowData.status;
          get(kd,tt,st); 
          lcidx = rowIndex;  
                                       
        }
        
        });
       
    });  
    
    function simpanx(cid,ctt,sta){
		var ids =  document.getElementById('id_user').value;	
       // alert(sta);	
		$(document).ready(function(){
			$.ajax({
				type: "POST",
				url: '<?php echo base_url(); ?>/index.php/master/simpan_otorisasi',
				data: ({idx:cid,tt:ctt,st:sta,vids:ids}),
				dataType:"json"
			});
		});                                            
	
		$('#dg').datagrid('reload');     

    } 
    
     function get(kd,tt) {
        
        $("#id").attr("value",kd);
        $("#title").attr("value",tt);     
                       
    }
	</script>
 </head>
 <body>
<div id="content">
  <table align="center" style="width:100%;">
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>   
    	<tr>
        <td width="20%"><span style="font-weight:bold">USER ID</span></td>
        <td width="1%">:</td>
            <td>
            <input name="id_user" type="text" id="id_user" disabled="true" value="<?php echo $user->id_user; ?>" size="3" /> <?php echo form_error('id_user'); ?>
            </td>
        </tr>
        <tr>
        <td width="20%"><span style="font-weight:bold">USER NAME</span></td>
        <td width="1%">:</td>
            <td>
            <input name="user_name" type="text" id="user_name" value="<?php echo $user->user_name; ?>" size="16" />
            </td>
        </tr>
        <tr>
        <td width="20%"><span style="font-weight:bold">PASSWORD</span></td>
        <td width="1%">:</td>
            <td>
            <input name="password_before" type="hidden" id="password_before" value="<?php echo $user->password; ?>" size="40" />
            <input name="password" type="password" id="password" value="<?php echo $user->password; ?>" size="40" />
            </td>
        </tr>
        <tr>
        <td width="20%"><span style="font-weight:bold">NAMA</span></td>
        <td width="1%">:</td>
            <td>
                <input name="nama" type="text" id="nama" value="<?php echo $user->nama; ?>" size="40" />
            </td>
        </tr>
        <tr>
        <td width="20%"><span style="font-weight:bold">Kementrian/Lembaga</span></td>
        <td width="1%">:</td>
            <td>
                <input id="sskpd" name="sskpd" style="width:60px;height:15px; "/><input id="nmskpd" name="nmskpd" readonly="true" style="width: 320px; border:0;  " />
            </td>
        </td>
        </tr>
        <tr>
                <td width="20%"><span style="font-weight:bold">Jenis</span></td>
                <td width="1%">:</td>
                <td><input id="jns" name="jns" style="width:50px; height:15px" value="<?php echo $user->type; ?>"/></td>  
            </tr>     
        <tr>   
        <td width="20%"><span style="font-weight:bold">Esselon 1</span></td>
        <td width="1%">:</td>
           <td><input name="kdprog" class="easyui-combobox" id="kdprog" style="width:60px;height:15px;" value="<?php echo $user->esselon1; ?>" />
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>        
     
        <tr>
           <td colspan="3" align="center">
            <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan();">Simpan</a>
            <a class="easyui-linkbutton" iconCls="icon-reload" plain="true" onclick="history.go(0)">refresh</a>
            <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" href="<?php echo site_url(); ?>/master/user">Kembali</a> </td>
        </tr>
    </table>
    <table align="center" class="narrow" id="dg" title="LISTING OTORISASI" style="width:927px;height:450px;" >  
     </table> 
</div>
</body>

</html>