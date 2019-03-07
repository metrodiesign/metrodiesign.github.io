<div class="row">
   <div class="col-12">
      <h1>คำนวณค่าเบี้ย พ.ร.บ.</h1>
   </div>
</div>
<div class="card">
    <div class="card-body">
      <div class="row">
         <div class="col-12">
            <?php $attributes = array('id' => 'master_form_create'); ?>
            <?php echo form_open('http://www.viriyah.pro', $attributes); ?>
                <fieldset class="mb-3">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label class="d-block">ยี่ห้อรถยนต์<span class="font-weight-bold text-danger ml-1">*</span></label>
                                <select id="carMake" name="carMake" class="form-control form-control-lg select-search" data-placeholder="ยี่ห้อรถยนต์"
                                    data-container-css-class="select-lg" data-fouc>
                                    <option value="">ยี่ห้อรถยนต์</option>
                                </select>
                                <span id="carMake_error" class="validation-invalid-label" style="display: none;"></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label class="d-block">รุ่นรถยนต์<span class="font-weight-bold text-danger ml-1">*</span></label>
                                <select id="carModel" name="carModel" class="form-control form-control-lg select-search" data-placeholder="รุ่นรถยนต์"
                                    data-container-css-class="select-lg" data-fouc>
                                    <option value="">รุ่นรถยนต์</option>
                                </select>
                                <span id="carModel_error" class="validation-invalid-label" style="display: none;"></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label class="d-block">ลักษณะการใช้งาน<span class="font-weight-bold text-danger ml-1">*</span></label>
                                <select id="carType" name="carType" class="form-control form-control-lg select-search" data-placeholder="ลักษณะการใช้งาน"
                                    data-container-css-class="select-lg" data-fouc>
                                    <option value="">ลักษณะการใช้งาน</option>
                                </select>
                                <span id="carType_error" class="validation-invalid-label" style="display: none;"></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label class="d-block">&nbsp;</label>
                                <button type="button" class="font-size-lg btn btn-lg bg-primary d-sm-block d-md-block d-lg-inline-block w-100 pl-5 pr-5">เช็คเบี้ย</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            <?php echo form_close(); ?>
         </div>
      </div>
   </div>
</div>

<script src="<?php echo $path_asset_theme_global; ?>/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo $path_asset_theme_global; ?>/js/plugins/forms/styling/uniform.min.js"></script>

<script>
let _componentSelect2 = function () {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }

    $('.select').select2({
        minimumResultsForSearch: Infinity
    });

    $('.select-search').select2();
};

document.addEventListener('DOMContentLoaded', function () {
    _componentSelect2();
});
</script>