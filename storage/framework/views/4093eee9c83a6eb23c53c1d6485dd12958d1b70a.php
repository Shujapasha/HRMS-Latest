<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php
$logo = asset(Storage::url('uploads/logo/'));
$company_logo = Utility::getValByName('company_logo');
$company_logo_light = Utility::getValByName('company_logo_light');
$company_favicon = Utility::getValByName('company_favicon');
$SITE_RTL=env('SITE_RTL');

$lang = \App\Models\Utility::getValByName('default_language');
$color = isset($settings['theme_color']) ? $settings['theme_color'] : 'theme-4';
$is_sidebar_transperent = isset($settings['is_sidebar_transperent']) ? $settings['is_sidebar_transperent'] : '';
$dark_mode = isset($settings['dark_mode']) ? $settings['dark_mode'] : '';

?>



<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Settings')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
       $(document).on('change', '.email-template-checkbox', function() {
            var url = $(this).data('url');
            var chbox = $(this);
          
            $.ajax({
                url: url,
                type: 'GET',
                data: {_token: $('meta[name="csrf-token"]').attr('content'), status: chbox.val()},
                success: function(data) {

                },
            });
        });

        $(document).ready(function() {
            if ($('.gdpr_fulltime').is(':checked')) {

                $('.fulltime').show();
            } else {

                $('.fulltime').hide();
            }

            $('#gdpr_cookie').on('change', function() {
                if ($('.gdpr_fulltime').is(':checked')) {

                    $('.fulltime').show();
                } else {

                    $('.fulltime').hide();
                }
            });
        });


        $('.themes-color-change').on('click', function() {
            var color_val = $(this).data('value');
            $('.theme-color').prop('checked', false);
            $('.themes-color-change').removeClass('active_color');
            $(this).addClass('active_color');
            $(`input[value=${color_val}]`).prop('checked', true);

        });
    </script>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
    <script>
        document.getElementById('company_logo').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
        }
    </script>
     <script>
        document.getElementById('company_logo_light').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image1').src = src
        }
    </script>  
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xl-3">
                <div class="card sticky-top">
                    <div class="list-group list-group-flush" id="useradd-sidenav">

                        <a href="#business-setting" id="business-setting-tab"
                            class="list-group-item list-group-item-action border-0"><?php echo e(__('Business Setting')); ?> <div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>


                                 <a href="#company-setting" id="company-setting-tab"
                            class="list-group-item list-group-item-action border-0"><?php echo e(__('Company Setting')); ?> <div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                        <a href="#system-setting" id="system-setting-tab"
                            class="list-group-item list-group-item-action border-0"><?php echo e(__('System Setting')); ?> <div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a> 

                         <a href="#email-setting" id="email-setting-tab"
                          class="list-group-item list-group-item-action border-0"><?php echo e(__('Email Setting')); ?> <div
                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                       

                        <a href="#pusher-setting" id="pusher-setting-tab"
                            class="list-group-item list-group-item-action border-0"><?php echo e(__('Pusher Setting')); ?> <div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>


                        <a id="email-notification-tab" data-toggle="tab" href="#email-notification" role="tab"
                            aria-controls="" aria-selected="false"
                            class="list-group-item list-group-item-action border-0"><?php echo e(__('Email Notification')); ?><div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                        <a href="#ip-restrict" id="ip-restrict-tab"
                            class="list-group-item list-group-item-action border-0"><?php echo e(__('IP Restrict Setting')); ?> <div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                        <?php if(Auth::user()->type == 'company'): ?>
                            <a href="#zoom-meeting-setting" id="zoom-meeting-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Zoom Meeting')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a href="#slack-setting" id="slack-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Slack Setting')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a href="#telegram-setting" id="telegram-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Telegram Setting')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a href="#twilio-setting" id="twilio-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Twilio Setting')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <?php endif; ?>
                        <a href="#recaptcha-print-setting" id="recaptcha-print-setting-tab"
                            class="list-group-item list-group-item-action border-0"><?php echo e(__('Recaptcha Setting')); ?> <div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                    </div>

                </div>
            </div>

            <div class="col-xl-9">
                <div class="" id="business-setting">
                    <?php echo e(Form::model($settings, ['route' => 'business.setting', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5><?php echo e(__('Business Setting')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-6 col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5><?php echo e(__('Logo dark')); ?></h5>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class=" setting-card">
                                                        <div class="logo-content mt-4 setting-logo">
                                                            <img id="image"src="<?php echo e($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'dark_logo.png')); ?>"
                                                                class="logo logo-sm" 
                                                                style="filter: drop-shadow(2px 3px 7px #011c4b);">
                                                        </div>


                                                        <div class="choose-files mt-5">
                                                            <label for="company_logo">
                                                                <div class=" bg-primary company_logo"> <i
                                                                        class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                </div>
                                                                <input type="file" class="form-control file"
                                                                    name="company_logo" id="company_logo"
                                                                    data-filename="company_logo" accept=".jpeg,.jpg,.png"
                                                                    accept=".jpeg,.jpg,.png">
                                                            </label>
                                                        </div>


                                                        <?php $__errorArgs = ['company_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="row">
                                                                <span class="invalid-company_logo" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6 col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5><?php echo e(__('Logo Light')); ?></h5>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class=" setting-card">
                                                        <div class="logo-content mt-4  setting-logo">
                                                            <img id="image1" src="<?php echo e($logo . '/' . (isset($company_logo_light) && !empty($company_logo_light) ? $company_logo_light : 'light_logo.png')); ?>"
                                                                class="logo logo-sm img_setting"
                                                                style="filter: drop-shadow(2px 3px 7px #011c4b);">
                                                        </div>
                                                        <div class="choose-files mt-5">
                                                            <label for="company_logo_light">
                                                                <div class=" bg-primary company_logo_light"> <i
                                                                        class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                </div>
                                                                <input type="file" class="form-control file"
                                                                    name="company_logo_light" id="company_logo_light"
                                                                    data-filename="company_logo_light">
                                                            </label>
                                                        </div>

                                                        <?php $__errorArgs = ['company_logo_light'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="row">
                                                                <span class="invalid-company_logo_light" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6 col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5><?php echo e(__('Favicon')); ?></h5>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class=" setting-card">
                                                        <div class="logo-content mt-4 setting-logo ">
                                                            <img src="<?php echo e($logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>"
                                                                width="50px" class="logo logo-sm img_setting">
                                                        </div>

                                                        <div class="choose-files mt-5">
                                                            <label for="company_favicon">
                                                                <div class=" bg-primary company_favicon"> <i
                                                                        class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                </div>
                                                                <input type="file" class="form-control file"
                                                                    name="company_favicon" id="company_favicon"
                                                                    data-filename="company_favicon">
                                                            </label>
                                                        </div>


                                                        <?php $__errorArgs = ['company_favicon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="row">
                                                                <span class="invalid-logo" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">

                                            <?php echo e(Form::label('title_text', __('Title Text'), ['class' => 'col-form-label'])); ?>

                                            <?php echo e(Form::text('title_text', null, ['class' => 'form-control', 'placeholder' => __('Enter Title Text')])); ?>


                                            <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-title_text" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_text', __('Footer Text'), ['class' => 'col-form-label'])); ?>

                                            <?php echo e(Form::text('footer_text', null, ['class' => 'form-control', 'placeholder' => __('Footer Text')])); ?>

                                            <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-footer_text" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="metakeyword" class="col-form-label"><?php echo e(__('Meta Keywords')); ?>

                                            </label>
                                            <textarea class="form-control" rows="4" cols="8"
                                                value="<?php echo e(isset($settings['metakeyword']) ? $settings['metakeyword'] : ''); ?>"
                                                name="metakeyword" id="metakeyword"
                                                style="resize: vertical; height: 42px;"
                                                placeholder="Enter Meta Keyword"><?php echo e(isset($settings['metakeyword']) ? $settings['metakeyword'] : ''); ?></textarea>

                                        </div>


                                        <div class="form-group col-md-6">

                                            <label for="metadesc"
                                                class="col-form-label"><?php echo e(__('Meta Description')); ?></label>
                                            <textarea class="form-control" rows="4" cols="8"
                                                value="<?php echo e(isset($settings['metadesc']) ? $settings['metadesc'] : ''); ?>"
                                                name="metadesc" id="metadesc" style="resize: vertical; height: 42px;"
                                                placeholder="Enter Meta Description"><?php echo e(isset($settings['metadesc']) ? $settings['metadesc'] : ''); ?></textarea>

                                        </div>


                                        
                                        <div class="form-group col-md-3">
                                            <?php echo e(Form::label('default_language', __('Default Language'), ['class' => 'col-form-label'])); ?>

                                            <select name="default_language" id="default_language"
                                                class="form-control select2">
                                                <?php $__currentLoopData = \App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($lang == $language): ?> selected <?php endif; ?>
                                                        value="<?php echo e($language); ?>"><?php echo e(Str::upper($language)); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                        </div>

                                        <div class="col-md-3 ">
                                            <div class="col switch-width">
                                                <div class="form-group ml-2 mr-3">

                                                    <?php echo e(Form::label('display_landing_page', __('Landing Page Display'), ['class' => 'col-form-label'])); ?>


                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" data-toggle="switchbutton"
                                                            data-onstyle="primary" class=""
                                                            name="display_landing_page" id="display_landing_page"
                                                            <?php echo e($settings['display_landing_page'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                        <label class="custom-control-label mb-1"
                                                            for="display_landing_page"></label>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="col switch-width">
                                                <div class="form-group ml-2 mr-3">
                                                    <?php echo e(Form::label('SITE_RTL', __('RTL'), ['class' => 'col-form-label'])); ?>

                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" data-toggle="switchbutton"
                                                            data-onstyle="primary" class="" name="SITE_RTL"
                                                            id="SITE_RTL" value="on"
                                                            <?php echo e(env('SITE_RTL') == 'on' ? 'checked="checked"' : ''); ?>>
                                                        <label class="custom-control-label mb-1" for="SITE_RTL"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

 
                                        <div class="col-md-3">
                                            <div class="custom-control custom-switch p-0">
                                                <div class="form-group ml-2 mr-3">
                                                    <label class="col-form-label"
                                                        for="gdpr_cookie"><?php echo e(__('GDPR Cookie')); ?></label><br>
                                                    <input type="checkbox" class="form-check-input gdpr_fulltime gdpr_type"
                                                        data-toggle="switchbutton" data-onstyle="primary" name="gdpr_cookie"
                                                        id="gdpr_cookie"
                                                        <?php echo e(isset($settings['gdpr_cookie']) && $settings['gdpr_cookie'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-12">
                                            <?php echo e(Form::label('cookie_text', __('GDPR Cookie Text'), ['class' => 'fulltime form-label'])); ?>

                                            <?php echo Form::textarea('cookie_text', isset($settings['cookie_text']) && $settings['cookie_text'] ? $settings['cookie_text'] : '', ['class' => 'form-control fulltime', 'style' => 'display: hidden;resize: none;', 'rows' => '2']); ?>

                                        </div>

                                        <h5 class="mt-3 mb-3"><?php echo e(__('Theme Customizer')); ?></h5>
                                        <div class="col-12">
                                            <div class="pct-body">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h6 class="">
                                                            <i data-feather="credit-card"
                                                                class="me-2"></i><?php echo e(__('Primary color settings')); ?>

                                                        </h6>
                                                        <hr class="my-2" />
                                                        <div class="theme-color themes-color">
                                                            <a href="#!"
                                                                class="themes-color-change <?php echo e($color == 'theme-1' ? 'active_color' : ''); ?>"
                                                                data-value="theme-1"></a>
                                                            <input type="radio" class="theme_color d-none"
                                                                name="theme_color" value="theme-1"
                                                                <?php echo e($color == 'theme-1' ? 'checked' : ''); ?>>
                                                            <a href="#!"
                                                                class="themes-color-change <?php echo e($color == 'theme-2' ? 'active_color' : ''); ?>"
                                                                data-value="theme-2"></a>
                                                            <input type="radio" class="theme_color d-none"
                                                                name="theme_color" value="theme-2"
                                                                <?php echo e($color == 'theme-2' ? 'checked' : ''); ?>>
                                                            <a href="#!"
                                                                class="themes-color-change <?php echo e($color == 'theme-3' ? 'active_color' : ''); ?>"
                                                                data-value="theme-3"></a>
                                                            <input type="radio" class="theme_color d-none"
                                                                name="theme_color" value="theme-3"
                                                                <?php echo e($color == 'theme-3' ? 'checked' : ''); ?>>
                                                            <a href="#!"
                                                                class="themes-color-change <?php echo e($color == 'theme-4' ? 'active_color' : ''); ?>"
                                                                data-value="theme-4"></a>
                                                            <input type="radio" class="theme_color d-none"
                                                                name="theme_color" value="theme-4"
                                                                <?php echo e($color == 'theme-4' ? 'checked' : ''); ?>>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <h6 class=" ">
                                                            <i data-feather="layout"
                                                                class="me-2"></i><?php echo e(__('Sidebar settings')); ?>

                                                        </h6>
                                                        <hr class="my-2 " />
                                                        <div class="form-check form-switch ">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="is_sidebar_transperent" name="is_sidebar_transperent"
                                                                <?php if($is_sidebar_transperent == 'on'): ?> checked <?php endif; ?> />

                                                            <label class="form-check-label f-w-600 pl-1"
                                                                for="is_sidebar_transperent"><?php echo e(__('Transparent layout')); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <h6 class=" ">
                                                            <i data-feather="sun"
                                                                class=""></i><?php echo e(__('Layout settings')); ?>

                                                        </h6>
                                                        <hr class=" my-2  " />
                                                        <div class="form-check form-switch mt-2 ">
                                                            <input type="checkbox" class="form-check-input" id="dark_mode"
                                                                name="dark_mode"
                                                                <?php if($dark_mode == 'on'): ?> checked <?php endif; ?> />

                                                            <label class="form-check-label f-w-600 pl-1"
                                                                for="dark_mode"><?php echo e(__('Dark Layout')); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <div class="col-sm-12 px-2">
                                        <div class="text-end">
                                            <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>


                 <div class="" id="company-setting">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Company Setting')); ?></h5>
                        </div>
                        <?php echo e(Form::model($settings, ['route' => 'company.settings', 'method' => 'post'])); ?>

                        <div class="card-body">

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('company_name *', __('Company Name *'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Enter yore company name'])); ?>


                                    <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_name" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('company_address', __('Address'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('company_address', null, ['class' => 'form-control ', 'placeholder' => 'Enter yore Address'])); ?>

                                    <?php $__errorArgs = ['company_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_address" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('company_city', __('City'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('company_city', null, ['class' => 'form-control ', 'placeholder' => 'Enter yore City'])); ?>

                                    <?php $__errorArgs = ['company_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_city" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('company_state', __('State'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('company_state', null, ['class' => 'form-control ', 'placeholder' => 'Enter yore State'])); ?>

                                    <?php $__errorArgs = ['company_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_state" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('company_zipcode', __('Zip/Post Code'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('company_zipcode', null, ['class' => 'form-control', 'placeholder' => 'Enter yore Zip/Post Code'])); ?>

                                    <?php $__errorArgs = ['company_zipcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_zipcode" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('company_country', __('Country'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('company_country', null, ['class' => 'form-control ', 'placeholder' => 'Enter yore Country'])); ?>

                                    <?php $__errorArgs = ['company_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_country" role="alert"><strong
                                                class="text-danger"><?php echo e($message); ?></strong></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('company_telephone', __('Telephone'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('company_telephone', null, ['class' => 'form-control', 'placeholder' => 'Enter yore Telephone'])); ?>

                                    <?php $__errorArgs = ['company_telephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_telephone" role="alert"><strong
                                                class="text-danger"><?php echo e($message); ?></strong></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('company_email', __('System Email *'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('company_email', null, ['class' => 'form-control', 'placeholder' => 'Enter yore System Email'])); ?>

                                    <?php $__errorArgs = ['company_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_email" role="alert"><strong
                                                class="text-danger"><?php echo e($message); ?></strong></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('company_email_from_name', __('Email (From Name) *'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('company_email_from_name', null, ['class' => 'form-control ', 'placeholder' => 'Enter yore Email'])); ?>

                                    <?php $__errorArgs = ['company_email_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_email_from_name" role="alert"><strong
                                                class="text-danger"><?php echo e($message); ?></strong></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>


                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('company_start_time', __('Company Start Time *'), ['class' => 'col-form-label'])); ?>


                                            <?php echo e(Form::time('company_start_time', null, ['class' => 'form-control timepicker_format'])); ?>

                                            <?php $__errorArgs = ['company_start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-company_start_time" role="alert">
                                                    <small class="text-danger"><?php echo e($message); ?></small>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('company_end_time', __('Company End Time *'), ['class' => 'col-form-label'])); ?>

                                            <?php echo e(Form::time('company_end_time', null, ['class' => 'form-control timepicker_format'])); ?>

                                            <?php $__errorArgs = ['company_end_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-company_end_time" role="alert">
                                                    <small class="text-danger"><?php echo e($message); ?></small>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('timezone', __('Timezone'), ['class' => 'col-form-label text-dark'])); ?>

                                    <select type="text" name="timezone" class="form-control select2" id="timezone">
                                        <option value=""><?php echo e(__('Select Timezone')); ?></option>
                                        <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($k); ?>"
                                                <?php echo e(env('TIMEZONE') == $k ? 'selected' : ''); ?>>
                                                <?php echo e($timezone); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['timezone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-timezone" role="alert">
                                            <small class="text-danger"><?php echo e($message); ?></small>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class=" form-check-input" data-toggle="switchbutton"
                                            data-onstyle="primary" name="ip_restrict" id="ip_restrict"
                                            <?php echo e($settings['ip_restrict'] == 'on' ? 'checked="checked"' : ''); ?>>
                                        <label class=" col-form-label p-0"
                                            for="ip_restrict"><?php echo e(__('Ip Restrict')); ?></label>



                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn-submit btn btn-primary" type="submit">
                                <?php echo e(__('Save Changes')); ?>

                            </button>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
 


                <div class="" id="system-setting">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('System Setting')); ?></h5>
                        </div>
                        <?php echo e(Form::model($settings, ['route' => 'system.settings', 'method' => 'post'])); ?>

                        <div class="card-body">
                            <div class="row company-setting">
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('site_currency', __('Currency *'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('site_currency', null, ['class' => 'form-control '])); ?>

                                    <small class="text-xs">
                                        <?php echo e(__('Note: Add currency code as per three-letter ISO code')); ?>.
                                        <a href="https://stripe.com/docs/currencies"
                                            target="_blank"><?php echo e(__('you can find out here..')); ?></a>
                                    </small>
                                    <?php $__errorArgs = ['site_currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <br>
                                        <span class="text-xs text-danger invalid-site_currency"
                                            role="alert"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('site_currency_symbol', __('Currency Symbol *'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('site_currency_symbol', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['site_currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-xs text-danger invalid-site_currency_symbol"
                                            role="alert"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-form-label"><?php echo e(__('Currency Symbol Position')); ?></label>
                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" id="pre" value="pre"
                                            name="site_currency_symbol_position"
                                            <?php if($settings['site_currency_symbol_position'] == 'pre'): ?> checked <?php endif; ?>>
                                        <label class="form-check-label" for="pre">
                                            <?php echo e(__('Pre')); ?>

                                        </label>
                                    </div>
                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" id="post" value="post"
                                            name="site_currency_symbol_position"
                                            <?php if($settings['site_currency_symbol_position'] == 'post'): ?> checked <?php endif; ?>>
                                        <label class="form-check-label" for="post">
                                            <?php echo e(__('Post')); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="site_date_format" class="col-form-label"><?php echo e(__('Date Format')); ?></label>
                                    <select type="text" name="site_date_format" class="form-control select2"
                                        id="site_date_format">
                                        <option value="M j, Y" <?php if(@$settings['site_date_format'] == 'M j, Y'): ?> selected="selected" <?php endif; ?>>
                                            Jan 1,2015</option>
                                        <option value="d-m-Y" <?php if(@$settings['site_date_format'] == 'd-m-Y'): ?> selected="selected" <?php endif; ?>>
                                            d-m-y</option>
                                        <option value="m-d-Y" <?php if(@$settings['site_date_format'] == 'm-d-Y'): ?> selected="selected" <?php endif; ?>>
                                            m-d-y</option>
                                        <option value="Y-m-d" <?php if(@$settings['site_date_format'] == 'Y-m-d'): ?> selected="selected" <?php endif; ?>>
                                            y-m-d</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="site_time_format" class="col-form-label"><?php echo e(__('Time Format')); ?></label>
                                    <select type="text" name="site_time_format" class="form-control select2"
                                        id="site_time_format">
                                        <option value="g:i A" <?php if(@$settings['site_time_format'] == 'g:i A'): ?> selected="selected" <?php endif; ?>>
                                            10:30 PM</option>
                                        <option value="g:i a"
                                            <?php if(@$settings['site_time_format'] == 'g:i a'): ?> selected="selected" <?php endif; ?>>
                                            10:30 pm</option>
                                        <option value="H:i" <?php if(@$settings['site_time_format'] == 'H:i'): ?> selected="selected" <?php endif; ?>>
                                            22:30</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    


                                    <?php echo e(Form::label('employee_prefix', __('Employee Prefix'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('employee_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['employee_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-xs text-danger invalid-employee_prefix" role="alert">
                                            <small class="text-danger"><?php echo e($message); ?></small>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                </div>







                            </div>
                        </div>

                        <div class="card-footer ">
                            <div class="col-sm-12 px-2">
                                <div class="text-end">
                                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                </div>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>  


                 <div class="" id="email-setting">
                    <?php echo e(Form::open(['route' => 'email.settings', 'method' => 'post'])); ?>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5><?php echo e(__('Email Setting')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_driver', __('Mail Driver'), ['class' => 'col-form-label'])); ?>

                                            <?php echo e(Form::text('mail_driver', env('MAIL_DRIVER'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Driver')])); ?>

                                            <?php $__errorArgs = ['mail_driver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-xs text-danger invalid-mail_driver"
                                                    role="alert"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_host', __('Mail Host'), ['class' => 'col-form-label'])); ?>

                                            <?php echo e(Form::text('mail_host', env('MAIL_HOST'), ['class' => 'form-control ', 'placeholder' => __('Enter Mail Driver')])); ?>

                                            <?php $__errorArgs = ['mail_host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-xs text-danger invalid-mail_driver"
                                                    role="alert"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_port', __('Mail Port'), ['class' => 'col-form-label'])); ?>

                                            <?php echo e(Form::text('mail_port', env('MAIL_PORT'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Port')])); ?>

                                            <?php $__errorArgs = ['mail_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-xs text-danger invalid-mail_port"
                                                    role="alert"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_username', __('Mail Username'), ['class' => 'col-form-label'])); ?>

                                            <?php echo e(Form::text('mail_username', env('MAIL_USERNAME'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Username')])); ?>

                                            <?php $__errorArgs = ['mail_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-xs text-danger invalid-mail_username"
                                                    role="alert"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_password', __('Mail Password'), ['class' => 'col-form-label'])); ?>

                                            <?php echo e(Form::text('mail_password', env('MAIL_PASSWORD'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Password')])); ?>

                                            <?php $__errorArgs = ['mail_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-xs text-danger invalid-mail_password"
                                                    role="alert"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'col-form-label'])); ?>

                                            <?php echo e(Form::text('mail_encryption', env('MAIL_ENCRYPTION'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Encryption')])); ?>

                                            <?php $__errorArgs = ['mail_encryption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-xs text-danger invalid-mail_encryption"
                                                    role="alert"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_from_address', __('Mail From Address'), ['class' => 'col-form-label'])); ?>

                                            <?php echo e(Form::text('mail_from_address', env('MAIL_FROM_ADDRESS'), ['class' => 'form-control', 'placeholder' => __('Enter Mail From Address')])); ?>

                                            <?php $__errorArgs = ['mail_from_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-xs text-danger invalid-mail_from_address"
                                                    role="alert"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_from_name', __('Mail From Name'), ['class' => 'col-form-label'])); ?>

                                            <?php echo e(Form::text('mail_from_name', env('MAIL_FROM_NAME'), ['class' => 'form-control', 'placeholder' => __('Enter Mail From Name')])); ?>

                                            <?php $__errorArgs = ['mail_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-xs text-danger invalid-mail_from_name"
                                                    role="alert"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="#" class="btn btn-xs btn-primary" data-ajax-popup="true"
                                                data-title="<?php echo e(__('Send Test Mail')); ?>"
                                                data-url="<?php echo e(route('test.mail')); ?>">
                                                <?php echo e(__('Send Test Mail')); ?>

                                            </a>

                                        </div>
                                        <div class="text-end col-md-6">
                                            <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>

                

                <div class="" id="pusher-setting">
                    <?php echo e(Form::open(['route' => 'pusher.settings', 'method' => 'post'])); ?>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <h5><?php echo e(__('Pusher Setting')); ?></h5><small
                                                class="text-secondary font-weight-bold"></small>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="pusher_app_id"
                                                class="col-form-label"><?php echo e(__('Pusher App Id')); ?></label>
                                            <input class="form-control" placeholder="Enter Pusher App Id"
                                                name="pusher_app_id" type="text" value="<?php echo e(env('PUSHER_APP_ID')); ?>"
                                                id="pusher_app_id">

                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="pusher_app_key"
                                                class="col-form-label"><?php echo e(__('Pusher App Key')); ?></label>
                                            <input class="form-control " placeholder="Enter Pusher App Key"
                                                name="pusher_app_key" type="text" value="<?php echo e(env('PUSHER_APP_KEY')); ?>"
                                                id="pusher_app_key">

                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="pusher_app_secret"
                                                class="col-form-label"><?php echo e(__('Pusher App Secret')); ?></label>
                                            <input class="form-control " placeholder="Enter Pusher App Secret"
                                                name="pusher_app_secret" type="text"
                                                value="<?php echo e(env('PUSHER_APP_SECRET')); ?>" id="pusher_app_secret">

                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="pusher_app_cluster"
                                                class="col-form-label"><?php echo e(__('Pusher App Cluster')); ?></label>
                                            <input class="form-control " placeholder="Enter Pusher App Cluster"
                                                name="pusher_app_cluster" type="text"
                                                value="<?php echo e(env('PUSHER_APP_CLUSTER')); ?>" id="pusher_app_cluster">

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">

                                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>


                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>

                <div class="" id="email-notification">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Email Notification')); ?></h5>
                        </div>
                        <div class="card-body table-border-style ">
                            <div class="table-responsive">
                                <table class="table" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th class="w-75"> <?php echo e(__('Name')); ?></th>
                                            <th class="text-center"> <?php echo e(__('On/Off')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $EmailTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $EmailTemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                            <tr class="">
                                                <td><?php echo e($EmailTemplate->name); ?></td>
                                                <td class="text-center">

                                                    <div class="form-group col-md-12">
                                                        <label class="form-check form-switch d-inline-block">
                                                            <input type="checkbox"
                                                                class="email-template-checkbox form-check-input"
                                                                name="<?php echo e($EmailTemplate->id); ?>"
                                                                <?php if($EmailTemplate->template->is_active == 1): ?> checked="checked" <?php endif; ?>
                                                                value="<?php echo e($EmailTemplate->template->is_active == 1 ? '1' : '0'); ?>"
                                                                data-url="<?php echo e(route('company.email.setting', $EmailTemplate->id)); ?>">
                                                            <span class="slider1 round"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
non-saas chhe
                <div class="" id="ip-restrict">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                            <h5><?php echo e(__('IP Restrict Setting')); ?></h5>
                           <!--  <a href="#" data-url="<?php echo e(route('create.ip')); ?>" class="btn btn-sm btn-primary"
                                data-size="md" data-ajax-popup="true" data-title="<?php echo e(__('Create New IP')); ?>">
                                <i class="ti ti-plus"></i>
                            </a> --> 
                            <a href="#" data-url="<?php echo e(route('create.ip')); ?>" class="btn btn-sm btn-primary"  data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Create New IP')); ?>" data-bs-placement="top"
                                data-size="md" data-ajax-popup="true" data-title="<?php echo e(__('Create New IP')); ?>">
                                <i class="ti ti-plus"></i>
                            </a>

                        </div>
                        <div class="card-body table-border-style ">
                            <div class="table-responsive">
                                <table class="table" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th class="w-75"> <?php echo e(__('IP')); ?></th>
                                            <th width="200px"> <?php echo e('Action'); ?></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $__currentLoopData = $ips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="Action">
                                                <td class="sorting_1"><?php echo e($ip->ip); ?></td>
                                                <td class="">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Company Settings')): ?>
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                                data-url="<?php echo e(route('edit.ip', $ip->id)); ?>" data-size="md"
                                                                data-ajax-popup="true" data-title="<?php echo e(__('Edit IP')); ?>"  data-bs-toggle="tooltip" 
                                                                class="edit-icon"  data-bs-placement="top"
                                                                title="<?php echo e(__('Edit')); ?>"><i
                                                                    class="ti ti-pencil text-white"></i></a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Company Settings')): ?>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['destroy.ip', $ip->id], 'id' => 'delete-form-' . $ip->id]); ?>

                                                            <a href="#!"
                                                                class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="<?php echo e(__('Delete')); ?>">
                                                                <i class="ti ti-trash text-white"></i></a>
                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>


                
                <?php if(Auth::user()->type == 'company'): ?>
                    <div class="" id="zoom-meeting-setting">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Zoom Meeting')); ?></h5>
                            </div>
                            <?php echo e(Form::open(['route' => 'zoom.settings', 'method' => 'post'])); ?>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <?php echo e(Form::label('zoom_apikey', __('Zoom API Key'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('zoom_apikey', isset($settings['zoom_apikey']) ? $settings['zoom_apikey'] : '', ['class' => 'form-control ', 'placeholder' => 'Zoom API Key'])); ?>

                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <?php echo e(Form::label('Zoom Secret Key', __('Zoom Secret Key'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('zoom_secret_key', !empty($settings['zoom_secret_key']) ? $settings['zoom_secret_key'] : '', ['class' => 'form-control', 'placeholder' => 'Zoom Secret Key'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn-submit btn btn-primary" type="submit">
                                    <?php echo e(__('Save Changes')); ?>

                                </button>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                    <div class="" id="slack-setting">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Slack Setting')); ?></h5>
                                <small
                                    class="text-secondary font-weight-bold"><?php echo e(__('Slack Notification Setting')); ?></small>
                            </div>
                            <?php echo e(Form::open(['route' => 'slack.setting', 'id' => 'slack-setting', 'method' => 'post', 'class' => 'd-contents'])); ?>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <?php echo e(Form::label('Slack Webhook URL', __('Slack Webhook URL'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('slack_webhook', isset($settings['slack_webhook']) ? $settings['slack_webhook'] : '', ['class' => 'form-control w-100', 'placeholder' => __('Enter Slack Webhook URL'), 'required' => 'required'])); ?>

                                    </div>
                                    
                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Monthly payslip create', __('Create Monthly Payslip '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('monthly_payslip_notification', '1', isset($settings['monthly_payslip_notification']) && $settings['monthly_payslip_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'monthly_payslip_notification'])); ?>

                                                    <label class="col-form-label" for="lead_notificaation"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Award create', __('Create Award '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('award_notificaation', '1', isset($settings['award_notificaation']) && $settings['award_notificaation'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'award_notificaation'])); ?>

                                                    <label class="col-form-label" for="award_notificaation"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Ticket create', __('Create Ticket '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('ticket_notification', '1', isset($settings['ticket_notification']) && $settings['ticket_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'ticket_notification'])); ?>

                                                    <label class="col-form-label" for="ticket_notification"></label>
                                                </div>
                                            </li>


                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Announcement create', __('Create Announcement '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">

                                                    <?php echo e(Form::checkbox('Announcement_notification', '1', isset($settings['Announcement_notification']) && $settings['Announcement_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'Announcement_notification'])); ?>

                                                    <label class="col-form-label" for="Announcement_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Holidays create', __('Create Holidays '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('Holiday_notification', '1', isset($settings['Holiday_notification']) && $settings['Holiday_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'Holiday_notification'])); ?>

                                                    <label class="col-form-label" for="Holiday_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Event create', __('Create Event '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('event_notification', '1', isset($settings['event_notification']) && $settings['event_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'event_notification'])); ?>

                                                    <label class="col-form-label" for="event_notification"></label>
                                                </div>
                                            </li>


                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Meeting create', __('Create Meeting '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('meeting_notification', '1', isset($settings['meeting_notification']) && $settings['meeting_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'meeting_notification'])); ?>

                                                    <label class="col-form-label" for="meeting_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Company policy create', __('Create Company Policy '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('company_policy_notification', '1', isset($settings['company_policy_notification']) && $settings['company_policy_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'company_policy_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="company_policy_notification"></label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn-submit btn btn-primary" type="submit">
                                    <?php echo e(__('Save Changes')); ?>

                                </button>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>



                    <div class="" id="telegram-setting">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Telegram Setting')); ?></h5>
                                <small
                                    class="text-secondary font-weight-bold"><?php echo e(__('Telegram Notification Setting')); ?></small>
                            </div>
                            <?php echo e(Form::open(['route' => 'telegram.setting', 'id' => 'telegram-setting', 'method' => 'post', 'class' => 'd-contents'])); ?>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('Telegram Access Token', __('Telegram Access Token'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('telegram_accestoken', isset($settings['telegram_accestoken']) ? $settings['telegram_accestoken'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Telegram AccessToken')])); ?>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('Telegram ChatID', __('Telegram ChatID'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('telegram_chatid', isset($settings['telegram_chatid']) ? $settings['telegram_chatid'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Telegram ChatID')])); ?>

                                    </div>
                                    


                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Monthly payslip create', __('Create Monthly Payslip '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_monthly_payslip_notification', '1', isset($settings['telegram_monthly_payslip_notification']) && $settings['telegram_monthly_payslip_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_monthly_payslip_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_monthly_payslip_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Award create', __('Create Award '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_award_notification', '1', isset($settings['telegram_award_notification']) && $settings['telegram_award_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_award_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_award_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Ticket create', __('Create Ticket'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_ticket_notification', '1', isset($settings['telegram_ticket_notification']) && $settings['telegram_ticket_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_ticket_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_ticket_notification"></label>
                                                </div>
                                            </li>


                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Announcement create', __('Create Announcement '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_Announcement_notification', '1', isset($settings['telegram_Announcement_notification']) && $settings['telegram_Announcement_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_Announcement_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_Announcement_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Holidays create', __('Create Holidays '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_Holiday_notification', '1', isset($settings['telegram_Holiday_notification']) && $settings['telegram_Holiday_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_Holiday_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_Holiday_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Event create', __('Create Event '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_event_notification', '1', isset($settings['telegram_event_notification']) && $settings['telegram_event_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_event_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_event_notification"></label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Meeting create', __('Create Meeting '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_meeting_notification', '1', isset($settings['telegram_meeting_notification']) && $settings['telegram_meeting_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_meeting_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_meeting_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Company policy create', __('Create Company Policy '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_company_policy_notification', '1', isset($settings['telegram_company_policy_notification']) && $settings['telegram_company_policy_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_company_policy_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_company_policy_notification"></label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn-submit btn btn-primary" type="submit">
                                    <?php echo e(__('Save Changes')); ?>

                                </button>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>

                    <div class="" id="twilio-setting">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Twilio Setting')); ?></h5>
                                <small  class="text-secondary font-weight-bold"><?php echo e(__('Twilio Notification Setting')); ?></small>
                                   
                            </div>
                            <?php echo e(Form::open(['route' => 'twilio.setting', 'id' => 'twilio-setting', 'method' => 'post', 'class' => 'd-contents'])); ?>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('Twilio SID', __('Twilio SID'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('twilio_sid', isset($settings['twilio_sid']) ? $settings['twilio_sid'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Twilio Sid')])); ?>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('Twilio Token', __('Twilio Token'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('twilio_token', isset($settings['twilio_token']) ? $settings['twilio_token'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Twilio Token')])); ?>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('Twilio From', __('Twilio From'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('twilio_from', isset($settings['twilio_from']) ? $settings['twilio_from'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Twilio From')])); ?>

                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3">
                                        
                                    </div>


                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Payslip create', __('Create Payslip '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('twilio_payslip_notification', '1', isset($settings['twilio_payslip_notification']) && $settings['twilio_payslip_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_payslip_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="twilio_payslip_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Leave Approve/Reject', __('Leave Approve/Reject'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('twilio_leave_approve_notification', '1', isset($settings['twilio_leave_approve_notification']) && $settings['twilio_leave_approve_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_leave_approve_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="twilio_leave_approve_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Ticket create', __('Create Ticket '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('twilio_ticket_notification', '1', isset($settings['twilio_ticket_notification']) && $settings['twilio_ticket_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_ticket_notification'])); ?>

                                                    <label class="col-form-label" for="twilio_ticket_notification"></label>
                                                </div>
                                            </li>


                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Award create', __('Create Award '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('twilio_award_notification', '1', isset($settings['twilio_award_notification']) && $settings['twilio_award_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_award_notification'])); ?>

                                                    <label class="col-form-label" for="twilio_award_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Trip create', __('Create Trip '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('twilio_trip_notification', '1', isset($settings['twilio_trip_notification']) && $settings['twilio_trip_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_trip_notification'])); ?>

                                                    <label class="col-form-label" for="twilio_trip_notification"></label>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Event create', __('Create Event '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('twilio_event_notification', '1', isset($settings['twilio_event_notification']) && $settings['twilio_event_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_event_notification'])); ?>

                                                    <label class="col-form-label" for="twilio_event_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Announcement create', __('Create Announcement '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('twilio_announcement_notification', '1', isset($settings['twilio_announcement_notification']) && $settings['twilio_announcement_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_announcement_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="twilio_announcement_notification"></label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn-submit btn btn-primary" type="submit">
                                    <?php echo e(__('Save Changes')); ?>

                                </button>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                <?php endif; ?>

                <div id="recaptcha-print-setting" class="card">
                    <div class="col-md-12">
                        <form method="POST" action="<?php echo e(route('recaptcha.settings.store')); ?>" accept-charset="UTF-8">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <a href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/"
                                            target="_blank" class="text-blue">
                                            <h5 class=""><?php echo e(__('ReCaptcha settings')); ?></h5><small
                                                class="text-secondary font-weight-bold">(<?php echo e(__('How to Get Google reCaptcha Site and Secret key')); ?>)</small>
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 text-end">
                                        <div class="col switch-width">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary"
                                                    class="" name="recaptcha_module" id="recaptcha_module"
                                                    value="yes"
                                                    <?php echo e(env('RECAPTCHA_MODULE') == 'yes' ? 'checked="checked"' : ''); ?>>
                                                <label class="custom-control-label form-control-label px-2"
                                                    for="recaptcha_module "></label><br>
                                                <a href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/"
                                                    target="_blank" class="text-blue">

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <label for="google_recaptcha_key"
                                            class="form-label"><?php echo e(__('Google Recaptcha Key')); ?></label>
                                        <input class="form-control"
                                            placeholder="<?php echo e(__('Enter Google Recaptcha Key')); ?>"
                                            name="google_recaptcha_key" type="text"
                                            value="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>" id="google_recaptcha_key">

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <label for="google_recaptcha_secret"
                                            class="form-label"><?php echo e(__('Google Recaptcha Secret')); ?></label>
                                        <input class="form-control "
                                            placeholder="<?php echo e(__('Enter Google Recaptcha Secret')); ?>"
                                            name="google_recaptcha_secret" type="text"
                                            value="<?php echo e(env('NOCAPTCHA_SECRET')); ?>" id="google_recaptcha_secret">

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">

                                <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>


                            </div>
                        </form>
                    </div>
                </div>



            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\accounts\resources\views/setting/company_settings.blade.php ENDPATH**/ ?>