<script>
    $(".btn-checkout").on("click", function() {
        $(".loadingupdate").show();
        check_stock(function(anyRequestFailed) {
            $(".loadingupdate").hide();
            $('.inputqty').prop('disabled', false);
            if (anyRequestFailed) {
                alert('Tidak dapat melakukan checkout');
            } else {
                window.location.href = "<?= base_url('cekout') ?>";
            }

        });
    });

    // Fungsi Check Stock
    check_stock();

    var timeout;
    $('.inputqty').on('keyup change', function() {
        clearTimeout(timeout);

        timeout = setTimeout(function() {
            var arr = $('.inputqty').map(function() {
                return this.value;
            }).get();

            $('.inputqty').prop('disabled', true);
            $(".loadingupdate").show();

            check_stock(arr, function(anyRequestFailed) {
                // get_cart_summary();
                if (!anyRequestFailed) {
                    window.location.reload();
                }
                $(".loadingupdate").hide();
                $('.inputqty').prop('disabled', false);
            });
        }, 500); // Set your desired delay in milliseconds (e.g., 500ms)
    });

    function check_stock(arr_qty, callback) {
        var items = $('.cart-items').find('[id-product]');
        var requestsCompleted = 0;
        var anyRequestFailed = false;

        items.each(function() {
            var productId = $(this).attr('id-product');
            var attributeId = $(this).attr('id-product-attribute');

            $.ajax({
                url: "http://localhost/web/CartController/check_stock",
                type: "POST",
                dataType: "json",
                data: {
                    productId: productId,
                    attributeId: attributeId,
                    qty: arr_qty,
                },
                success: function(responses) {
                    responses.forEach(function(response) {
                        console.log(response);
                        var selector = `[id-product='${response.id_product}'][id-product-attribute='${response.id_attribute_product}']`;

                        if (!response.stock_available) {
                            anyRequestFailed = true;
                            $(selector)
                                .find(".trigger-info")
                                .removeClass("hidden")
                                .addClass("bg-[red] text-white");
                            $(selector)
                                .find(".message")
                                .text(`Sorry, ${response.stock} left in stock.`);

                        } else {
                            $(selector)
                                .find(".trigger-info")
                                .addClass("hidden");
                            $(selector)
                                .find(".message")
                                .text(``);

                        }
                    });

                    requestsCompleted++;

                    // Check if all requests are completed before calling the callback
                    if (requestsCompleted === items.length && typeof callback === 'function') {
                        callback(anyRequestFailed);
                    }
                },
                error: function() {
                    console.log("Error in the Ajax request");
                    anyRequestFailed = true;
                    requestsCompleted++;

                    // Check if all requests are completed before calling the callback
                    if (requestsCompleted === items.length && typeof callback === 'function') {
                        callback(anyRequestFailed);
                    }
                }
            });
        });
    }
    // END - Fungsi Check Stock

    get_cart_summary()

    function get_cart_summary() {
        $(".loadingupdate").show();
        $.ajax({
            url: "<?= base_url('CartController/getCartSummary') ?>",
            type: "get",
            success: function(response) {
                $("#cart-summary").html(response);
            },
            error: function() {
                console.log('Error occurred during the check.');
            },
            complete: function() {
                $(".loadingupdate").hide();
            }
        });
    }
</script>