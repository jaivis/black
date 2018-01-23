window.Vue = require('vue');

new Vue({
    el: '#v-deals-filters',
    data: {
        //
        options: {
            types: [], // from selected element
            sections: [], // from object id
            systems: [], // from selected type
        },

        //
        form: {
            outlay: document.querySelector("#filter_outlay").value,
            name: document.querySelector("#filter_name").value,
            amount: document.querySelector("#filter_amount").value,
            performer: document.querySelector("#filter_performer").value,
            object: document.querySelector("#filter_objects").value,
            element: [],
            section: [],
            type: [],
            system: [],
        },

    },
    methods: {
        resetForm: function () {
            //
            this.form = {
                outlay: '',
                name: '',
                amount: '',
                performer: '',
                object: '',
                element: [],
                section: [],
                type: [],
                system: [],
            };
        },
        showLoader: function () {
            //
            window.loader('show');
        },
        hideLoader: function () {
            //
            window.loader('hide');
        }
    },
    watch: {
        //  start - set / remove names
        'form.outlay': function (newVal, oldVal) {
            //  vars
            var id = "#filter_outlay";
            var name = "filter[outlay]";
            //
            if (newVal !== '') {
                document.querySelector(id).setAttribute("name", name)
            } else {
                document.querySelector(id).removeAttribute("name")
            }
        },
        'form.amount': function (newVal, oldVal) {
            //  vars
            var id = "#filter_amount";
            var name = "filter[amount]";
            //
            if (newVal !== '') {
                document.querySelector(id).setAttribute("name", name)
            } else {
                document.querySelector(id).removeAttribute("name")
            }

            // //  ienākumi
            // if (this.form.amount > 0) {
            //     this.form.outlay = 0;
            // }
            // //  izdevumi
            // if (this.form.amount < 0) {
            //     this.form.outlay = 1;
            // }
            // //  tukšs
            // if (this.form.amount === '' || this.form.amount === 0) {
            //     this.form.outlay = '';
            // }
        },
        'form.name': function (newVal, oldVal) {
            //  vars
            var id = "#filter_name";
            var name = "filter[name]";
            //
            if (newVal !== '') {
                document.querySelector(id).setAttribute("name", name)
            } else {
                document.querySelector(id).removeAttribute("name")
            }
        },
        'form.performer': function (newVal, oldVal) {
            //  vars
            var id = "#filter_performer";
            var name = "filter[performer]";
            //
            if (newVal !== '') {
                document.querySelector(id).setAttribute("name", name)
            } else {
                document.querySelector(id).removeAttribute("name")
            }
        },
        //  end - set / remove names
        'form.object': function (newVal, oldVal) {
            /*  name set/remove start    */
            //  vars
            var id = "#filter_objects";
            var name = "filter[objects_id]";
            //
            if (newVal !== '') {
                document.querySelector(id).setAttribute("name", name)
            } else {
                document.querySelector(id).removeAttribute("name")
            }
            /*  name set/remove end    */

            //
            var inst = this;

            //  reset values
            this.form.section = [];
            this.options.sections = [];

            //
            var _id = this.form.object;

            //
            if (_id !== '' && !isNaN(_id)) {
                //
                inst.showLoader();

                //  request for sections list by object id
                window.axios.get('/agent/sections/parent/' + _id)
                    .then(function (response) {
                        //
                        inst.options.sections = response.data;
                        //
                        inst.hideLoader();
                    })
                    .catch(function (error) {
                        console.log(error);
                        //
                        inst.hideLoader();
                        //
                        alert('Kļūda pārbaudiet datus');
                    });
            }
        },
        'form.element': function (newVal, oldVal) {
            //
            var inst = this;

            //  reset values
            this.form.type = [];
            this.form.system = [];

            //
            var _ids = this.form.element;
            //
            if (Array.isArray(_ids)) {
                //
                var _new_options = [];
                //
                _ids.forEach(function (_id, index) {
                    //
                    if (_id !== '' && !isNaN(_id)) {
                        //
                        inst.showLoader();

                        //  request for types list by element id
                        window.axios.get('/agent/types/parent/' + _id)
                            .then(function (response) {
                                //
                                var _types = response.data;
                                //
                                if (Array.isArray(_types)) {
                                    ///
                                    _types.forEach(function (_item) {
                                        //
                                        _new_options.push(_item);
                                    });
                                }
                                //  kad pēdējais ieraksts tiek pabeigts, paslēpj loader
                                if (_ids.length == (index + 1)) {
                                    //
                                    inst.hideLoader();
                                }
                            })
                            .catch(function (error) {
                                console.log(error);
                                console.log('Kļūda pārbaudiet datus');
                                //
                                inst.hideLoader();
                            });
                    }
                });
                //
                inst.options.types = _new_options;
            }
        },
        'form.type': function (newVal, oldVal) {
            //
            var inst = this;

            //  reset values
            this.form.system = [];

            //
            var _ids = this.form.type;
            //
            if (Array.isArray(_ids)) {
                //
                var _new_options = [];
                //
                _ids.forEach(function (_id, index) {
                    //
                    if (_id !== '' && !isNaN(_id)) {
                        //
                        inst.showLoader();

                        //  request for types list by element id
                        window.axios.get('/agent/systems/parent/' + _id)
                            .then(function (response) {
                                //
                                var _types = response.data;
                                //
                                if (Array.isArray(_types)) {
                                    ///
                                    _types.forEach(function (_item) {
                                        //
                                        _new_options.push(_item);
                                    });
                                }
                                //  kad pēdējais ieraksts tiek pabeigts, paslēpj loader
                                if (_ids.length == (index + 1)) {
                                    //
                                    inst.hideLoader();
                                }
                            })
                            .catch(function (error) {
                                console.log(error);
                                console.log('Kļūda pārbaudiet datus');
                                //
                                inst.hideLoader();
                            });
                    }
                });
                //
                inst.options.systems = _new_options;
            }
        },
    },
    computed: {

        validation: function () {
            return {
                AMOUNT: ((this.form.amount).length != 0) ? !!this.form.amount && !isNaN(this.form.amount) : true,
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
        console.info('deals-filters library loaded');
    }
});