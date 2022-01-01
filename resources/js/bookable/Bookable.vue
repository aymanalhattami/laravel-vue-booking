<template>
    <div class="">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div v-if="!loading">
                        <div class="card-header">
                            <h4>{{ bookable.title }}</h4>
                        </div>
                        <div class="card-body">
                            <article>
                                {{ bookable.description }}
                            </article>
                        </div>
                    </div>
                    <div v-else>Loading ...</div>
                </div>
            </div>
            <div class="col-md-4">
                <availability></availability>    
            </div>
        </div>
    </div>
</template>

<script>
import Availability from './Availability';

export default{
    components: {
        Availability
    },

    data(){
        return {
            bookable: null,
            loading: false,
        }
    },

    created(){
        this.loading = true;

        axios
            .get(`/api/bookables/${this.$route.params.id}`)
            .then(response => {
                this.bookable = response.data;
                this.loading = false;
            });
    }
}
</script>
