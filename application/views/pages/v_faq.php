<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>FAQ</h2>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>"><?=lang('beranda')?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<!--section start-->
<section class="faq-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="accordion theme-accordion" id="accordionExample">
                    <?php foreach ($list_faq as $key_faq => $faq) { ?>
                        <div class="card">
                            <div class="card-header" id="heading_<?= $faq->faq_id ?>">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_<?= $faq->faq_id ?>" aria-expanded="true" aria-controls="collapse_<?= $faq->faq_id ?>">
                                        <?= $faq->title ?>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse_<?= $faq->faq_id ?>" class="collapse <?php if ($key_faq == 0) {
                                                                                        echo "show";
                                                                                    } ?>" aria-labelledby="heading_<?= $faq->faq_id ?>" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p class="text-jutify"><?= $faq->content ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->