<template>
<div>
    <div class = "container">
        <div class = "row">
            <div class = "col-md-12">
                <button type = "button" class = "btn btn-primary float-left" v-on:click="goBack()">Go Back</button>
            </div>
            <div class = "col-md-12">
                <Booking-table></Booking-table>
            </div>
        </div>
    </div>
</div>
</template>

<script>

import Vue from 'vue';
import Datatable from '@/components/datatable/Datatable'

import CustomActions from '@/components/datatable/CustomActions'

import { mapGetters } from 'vuex';
import { mapMutations } from 'vuex';

Vue.component('custom-actions', CustomActions)

let BookingTable = {
    mixins:[Datatable],
    data () {
        return {
            dataurl : Vue.http.options.root + '/appointments/read',
            fields : ['date', 'hour', 'name', 'phonenumber', 'email', 
            {
                name: '__component:custom-actions',   // <----
                title: 'Actions',
                titleClass: 'center aligned',
                dataClass: 'center aligned'
            }]
        }
    },
    computed : {
        ...mapGetters({
            recharge  : 'getRecharge'
        })
    },
    watch: {
        recharge(val, oldval) {    
           Vue.nextTick( () => this.$refs.vuetable.refresh());
        }
    },
    methods: {
        ...mapMutations({
            setRecharge  : 'setRecharge'
        })
    }
    
}

export default {
    components:{
        BookingTable
    },
    methods: {
        goBack (){
            this.$router.replace('/about');
        },
        actionButton(){
            return ''
        }
    }
}
</script>
