<!-- breadcrumb start -->

<div class="breadcrumb-section">

    <div class="container">

        <div class="row">

            <div class="col-sm-6">

                <div class="page-title">

                    <h2><?= $title_page ?></h2>

                </div>

            </div>

            <div class="col-sm-6">

                <nav aria-label="breadcrumb" class="theme-breadcrumb">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="<?= base_url() ?>"><?=lang('beranda')?></a></li>

                        <li class="breadcrumb-item active"><?= $title_page ?></li>

                    </ol>

                </nav>

            </div>

        </div>

    </div>

</div>

<section class="section-b-space blog-page ratio2_3">

    <div class="container">

        <div class="row">

            <div class="col-12">
                <?= $content ?>
            </div>

        </div>

    </div>

</section>