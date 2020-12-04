<script>
    $(document).ready(function () {
        $('#checkedAllPermission').click(function () {
            if($(this).is(':checked')) {
                //Checked all checkbox...
                $('input[type=checkbox]').prop('checked', true);
            } else {
                //Unchecked all checkbox...
                $('input[type=checkbox]').prop('checked', false);
            }
        });
        //Another way...
        // $('#checkedAllPermission').change(function () {
        //     $('.check-item').prop('checked', $(this).prop('checked'));
        // });

    });


    function checkGroupWisePermission(groupWisePermissionCheckboxClass, thisId) {
        const permissionGroupNameId = $('#'+thisId.id);
        const GroupWisePermissionNameCheckClass = $('.'+groupWisePermissionCheckboxClass+' input');

        if(permissionGroupNameId.is(':checked')) {
            GroupWisePermissionNameCheckClass.prop('checked', true);
        } else {
            GroupWisePermissionNameCheckClass.prop('checked', false);
        }

        // allPermissionsCheckUncheck();

    }

    function checkGroupWiseSinglePermission(groupWisePermissionCheckboxClass, permissionGroupNameId, countTotalPermission) {
        // const GroupWisePermissionNameCheckClass = $('.'+groupWisePermissionCheckboxClass+' input');
        const permissionGroupNameCheckId = $('#'+permissionGroupNameId);

        if($('.'+groupWisePermissionCheckboxClass+' input:checked').length === countTotalPermission) {
            permissionGroupNameCheckId.prop('checked', true);
        } else {
            permissionGroupNameCheckId.prop('checked', false);
        }

        // allPermissionsCheckUncheck();
    }

    {{--function allPermissionsCheckUncheck() {--}}
    {{--    const countPermissions = {{ count($permissions) }};--}}
    {{--    const countPermissionsGroup = {{ count($permission_groups) }};--}}

    {{--    // console.log((countPermissions + countPermissionsGroup));--}}
    {{--    // console.log($('input[type=checkbox]:checked').length);--}}

    {{--    if($('input[type=checkbox]:checked').length >= (countPermissions + countPermissionsGroup)) {--}}
    {{--        $('#checkedAllPermission').prop('checked', true);--}}
    {{--    } else {--}}
    {{--        $('#checkedAllPermission').prop('checked', false);--}}
    {{--    }--}}

    {{--}--}}

    $('.check-group-name').change(function () {
        if($(this).prop('checked') === false) {
            $('#checkedAllPermission').prop('checked', false);
        }
        if($('.check-group-name:checked').length === $('.check-group-name').length) {
            $('#checkedAllPermission').prop('checked', true);
        }
    });

    $('.check-group-item-name').change(function () {
        if($(this).prop('checked') === false) {
            $('#checkedAllPermission').prop('checked', false);
        }
        if($('.check-group-item-name:checked').length === $('.check-group-item-name').length) {
            $('#checkedAllPermission').prop('checked', true);
        }
    });


</script>
