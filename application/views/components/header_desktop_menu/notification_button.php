<?php
$notif = $this->M_notification->get_notification()->result();
$notifCount = $this->M_notification->get_notification()->num_rows();
$is_have_notif = $notifCount > 0 ? true : false;
?>

<!-- Notification Button -->
<div class="md:relative inline-block text-left">
    <div class="relative">
        <button type="button" id="notification_button" class="notification_button inline-flex justify-center items-center p-2 rounded-full <?php echo $is_have_notif ? "fill-[red]" : "" ?> ">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-bell" viewBox="0 0 16 16">
                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
            </svg>
        </button>
        <?php if ($is_have_notif) : ?>
            <!-- Badge -->
            <div>
                <div class="bg-[red] w-[10px] aspect-square absolute top-0 right-0 rounded-full">
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div id="notificationContent" class="hidden absolute top-0 md:top-auto right-0 z-50 md:mt-2 space-y-2 shadow-lg bg-white w-full md:w-auto h-screen md:h-auto md:rounded-md">

        <div class="block w-full md:w-[500px] p-3">
            <div class=" mb-2 flex justify-between gap-3">
                <span class="font-bold">
                    Notification
                </span>
                <div class="notification_button text-[20px] cursor-pointer text-red-500 block md:hidden ">
                    ×
                </div>
            </div>
            <!-- Nantinya jadi tab notifikasi -->
            <div class="flex gap-3">
                <div class="py-1 px-3 rounded-full bg-[#006D18] text-white text-[13px] font-bold">
                    Order
                    <span class="text-[10px] font-normal">
                        <?php echo $is_have_notif ? "( $notifCount )" : "" ?>
                    </span>
                </div>
                <div class="py-1 px-3 rounded-full bg-[#cdded3] text-[#006D18] text-[13px] font-bold">
                    Komisi
                </div>
            </div>
            <hr class="border-t border-[#d9d9d9] my-3">
            <!-- Dropdown content goes here -->

            <div class="flex gap-2 flex-col max-h-[300px] overflow-y-scroll">
                <?php foreach ($notif as $v_notif) { ?>
                    <a href="<?= base_url('notifications/read/' . $v_notif->id_notification_user) ?>" class="block">
                        <div class="border-2 rounded-md p-3">
                            <div class="mb-2">
                                <!-- <div class="font-bold">
                                        Invoice ORD/20231120/5/QZF8
                                    </div> -->
                                <div>
                                    <?= $v_notif->message ?>
                                </div>
                            </div>
                            <div class="text-[grey] text-[12px]">
                                <?= date('d F Y , h:i A', strtotime($v_notif->created_at)) ?>
                            </div>
                        </div>
                    </a>
                    <!-- <li>
                            <div class="media">
                                <div class="media-body">
                                    <a href="<?= base_url('notifications/read/' . $v_notif->id_notification_user) ?>">
                                        <h6><?= $v_notif->message ?></h6>
                                        <p><?= date('d F Y , h:i A', strtotime($v_notif->created_at)) ?></p>
                                    </a>
                                </div>
                            </div>
                        </li> -->
                <?php  }  ?>
            </div>

            <div class="flex justify-center mt-3">
                <a href="<?php echo base_url('notifications') ?>" class="px-3 py-2 rounded-full font-bold border-2 border-[#006D18] text-[#006D18]">
                    Tampilkan Lebih Banyak
                </a>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        const notificationButton = $('.notification_button');
        const notificationContent = $('#notificationContent');

        notificationButton.on('click', function() {
            notificationContent.toggleClass('hidden');
        });

        $(document).on('click', function(event) {
            if (!$(event.target).closest('.notification_button') && !$(event.target).closest('#notificationContent')) {
                notificationContent.addClass('hidden');
            }
        });

        // Set default active tab
        $('.tab-button[data-tab="order"]').addClass('bg-[#006D18] text-white');
        $('.tab-content[data-tab="order"]').removeClass('hidden');
    });
</script>