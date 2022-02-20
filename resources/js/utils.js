// ARRAY UTILS
export function toggleValueInArray(value, array) {
    let index = $.inArray(value, array);
    if (index === -1) {
        array.push(value);
    } else {
        array.splice(index, 1);
    }
}

// AJAX UTILS
export function setToken(selector = 'meta[name=csrf]') {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $(selector).attr('content')
        }
    });
}

// OBJECT UTILS
export function initElementFromSelector(elements, selectors) {
    for (let key in selectors) {
        if ($.type(selectors[key]) === 'string') {
            elements[key] = $(selectors[key]);
        } else if ($.type(selectors[key]) === 'object' && !$.isEmptyObject(selectors[key])) {
            elements[key] = {};
            initElementFromSelector(elements[key], selectors[key]);
        }
    }
}

export function getValueObjectAt(key, object) {
    if (typeof key !== 'string') {
        return null;
    }
    
    let keys = key.trim().split('.').map(k => k.trim());
    for (let k of keys) {
        if (k in object && typeof object === 'object') {
            object = object[k];
        } else {
            return null;
        }
    }
    return object;
}

// EXCEPTION UTILS
export function handleError(jqXHR, textStatus, errorThrow) {
    console.log(jqXHR);
    let status = jqXHR.status;
    let response = jqXHR.responseJSON;
    let title = textStatus.toUpperCase();
    let html = '';
    let message = '';
    let errors = '';
    message = ('message' in response) ? `<h5 class="text-danger">${response.message}</h5>` : '';
    if ('errors' in response) {
        errors = `
            <table class="table table-sm table-bordered mt-2">
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Error</th>
                </tr>
            </thead>
            <tbody>`;
        for (let field in response.errors) {
            errors += `
                <tr>
                    <td>${field}</td>
                    <td>${response.errors[field][0]}</td>
                </tr>`;
        }
        errors += `</tbody></table>`;
    }
    html = `<div>${message}${errors}</div>`;
    Swal.fire({
        title: title,
        html: `${html}`,
        icon: `error`
    });
};

export const whenType = function(selector, event, options = []) {
    $(document).on(event, selector, function(e) {
        let value = $(this).val();
        for (let option of options) {
            switch (option.toLowerCase()) {
                case 'lowercase':
                    value = value.toLowerCase();
                    break;
                case 'uppercase':
                    value = value.toUpperCase();
                    break;
                case 'trim':
                    value = value.trim();
                    break;
                default:
                    value = value;
                    break;
            }
        }
        $(this).val(value);
    });
}

// goi module can dung dua vao data-location tren the body
export const Route = {
    init: (namespace) => {
        Route.namespace = namespace;
        let action = $('body').data('action');
        Route.exec(action);
    },
    exec: (action) => {
        let func = getValueObjectAt(action, Route.namespace);
        if (func !== null && typeof func === 'function') {
            func();
        }
    }
}