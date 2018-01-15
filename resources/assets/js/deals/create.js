window.Vue = require('vue');

new Vue({
    el: '#v-deals-create',
    data: {
        //
        options: {
            elements: null,
            types: null, // from selected element
            sections: null, // from object id
            systems: null, // from selected type
        },

        //
        form: {
            outlay: document.querySelector("input[name='OUTLAY']").value,
            name: document.querySelector("#name").value,
            amount: document.querySelector("#amount").value,
            performer: document.querySelector("#performer").value,
            object: document.querySelector("#object").value,
            section: document.querySelector("#section").value,
            element: document.querySelector("#element").value,
            type: document.querySelector("#type").value,
            system: document.querySelector("#system").value,
        },

        //
        modal: {
            subtype: null,
            subtypeid: null,
            type: null,
            number: null,
            name: null,
        }
    },
    methods: {
        openModal: function (subtype, type) {
            this.modal.type = type;
            this.modal.subtype = subtype;
            this.modal.subtypeid = eval('this.form.' + subtype);
            window.$('#new_name_nr_modal').modal('show');
        },
        closeModal: function(){
            this.modal = {
                subtype: null,
                subtypeid: null,
                type: null,
                number: document.querySelector("#new_number").value,
                name: document.querySelector("#new_name").value,
            }
        },
        submitModal: function(){
            //
            alert('Ja pievienots aizver logu, ja nav pievienots tad atstāj atvērtu un parāda kļūdas');
        }
    },
    watch: {
        'options.elements': function (newVal, oldVal) {
            //  values
            var elemVal = document.querySelector("#element").value;
            // set element value
            this.form.element = elemVal;
            // reset values
            this.form.type = '';
            this.form.system = '';
            //  override if undefined
            if (elemVal === undefined) {
                this.form.element = '';
            }
        },
        'form.object': function (newVal, oldVal) {
            //
            var inst = this;

            //  reset values
            this.form.section = '';

            //
            var _id = this.form.object;

            //
            if (_id !== '' && !isNaN(_id)) {
                //
                window.loader('show');

                //  request for sections list by object id
                window.axios.get('/agent/sections/parent/' + _id)
                    .then(function (response) {
                        inst.options.sections = response.data;
                        //
                        window.loader('hide');
                    })
                    .catch(function (error) {
                        console.log(error);
                        //
                        window.loader('hide');
                        //
                        alert('Kļūda pārbaudiet datus');
                    });
            }
        },
        'form.element': function (newVal, oldVal) {
            //
            window.loader('show');
            //
            var inst = this;

            //  reset values
            this.form.type = '';
            this.form.system = '';

            //
            var _id = this.form.element;

            //
            if (_id !== '' && !isNaN(_id)) {
                //
                window.loader('show');

                //  request for types list by element id
                window.axios.get('/agent/types/parent/' + _id)
                    .then(function (response) {
                        inst.options.types = response.data;
                        //
                        window.loader('hide');
                    })
                    .catch(function (error) {
                        console.log(error);
                        //
                        window.loader('hide');
                        //
                        alert('Kļūda pārbaudiet datus');
                    });
            }
        },
        'form.type': function (newVal, oldVal) {
            //
            window.loader('show');
            //
            var inst = this;

            //  reset values
            this.form.system = '';

            //
            var _id = this.form.type;

            //
            if (_id !== '' && !isNaN(_id)) {
                //
                window.loader('show');

                //  request for systems list by type id
                window.axios.get('/agent/systems/parent/' + _id)
                    .then(function (response) {
                        inst.options.systems = response.data;
                        //
                        window.loader('hide');
                    })
                    .catch(function (error) {
                        console.log(error);
                        //
                        window.loader('hide');
                        //
                        alert('Kļūda pārbaudiet datus');
                    });
            }
        },
        'form.amount': function (newVal, oldVal) {
            if (this.form.amount >= 0) {
                this.form.outlay = 0;
            } else {
                this.form.outlay = 1;
            }
        }
    },
    computed: {

        validation: function () {
            return {
                NAME: !!this.form.name.trim(),
                PERFORMER: !!this.form.performer.trim(),
                AMOUNT: !!this.form.amount && !isNaN(this.form.amount),
                OBJECT: !!this.form.object && !isNaN(this.form.object),
                SECTION: !!this.form.section && !isNaN(this.form.section),
                ELEMENT: !!this.form.element && !isNaN(this.form.element),
                TYPE: !!this.form.type && !isNaN(this.form.type),
                SYSTEM: !!this.form.system && !isNaN(this.form.system),
            };
        },

        isValid: function () {
            //
            var validation = this.validation;
            return Object.keys(validation).every(function (key) {
                return validation[key];
            });
        }
    },
    mounted: function () {
        //
        var inst = this;

        //  request for elements list
        window.axios.get('/agent/elements')
            .then(function (response) {
                inst.options.elements = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });

        console.info('deals-create library loaded');
    }
});

document.querySelector("#v-deals-create form").addEventListener("submit", function (e) {
    //
    window.loader('show');
});