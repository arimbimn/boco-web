<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Membership</title>
    <!-- Icons -->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/fontawesome.css">
    <!-- Bootstrap css -->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrap.css">
  <script type='text/javascript' src='<?= base_url() ?>assets/chartjs/jquery.js'></script>
  <!--link rel="stylesheet" href="<?= base_url() ?>assets/chartjs/demo.css"/-->
  <link rel="stylesheet" href="<?= base_url() ?>assets/chartjs/jquery.orgchart.css"/>
  <script src="<?= base_url() ?>assets/chartjs/jquery.orgchart.js"></script>
  <style>
      #loading {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.8);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

#loading img {
  width: 50px; /* Atur lebar sesuai kebutuhan Anda */
  height: 50px; /* Atur tinggi sesuai kebutuhan Anda */
  animation: spin 2s linear infinite; /* Animasi berputar selama 2 detik secara tak terbatas */
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

  </style>
   <script type='text/javascript'>
$(function(){
//var members=<!?php echo json_encode($data_downline); ?>;
/*$.ajax({
	url:'load.php',
	async:false,
	success:function(data){
		members=$.parseJSON(data)
	}
})*/
	function showLoading() {
        var loadingElement = $("#loading");
        loadingElement.show();
    }
    
    function hideLoading() {
        var loadingElement = $("#loading");
        loadingElement.hide();
    }
	showLoading();
var id="<?= $this->uri->segment('3') !== false ? $this->uri->segment('3') : '0' ?>";
//alert(id);
if(id == '0' || id == ''){
    alert('Data tidak ada');
    hideLoading();
    exit;
}
var data='id='+id;
		$.ajax({
            url: "<?= base_url('MembersController/get_view_tree') ?>",
            type: 'POST',
            data:data,
            dataType: 'JSON',
            success: function(response){
                view_tree(response,1);
                hideLoading();
            },
              error: function(error) {
                console.error("Error:", error);
                hideLoading();
              }
        });
	function view_tree(members,sts){
		//memberId,parentId,otherInfo
		for(var i = 0; i < members.length; i++){
			
		    var member = members[i];
			var vclass;
			var vaktif="";
			var vwa="";
			var add_text="";
			var vstyle="";
			var sts_royalti="OFF";
			var vaktif_royalti="bg-danger";
			if(i < 1){
				vclass="memberfirst";
			}else{
				vclass="member";
			}
			if(member.level == 1){
			    vwa="<a class='text-white label-default fa fa-whatsapp' href='https://wa.me/"+member.phone+"' class='label-default' target='_blank'>" +member.phone+"</a>";
			}
			if(member.peringkat == 'Master Distributor'){
				vcss='text-white';
				vstyle="background-color: #FF8F00;font-size:12px";
			}else if(member.peringkat == 'Distributor'){
				vcss='text-white';
				vstyle="background-color: #992BAC;font-size:12px";
			}else if(member.peringkat == 'Agent'){
				vcss='text-white';
				vstyle="background-color: #283593;font-size:12px";
			}else{
			    vcss='bg-success text-white'; //bg-info
			    if(member.sts == 'TIDAK AKTIF'){
			        vaktif='bg-danger ';
			    }else{
			        vaktif="";
			    }
				vstyle="font-size:12px";
			    /*if(member.sts == 'AKTIF'){
			        vcss='bg-info text-white';
			    }else{
			        vcss='bg-danger text-white';
			    }*/
			}
			
			if(member.sts == 'TIDAK AKTIF'){
			  add_text="";
			}else{
			  add_text=" ("+member.tgl_peringkat+")";
			}
			
			var_css=vcss;//+" "+vclass;
			if(member.op_asli >= 27027027){
			    sts_royalti="ON";
			    vaktif_royalti="bg-warning";
			}
			
			if(i==0){
				$("#mainContainer").append("<li id="+member.id+" style='"+vstyle+"' class='"+var_css+"'><small>"+member.name+" ("+member.username+")"+"<br/><b>" + 
				member.peringkat + "</b><br/>" +
				"OP: "+member.op + "<br/>" +
				"OG: "+member.og + "<br/>" +
				"<span class='"+vaktif+"'>STS: "+member.sts+add_text + "</span><br/>" +
				"Royalty: <span class='"+vaktif_royalti+"'>"+sts_royalti + "</span><br/>" +
				"</small></li>")
			}else{
				
				if($('#pr_'+member.sponsor).length<=0){
				  $('#'+member.sponsor).append("<ul id='pr_"+member.sponsor+"'><li id="+member.id+" style='"+vstyle+"' class='"+var_css+"'><small><a href="+member.id+" class='text-white label-default' id='mc-submit' target='_blank'>"+member.name+" ("+member.username+")"+"</a><br/><b>" + 
				member.peringkat + "</b><br/>" +
				"OP: "+member.op + "<br/>" +
				"OG: "+member.og + "<br/>" +
				"<span class='"+vaktif+"'>STS: "+member.sts+add_text + "</span><br/>" +
				"<span>"+ vwa + "</span>" +
				"Royalty: <span class='"+vaktif_royalti+"'>"+sts_royalti + "</span><br/>" +
				"</small></li></ul>")
				}
				else{
				  $('#pr_'+member.sponsor).append("<li id="+member.id+" style='"+vstyle+"' class='"+var_css+"'><small><a href="+member.id+" class='text-white label-default' id='mc-submit' target='_blank'>"+member.name+" ("+member.username+")"+"</a><br/><b>" + 
				member.peringkat + "</b><br/>" +
				"OP: "+member.op + "<br/>" +
				"OG: "+member.og + "<br/>" +
				"<span class='"+vaktif+"'>STS: "+member.sts+add_text + "</span><br/>" +
				"<span>"+ vwa + "</span>" +
				"Royalty: <span class='"+vaktif_royalti+"'>"+sts_royalti + "</span><br/>" +
				"</small></li>")
			     }
				
			}
		}
					 
		$("#mainContainer").orgChart({container: $("#main"),interactive: true, fade: true, speed: 'slow'});	
	}
}); 
</script>
</head>
<body>
<div id="loading" style="display: none;">
    <img src="<?= base_url() ?>assets/images/Spinner-3.gif" alt="Loading..." />
</div>
<div  style="display: none">
<ul id="mainContainer" class="clearfix"></ul>	
</div>
<div id="main">
</div>
</body>
</html>