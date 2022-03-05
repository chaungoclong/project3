// url goc
export const BASE_URL = 'http://127.0.0.1:8000';

// URL cho request ajax
export const URL = {
    admin: {
        roles: {
            index: () => `${BASE_URL}/admin/roles/get-datatables`,
            delete: (id) => `${BASE_URL}/admin/roles/${id}`,
            deleteMultiple: () => `${BASE_URL}/admin/roles/delete-multiple`,
            setDefault: (id) => `${BASE_URL}/admin/roles/set-default/${id}`,
        }
    }
}
// // goi module can dung dua vao data-location tren the body
// export const ROUTE = {
//     init: (namespace) => {
//         ROUTE.namespace = namespace;
//         let action = $('body').data('action');
//         ROUTE.exec(action);
//     },
//     exec: (action) => {
//         let func = getValueObjectAt(action, ROUTE.namespace);
//         if (func !== null && typeof func === 'function') {
//             func();
//         }
//     }
// }
export const DATATABLE_LANG = {
    "decimal":        "",
    "emptyTable":     "Không có bản ghi",
    "info":           "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
    "infoEmpty":      "Không có bản ghi",
    "infoFiltered":   "(filtered from _MAX_ total entries)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Hiển thị _MENU_ bản ghi trên trang",
    "loadingRecords": "Đang tải...",
    "processing":     "Đang xử lý...",
    "search":         "Tìm kiếm:",
    "zeroRecords":    "Không tìm thấy bản ghi",
    "paginate": {
        "first":      "Đầu",
        "last":       "Cuối",
        "next":       "Tiếp",
        "previous":   "Trước"
    }
}