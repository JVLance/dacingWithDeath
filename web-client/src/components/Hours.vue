<template>
    <div>
        <h5>Select a time to reserve</h5>
        <select size = '9' v-model="selectedHour" class = "form-control maxime" v-on:click="setHour()">
            <option v-for="hour in listhours" v-bind:value = "hour">
                {{ hour }}
            </option>

            <option v-if="ifHoursIsEmpty" value = "0"> There are no hours available for this day</option>
        </select>
    </div>
</template>

<style>
    .maxime {
        width:100%;
        min-height:300px;
    }
</style>



<script>
export default {
    name: 'hours',
    props: {
        listhours: { type: Array, required: true }
    },
    data (){
        return {
            selectedHour: null
        }
    },
    computed: {
        ifHoursIsEmpty(){
            return (this.listhours.length == 0);
        }
    },
    methods: {
        setHour(){
            if (this.selectedHour == 0){
                return;
            }
            this.$emit('setHour', this.selectedHour);
        },
        ifHourSelected(hour){
            return (hour == this.selectedHour);
        }
        
    }
}
</script>
