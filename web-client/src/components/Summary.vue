<template>
    <div>
        <div class = 'container'>
            <div class = 'row'>
                <div class = 'col-md-12'>
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Successful booking</h4>
                        <p>Your reservation has been scheduled. Happy dance with death!</p>
                    </div>
                </div>
            </div>
            <div class = 'row'>
                <div class = 'col-md-12'>
                    <h5>Summary of the reservation</h5>

                    <table class = "table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <th>Date: </th>
                                <td>{{ summary.date }}</td>
                            </tr>
                            <tr>
                                <th>Hour: </th>
                                <td>{{ summary.hour }}</td>
                            </tr>
                            <tr>
                                <th>Name: </th>
                                <td>{{ summary.name }}</td>
                            </tr>
                            <tr>
                                <th>Phone Number: </th>
                                <td>{{ summary.phonenumber }}</td>
                            </tr>
                            <tr>
                                <th>Email: </th>
                                <td>{{ summary.email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class = "row">
                <div class ="col-md-6">
                    <button type="button" class="btn btn-primary btn-lg btn-block" v-on:click="toHome()">Back to the start</button>
                </div>
                <div class ="col-md-6">
                    <button type="button" class="btn btn-success btn-lg btn-block" v-on:click="toAbout()">About this</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex';

import store from '@/store';

export default {

    computed: {
        ...mapGetters({
            summary  : 'getSummary'
        })
    },
    beforeRouteEnter (to, from, next) {
        let keys = Object.keys(store.state.summary);
        if (keys.length == 0) {
            next('/');
        }

        next();
    },
    methods : {
        toHome(){
            this.$router.replace('/');
        },
        toAbout(){
            this.$router.replace('/about');
        }
    }
}
</script>
