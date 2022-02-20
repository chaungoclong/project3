require('./bootstrap');
// DISPLAY MENU SIDEBAR ACTIVED
// let url = window.location;
// // for single sidebar menu
// $('ul.nav-sidebar a').filter(function() {
//     return this.href == url;
// }).addClass('active');
// // for sidebar menu and treeview
// $('ul.nav-treeview a').filter(function() {
//     return this.href == url;
// }).parents(".nav-treeview, .nav-item:has(.nav-treeview)").css({
//     'display': 'block'
// }).addClass('menu-open').prev('a').addClass('active');

import { Route } from './utils.js';
import * as RoleModule from './role/role-module.js';

// chay app
$(function() {
    const APP = {
        admin: {
            role: {
                index: RoleModule.IndexPage.init,
                create: RoleModule.CreatePage.init,
                edit: RoleModule.EditPage.init,
            },
        },
    };

    Route.init(APP);
});
