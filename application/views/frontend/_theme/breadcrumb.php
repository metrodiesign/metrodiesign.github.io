<div class="page-header page-header-default mb-10">
    <div class="page-header-content">
        <div class="page-title pt-10 pb-10 no-padding-right">
            <h4><i class="icon-arrow-left52 position-left"></i> <?php echo (isset($heading_title) ? $heading_title : ''); ?></h4>
        </div>
    </div>
    <?php if (!empty($breadcrumbs)) { ?>
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $row) { ?>
                    <li><a href="<?php echo $row['href']; ?>"><?php echo $row['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
</div>