<link rel="stylesheet" href="https://adm.bocorocco-online.com:443/asset/admin-lte/plugins/select2/select2.min.css" rel="stylesheet" media="all" />
<script src="https://adm.bocorocco-online.com:443/asset//admin-lte/plugins/select2/select2.min.js"></script>
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
<!-- breadcrumb start -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="page-title">
              <h2>Members</h2>
            </div>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Members</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- breadcrumb End -->

    <!-- section start -->
    <section class="section-b-space">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
          <div class="account-sidebar"><a class="popup-btn"> <i class="fa fa-bars"></i> <?= lang('MyAccount') ?></a></div>
            <div class="dashboard-left">
              <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i><?= lang('back') ?></span></div>
              <div class="block-content">
                <?php $this->load->view('users/v_menu_user') ?>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="dashboard-right" id="dashboard-right">
              <div class="dashboard">
                <!-- product-tab starts -->
                <section class="tab-product m-0">
					<div id="loading" style="display: none;">
					  <img src="<?= base_url() ?>assets/images/Spinner-3.gif" alt="Loading..." />
					</div>
                  <div class="container"><!--button onclick="openFullscreen();">Open Video in Fullscreen Mode</button-->
					<div class="row">
						<div class="col-sm-12 col-lg-12">
                            <a href="<?= base_url('users/download') ?>" class="btn btn-info" id="mc-submit">Download</a>
							<p>
						</div>
						<div class="col-sm-6 col-lg-6">
                            <a href="<?= base_url('/MembersController/detail_members/'.$data_id) ?>" class="btn btn-outline-primary linknext2">Click to open it in fullscreen</a>
							<p>
						</div>
						<div class="col-sm-6 col-lg-6">                            
                            <div class="input-group">
                              <select class="form-control option_member" style="width: 250px;" name="member" id="member" data-placeholder="Select Downline" required>
                                <option value='0'>Tidak Pilih Downline</option>
                              </select>
                              <a href="#" id="btn_proses" type="button" class="btn btn-outline-primary linknext">search</a>
                            </div>
						</div>
					</div>

                    <div class="row">
                      <div class="col-sm-12 col-lg-12">
                        <div class="tab-content nav-material" id="top-tabContent">
                          <div class="table-responsive tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">

			<div style="display: none">
<ul id="mainContainer" class="clearfix"></ul>	
</div>
<div id="main"></div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!-- product-tab ends -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- section end -->
	<script type='text/javascript'>
$(document).ready(function() {
	    
  function showLoading() {
    var loadingElement = $("#loading");
    loadingElement.show();
  }

  function hideLoading() {
    var loadingElement = $("#loading");
    loadingElement.hide();
  }
  // Fungsi untuk mengisi elemen <select> dari hasil AJAX
  function fillSelectWithAjaxData(data) {
    var selectElement = $("#member");

    // Kosongkan elemen <select>
    selectElement.empty();

    // Tambahkan opsi "Tidak Pilih Downline"
    selectElement.append("<option value='0'>Tidak Pilih Downline</option>");
    selectElement.append("<option value='0'>&nbsp;</option>");
    // Loop melalui data yang diterima dari AJAX dan tambahkan setiap opsi ke elemen <select>
    for (var i = 0; i < data.length; i++) {
      selectElement.append("<option value='" + data[i].id + "'>" + data[i].name + "(" + data[i].username + ")</option>");
    }
  }

  // Fungsi untuk melakukan permintaan AJAX
  function fetchDataFromAjax() {
    showLoading();  
    $.ajax({
      url: "<?= base_url('MembersController/get_view_select') ?>", // Ganti dengan URL sesuai dengan server Anda
      method: 'GET', // Ganti metode HTTP sesuai kebutuhan Anda
      dataType: 'JSON',
      success: function(data) {
        // Panggil fungsi fillSelectWithAjaxData untuk mengisi elemen <select>
        fillSelectWithAjaxData(data);
        hideLoading();
      },
      error: function(error) {
        console.error("Error:", error);
        hideLoading();
      }
    });
  }

  // Panggil fungsi fetchDataFromAjax untuk mengambil data dan mengisi elemen <select>
  fetchDataFromAjax();
});
/*	var elem = document.getElementById("dashboard-right");
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen) { /* Safari */
  /*  elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE11 */
  /*  elem.msRequestFullscreen();
  }
}*/
$(function(){
//var members=<!?php echo json_encode($data_downline); ?>;
/*$.ajax({
	url:'load.php',
	async:false,
	success:function(data){
		members=$.parseJSON(data)
	}
})*/
$(".option_member").select2();
    $('.linknext2').click(function(){
        var member = $('#member').val();
        if(member == '0'){
		     alert('Silahkan pilih downline');
		     exit;
		 }
		var link = "<?= base_url('users/membersfulltree/') ?>"+member;
		$(".linknext2").attr('target', '_blank');
		$(".linknext2").attr('href', link);
    });
    $('#btn_proses').click(function(){
		 var member = $('#member').val();
		 //alert(member);
		 if(member == '0'){
		     alert('Silahkan pilih downline');
		     exit;
		 }
		 var link = "<?= base_url('users/members/') ?>"+member;
		 //$(".linknext").attr('href', link);
		 var data='id='+member;
		showLoading(); 
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
	});
function showLoading() {
    var loadingElement = $("#loading");
    loadingElement.show();
  }

  function hideLoading() {
    var loadingElement = $("#loading");
    loadingElement.hide();
  }
function view_tree(members,sts){
	if(sts == 1){
    // Reset the orgChart plugin and remove its content
        //$("#mainContainer").orgChart("destroy");
        $("#mainContainer").empty();
    }
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
	<!--script>
	var members=<!?php echo json_encode($data_downline); ?>;
var members2 = [
    {memberId : 1, parentId:null, amount:200, otherInfo:"blah"},
    {memberId : 2, parentId:1, amount:300, otherInfo:"blah1"},
    {memberId : 3, parentId:1, amount:400, otherInfo:"blah2"},
    {memberId : 4, parentId:3, amount:500, otherInfo:"blah3"},
    {memberId : 6, parentId:1, amount:600, otherInfo:"blah4"},
    {memberId : 9, parentId:4, amount:700, otherInfo:"blah5"},
    {memberId : 12, parentId:2, amount:800, otherInfo:"blah6"},
    {memberId : 5, parentId:2, amount:900, otherInfo:"blah7"},
    {memberId : 13, parentId:2, amount:0, otherInfo:"blah8"},
    {memberId : 14, parentId:2, amount:800, otherInfo:"blah9"},
    {memberId : 55, parentId:2, amount:250, otherInfo:"blah10"},
    {memberId : 56, parentId:3, amount:10, otherInfo:"blah11"},
    {memberId : 57, parentId:3, amount:990, otherInfo:"blah12"},
    {memberId : 58, parentId:3, amount:400, otherInfo:"blah13"},
    {memberId : 59, parentId:6, amount:123, otherInfo:"blah14"},
    {memberId : 54, parentId:6, amount:321, otherInfo:"blah15"},
    {memberId : 53, parentId:56, amount:10000, otherInfo:"blah7"},
    {memberId : 52, parentId:2, amount:47, otherInfo:"blah17"},
    {memberId : 51, parentId:6, amount:534, otherInfo:"blah18"},
    {memberId : 50, parentId:9, amount:55943, otherInfo:"blah19"},
    {memberId : 22, parentId:9, amount:2, otherInfo:"blah27"},
    {memberId : 33, parentId:12, amount:-10, otherInfo:"blah677"}
    
];
var testImgSrc = "http://0.gravatar.com/avatar/06005cd2700c136d09e71838645d36ff?s=69&d=wavatar";
(function heya( parentId ){
	//alert(parentId);
    // This is slow and iterates over each object everytime.
    // Removing each item from the array before re-iterating 
    // may be faster for large datasets.
    for(var i = 0; i < members.length; i++){
        var member = members[i];
        if(member.sponsor === parentId){
            var parent = parentId ? $("#containerFor" + parentId) : $("#mainContainer"),
                memberId = member.id,
                    metaInfo = "<img src='"+testImgSrc+"'/>" + member.name + " ($" + member.peringkat + ")";
			var vclass;
			if(i < 1){
				vclass="memberfirst";
			}else{
				vclass="member";
			}
			if(member.peringkat == 'Mentor'){
				vcss='bg-warning text-white';
			}else if(member.peringkat == 'Master Distributor'){
				vcss='bg-dark text-white';
			}else if(member.peringkat == 'Distributor'){
				vcss='bg-success text-white';
			}else{
				vcss='bg-info text-white';
			}
			//"base_url('users/members/'.$data[$i]['id'].'" class="label-default" id="mc-submit">'.ucwords($data[$i]['name']).'</a>
			var_css=vcss+" "+vclass;
			var vlink="<!?= base_url('users/members/') ?>";
			parent.append("<div class='container_member' id='containerFor" + memberId + "'><div class='"+var_css+"'><a href="+memberId+" class='text-white label-default' id='mc-submit' target='_blank'>" + 
			member.name + "</a><br/><b>" + 
			member.peringkat + "</b><br/>" +
			"OP: "+member.op + "<br/>" +
			"OG: "+member.og + "<br/>"
			+ "</div></div>");
            heya(memberId);
            /*parent.append("<div class='container' id='containerFor" + memberId + "'><div class='"+vclass+"'>" + memberId + "-" + member.name + "<br/>" + member.peringkat +"<div class='metaInfo'>" + metaInfo + "</div></div></div>");
            heya(memberId);*/
        } 
    }
 }( null ));

// makes it pretty:
// recursivley resizes all children to fit within the parent.
var pretty = function(){
    var self = $(this),
        children = self.children(".container_member"),
        // subtract 4% for margin/padding/borders.
        width = (100/children.length) - 2;
    children
        .css("width", width + "%")
        .each(pretty);
    
};
$("#mainContainer").each(pretty);
*/    	
</script-->