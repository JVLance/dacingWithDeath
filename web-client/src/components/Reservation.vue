<template>
    <div class = 'container'>
        <div class = 'row'>
            <div class = 'col-md-4'>
                <calendar @changeDate="setDate"></calendar>
            </div>
            <div class = 'col-md-4' v-if="!processing && !locked">
                <hours v-bind:listhours = 'hours' @setHour="setHour"></hours>
            </div>
            <div class = 'col-md-4' v-if="!processing && locked && !first">
                <center><h5>There are no appointments for weekends</h5></center>
            </div>
            <div class = 'col-md-4' v-if="!processing && currentHour != null && !locked">
                <contact  @saveHour="schedule" v-bind:date = "date" v-bind:hour = "currentHour"></contact>
            </div>
        </div>
    </div>
</template>



<script>

import Calendar from '@/components/Calendar'
import Hours from '@/components/Hours'
import Contact from '@/components/Contact'
import { mapGetters } from 'vuex';
import { mapMutations } from 'vuex';
import { mapActions } from 'vuex';

export default {
    components : {Calendar, Hours, Contact},
    data () {
        return {
            locked : true,
            first : true
        }
    },
    computed: {
        ...mapGetters({
            date  : 'getCurrentDate',
            hours : 'getHours',
            currentHour : 'getCurrentHour',
            processing: 'getProcessing'
        })
    },
    methods: {
        ...mapMutations({
            chargeHours : 'chargeHours',
            selectHour  : 'selectHour',
            setSummary  : 'setSummary'
        }),
        ...mapActions({
            fetchHours : 'fetchHours',
            saveHour   : 'saveHour'
        }),
        setDate(date){
            this.first = false;
            
            this.selectHour({ hour: null });

            if (this.ifWeekend(date)){
                this.locked = true;
                return;
            }

            this.locked = false;
            this.fetchHours(date);
        },
        setHour(hour){
            this.selectHour({ hour : hour });
        },
        ifWeekend(largedate){
            let date = this.generateDate(largedate);
            return (date.getDay() == 0 || date.getDay() == 6);
        },
        generateDate(largedate){
            
            let params = largedate.split('-');

            let date=new Date();
            date.setDate(params[2]);
            date.setMonth(params[1] - 1);
            date.setYear(params[0]);
            return date;
        },
        schedule (hour){
            this.saveHour(hour).then(response => {
                if (response.response == 'success'){
                    this.setSummary(hour);
                    this.$router.replace('/summary');
                }else{
                    this.modalError(response.Message);
                }
            }, error => {
              this.modalError();  
            });
        },
        modalError(error){
            error = typeof(error) == 'undefined' ? 'A server-side problem occurred. Try again.' : error;

            this.$modal.show('dialog', {
                title: 'Could not schedule',
                text: error,
                buttons: [
                    {
                        title: 'Close'
                    }
                ]
            })
        }
    }
}
</script>

