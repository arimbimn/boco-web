 <!-- breadcrumb start -->
 <div class="breadcrumb-section">
   <div class="container">
     <div class="row">
       <div class="col-sm-6">
         <div class="page-title">
           <h2>blog </h2>
         </div>
       </div>
       <div class="col-sm-6">
         <nav aria-label="breadcrumb" class="theme-breadcrumb">
           <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
             <li class="breadcrumb-item active">blog</li>
           </ol>
         </nav>
       </div>
     </div>
   </div>
 </div>
 <!-- breadcrumb End -->


 <!-- section start -->
 <section class="section-b-space blog-page ratio2_3">
   <div class="container">
     <div class="row">
       <?php if ($blogs) { ?>
         <div class="col-xl-9 col-lg-8 col-md-7">
           <?php foreach ($blogs as $item_blog) { ?>
             <div class="row blog-media">
               <div class="col-xl-6">
                 <div class="blog-left">
                   <a href="<?= base_url('blog/detail/' . $item_blog->slug) ?>"><img src="<?= smn_baseurl() ?>/uploads/blogs/<?= $item_blog->image_blog ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                 </div>
               </div>
               <div class="col-xl-6">
                 <div class="blog-right">
                   <div class="text-justify">
                     <h6><?= date('d M, Y', strtotime($item_blog->created_at)) ?></h6> <a href="<?= base_url('blog/detail/' . $item_blog->slug) ?>">
                       <h4><?= $item_blog->title ?></h4>
                     </a>
                     <ul class="post-social">
                       <li class="display-inline"><?= lang('post_by') ?>: <?= $item_blog->full_name ?></li>
                       <li class="display-inline ml-0"><i class="fa fa-eye"></i> <?= $item_blog->read_count ?> <?= lang('viwes_blog') ?></li>
                       <li class="display-inline ml-0">
                         <i class="fa fa-comments"></i>
                         <?php
                          $count_comments = $this->M_Blog->get_countcomment_ByBlogID($item_blog->id_blog);
                          echo $count_comments->count_comment;
                          ?>
                         <?= lang('comment_blog') ?>
                       </li>
                     </ul>
                     <?php if ($this->session->userdata('site_lang') == "indonesian") {  ?>
                       <?= substr(strip_tags($item_blog->body_content_id), 0, 200)  ?> ...
                     <?php  } else { ?>
                       <?= substr(strip_tags($item_blog->body_content), 0, 200)  ?> ...
                     <?php } ?>
                   </div>
                 </div>
               </div>
             </div>
           <?php } ?>
         </div>
       <?php } ?>
       <div class="col-xl-3 col-lg-4 col-md-5">
         <div class="blog-sidebar">
           <div class="theme-card">
             <h4><?= lang('recent_blog') ?></h4>
             <ul class="recent-blog">
               <?php foreach ($recent_blog as $recent) { ?>
                 <li>
                   <div class="img-fluid text-justify"> <!--media-->
                     <a href="<?= base_url() ?>blog/detail/<?= $recent->slug ?>"><img class="img-fluid blur-up lazyload" src="<?= smn_baseurl() ?>uploads/blogs/<?= $recent->image_blog ?>" alt=""></a>
                     <div class="media-body align-self-center">
                       <a href="<?= base_url() ?>blog/detail/<?= $recent->slug ?>">
                         <h6><?= $recent->title ?></h6>
                       </a>
                       <p class="text-center"><?= $recent->read_count ?> <?= lang('viwes_blog') ?></p>
                     </div>
                   </div>
                 </li>
               <?php } ?>
               <!-- <li>
                 <div class="media"> <img class="img-fluid blur-up lazyload" src="../assets/images/blog/2.jpg" alt="">
                   <div class="media-body align-self-center">
                     <h6>25 Dec 2018</h6>
                     <p>0 hits</p>
                   </div>
                 </div>
               </li> -->
             </ul>
           </div>
           <div class="theme-card">
             <h4><?= lang('popular_blog') ?></h4>
             <ul class="popular-blog">
               <?php foreach ($popular_blog as $popular) { ?>
                 <li>
                   <div class="media">
                     <?php
                      $day = date('d', strtotime($popular->created_at));
                      $month = date('M', strtotime($popular->created_at));
                      ?>
                     <div class="blog-date"><span><?= $day ?> </span><span><?= $month ?></span></div>
                     <div class="media-body align-self-center">
                       <a href="<?= base_url() ?>blog/detail/<?= $recent->slug ?>">
                         <h6><?= $popular->title ?></h6>
                       </a>
                       <p><?= $popular->read_count ?> <?= lang('viwes_blog') ?></p>
                     </div>
                   </div>
                   <?php if ($this->session->userdata('site_lang') == "indonesian") {  ?>
                     <?= substr(strip_tags($popular->body_content_id), 0, 100)  ?> ...
                   <?php  } else { ?>
                     <?= substr(strip_tags($popular->body_content), 0, 100)  ?> ...
                   <?php } ?>
                 </li>
               <?php } ?>
             </ul>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- Section ends -->