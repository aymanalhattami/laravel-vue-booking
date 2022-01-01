<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bold">
            <span>Check Availability</span>
        </h6>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="from">From</label>
                <input @keyup.enter="check" type="text" v-model="from" class="form-control from-control-sm">
            </div>
            <div class="form-group col-md-6">
                <label for="to">To</label>
                <input @keyup.enter="check" type="text" v-model="to" class="form-control from-control-sm">
            </div>

            <div class="col-md-12 mt-3">
                <button @click="check" class="btn btn-secondary btn-block w-100">Check</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            from: null,
            to: null
        }
    },

    methods: {
        check(){
            alert('here');
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