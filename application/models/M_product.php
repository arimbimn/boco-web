<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_product extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_product($keyword, $filter_category, $filter_size, $filter_fromprice, $filter_toprice, $limit = null, $start = null)
  {


    $this->db->select('*');
    // $this->db->from('product');
    if (!empty($keyword)) {

      //$this->db->like('product.nama_barang', $keyword);

      $keyword2 = explode(" ", $keyword);

      if (!empty($keyword2)) {
        foreach ($keyword2 as $key) {
          $this->db->like('product.nama_barang', $key);
        }
      }
    }
    if (!empty($filter_category)) {
      $this->db->where("product.kategori_id IN ('" . $filter_category . "')");
    }
    if (!empty($filter_size)) {
      $this->db->where("product_attribute.size IN ('" . $filter_size . "')");
    }
    if (!empty($filter_fromprice) && !empty($filter_toprice)) {
      $this->db->where(["product.harga >=" => $filter_fromprice]);
      $this->db->where("product.harga <=", $filter_toprice);
    }
    $this->db->where(['is_active' => 1]);
    $this->db->join('product_brand', 'product_brand.id_product_brand = product.brand_id', 'left');
    $this->db->join('product_attribute', 'product_attribute.product_id = product.id_product', 'left');
    $this->db->group_by('product.id_product');
    $query = $this->db->get('product', $limit, $start);
    return $query;
  }

  public function countProduct()
  {
    return $this->db->get('product')->num_rows();
  }


  public function get_productkategori($kategori_id, $subkategori_id)
  {
    $this->db->select('*');
    $this->db->from('product');
    $this->db->where(['kategori_id' => $kategori_id]);
    $this->db->where(['is_active' => 1]);
    if (!empty($subkategori_id)) {
      $this->db->where('subkategori_id', $subkategori_id);
    }
    $query = $this->db->get();
    return $query;
  }



  public function get_detailproduct($id)
  {
    $this->db->select('*');
    $this->db->from('product');
    $this->db->where(['is_active' => 1]);
    $this->db->where(['id_product' => $id]);
    $query = $this->db->get()->row();
    //echo $this->db->last_query();
    //exit();
    return $query;
  }
  public function get_stokproduct($id_product, $id_attribute)
  {
    $this->db->select('nama_barang,size,sum(jumlah_stok) as jml_stok');
    $this->db->from('product_stok');
    $this->db->join('product', 'product_stok.id_product = product.id_product');
    $this->db->join('product_attribute', 'product_stok.id_product_attribute = product_attribute.id_product_attribute');
    $this->db->where(['product_stok.id_store' => 100]);
    $this->db->where(['product_stok.id_product' => $id_product]);
    $this->db->where(['product_stok.id_product_attribute' => $id_attribute]);
    $this->db->group_by('product_stok.id_product,product_stok.id_product_attribute');
    $query = $this->db->get()->row();
    //echo $this->db->last_query();
    //exit();
    return $query;
  }
  public function getRelateProduct($id)
  {
    $product = $this->db->where(['id_product' => $id])->get('product')->row();

    // $this->db->where(['is_active' => 1]);
    // $this->db->like('product.kategori_id', $product->kategori_id);
    // $this->db->or_like('product.subkategori_id', $product->subkategori_id);
    // $query = $this->db->limit(5)->get('product')->result();

    // $query = $this->db->group_start()->like('product.identity_product', $product->identity_product)
    //   ->or_like('product.kategori_id', $product->kategori_id)->group_end()
    //   ->where(['is_active' => 1])->limit(5)->order_by('product.id_product', 'desc')->get('product')->result();
    /*$query = $this->db->group_start()
      ->like('product.subkategori_id', $product->subkategori_id)->group_end()
      ->where(['is_active' => 1])->limit(5)->order_by('product.id_product', 'desc')->get('product')->result();*/
    $this->db->select('a.id_product,image_one,image_two,harga,nama_barang');
    $this->db->from('product a');
    $this->db->join('product_stok b', 'a.id_product = b.id_product');
    $this->db->group_start();
    $this->db->like('a.subkategori_id', $product->subkategori_id);
    $this->db->group_end();
    $this->db->where(['is_active' => 1]);
    $this->db->where(['b.jumlah_stok >' => 0]);
    $this->db->where(['b.id_store >' => 100]);
    $this->db->group_by('a.id_product');
    $this->db->limit(5);
    $this->db->order_by('a.id_product', 'desc');
    $query = $this->db->get()->result();

    return $query;
  }


  function get_newproduct()
  {
    $this->db->order_by('created_at', 'DESC');

    $this->db->where(['is_active' => 1]);
    $this->db->limit(8);

    return $this->db->get('product')->result();
  }

  function get_newproduct_baru() //ebe
  {
    $this->db->order_by('created_at', 'DESC');
    $this->db->select('id_product,image_one,image_two,nama_barang,harga,colour_picker');
    $this->db->where(['is_active' => 1]);
    $this->db->limit(4);

    return $this->db->get('product')->result();
  }

  function get_categoryproduct()
  {
    /*$this->db->order_by('category_order', 'ASC');
    return $this->db->where(['is_active' => 1])->get('product_kategori')->result();*/
    if (isset($this->ion_auth->user()->row()->sts_reseller) == 1) {
      $this->db->order_by('category_order', 'ASC');
      return $this->db->where(['is_active' => 1])->get('product_kategori')->result();
    } else {
      $this->db->order_by('category_order', 'ASC');
      return $this->db->where(['is_active' => 1])->where('id_product_kategori !=', 19)->get('product_kategori')->result();
    }
  }

  public function getSizeProduct($product_id)
  {
    //$query = $this->db->where(['product_id' => $product_id])->order_by('size')->get('product_attribute')->result();
    $query = $this->db->where(['product_id' => $product_id])->where(['size NOT LIKE' => '%.%'])->order_by('size')->get('product_attribute')->result();
    //echo $this->db->last_query();
    //exit();
    return $query;
  }


  public function getWishlist_ByUserIDProductID($id, $user_id)
  {
    $this->db->where('product_id', $id);
    $this->db->where('user_id', $user_id);
    return $this->db->get('wishlist')->row();
  }


  public function get_allwishlist_ByUserID($user_id)
  {
    $this->db->select('wishlist.*, product.nama_barang, product.image_one, product.harga');
    $this->db->from('wishlist');
    $this->db->join('product', 'product.id_product = wishlist.product_id');
    $this->db->where('wishlist.user_id', $user_id);
    return $this->db->get()->result();
  }


  public function get_product_reviews($id_product)
  {
    $this->db->select('users.first_name, users.last_name,
    product_reviews.*');
    $this->db->from('product_reviews');
    $this->db->join('users', 'users.id = product_reviews.user_id');
    $this->db->where('product_reviews.product_id', $id_product);
    $this->db->order_by('product_reviews.created_at', 'DESC');
    return $this->db->get()->result();
  }


  public function get_OrderlistItem_ByProductID($id, $user_id)
  {
    $this->db->select('order_items.product_id,
    order_status.status_order');
    $this->db->from('order_items');
    $this->db->join('order_status', 'order_status.order_id = order_items.order_id');
    $this->db->where('order_items.product_id', $id);
    $this->db->where('order_items.user_id', $user_id);
    $this->db->where('order_status.status_order', 'SELESAI');
    $this->db->group_by('order_items.order_id');
    return $this->db->get()->result();
  }

  public function get_Review_ByUserProductID($id, $user_id)
  {
    $this->db->where('product_id', $id);
    $this->db->where('user_id', $user_id);
    return $this->db->get('product_reviews')->row();
  }


  public function get_avgReviewProductID($id)
  {
    $this->db->select('AVG(rating) as rating');
    $this->db->where('product_id', $id);
    return $this->db->get('product_reviews')->row();
  }


  public function get_avgReview5ProductID($id)
  {
    $this->db->select('AVG(rating) as avg_rating, COUNT(rating) as count_rating');
    $this->db->where('product_id', $id);
    $this->db->where('rating', '5');
    return $this->db->get('product_reviews')->row();
  }

  public function get_avgReview4ProductID($id)
  {
    $this->db->select('AVG(rating) as avg_rating, COUNT(rating) as count_rating');
    $this->db->where('product_id', $id);
    $this->db->where('rating', '4');
    return $this->db->get('product_reviews')->row();
  }

  public function get_avgReview3ProductID($id)
  {
    $this->db->select('AVG(rating) as avg_rating, COUNT(rating) as count_rating');
    $this->db->where('product_id', $id);
    $this->db->where('rating', '3');
    return $this->db->get('product_reviews')->row();
  }

  public function get_avgReview2ProductID($id)
  {
    $this->db->select('AVG(rating) as avg_rating, COUNT(rating) as count_rating');
    $this->db->where('product_id', $id);
    $this->db->where('rating', '2');
    return $this->db->get('product_reviews')->row();
  }

  public function get_avgReview1ProductID($id)
  {
    $this->db->select('AVG(rating) as avg_rating, COUNT(rating) as count_rating');
    $this->db->where('product_id', $id);
    $this->db->where('rating', '1');
    return $this->db->get('product_reviews')->row();
  }

  public function getAllSize()
  {
    //$attributes = $this->db->group_by('size')->limit(50, 24)->get('product_attribute')->result();
    $attributes = $this->db->where(['size NOT LIKE' => '%-%'])->where(['size NOT LIKE' => '%.%'])->group_by('size')->limit(50, 23)->get('product_attribute')->result();
    return $attributes;
  }

  public function make_query($limit, $start, $filter_category, $filter_subcategory, $filter_size, $filter_from_price, $filter_to_price, $keyword)
  {


    $this->db->select('*');
    // $this->db->from('product');
    if (!empty($keyword)) {

      //$this->db->like('product.nama_barang', $keyword);

      $keyword2 = explode(" ", $keyword);

      if (!empty($keyword2)) {
        foreach ($keyword2 as $key) {
          $this->db->like('product.nama_barang', $key);
        }
      }
    }

    if (!empty($filter_category)) {

      $filter_category = explode(',', $filter_category);

      if (empty($filter_subcategory)) {

        $this->db->where_in('product.kategori_id', $filter_category);
      } else {

        $this->db->group_start();

        $this->db->where_in('product.kategori_id', $filter_category);
      }
    }

    if (!empty($filter_subcategory)) {

      $filter_subcategory = explode(',', $filter_subcategory);

      if (!empty($filter_category)) {

        $this->db->or_where_in('product.subkategori_id', $filter_subcategory);

        $this->db->group_end();
      } else {

        $this->db->where_in('product.subkategori_id', $filter_subcategory);
      }
    }

    if (!empty($filter_size)) {

      $filter_size = explode(",", $filter_size);

      $this->db->where_in('product_attribute.size', $filter_size);
    }

    if (!empty($filter_from_price) && !empty($filter_to_price)) {
      $this->db->where(["product.harga >=" => $filter_from_price]);
      $this->db->where("product.harga <=", $filter_to_price);
    }

    $this->db->where(['product_stok.jumlah_stok >' => 0]);
    $this->db->where(['product_stok.id_store' => 100]);
    $this->db->where(['is_active' => 1]);
    $this->db->join('product_brand', 'product_brand.id_product_brand = product.brand_id', 'left');
    $this->db->join('product_stok', 'product.id_product=product_stok.id_product');
    $this->db->join('product_attribute', 'product_stok.id_product_attribute = product_attribute.id_product_attribute');
    /*$this->db->join('product_brand', 'product_brand.id_product_brand = product.brand_id', 'left');
    $this->db->join('product_attribute', 'product_attribute.product_id = product.id_product', 'left');*/
    $this->db->group_by('product.id_product');
    $this->db->order_by('product.created_at', 'desc');

    if (empty($limit) && empty($start)) {
      $query = $this->db->get('product')->result();
      return count($query);
    } else {
      $query = $this->db->get('product', $limit, $start)->result();
      //echo $this->db->last_query();
      //exit();
      if (!empty($query)) {

        $output = "";

        $html_content = "";

        foreach ($query as $item_product) {
          // $member = 'UMUM';
          // if ($this->ion_auth->logged_in()) {
          //   $cekMember = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where("DATE_FORMAT(masaberlaku,'%Y-%m-%d') >=", date('Y-m-d'))->get('user_membership')->row();
          //   if ($cekMember) {
          //     $member = $cekMember->peringkat_member;
          //   };
          // }
          // $cekDiskon = $this->db->where(['to_member' => $member])->where(['type' => 1])->where(['voucher_vip' => 0])->like('sepatu_tag', $item_product->id_product)->order_by('bobot', 'desc')->get('voucher')->row();
          $cekDiskon = $this->db->where(['product_id' => $item_product->id_product])->where(['exp_date >=' => date('Y-m-d')])
            ->where(['start_date <=' => date('Y-m-d')])->get('discount_items')->row();

          $tambahan_1 = '';

          if ($cekDiskon) {

            $tambahan_2 = "";
            $tambahan_2 = "$cekDiskon->jumlah %";
            // if ($cekDiskon->type == 1) {
            //   $tambahan_2 = "$cekDiskon->jumlah %";
            // } else if ($cekDiskon->type == 2) {
            //   $tambahan_2 = 'Potongan <br> Harga';
            // }

            if ($tambahan_2 != "") {
              $tambahan_1 = '<div class="lable-block">
                          <span class="lable3">' . $tambahan_2 . '</span>
                          </div>';
            }
          }


          $tambahan_3 = base_url() . "product/detail/" . $item_product->id_product;
          $tambahan_4 = smn_baseurl() . "/uploads/product/" . $item_product->image_one;
          $tambahan_6 = smn_baseurl() . "/uploads/product/" . $item_product->image_two;
          $tambahan_7 = base_url() . "add_to_compare/" . $item_product->id_product;
          $tambahan_8 = "";

          $detail_rating = $this->db->select('AVG(rating) as avg_rating')->where('product_id', $item_product->id_product)->get('product_reviews')->row()->avg_rating;
          for ($usrating = 1; $usrating <= 5; $usrating++) {
            if ($usrating <= $detail_rating) {
              $tambahan_8 .= '<i class="fa fa-star active"></i>';
            } else {
              $tambahan_8 .= '<i class="fa fa-star"></i>';
            }
          }

          $tambahan_9 = "";

          $colorRelate = $this->db->select('product.id_product as idcolor, product.colour, product.colour_picker')->where(['identity_product' => $item_product->identity_product])->where(['is_active' => 1])->get('product')->result();

          if (!empty($colorRelate)) {
            foreach ($colorRelate as $itemColor) {
              $tambahan_9 .= '<li class="bg-light0" style="background-color:' . $itemColor->colour_picker . ';"><span style="color: #82817e; margin-left: 20px; margin-bottom: 20px"></span></li>';
            }
          }

          $data = [
            'data' => [
              'url' => $tambahan_3,
              'nama_produk' => $item_product->nama_barang,
              'gambar_produk' => $tambahan_4,
              'gambar_produk_2' => $tambahan_6,
              'harga_produk' => number_format($item_product->harga, 0, ',', '.'),
              'color_variant_html' => $tambahan_9
            ]
          ];

          $html_content .= $this->load->view('components/product/product_card', $data, TRUE);

          $output .= '  <div class="col-xl-3 col-6 col-grid-box">
                  <div class="product-box">
                    <div class="img-wrapper">
                        ' . $tambahan_1 . '
                      <div class="front">
                        <a href="' . $tambahan_3 . '"><img src="' . $tambahan_4 . '" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                      </div>
                      <div class="back">
                        <a href="' . $tambahan_3 . '"><img src="' . $tambahan_6 . '" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                      </div>
                      <div class="cart-info cart-wrap">
  
                        <a href="' . $tambahan_7 . '" title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                      </div>
                    </div>
                    <div class="product-detail h-200">
                      <div>
                        <div class="rating three-star">
                         ' . $tambahan_8 . '
                        </div>
                        <a href="' . $tambahan_3 . '">
                          <h6>' . $item_product->nama_barang . '</h6>
                        </a>
  
                        <h4>IDR ' . number_format($item_product->harga, 0, ',', '.') . '</h4>
                      
                        <ul class="color-variant mb-2">
                        ' . $tambahan_9 . '
                        </ul>
                        <div class="product-buttons mt-30">
                          <a href="' . $tambahan_3 . '" class="btn_save btn btn-solid" title="Add to cart">Detail</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>';
        }
        //var_dump($output);exit();
        return $html_content;
        // return $this->load->view('components/product_card');
      } else {
        $html_content = '<div class="col-xl-12 col-12 col-grid-box">
            <div class="product-box">
              <p class="text-muted">
                <i class="fa fa-info-circle"></i>
                ' . lang('not_available_produk') . '
              </p>
            </div>
          </div>';

        return $html_content;
      }
    }
  }


  public function convert_svg($file)
  {
    //$file = __DIR__ . $path2image;
    //$vfile=list($w,$h) = (ROOTINDEX."admin/upload/post-images/".$value['post_image']);
    $path = pathinfo($file);
    $ext = mb_strtolower($path['extension']);
    $img = "";
    if (in_array($ext, array('jpeg', 'jpg', 'gif', 'png', 'webp'))) {
      $size = getimagesize($file);
      $img = 'data:' . $size['mime'] . ';base64,' . base64_encode(file_get_contents($file));
      //$img = 'data:image/svg+xml;base64,' . base64_encode(file_get_contents($file));
    }
    return $img;
  }

  public function BestSellerProduct()
  {
    $this->db->select('SUM(qty) as ttl_qty, product.*');
    $this->db->group_start();
    $this->db->join('order', 'order.id_order = order_items.order_id');
    $this->db->where(['order.status_order' => 'SELESAI']);
    $this->db->group_by('product_id')->order_by('ttl_qty', 'desc');
    $this->db->group_end();
    $this->db->join('product', 'product.id_product = order_items.product_id');
    $this->db->where(['product.is_active' => 1]);
    $this->db->limit(4);

    $query = $this->db->get('order_items')->result();
    return $query;
  }
  function get_newproduct_adastok()
  {
    $this->db->select('a.id_product,a.nama_barang,a.harga,a.image_one,a.image_two');
    $this->db->join('product_stok b', 'a.id_product=b.id_product', 'LEFT');
    $this->db->group_by('a.id_product');
    $this->db->order_by('a.created_at', 'DESC');
    $this->db->where(['is_active' => 1]);
    $this->db->where('b.id_store', '100');
    $this->db->where('jumlah_stok >', 0);
    $this->db->limit(4);

    return $this->db->get('product a')->result();
  }

  public function insert_data($data = array())
  {
    $this->db->insert('tb_alamat_pengiriman', $data);
    // return $this->db->insert_id();
  }

  public function get_data()
  {
    $query = $this->db->get('tb_alamat_pengiriman');
    return $query->result();
  }

  public function ambil_data_alamat()
  {
    $this->db->select('id, label_alamat, penerima, alamat');
    $query = $this->db->get('tb_alamat_pengiriman');
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return FALSE;
    }
  }
  public function update_data_alamat($id = NULL, $data = array())
  {
    $this->db->where('id', $id);
    $this->db->update('tb_alamat_pengiriman', $data);

    return $this->db->affected_rows();
  }

  public function hapus_data_alamat($id = NULL)
  {
    $this->db->where('id', $id);
    $this->db->delete('tb_alamat_pengiriman');

    return $this->db->affected_rows();
  }
}
