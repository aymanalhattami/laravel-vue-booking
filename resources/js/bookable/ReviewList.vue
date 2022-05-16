<template>
    <div class="d-none d-md-block">
        <h6 class="text-uppercase text-secondary font-weight-bolder">
            Reivew List
        </h6>

        <div v-if="loading">loading ...</div>
        <div v-else>
            <div
                class="border-bottom bg-white p-3 mb-2"
                v-for="(review, index) in reviews"
                :key="index"
            >
                <div class="row pt-2">
                    <div class="col-md-6">Ayman Mohammed</div>
                    <div class="col-md-6 d-flex justify-content-end">
                        {{ review.rating }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{ review.created_at }}
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-md-12">
                        {{ review.content }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        bookableId: String,
    },

    data() {
        return {
            loading: false,
            reviews: null,
        };
    },

    created() {
        this.loading = true;
        axios
            .get(`/api/bookables/${this.bookableId}/reviews`)
            .then((response) => (this.reviews = response.data))
            .then(() => this.loading = false);
    },
};
</script>
