// var Copy = (function() {
//     let configs = {};
//     // cac phan tu can thao tac va lay du lieu
//     let elements = {};
//     // luu id cua cac hang duoc chon
//     let checkeds = [];
//     // datatables
//     let dTable = null;
//     // url
//     let route = null;

//     // refresh page
//     let refreshPage = function() {
//         dTable.draw();
//         initOrRefreshElements();
//     };

//     let deleteButtonClick = function() {
//         Swal.fire({
//             title: 'do you want delete this role',
//             showCancelButton: true,
//             confirmButtonText: 'delete',
//             icon: 'warning'
//         }).then(result => {
//             if (result.isConfirmed) {
//                 let roleId = $(this).data('role-id');
//                 deleteRole(roleId);
//             }
//         });
//     };

//     let deleteButtonMultipleClick = function() {
//         Swal.fire({
//             title: 'do you want delete this role',
//             showCancelButton: true,
//             confirmButtonText: 'delete',
//             icon: 'warning'
//         }).then(result => {
//             if (result.isConfirmed) {
//                 deleteMultipleRoles();
//             }
//         });
//     };

//     let selectRow = function() {
//         toggleValueInArray($(this).val(), checkeds);
//         initOrRefreshElements();
//         if (checkeds.length !== 0) {
//             elements.btnDelete.hide();
//             elements.btnEdit.hide();
//         } else {
//             elements.btnDelete.show();
//             elements.btnEdit.show();
//         }
//         console.log(checkeds);
//     };

//     let deleteRole = function(id) {
//         setToken();
//         $.ajax({
//             url: route.get('delete', id),
//             type: 'DELETE',
//             data: {
//                 id: id,
//             },
//             dataType: 'JSON',
//         }).done(function(res) {
//             Swal.fire('delete success', '', 'success');
//             refreshPage();
//         }).fail(function(res) {
//             Swal.fire(res.responseJSON.message, '', 'error');
//         });
//     };

//     let deleteMultipleRoles = function() {
//         setToken();
//         $.ajax({
//             url: route.get('deleteMultiple'),
//             type: 'DELETE',
//             data: {
//                 ids: checkeds
//             },
//             dataType: 'JSON',
//         }).done(function(res) {
//             Swal.fire('delete success', '', 'success');
//             checkeds = [];
//             refreshPage();
//         }).fail(function(res) {
//             Swal.fire(res.responseJSON.message, res.responseJSON.errors.ids[0], 'error');
//         });
//     };

//     let bindFunctions = function() {
//         let selectors = configs.selectors;
//         $(document).on('click', selectors.selectSingleRow, selectRow);
//         // delete role
//         $(document).on('click', selectors.btnDelete, deleteButtonClick);
//         //delete multiple roles
//         $(document).on('click', selectors.btnDeleteMultiple, deleteButtonMultipleClick);
//         $(document).on('click', selectors.btnCreate, function() {
//             elements.modalCreate.modal('show');
//            $.get(route.get('create'), function(res) {
//                 $(res).each(function(k, v) {
//                     let checkBox = $('<input />', {type: 'checkbox', value: v.id});
//                     console.log(checkBox);
//                     elements.permissionInput.append(checkBox);
//                 })
//            })
//         });
//     };

//     // khoi tao cac element tu selector
//     let initOrRefreshElements = function() {
//         initElementFromSelector(elements, configs.selectors);
//     };

//     // khoi tao datatables (1 lan duy nhat)
//     let initTable = function() {
//         dTable = elements.table.DataTable({
//             processing: true,
//             serverSide: true,
//             ajax: {
//                 url: route.get('index'),
//                 method: 'GET',
//                 data: function(d) {
//                     d.checkeds = checkeds;
//                 },
//                 error: function(res) {
//                     Swal.fire(res.responseJSON.message, '', 'error');
//                 }
//             },
//             columns: [{
//                 data: 'select',
//                 searchable: false,
//                 sortable: false
//             }, {
//                 data: 'DT_RowIndex',
//                 'orderable': false,
//                 'searchable': false
//             }, {
//                 data: 'title',
//                 name: 'roles.title'
//             }, {
//                 data: 'name',
//                 name: 'roles.name'
//             }, {
//                 data: 'users',
//                 name: 'posts.users_count',
//                 searchable: false,
//                 sortable: false
//             }, {
//                 data: 'permissions',
//                 name: 'posts.permissions_count',
//                 searchable: false,
//                 sortable: false
//             }, {
//                 data: 'actions',
//                 searchable: false,
//                 sortable: false
//             }, ],
//             initComplete: function(settings) {
//                 this.api().columns().every(function(index) {
//                     var column = this;
//                     var settingOfColumn = settings['aoColumns'][index];
//                     // console.log(settingOfColumn);
//                     if (settingOfColumn.bSearchable) {
//                         var input = document.createElement("input");
//                         $(input).appendTo($(column.footer()).empty()).on('change', function() {
//                             column.search($(this).val(), false, false, true).draw();
//                         });
//                     }
//                 });
//             },
//         });
//     };

//     let initRoute = function() {
//         route = new Url(configs.urlMap);
//     };

//     // khoi tao de chay
//     let init = function(cfgs = {}) {
//         if (!$.isEmptyObject(cfgs)) {
//             configs = cfgs;
//         }
//         initOrRefreshElements();
//         console.log(elements);
//         initRoute();
//         initTable();
//         bindFunctions();
//     };
//     return {
//         init: init,
//     };
// })();
// 
// var Role = (function() {
//     var $url = {
//         index: () => `${BASE_URL}/admin/roles/get-datatables`,
//         delete: (id) => `${BASE_URL}/admin/roles/${id}`,
//         deleteMultiple: () => `${BASE_URL}/admin/roles/delete-multiple`,
//         setRoleDefault: (id) => `${BASE_URL}/admin/roles/set-default/${id}`,
//     };
//     var $selectors = {
//         table: '#table',
//         selectOneRow: '.select-one-row',
//         btnDeleteMultiple: '#btnDeleteMultiple',
//         btnDelete: '.btn-delete',
//         btnEdit: '.btn-edit',
//         btnSwitchRoleDefault: '.btn-switch-role-default',
//         checkboxCheckAllGroupPermission: '.checkbox_check-all_group-permission',
//         cardGroupPermission: '.card_group-permission',
//         checkboxPermission: '.checkbox_permission',
//     };
//     var $elements = {};
//     var $dTable = null;
//     var $checkeds = [];
//     const reload = function() {
//         $checkeds = [];
//         initElements();
//         $dTable.draw();
//     }
//     const initElements = function() {
//         initElementFromSelector($elements, $selectors);
//     };
//     const initTable = function() {
//         $dTable = $elements.table.DataTable({
//             processing: true,
//             serverSide: true,
//             ajax: {
//                 url: $url.index(),
//                 method: 'GET',
//                 data: function(d) {
//                     d.checkeds = $checkeds;
//                 },
//                 error: function(jqXHR, textStatus, errorThrow) {
//                     handleError(jqXHR, textStatus, errorThrow);
//                 }
//             },
//             columns: [{
//                 data: 'select',
//                 searchable: false,
//                 sortable: false
//             }, {
//                 data: 'DT_RowIndex',
//                 'orderable': false,
//                 'searchable': false
//             }, {
//                 data: 'name',
//                 name: 'roles.name'
//             }, {
//                 data: 'title',
//                 name: 'roles.title'
//             }, {
//                 data: 'default',
//                 name: 'roles.is_default',
//                 searchable: false,
//                 sortable: false
//             }, {
//                 data: 'users',
//                 name: 'posts.users_count',
//                 searchable: false,
//                 sortable: false
//             }, {
//                 data: 'permissions',
//                 name: 'posts.permissions_count',
//                 searchable: false,
//                 sortable: false
//             }, {
//                 data: 'actions',
//                 searchable: false,
//                 sortable: false
//             }, ],
//             // initComplete: function(settings) {
//             //     this.api().columns().every(function(index) {
//             //         var column = this;
//             //         var settingOfColumn = settings['aoColumns'][index];
//             //         // console.log(settingOfColumn);
//             //         if (settingOfColumn.bSearchable) {
//             //             var input = document.createElement("input");
//             //             $(input).appendTo($(column.footer()).empty()).on('change', function() {
//             //                 column.search($(this).val(), false, false, true).draw();
//             //             });
//             //         }
//             //     });
//             // },
//         });
//     };
//     // EVENT
//     const selectRow = function(e) {
//         initElements();
//         toggleValueInArray($(this).val(), $checkeds);
//         if ($checkeds.length !== 0) {
//             $elements.btnDelete.hide();
//             $elements.btnEdit.hide();
//         } else {
//             $elements.btnDelete.show();
//             $elements.btnEdit.show();
//         }
//         console.log($checkeds);
//     };
//     const deleteClick = function(e) {
//         let id = $(this).data('role-id');
//         Swal.fire({
//             title: 'Do you want delete this role',
//             showCancelButton: true,
//             confirmButtonText: 'Delete',
//             icon: 'warning'
//         }).then(result => {
//             if (result.isConfirmed) {
//                 deleteOneRole(id);
//             }
//         });
//     };
//     const deleteMultipleClick = function(e) {
//         if ($checkeds.length === 0) {
//             Swal.fire('No role selected', '', 'warning');
//         } else {
//             Swal.fire({
//                 title: 'Do you want delete all role',
//                 text: `${$checkeds.length} role selected`,
//                 showCancelButton: true,
//                 confirmButtonText: 'Delete All',
//                 icon: 'warning'
//             }).then(result => {
//                 if (result.isConfirmed) {
//                     deleteMultipleRole();
//                 }
//             });
//         }
//     };
//     const setRoleDefaultClick = function(e) {
//         let id = $(this).val();
//         let isDefault = $(this).prop('checked') ? 1 : 0;
//         Swal.fire({
//             title: 'Do you want set this role is default',
//             showCancelButton: true,
//             confirmButtonText: 'Set default',
//             icon: 'warning'
//         }).then(result => {
//             if (result.isConfirmed) {
//                 setRoleDefault(id, isDefault);
//             } else {
//                 $(this).prop('checked', !$(this).prop('checked'));
//             }
//         });
//     };
//     const selectAllPermissionInGroup = function(e) {
//         $(this).closest($selectors.cardGroupPermission).find($selectors.checkboxPermission).prop('checked', $(this).prop('checked'));
//     }
//     const switchStatusOfCheckboxCheckAllPermissionGroup = function(e) {
//         $(this).closest($selectors.cardGroupPermission).find($selectors.checkboxCheckAllGroupPermission).prop('checked', false);
//     }
//     // ===================== CRUD ===================== //
//     const deleteOneRole = function(id) {
//         setToken();
//         $.ajax({
//             url: $url.delete(id),
//             type: 'DELETE',
//             data: {
//                 id: id
//             },
//             dataType: 'JSON',
//             success: (data) => {
//                 Swal.fire(data.message, '', 'success');
//                 reload();
//             },
//             error: (jqXHR, textStatus, errorThrow) => {
//                 handleError(jqXHR, textStatus, errorThrow);
//             }
//         });
//     };
//     const deleteMultipleRole = function() {
//         setToken();
//         $.ajax({
//             url: $url.deleteMultiple(),
//             type: 'DELETE',
//             data: {
//                 ids: $checkeds.join()
//             },
//             dataType: 'JSON',
//             success: (data) => {
//                 console.log(data);
//                 Swal.fire(data.message, '', 'success');
//                 reload();
//             },
//             error: (jqXHR, textStatus, errorThrow) => {
//                 handleError(jqXHR, textStatus, errorThrow);
//             }
//         });
//     };
//     const setRoleDefault = function(id, isdefault) {
//         setToken();
//         $.ajax({
//             url: $url.setRoleDefault(id),
//             data: {
//                 is_default: isdefault
//             },
//             type: 'PATCH',
//             dataType: 'JSON',
//             success: (data) => {
//                 Swal.fire(data.message, '', 'success');
//                 reload();
//             },
//             error: (jqXHR, textStatus, errorThrow) => {
//                 handleError(jqXHR, textStatus, errorThrow);
//             }
//         });
//     };
//     // BIND FUNCTIONS
//     const bindFunctions = function() {
//         // chon role
//         $(document).on('click', $selectors.selectOneRow, selectRow);
//         // xoa nhieu role
//         $(document).on('click', $selectors.btnDeleteMultiple, deleteMultipleClick);
//         // xoa mot role
//         $(document).on('click', $selectors.btnDelete, deleteClick);
//         // dat role mac dinh
//         $(document).on('click', $selectors.btnSwitchRoleDefault, setRoleDefaultClick);
//         // chon tat ca cac permission trong nhom (create/edit page)
//         $(document).on('click', $selectors.checkboxCheckAllGroupPermission, selectAllPermissionInGroup);
//         // thay doi trang thai chon tat ca khi mot permission trong nhom duoc
//         // chon hoac huy chon
//         $(document).on('click', $selectors.checkboxPermission, switchStatusOfCheckboxCheckAllPermissionGroup);
//     };
//     const init = function() {
//         initElements();
//         initTable();
//         bindFunctions();
//         console.log($elements);
//     };
//     return {
//         init: init
//     }
// })();

// $(function() {
//     Role.init();
// });

 // let RoleIndex = (function() {
 //     let _url = {
 //         index: () => `${BASE_URL}/admin/roles/get-datatables`,
 //         delete: (id) => `${BASE_URL}/admin/roles/${id}`,
 //         deleteMultiple: () => `${BASE_URL}/admin/roles/delete-multiple`,
 //         setRoleDefault: (id) => `${BASE_URL}/admin/roles/set-default/${id}`,
 //     };
 //     let _selectors = {
 //         $tblListRole: '#list_role',
 //         $chbxSelectRole: '.list-role__checkbox--select-one',
 //         $chbxSetRoleDefault: '.list-role__checkbox--set-default',
 //         $btnDeleteRole: '.list-role__btn--delete',
 //         $btnEditRole: '.list-role__btn--edit',
 //         $btnDeleteMultipleRole: '#delete_multiple_role',
 //     };
 //     let _elements = {};
 //     let _checkeds = [];
 //     let _listRole = null;
 //     const initElements = () => {
 //         // alert('here');
 //         initElementFromSelector(_elements, _selectors);
 //     }
 //     const initElementsAfterAjax = () => {
 //         let selectors = {
 //             $chbxSelectRole: '.list-role__checkbox--select-one',
 //             $btnDeleteRole: '.list-role__btn--delete',
 //             $btnEditRole: '.list-role__btn--edit',
 //         };
 //         initElementFromSelector(_elements, selectors);
 //     }
 //     let _fEvents = {
 //         selectRole: function(e) {
 //             initElementsAfterAjax();
 //             toggleValueInArray($(this).val(), _checkeds);
 //             if (_checkeds.length !== 0) {
 //                 _elements.$btnDeleteRole.hide();
 //                 _elements.$btnEditRole.hide();
 //             } else {
 //                 _elements.$btnDeleteRole.show();
 //                 _elements.$btnEditRole.show();
 //             }
 //             console.log(_checkeds);
 //         },
 //         deleteOneRoleClick: function(e) {
 //             let id = $(this).data('role-id');
 //             Swal.fire({
 //                 title: 'Do you want delete this role',
 //                 showCancelButton: true,
 //                 confirmButtonText: 'Delete',
 //                 icon: 'warning'
 //             }).then(result => {
 //                 if (result.isConfirmed) {
 //                     _fAjaxs.deleteOneRole(id);
 //                 }
 //             });
 //         },
 //         deleteMultipleRoleClick: function(e) {
 //             if (_checkeds.length === 0) {
 //                 Swal.fire('No role selected', '', 'warning');
 //             } else {
 //                 Swal.fire({
 //                     title: 'Do you want delete all role',
 //                     text: `${_checkeds.length} role selected`,
 //                     showCancelButton: true,
 //                     confirmButtonText: 'Delete All',
 //                     icon: 'warning'
 //                 }).then(result => {
 //                     if (result.isConfirmed) {
 //                         _fAjaxs.deleteMultipleRole();
 //                     }
 //                 });
 //             }
 //         },
 //         setRoleDefaultClick: function(e) {
 //             let id = $(this).val();
 //             let isDefault = $(this).prop('checked') ? 1 : 0;
 //             Swal.fire({
 //                 title: 'Do you want set this role is default',
 //                 showCancelButton: true,
 //                 confirmButtonText: 'Set default',
 //                 icon: 'warning'
 //             }).then(result => {
 //                 if (result.isConfirmed) {
 //                     _fAjaxs.setRoleDefault(id, isDefault);
 //                 } else {
 //                     $(this).prop('checked', !$(this).prop('checked'));
 //                 }
 //             });
 //         },
 //     };
 //     let _fAjaxs = {
 //         deleteOneRole: function(id) {
 //             setToken();
 //             $.ajax({
 //                 url: _url.delete(id),
 //                 type: 'DELETE',
 //                 data: {
 //                     id: id
 //                 },
 //                 dataType: 'JSON',
 //                 success: (data) => {
 //                     Swal.fire(data.message, '', 'success');
 //                     reload();
 //                 },
 //                 error: (jqXHR, textStatus, errorThrow) => {
 //                     handleError(jqXHR, textStatus, errorThrow);
 //                 }
 //             });
 //         },
 //         deleteMultipleRole: function() {
 //             setToken();
 //             $.ajax({
 //                 url: _url.deleteMultiple(),
 //                 type: 'DELETE',
 //                 data: {
 //                     ids: _checkeds.join()
 //                 },
 //                 dataType: 'JSON',
 //                 success: (data) => {
 //                     console.log(data);
 //                     Swal.fire(data.message, '', 'success');
 //                     reload();
 //                 },
 //                 error: (jqXHR, textStatus, errorThrow) => {
 //                     handleError(jqXHR, textStatus, errorThrow);
 //                 }
 //             });
 //         },
 //         setRoleDefault: function(id, isDefault) {
 //             setToken();
 //             $.ajax({
 //                 url: _url.setRoleDefault(id),
 //                 data: {
 //                     is_default: isDefault
 //                 },
 //                 type: 'PATCH',
 //                 dataType: 'JSON',
 //                 success: (data) => {
 //                     Swal.fire(data.message, '', 'success');
 //                     reload();
 //                 },
 //                 error: (jqXHR, textStatus, errorThrow) => {
 //                     handleError(jqXHR, textStatus, errorThrow);
 //                 }
 //             });
 //         },
 //     };
 //     const reload = () => {
 //         _checkeds = [];
 //         _listRole.draw();
 //     }
 //     const initListRole = function() {
 //         _listRole = _elements.$tblListRole.DataTable({
 //             processing: true,
 //             serverSide: true,
 //             ajax: {
 //                 url: _url.index(),
 //                 method: 'GET',
 //                 data: function(d) {
 //                     d.checkeds = _checkeds;
 //                 },
 //                 error: function(jqXHR, textStatus, errorThrow) {
 //                     handleError(jqXHR, textStatus, errorThrow);
 //                 }
 //             },
 //             columns: [{
 //                 data: 'select',
 //                 searchable: false,
 //                 sortable: false
 //             }, {
 //                 data: 'DT_RowIndex',
 //                 'orderable': false,
 //                 'searchable': false
 //             }, {
 //                 data: 'name',
 //                 name: 'roles.name'
 //             }, {
 //                 data: 'title',
 //                 name: 'roles.title'
 //             }, {
 //                 data: 'default',
 //                 name: 'roles.is_default',
 //                 searchable: false,
 //                 sortable: false
 //             }, {
 //                 data: 'users',
 //                 name: 'posts.users_count',
 //                 searchable: false,
 //                 sortable: false
 //             }, {
 //                 data: 'permissions',
 //                 name: 'posts.permissions_count',
 //                 searchable: false,
 //                 sortable: false
 //             }, {
 //                 data: 'actions',
 //                 searchable: false,
 //                 sortable: false
 //             }, ],
 //         });
 //     };
 //     const bindEvents = () => {
 //         $(document).on('click', _selectors.$chbxSelectRole, _fEvents.selectRole);
 //         $(document).on('click', _selectors.$btnDeleteRole, _fEvents.deleteOneRoleClick);
 //         $(document).on('click', _selectors.$chbxSetRoleDefault, _fEvents.setRoleDefaultClick);
 //         $(document).on('click', _selectors.$btnDeleteMultipleRole, _fEvents.deleteMultipleRoleClick);
 //     }
 //     const init = () => {
 //         initElements();
 //         initListRole();
 //         bindEvents();
 //         console.log(_elements);
 //     }
 //     return {
 //         init: init,
 //     }
 // })();
 // export default RoleIndex;