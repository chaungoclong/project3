import { 
    SELECTOR_CHECK_ONE_PERMISSION,
    SELECTOR_CHECK_ALL_PERMISSION,
    checkAllPermissionEvent, 
    checkOnePermissionEvent 
} from './common.js';

const bindFunctions = () => {
    $(SELECTOR_CHECK_ALL_PERMISSION).on('click', checkAllPermissionEvent);
    $(SELECTOR_CHECK_ONE_PERMISSION).on('click', checkOnePermissionEvent);
}
const init = () => {
    bindFunctions();
}
const EditPage = {
    init: init,
}
export default EditPage;