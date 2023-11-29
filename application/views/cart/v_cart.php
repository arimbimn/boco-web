<main class="relative">

  <!-- breadcrumb start -->
  <div class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="page-title">
            <h2><?= lang('cart_produk') ?></h2>
          </div>
        </div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb" class="theme-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('') ?>"><?= lang('beranda') ?></a></li>
              <li class="breadcrumb-item active"><?= lang('cart_produk') ?></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- breadcrumb End -->

  <div class="container">
    <div class="max-w-[1100px] mx-auto py-[50px]">



      <?php if (isset($_GET['msg'])) : ?>
        <div id="popupContainer" style="margin: 0 auto;right: 0;left: 0;top: 0;">
          <div class=" rounded-lg bg-red-700 p-3 px-4 shadow-lg my-4" onclick="closePopup()">
            <span class="font-bold text-white">
              <?php
              echo $_GET['msg'];
              ?>
            </span>
          </div>
        </div>

        <script>
          $(document).ready(function() {
            // Show the popup
            showPopup();

            // Set timeout to close the popup after 10 seconds
            setTimeout(function() {
              closePopup();
            }, 5000);
          });

          function showPopup() {
            $('#popupContainer').removeClass('hidden');
          }

          function closePopup() {
            $('#popupContainer').addClass('hidden');
          }
        </script>
      <?php endif ?>

      <?php if (!empty($this->cart->contents())) : ?>
        <?php
        $this->load->view('cart/cart_has_items');
        ?>
      <?php else : ?>
        <?php
        $this->load->view('cart/cart_no_items');
        ?>
      <?php endif ?>

    </div>
  </div>

</main>


<script>
  // Function to remove URL parameters
  function removeURLParameters() {
    // Get the current URL without parameters
    var urlWithoutParams = window.location.href.split('?')[0];

    // Replace the current history entry with the URL without parameters
    history.replaceState(null, null, urlWithoutParams);
  }

  // Call the function to remove parameters (you can trigger this based on your logic)
  removeURLParameters();
</script>