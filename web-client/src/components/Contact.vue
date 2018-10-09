<template>
<div>
    <h5>Contact information</h5>
    <form  @submit.prevent="validateBeforeSubmit" action="#" class = "lefty" autocomplete="off">
        <div class = "row">
            <div class = "col-md-6">
                <div class = "form-group">
                    <label><strong>Date</strong></label>
                    <input type = "text" v-bind:value="date" class = "form-control" disabled="disabled"/>
                </div>
            </div>
            <div class = "col-md-6">
                <div class = "form-group">
                    <label><strong>Hour</strong></label>
                    <input type = "text" v-bind:value="hour" class = "form-control" disabled="disabled" />
                </div>
            </div>
            <div class = "col-md-12">
                <div class = "form-group">
                    <label :class="{ 'has-error' : errors.has('name')}"><strong>Name</strong></label>
                    <input type = "text" v-model="name" name = "name" class = "form-control" :class="{ 'has-error' : errors.has('name')}"  v-validate="'required'"/>
                    <span v-show="errors.has('name')" class="text-danger">
                        {{ errors.first('name') }}
                    </span>
                </div>
            </div>
            <div class = "col-md-12">
                <div class = "form-group">
                    <label :class="{ 'has-error' : errors.has('phonenumber')}"><strong>Phone Number</strong></label>
                    <input type = "text" v-model="phonenumber" name = "phonenumber" class = "form-control" :class="{ 'has-error' : errors.has('phonenumber')}"  v-validate="'required'"/>
                    <span v-show="errors.has('phonenumber')" class="text-danger">
                        {{ errors.first('phonenumber') }}
                    </span>
                </div>
            </div>
            <div class = "col-md-12">
                <div class = "form-group">
                    <label :class="{ 'has-error' : errors.has('email')}"><strong>Email</strong></label>
                    <input type = "text" v-model="email" name = "email" class = "form-control" :class="{ 'has-error' : errors.has('email')}"  v-validate="'required|email'"/>
                    <span v-show="errors.has('email')" class="text-danger">
                        {{ errors.first('email') }}
                    </span>
                </div>
            </div>
        </div>
        <div class = "row">
            <div class = "col-md-12">
                <button class = "btn btn-success">Schedule</button>
            </div>
        </div>
    </form>
    </div>
</template>

<style>
    .lefty {
        text-align: left;
    }

    .has-error{
        border-color: red;
        color: red;
    }
</style>


<script>
export default {
    name: 'contact',
    props: ['date', 'hour'],
    data(){
        return {
            name : "",
            phonenumber : "",
            email : ""
        }
    },
    methods: {
        validateBeforeSubmit () {
            this.$validator.validateAll()
                .then(result => {
                    if (!result){
                        //validation failed
                    }else{
                        this.$emit('saveHour', {
                            date : this.date,
                            hour : this.hour,
                            name : this.name,
                            phonenumber : this.phonenumber,
                            email : this.email
                        });
                    }
                })
                .catch(error => {
                    console.log(error);
                })
            }
    }
}
</script>
