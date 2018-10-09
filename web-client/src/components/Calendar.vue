<template>
    <div>
        <h5>Select the date you want to reserve </h5>
        <date-picker v-model="date" :config="options" @dp-change="ifDateChange"></date-picker>
    </div>
</template>

<script>
    import 'bootstrap/dist/css/bootstrap.css';
    
    import datePicker from 'vue-bootstrap-datetimepicker';
    
    import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
    
    export default {
        name: 'calendar',    
        data () {
            return {
                date: new Date(),
                options: {
                    format: 'DD/MM/YYYY',
                    useCurrent: false,
                    inline: true,
                    defaultDate: false
                }       
            }
        },
        components: {
            datePicker
        },
        methods : {
            ifDateChange(e){
                let date = this.getFormatDate(e);
                this.$emit('changeDate', date);
            },
            getFormatDate(e){
                let year  = e.date.year();
                let month = ((e.date.month() + 1) > 9) ? (e.date.month() + 1) : ('0' + (e.date.month() + 1));
                let day   = (e.date.date() > 9) ? e.date.date() : ('0' + e.date.date());

                return year + '-' + month + '-' + day;
            }
        }
    }
</script>
