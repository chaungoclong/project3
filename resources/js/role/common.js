export const SELECTOR_CARD_PERMISSION      = '.js-card-permission';
export const SELECTOR_CHECK_ONE_PERMISSION = '.js-check-one-permission';
export const SELECTOR_CHECK_ALL_PERMISSION = '.js-check-all-permission';

export const checkAllPermissionEvent = function(e) {
    $(this).closest(SELECTOR_CARD_PERMISSION)
                .find(SELECTOR_CHECK_ONE_PERMISSION)
                    .prop('checked', $(this).prop('checked'));
}

export const checkOnePermissionEvent = function(e) {
    let closestCard     = $(this).closest(SELECTOR_CARD_PERMISSION);
    let permissions     = closestCard.find(SELECTOR_CHECK_ONE_PERMISSION);
    let closestCheckAll = closestCard.find(SELECTOR_CHECK_ALL_PERMISSION);

    closestCheckAll.prop('checked', true);
    
    permissions.each((k, v) => {
        if (!$(v).prop('checked')) {
            closestCheckAll.prop('checked', false);
            return false;
        }
    });
}