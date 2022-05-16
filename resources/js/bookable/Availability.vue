<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bold">
            <span>Check Availability</span>
            <span v-if="noAvailability" class="text-danger">(NOT AVAILABILE)</span>
            <span v-if="hasAvailability" class="text-success">(AVAILABILE)</span>
        </h6>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="from">From</label>
                <input 
                    @keyup.enter="check" 
                    type="date" 
                    v-model="from" 
                    class="form-control from-control-sm"
                    :class="[{'is-invalid': this.errorFor('from')}]">
                <div class="invalid-feedback" v-for="(error, index) in this.errorFor('from')" :key="'from' + index">
                    {{ error }}
                </div>
            </div>
            <div class="form-group col-md-12 mt-4">
                <label for="to">To</label>
                <input 
                    @keyup.enter="check" 
                    type="date" 
                    v-model="to" 
                    class="form-control from-control-sm"
                    :class="[{'is-invalid' : this.errorFor('to')}]">
                <div class="invalid-feedback" v-for="(error, index) in this.errorFor('to')" :key="'to' + index">
                    {{ error }}
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <button @click="check" class="btn btn-secondary btn-block w-100" :disabled="loading">Check</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        bookableId: String
    },

    data(){
        return {
            from: null,
            to: null,
            loading: false,
            errors: null,
            status: null
        }
    },

    methods: {
        check(){
            this.loading = true;
            this.errors = null;

            axios.get(`/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`)
                .then(response => {
                    this.status == response.status;
                })
                .catch(error => {
                    /** 422 for validation error */
                    if(422 === error.response.status)
                        this.errors = error.response.data.errors;

                    this.status = error.response.status;
                })
                .then(() => {
                    this.loading = false;
                })
        },

        errorFor(field){
            return this.hasErrors && this.errors[field] ? this.errors[field] : null;
        }
    },
    computed:{
        hasErrors(){
            return 422 === this.status && this.errors !== null;
        },

        hasAvailability(){
            return 200 === this.status;
        },

        noAvailability(){
            return 404 === this.status;
        }
    }
}
</script>

<style scoped>
label{
    font-size: 0.7em;
    text-transform: uppercase;
    color: gray;
    font-weight: bolder;
}
</style>