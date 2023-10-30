 <!-- breadcrumb start-->
 <div class="breadcrumb-section">
   <div class="container">
     <div class="row">
       <div class="col-sm-6">
         <div class="page-title">
           <h2>blog details </h2>
         </div>
       </div>
       <div class="col-sm-6">
         <nav aria-label="breadcrumb" class="theme-breadcrumb">
           <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
             <li class="breadcrumb-item"><a href="<?= base_url('/blog') ?>">blog</a></li>
             <li class="breadcrumb-item active" aria-current="page"><?= lang('blog_detail') ?></li>
           </ol>
         </nav>
       </div>
     </div>
   </div>
 </div>
 <!-- breadcrumb end-->

 <!--section start-->
 <section class="blog-detail-page section-b-space ratio2_3">
   <div class="container">
     <div class="row">
       <div class="col-sm-12 blog-detail"><img src="<?= smn_baseurl() ?>uploads/blogs/<?= $blogs['image_blog'] ?>" class="img-fluid blur-up lazyload" alt="">
         <h3><?= $blogs['title'] ?></h3>
         <ul class="post-social">
           <li><?= date('d M Y', strtotime($blogs['created_at'])) ?></li>
           <li><?= lang('post_by') ?> : <?= $blogs['full_name'] ?></li>
           <li><i class="fa fa-eye"></i> <?= $blogs['read_count'] ?> <?= lang('viwes_blog') ?></li>
           <li>
             <i class="fa fa-comments"></i>
             <?php
              $count_comments = $this->M_Blog->get_countcomment_ByBlogID($blogs['id_blog']);
              echo $count_comments->count_comment;
              ?>
             <?= lang('comment_blog') ?>
           </li>
         </ul>
         <?php if ($this->session->userdata('site_lang') == "indonesian") {  ?>
           <?= $blogs['body_content_id'] ?>
         <?php  } else { ?>
           <?= $blogs['body_content'] ?>
         <?php } ?>
       </div>
     </div>
     <br>
     <br>
     <br>
     <div class="row blog-contact">
       <div class="col-sm-12">
         <h2><?= lang('coment_title_blog') ?></h2>
         <?php if (!empty($comments)) { ?>
           <div class="mt-20">
             <div class="collection-filter-block pad-0-20">
               <table width="100%">
                 <?php foreach ($comments as $comment) { ?>
                   <tr class="borderbottom">
                     <td class="pad-20-0">
                       <?= $comment->name ?>
                       <br>
                       <span class="text-muted"><?= $comment->email ?></span>
                       <br>
                       <br>
                       <span><?= date('d F Y H:i', strtotime($comment->created_at)) ?></span>
                     </td>
                     <td class="pad-20-0" width="80%">
                       <p class="text-justify pad-15 lh-15">
                         <?= $comment->comment ?>
                       </p>
                     </td>
                   </tr>
                 <?php } ?>
               </table>
             </div>
           </div>
         <?php } ?>
         <!--?= form_open(base_url() . 'submit_comment/' . $blogs['id_blog'], ['class' => 'theme-form']); ?>
         <div class="form-row">
           <div class="col-md-12">
             <label for="name"><?= lang('name_form_blog') ?></label>
             <input type="text" class="form-control" name="name" id="name" placeholder="<?= lang('name_placeholder_blog') ?>" required="">
           </div>
           <div class="col-md-12">
             <label for="email">Email</label>
             <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="">
           </div>
           <div class="col-md-12">
             <label for="exampleFormControlTextarea1"> <?= lang('comment_blog') ?></label>
             <textarea class="form-control" placeholder="<?= lang('coment_placeholder_blog') ?>" name="comment" id="exampleFormControlTextarea1" rows="6"></textarea>
           </div>
           <div class="col-md-12">
             <button class="btn btn-solid" type="submit"><?= lang('submit_button') ?> <?= lang('comment_blog') ?></button>
           </div>
         </div-->
         <!--?= form_close() ?-->
       </div>
     </div>
   </div>
 </section>
 <!--Section ends-->