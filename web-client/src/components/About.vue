<template>
    <div>
        <div class = 'container'>
            <div class = 'row'>
                <div class = 'col-md-12'>
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">About this</h4>
                        <p>
                            App created by Jorge Vega as part of the application for Asimov Consultores
                        </p>
                        <p>
                            If you want to check the list of saved appointments, to check if they have been stored, click <router-link to="/bookings">here</router-link>
                        </p>
                    </div>
                </div>

                <div class = 'col-md-12'>
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">VueJS - Used plugins</h4>
                        <ul>
                            <li>BootstrapVue </li>
                            <li>Vue-router </li>
                            <li>Vuex</li>
                            <li>Vee-validate </li>
                            <li>Vue-resource </li>
                            <li>BlockUI </li>
                            <li>Vue-bootstrap-datetimepicker</li>
                            <li>Vuetable-2</li>
                            <li>Vue-js-modal</li>
                            <li>Vueawesome</li>
                        </ul>
                    </div>
                </div>

                <div class = 'col-md-12'>
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">API REST - Information</h4>
                        <ul>
                            <li>Used language: PHP 7.1</li>
                            <li>Framework: Laravel 5.7</li>
                            <li>Database: MariaDB </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class = "row">
                <div class ="col-md-12">
                    <button type="button" class="btn btn-primary btn-lg btn-block" v-on:click="toHome()">Back to the start</button>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    methods : {
        toHome(){
            this.$router.replace('/');
        },
        toList(){
            this.$router.replace('/bookings');
        }
    }
}
</script>
