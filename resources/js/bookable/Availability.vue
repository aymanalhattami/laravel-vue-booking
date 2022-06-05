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
                <v-error :errors="errorFor('from')"></v-error>
            </div>
            <div class="form-group col-md-12 mt-4">
                <label for="to">To</label>
                <input 
                    @keyup.enter="check" 
                    type="date" 
                    v-model="to" 
                    class="form-control from-control-sm"
                    :class="[{'is-invalid' : this.errorFor('to')}]">
                <v-error :errors="errorFor('to')"></v-error>
            </div>

            <div class="col-md-12 mt-3">
                <button @click="check" class="btn btn-secondary btn-block w-100" :disabled="loading">Check</button>
            </div>
        </div>
    </div>
</template>

<script>
import { is422 } from "./../shared/utils/response";
import validationErrors from "../shared/mixins/validationErrors";

export default {
    mixins: [validationErrors],
    props:{
        bookableId: [String, Number]
    },

    data(){
        return {
            from: null,
            to: null,
            loading: false,
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
                    if(is422(error))
                        this.errors = error.response.data.errors;

                    this.status = error.response.status;
                })
                .then(() => {
                    this.loading = false;
                })
        },
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