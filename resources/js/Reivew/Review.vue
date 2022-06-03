<template>
    <div class="row">
        <success v-if="success">
            Operation was successful, thank you so much
        </success>
        <fatal-error v-if="error"></fatal-error>

        <div class="row" v-if="!success && !error">
            <div :class="[{ 'col-md-4': twoColumns }, { 'd-none': oneColumn }]">
                <div class="card">
                    <div class="card-body">
                        <div v-if="loading">loading ...</div>
                        <div v-if="hasBooking">
                            <p>
                                Stayed at
                                <router-link :to="{
                                    name: 'bookable',
                                    params: { id: booking.bookable.id },
                                }">
                                    {{ booking.bookable.title }}
                                </router-link>
                            </p>
                            <p>from {{ booking.from }} to {{ booking.to }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div :class="[
                { 'col-md-8': twoColumns },
                { 'col-md-12': oneColumn },
            ]">
                <div v-if="loading">Loading ...</div>

                <div v-if="alreadyReviewed">
                    <h1>You've already left a review for this booking!</h1>
                </div>
                <div v-else>
                    <div class="form-gorup mb-4">
                        <label for="rating" class="text-muted mb-2">Select star rating (1 is the worst - 5 is the
                            best)</label>
                        <star-rating v-model="review.rating" class="fa fa-2x"></star-rating>
                    </div>

                    <div class="form-group my-2">
                        <label for="content" class="text-muted">Describe your experience</label>
                        <textarea class="form-control bg-white" name="content" id="" cols="30" rows="10"
                            v-model="review.content" :class="[{ 'is-invalid': errorFor('content') }]"></textarea>
                        <v-error :errors="errorFor('content')"></v-error>
                    </div>

                    <button class="btn btn-primary" @click.prevent="submit" :disabled="sending">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { is404, is422 } from "./../shared/utils/response";
import validationErrors from "../shared/mixins/validationErrors";
import Success from "../shared/components/Success.vue";

export default {
    mixins: [validationErrors],
    data() {
        return {
            review: {
                id: null,
                rating: 5,
                content: null,
            },
            existingReview: null,
            loading: false,
            sending: false,
            booking: null,
            error: false,
            success: false,
        };
    },
    async created() {
        this.review.id = this.$route.params.id;
        this.loading = true;
        try {
            this.existingReview = (await axios.get(`/api/reviews/${this.review.id}`)).data.data;
        }
        catch (err) {
            if (is404(err)) {
                try {
                    this.booking = (await axios.get(`/api/booking-by-review/${this.review.id}`)).data.data;
                }
                catch (error) {
                    this.error = !is404(err);
                }
            }
            else {
                this.error = true;
            }
        }
        this.loading = false;
    },
    computed: {
        alreadyReviewed() {
            return this.hasReview || !this.booking;
        },
        hasReview() {
            return this.existingReview !== null;
        },
        hasBooking() {
            return this.booking !== null;
        },
        oneColumn() {
            return !this.loading && this.alreadyReviewed;
        },
        twoColumns() {
            return this.loading || !this.alreadyReviewed;
        },
    },
    methods: {
        submit() {
            this.errors = null;
            this.sending = true;
            this.success = false;
            axios
                .post("/api/reviews", this.review)
                .then((response) => {
                this.success = 201 === response.status;
            })
                .catch((err) => {
                if (is422(err)) {
                    const errors = err.response.data.errors;
                    if (errors["content"] && _.size(errors) === 1) {
                        this.errors = errors;
                        return;
                    }
                }
                this.error = true;
            })
                .then(() => (this.sending = false));
        },
    },
    components: { Success }
};
</script>