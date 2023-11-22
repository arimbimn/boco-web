<style>
    .filter-btn {
        border-radius: 8px;
    }

    .collection-filter {
        display: none;
    }

    .collection-filter.open {
        display: block;
    }

    .collapsible {
        display: none;
        flex-direction: column;
        margin-bottom: 10px;
    }

    @media (min-width: 768px) {
        .collapsible {
            display: flex;
        }

        .btn {
            cursor: pointer;
            padding: 10px;
            width: 200px;
            background-color: #CD212A;
            color: #fff;
            border: none;
            text-align: center;
            margin-left: auto;
            border-radius: 12px;
        }

        .collapse {
            display: block;
            padding: 10px;
            border: 1px solid #ddd;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 5px;
        }
    }

    @media (max-width: 768px) {
        .collapsible {
            display: none;
        }
    }
</style>




<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2><?= lang('title_produk') ?></h2>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('/product') ?>"><?= lang('title_produk') ?></a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<section class="section-b-space ratio_asos">
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="filter-main-btn d-flex">
                        <span class="filter-btn btn btn-theme">
                            <i class="fa fa-filter" aria-hidden="false">
                            </i>
                            Filter
                        </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 collection-filter" id="divfilter">
                    <div class="collection-filter-block">
                        <div class="collection-mobile-back">
                            <span class="filter-back p-4">
                                <i class="fa fa-angle-left" aria-hidden="true">
                                </i> back
                            </span>
                        </div>
                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title"><?= lang('kategory_produk') ?></h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    <?php
                                    foreach ($category_products as $category) {
                                        $category_slug = str_replace(" ", '-', strtolower($category->nama_kategori));
                                        $skip = [",", '.', '+', '/', "$", '#', '!', '(', ')', '~', '`', '@', '^', '*', '=', '_', '{', '}', '[', ']', '"', '<', '>', '?', '&', "'"];
                                        foreach ($skip as $s) {
                                            $category_slug = str_replace($s, '', $category_slug);
                                        }
                                    ?>
                                        <div class="custom-control custom-checkbox collection-filter-checkbox">
                                            <input type="checkbox" class="custom-control-input filter category parent_<?= $category_slug ?>" name="category_id" id="<?= $category_slug ?>" value="<?= $category->id_product_kategori ?>" <?php if (!empty($kategori)) {
                                                                                                                                                                                                                                                if ($kategori == $category->id_product_kategori) {
                                                                                                                                                                                                                                                    echo " checked";
                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                            } ?>>
                                            <label class="custom-control-label" for="<?= $category_slug ?>">
                                                <?= $category->nama_kategori ?>
                                            </label>
                                            <?php
                                            $cek_subcategory = $this->db->where('kategori_id', $category->id_product_kategori)->where(['is_active' => 1])->order_by('subcategory_order', 'ASC')->get('product_subkategori')->result();
                                            if (!empty($cek_subcategory)) {
                                                foreach ($cek_subcategory as $sub) {
                                                    $subcategory_slug = str_replace(" ", '-', strtolower($sub->nama_subkategori));
                                                    foreach ($skip as $l) {
                                                        $subcategory_slug = str_replace($l, '', $subcategory_slug);
                                                    }
                                                    $subcategory_slug = $category_slug . "-" . $subcategory_slug;
                                            ?>
                                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input type="checkbox" class="custom-control-input filter subcategory child_<?= $category_slug ?>" name="subcategory_id" id="<?= $subcategory_slug ?>" value="<?= $sub->id ?>" <?php if (!empty($subkategori)) {
                                                                                                                                                                                                                                            if ($subkategori == $sub->id) {
                                                                                                                                                                                                                                                echo " checked";
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                        } ?> <?php if (!empty($kategori)) {
                                                                                                                                                                                                                                                    if ($kategori == $category->id_product_kategori) {
                                                                                                                                                                                                                                                        echo " checked";
                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                } ?>>
                                                        <label class="custom-control-label" for="<?= $subcategory_slug ?>"><?= $sub->nama_subkategori ?></label>
                                                    </div>
                                            <?php }
                                            } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="container">
            <div class="collapsible d-flex justify-content-end mt-2 mb-2">
                <button class=" btn btn-danger" type="button" data-toggle="collapse" data-target="#itemList" aria-expanded="false" aria-controls="itemList">
                    Filter
                </button>
                <div class="collapse" id="itemList">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <input type="checkbox" id="checkbox1">
                            <label for="checkbox1">Item 1</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="checkbox2">
                            <label for="checkbox2">Item 2</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="checkbox3">
                            <label for="checkbox3">Item 3</label>
                        </li>
                    </ul>
                </div>
            </div>
        </div> -->

    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var filterBtn = document.querySelector('.filter-btn');
        var filterContainer = document.querySelector('.collection-filter');
        var filterMobileBack = document.querySelector('.collection-mobile-back');

        filterBtn.addEventListener('click', function() {
            filterContainer.classList.add('open');
        });

        filterMobileBack.addEventListener('click', function() {
            filterContainer.classList.remove('open');
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        var collapsibleBtn = document.querySelector(".btn");
        var collapsibleContent = document.querySelector(".collapse");

        collapsibleBtn.addEventListener("click", function() {
            if (collapsibleContent.style.display === "block") {
                collapsibleContent.style.display = "none";
            } else {
                collapsibleContent.style.display = "block";
            }
        });
    });
</script>