import { 
    SELECTOR_CHECK_ONE_PERMISSION,
    SELECTOR_CHECK_ALL_PERMISSION,
    checkAllPermissionEvent, 
    checkOnePermissionEvent 
} from './common.js';

/**
 * EVENTS
 */
// export const checkAllPermissionEvent = function(e) {
//     $(this).closest('.js-card-permission').find('.js-check-one-permission').prop('checked', $(this).prop('checked'));
// }
// export const checkOnePermissionEvent = function(e) {
//     let closestCard = $(this).closest('.js-card-permission');
//     let permissions = closestCard.find('.js-check-one-permission');
//     let closestCheckAll = closestCard.find('.js-check-all-permission');
//     closestCheckAll.prop('checked', true);
//     permissions.each((k, v) => {
//         if (!$(v).prop('checked')) {
//             closestCheckAll.prop('checked', false);
//             return false;
//         }
//     });
// }
const bindFunctions = () => {
    $(SELECTOR_CHECK_ALL_PERMISSION).on('click', checkAllPermissionEvent);
    $(SELECTOR_CHECK_ONE_PERMISSION).on('click', checkOnePermissionEvent);
}
const init = () => {
    bindFunctions();
}
const CreatePage = {
    init: init,
}
export default CreatePage;