window.Vue = require('vue');

new Vue({
    el: '#v-deals-form',
    data: {
        //
        options: {
            objects: null,
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
            title: null,
            subtypeid: null,
            subtype: null,
            type: null,
            number: null,
            name: null,
        },

        //  if edit mode
        edit: false
    },
    methods: {
        resetForm: function () {
            //
            this.form = {
                outlay: '0',
                name: '',
                amount: '',
                performer: '',
                object: '',
                section: '',
                element: '',
                type: '',
                system: '',
            };
        },
        showLoader: function () {
            //
            window.loader('show');
        },
        hideLoader: function () {
            //
            window.loader('hide');
        },
        openModal: function (subtype, type, title) {
            //
            this.modal.title = title;
            this.modal.type = type;
            this.modal.subtype = subtype;
            if (this.modal.subtype !== '') {
                this.modal.subtypeid = eval('this.form.' + this.modal.subtype);
            }
            //
            window.$('#new_name_nr_modal').modal('show');
        },
        closeModal: function () {
            //  reset values
            this.modal = {
                title: null,
                subtype: null,
                subtypeid: null,
                type: null,
                number: null,
                name: null,
            }
            //
            window.$('#new_name_nr_modal').modal('hide');
        },
        submitModal: function () {
            /**
             *  Vispārējā funkcionalitāte
             *  Objects/Sections/Elements/Types/Systems
             */
                //  instance
            var inst = this;
            //
            var data = {
                nr: this.modal.number,
                name: this.modal.name
            };

            //
            if (!isNaN(this.modal.subtypeid) && this.modal.subtypeid !== '') {
                data.id = this.modal.subtypeid;
            }

            //
            if (this.modal.type) {
                //
                inst.showLoader();
                //
                axios.post('/agent/' + this.modal.type, data)
                    .then(function (response) {
                        var option = response.data;
                        var options = eval('inst.options.' + inst.modal.type);
                        //  add to vue - all options array
                        options.unshift(option);
                        //
                        inst.closeModal();
                        //
                        inst.hideLoader();
                        //
                    })
                    .catch(function (error) {
                        console.log(error);
                        //
                        inst.hideLoader();
                        //
                        alert("Kļūda pievienojot ierakstu!");
                    });
            }

            // alert('Ja pievienots aizver logu, ja nav pievienots tad atstāj atvērtu un parāda kļūdas');
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
                inst.showLoader();

                //  request for sections list by object id
                window.axios.get('/agent/sections/parent/' + _id)
                    .then(function (response) {
                        inst.options.sections = response.data;

                        //  edit
                        if (inst.edit && inst.edit.SECTIONS_ID  && !inst.form.section) {
                            inst.form.section = inst.edit.SECTIONS_ID;
                        }else{
                            //
                            inst.hideLoader();
                        }

                        //  load elements after auto 'sections' select. HERE - Because element action fot fire elements ajax call
                        if (inst.edit && inst.edit.ELEMENTS_ID && !inst.form.element) {
                            inst.form.element = inst.edit.ELEMENTS_ID;
                        }else{
                            //
                            inst.hideLoader();
                        }

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
            this.form.type = '';
            this.form.system = '';

            //
            var _id = this.form.element;

            //
            if (_id !== '' && !isNaN(_id)) {
                //
                inst.showLoader();

                //  request for types list by element id
                window.axios.get('/agent/types/parent/' + _id)
                    .then(function (response) {
                        inst.options.types = response.data;

                        //  edit
                        if (inst.edit && inst.edit.TYPES_ID && !inst.form.type) {
                            inst.form.type = inst.edit.TYPES_ID;
                        }else{
                            //
                            inst.hideLoader();
                        }

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
        'form.type': function (newVal, oldVal) {
            //
            var inst = this;

            //  reset values
            this.form.system = '';

            //
            var _id = this.form.type;

            //
            if (_id !== '' && !isNaN(_id)) {
                //
                inst.showLoader();

                //  request for systems list by type id
                window.axios.get('/agent/systems/parent/' + _id)
                    .then(function (response) {
                        inst.options.systems = response.data;

                        //  edit
                        if (inst.edit && inst.edit.SYSTEMS_ID && !inst.form.system) {
                            inst.form.system = inst.edit.SYSTEMS_ID;
                        }else{
                            //
                            inst.hideLoader();
                        }

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
        // 'form.amount': function (newVal, oldVal) {
        //     if (this.form.amount >= 0) {
        //         this.form.outlay = 0;
        //     } else {
        //         this.form.outlay = 1;
        //     }
        // },
        'form.system': function (newVal, oldVal) {
            //  null edit - because all data are loaded
            //  don't touch - if not nulled incorrect working after elemnt, type select
            if(this.edit){
                this.hideLoader();
            }
            //
            this.edit = false;
        },

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

        //
        this.showLoader();

        // deal id
        var exsist_id = window.location.pathname.split('/')[2]
        //
        if (exsist_id && !isNaN(exsist_id)) {
            //
            window.axios.get('/agent/deal/' + exsist_id)
                .then(function (response) {
                    inst.edit = response.data;
                    console.log(inst.edit);
                    //  edit - set main form data
                    if (inst.edit) {
                        inst.form.amount = inst.edit.AMOUNT;
                        inst.form.outlay = inst.edit.OUTLAY;
                        inst.form.name = inst.edit.NAME;
                        inst.form.performer = inst.edit.PERFORMER;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        //  request for objects list
        window.axios.get('/agent/objects')
            .then(function (response) {
                inst.options.objects = response.data;

                //  edit
                if (inst.edit && inst.edit.OBJECTS_ID  && !inst.form.object) {
                    inst.form.object = inst.edit.OBJECTS_ID;
                }
            })
            .catch(function (error) {
                console.log(error);
            });

        //  request for elements list
        window.axios.get('/agent/elements')
            .then(function (response) {
                inst.options.elements = response.data;

                //
                if(!inst.edit){
                    inst.hideLoader();
                }
            })
            .catch(function (error) {
                console.log(error);
                //
                inst.hideLoader();
            });

        console.info('deals-create library loaded');
    }
});