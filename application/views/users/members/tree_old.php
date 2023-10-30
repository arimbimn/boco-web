<style>
#mainContainer{
   /* background:Red;
    min-width:850px;*/
}
.container_member{
    text-align:center;
    margin:10px .5%;
    padding:10px .5%;
    /*background:green;*/
    float:left;
    overflow:visible;
    position:relative;
}

.memberfirst{
    background:#eee;   
    position:relative;
    z-index:   1;
    cursor:default;
    border-bottom:solid 1px #000;
}
.member{
    background:#eee;   
    position:relative;
    z-index:   1;
    cursor:default;
    border-bottom:solid 1px #000;
}
.member:after{
    display:block;
    position:absolute;
    left:50%;
    width:1px; 
    height:20px;
    background:#000;
    content:" ";
    bottom:100%;
}
.member:hover{
 z-index:   2;
}
.member .metaInfo{
    display:none;
    border:solid 1px #000;
    background:#fff;
    position:absolute;
    bottom:100%;
    left:50%;
    padding:5px;
    width:100px;
}
.member:hover .metaInfo{
    display:block;   
}
.member .metaInfo img{
  width:50px;
  height:50px; 
  display:inline-block; 
  padding:5px;
  margin-right:5px;
    vertical-align:top;
  border:solid 1px #aaa;
}	
</style>
<!-- breadcrumb start -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="page-title">
              <h2>Bocorocco Entrepreneurs</h2>
            </div>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Bocorocco Entrepreneurs</li>
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
            <div class="dashboard-right">
              <div class="dashboard">
                <!-- product-tab starts -->
                <section class="tab-product m-0">
                  <div class="container">
                    <div class="row">
						<div class="col-sm-6 col-lg-6">
                            <a href="<?= base_url('users/download') ?>" class="btn btn-info" id="mc-submit">Download</a>
						</div>
					</div>
                    <div class="row">
                      <div class="col-sm-12 col-lg-12">
                        <!--?php $this->load->view('users/purchasehistory/v_submenu') ?-->
                        <div class="tab-content nav-material" id="top-tabContent">
                          <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
							<div id="mainContainer" class="clearfix"></div>
                            <!--?php } else { ?>
                              <!--?= lang('tidak_adadata') ?>
                            <!--?php } ?-->

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
	<script>
	var members=<?php echo json_encode($data_downline); ?>;
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
			var vlink="<?= base_url('users/members/') ?>";
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
    	
</script>