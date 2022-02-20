import * as Utils from '../utils.js';
import { URL } from '../config.js';

const SELECTOR_ROLE_TBL                 = '#role_table';
const SELECTOR_DELETE_MULTIPLE_ROLE_BTN = '#delete_multiple_role';
const SELECTOR_DELETE_ROLE_BTN          = '.js-delete-role';
const SELECTOR_SET_ROLE_DEFAULT_CHK     = '.js-set-role-default';
const SELECTOR_SELECT_ROLE_CHK          = '.js-select-one-role';

let _checkeds = [];
let _roleTable = null;

const initRoleTable = () => {
    _roleTable = $(SELECTOR_ROLE_TBL).DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: URL.admin.roles.index(),
            method: 'GET',
            data: function(d) {
                d.checkeds = _checkeds;
            },
            error: function(jqXHR, textStatus, errorThrow) {
                Utils.handleError(jqXHR, textStatus, errorThrow);
            }
        },
        columns: [{
            data: 'select',
            searchable: false,
            sortable: false
        }, {
            data: 'DT_RowIndex',
            'orderable': false,
            'searchable': false
        }, {
            data: 'name',
            name: 'roles.name'
        }, {
            data: 'title',
            name: 'roles.title'
        }, {
            data: 'default',
            name: 'roles.is_default',
            searchable: false,
            sortable: false
        }, {
            data: 'users',
            name: 'posts.users_count',
            searchable: false,
            sortable: false
        }, {
            data: 'permissions',
            name: 'posts.permissions_count',
            searchable: false,
            sortable: false
        }, {
            data: 'actions',
            searchable: false,
            sortable: false
        }, ],
    });
}

/**
 * EVENTS
 */
const selectRoleEvent = function(e) {
    Utils.toggleValueInArray($(this).val(), _checkeds);
    console.log(_checkeds);
}

const deleteOneRoleEvent = function(e) {
    let id = $(this).data('role-id');
    Swal.fire({
        title: 'Do you want delete this role',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        icon: 'warning'
    }).then(result => {
        if (result.isConfirmed) {
            deleteOneRole(id).done(data => {
                Swal.fire(data.message, '', 'success');
                reload();
            }).fail((jqXHR, textStatus, errorThrow) => {
                Utils.handleError(jqXHR, textStatus, errorThrow);
                reload();
            });
        }
    });
}

const deleteMultipleRoleEvent = function(e) {
    Swal.fire({
        title: 'Do you want delete all role',
        text: `${_checkeds.length} roles selected`,
        showCancelButton: true,
        confirmButtonText: 'Delete all',
        icon: 'warning'
    }).then(result => {
        if (result.isConfirmed) {
            deleteMultipleRole().done(data => {
                Swal.fire(data.message, '', 'success');
                reload();
            }).fail((jqXHR, textStatus, errorThrow) => {
                Utils.handleError(jqXHR, textStatus, errorThrow);
                reload();
            });
        }
    });
}

const setRoleDefaultEvent = function(e) {
    let id = $(this).val();
    let isDefault = $(this).prop('checked') ? 1 : 0;
    Swal.fire({
        title: 'Do you want set this role is default',
        showCancelButton: true,
        confirmButtonText: 'Set default',
        icon: 'warning'
    }).then(result => {
        if (result.isConfirmed) {
            setRoleDefault(id, isDefault).done(data => {
                Swal.fire(data.message, '', 'success');
                reload();
            }).fail((jqXHR, textStatus, errorThrow) => {
                Utils.handleError(jqXHR, textStatus, errorThrow);
                $(this).prop('checked', !$(this).prop('checked'));
            });
        } else {
            $(this).prop('checked', !$(this).prop('checked'));
        }
    });
}

/**
 * AJAX
 */
const deleteOneRole = (id) => {
    Utils.setToken();
    return $.ajax({
        url: URL.admin.roles.delete(id),
        type: 'DELETE',
        data: {
            id: id
        },
        dataType: 'JSON'
    });
}

const deleteMultipleRole = () => {
    Utils.setToken();
    return $.ajax({
        url: URL.admin.roles.deleteMultiple(),
        type: 'DELETE',
        data: {
            ids: _checkeds.join()
        },
        dataType: 'JSON'
    });
}

const setRoleDefault = (id, isDefault) => {
    Utils.setToken();
    return $.ajax({
        url: URL.admin.roles.setDefault(id),
        type: 'PATCH',
        data: {
            is_default: isDefault
        },
        dataType: 'JSON'
    });
}

const reload = () => {
    _checkeds = [];
    _roleTable.draw();
}

const init = () => {
    initRoleTable();
    bindFunctions();
}

const bindFunctions = () => {
    // chon role
    $(document).on('click', SELECTOR_SELECT_ROLE_CHK, selectRoleEvent);

    // xoa 1 role
    $(document).on('click', SELECTOR_DELETE_ROLE_BTN, deleteOneRoleEvent);
    
    // xoa nhieu role
    $(SELECTOR_DELETE_MULTIPLE_ROLE_BTN).on('click', deleteMultipleRoleEvent);

    // dat 1 role thanh mac dinh
    $(document).on('click', SELECTOR_SET_ROLE_DEFAULT_CHK, setRoleDefaultEvent);
}

const IndexPage = {
    init: init
}

export default IndexPage;