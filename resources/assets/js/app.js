require('./bootstrap');

window.Vue = require('vue');
window.TWEEN = require('@tweenjs/tween.js');

require('./load-components');
import User from './models/user';
import Content from './models/content';

const app = new Vue({
    el: '#app',
    data: {
        user: new User({
            id: null,
            name: null,
            email: null,
            cell_phone: null,
            office_phone: null,
            primary_phone: null,
            company: null,
            address: null,
            mls_id: null,
        }),
        content: new Content({
            id: '',
            title: null,
            body: null
        }),
        selected: 'leads',
        activeLeadsCount: 0,
        viewState: ''
    },
    computed: {
        boilerplate: function () {
            return this.user.name === '';
        },
        viewType: function () {
            return (this.viewState === '' ? 'grid' : this.viewState)
        }
    },
    mounted () {
        this.user.authenticate();
        this.content.fetch();
        this.updateLeadsCount();
    },
    methods: {
        sbc (data) {
            this.user.update(data);
        },
        updateContent(data) {
            this.content.update(data);
        },
        updateLeadsCount() {
            window.axios.get('/leads/count')
                .then(response => {
                    this.activeLeadsCount = response.data;
                });
        },
        switchView(){
            this.viewState = (this.viewState === 'map' || this.viewState === '' ? 'grid' : 'map');
        }
    }
});
