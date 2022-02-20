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