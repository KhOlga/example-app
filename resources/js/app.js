require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Users from './modules/users';
import Roles from './modules/roles';

new Users();
new Roles();
